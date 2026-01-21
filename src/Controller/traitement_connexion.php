<?php
require_once __DIR__ . '/../Model/modelUtilisateur.php';

if (!empty($_POST['email']) && !empty($_POST['motdepasse'])) {
    $email = $_POST['email'];
    $mdp = $_POST['motdepasse'];

    $user = connexion_utilisateur($email, $mdp);

    if ($user) {
        $_SESSION['isConnected'] = true; 

        $_SESSION['user'] = [
            'id_ut' => $user['id_ut'],
            'nom_ut' => $user['nom_ut'],
            'prenom_ut' => $user['pren_ut'],
            'email_ut' => $user['email_ut'],
            'roles' => $user['roles'],
            'id_dept' => $user['id_dept'] ?? null
        ];
        header('Location: '.$_ENV['BASE_URL']);
        exit();
    } else {
        // Erreur de login : message en session + redirection propre
        $_SESSION['connexion_error'] = "Email ou mot de passe incorrect.";
        header('Location: '.$_ENV['BASE_URL'].'connexion');
        exit();
    }
} else {
    $_SESSION['connexion_error'] = "Veuillez remplir tous les champs.";
    header('Location: '.$_ENV['BASE_URL'].'connexion');
    exit();
}

?>
