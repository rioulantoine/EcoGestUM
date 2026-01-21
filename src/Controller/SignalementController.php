<?php
require_once __DIR__ . '/../Model/modelBDD.php';
require_once __DIR__ . '/../Model/ModelSignalement.php';
require_once __DIR__ . '/../Model/ModelReservations.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idres = $_POST['idres'] ?? '';
    $description = trim($_POST['description'] ?? '');

    // Validation
    if (!$idres || !$description || !isset($_FILES['photos']) || empty($_FILES['photos']['name'][0])) {
        $error_message = "Veuillez remplir tous les champs et ajouter une photo.";
    }

    // Upload et insertion BDD
    $photoNamesSaved = [];
    if (!$error_message && isset($_FILES['photos']) && is_array($_FILES['photos']['name'])) {
        $upload_dir = __DIR__ . '/../../src/assets/imgCache/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        foreach ($_FILES['photos']['name'] as $index => $filename) {
            if ($_FILES['photos']['error'][$index] === UPLOAD_ERR_NO_FILE) continue;
            $tmp_name = $_FILES['photos']['tmp_name'][$index];
            $type = $_FILES['photos']['type'][$index];

            $valid_types = ['image/jpeg', 'image/png'];
            if (!in_array($type, $valid_types)) {
                $error_message = "Seuls les fichiers JPEG et PNG sont acceptés.";
                break;
            }
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $unique_name = uniqid("photo_signalement_") . '.' . $ext;
            $destination = $upload_dir . $unique_name;

            if (!move_uploaded_file($tmp_name, $destination)) {
                $error_message = "Erreur lors de l’upload des images.";
                break;
            }
            $photoNamesSaved[] = $unique_name;
        }
        if (!$photoNamesSaved) {
            $error_message = "Au moins une photo valide est requise.";
        }
    }

    if (empty($error_message)) {
        if (inserer_signalement_objet($description, $idres, $photoNamesSaved)) {
            $_SESSION['signalement_success'] = "Signalement enregistré avec succès.";
            envoyer_notification( $_SESSION['user']['id_ut'],"Votre signalement a bien été enregistré. Merci pour votre contribution.",3);
            header('Location: espace-reprise?success=signalement');
            exit;
        } else {
            $error_message = "Erreur lors de l’enregistrement du signalement.";
        }
    }

    $_SESSION['signalement_error'] = $error_message;
    header('Location: signalementObj');
    exit;
}

$error_message = $_SESSION['signalement_error'] ?? '';
unset($_SESSION['signalement_error']);
$user_id = $_SESSION['user']['id_ut'] ?? null;
$reservations = $user_id ? get_user_reservations_sans_signalement($user_id) : [];
?>
