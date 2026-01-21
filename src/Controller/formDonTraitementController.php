<?php
require_once __DIR__ . '/../Model/ModelFormDonTraitement.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categorie    = $_POST['categorie'] ?? '';
    $nom          = trim($_POST['nom'] ?? '');
    $description  = trim($_POST['description'] ?? '');
    $localisation = trim($_POST['localisation'] ?? '');
    $etat         = $_POST['etat'] ?? '';

    if (
        !$categorie || !$nom || !$description ||
        !$localisation || !$etat || !isset($_FILES['photos'])
    ) {
        $error_message = "Veuillez remplir tous les champs obligatoires.";
    }

    // Upload images dans imgCache
    $photoNamesSaved = [];
    if (!$error_message && isset($_FILES['photos']) && is_array($_FILES['photos']['name'])) {
        $upload_dir = __DIR__ . '/../../src/assets/imgCache/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        foreach ($_FILES['photos']['name'] as $index => $filename) {
            if ($_FILES['photos']['error'][$index] === UPLOAD_ERR_NO_FILE) continue;
            $tmp_name = $_FILES['photos']['tmp_name'][$index];
            $type     = $_FILES['photos']['type'][$index];

            $valid_types = ['image/jpeg', 'image/png'];
            if (!in_array($type, $valid_types)) {
                $error_message = "Seuls les fichiers JPEG et PNG sont acceptés.";
                break;
            }
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $unique_name = uniqid("photo_don_") . '.' . $ext;
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
        $id_user = $_SESSION['user']['id_ut'];
        $idinv = get_inventaire_by_idut($id_user);

        $id_objet = ajouter_objet_recyclable($categorie, $nom, $description, $localisation, $etat, $idinv);
        if ($id_objet) {
            foreach ($photoNamesSaved as $file) {
                ajouter_photo_objet($id_objet, $file); // Doit gérer TABLE PHOTO + PHOTO_OBJET
            }
            envoyer_notification($_SESSION['user']['id_ut'],"Votre objet a été ajouté avec succès à la plateforme ! Merci pour votre don.",4);
            header('Location: espace-reprise?success=don');
            exit;
        } else {
            $error_message = "Erreur lors de l’enregistrement de l’objet.";
        }
    }

    $_SESSION['formDon_error'] = $error_message;
    header('Location: formDon');
    exit;
} else {
    header("Location: formDon");
    exit;
}
?>
