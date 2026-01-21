<?php
require_once __DIR__ . '/../Model/modelUtilisateur.php';

$user_id = $_SESSION['user']['id_ut'] ?? null;
$user = null;
$error_message = '';
$success_message = '';

if ($user_id) {
    // Modification email
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_email'])) {
        $new_email = trim($_POST['new_email']);
        if (filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            update_user_email($user_id, $new_email);
            $success_message = "E-mail modifié avec succès !";
        } else {
            $error_message = "E-mail invalide.";
        }
    }
    $user = get_user_info($user_id);
}
?>
