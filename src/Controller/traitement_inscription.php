<?php
require_once __DIR__ . '/../Model/modelUtilisateur.php';

function motdepasse_invalide($mdp, $mdp2) {
    $err = [];
    if (strlen($mdp) < 8) $err[] = "Le mot de passe doit contenir au moins 8 caractères";
    if (!preg_match('/[a-z]/', $mdp)) $err[] = "Le mot de passe doit contenir au moins une minuscule";
    if (!preg_match('/[0-9]/', $mdp)) $err[] = "Le mot de passe doit contenir au moins un chiffre";
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $mdp)) $err[] = "Le mot de passe doit contenir au moins un caractère spécial (!@#$%^&*(),.?\":{}|<>)";
    if ($mdp !== $mdp2) $err[] = "Les mots de passe sont différents";
    return $err;
}

if (
    !empty($_POST['email']) &&
    !empty($_POST['nom']) &&
    !empty($_POST['prenom']) &&
    !empty($_POST['motdepasse']) &&
    !empty($_POST['confirmer_mdp']) &&
    !empty($_POST['iduniv']) &&
    !empty($_POST['idcomp']) &&
    !empty($_POST['iddept'])
) {
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['motdepasse'];
    $mdp2 = $_POST['confirmer_mdp'];
    $idrole = 4; // étudiant par défaut
    $iduniv = $_POST['iduniv'];
    $idcomp = $_POST['idcomp'];
    $iddept = $_POST['iddept'];

    // Vérification mot de passe
    $errors = motdepasse_invalide($mdp, $mdp2);

    // Vérification email déjà utilisé AVANT la création
    if (email_existe($email)) {
        $errors[] = "Cet email est déjà inscrit.";
    }


    if (empty($errors)) {
        $result = inscription_utilisateur($nom, $prenom, $email, $mdp, $iduniv, $idcomp, $iddept, $idrole);

        if ($result) {
            header('Location: ' . $_ENV['BASE_URL'] . 'connexion');
            exit();
        } else {
            $errors[] = "Erreur lors de l'inscription. Essayez un autre email.";
        }
    }

    // S'il y a des erreurs
    if (!empty($errors)) {
        // On stocke l'erreur en session pour l'afficher ensuite
        $_SESSION['inscription_error'] = $errors;
        header('Location: ' . $_ENV['BASE_URL'] . 'inscription');
        exit();
    }

} else {
    $_SESSION['inscription_error'] = ["Tous les champs sont obligatoires."];
    header('Location: ' . $_ENV['BASE_URL'] . 'inscription');
    exit();
}
?>
