<?php

require_once __DIR__ . '/../Model/modelCommunication.php';

$message = '';
$messagesup = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!isset($_SESSION['user']['id_ut'])) {
        $_SESSION['error'] = "Vous devez être connecté.";
        header('Location: ' . getenv('BASE_URL') . 'connexion');
        exit();
    }

    $titre = $_POST['titre'] ?? '';
    $contenu = $_POST['description'] ?? '';
    $id_ut = $_SESSION['user']['id_ut'];
    
    // Validation des champs
    if (empty($titre) || empty($contenu)) {
        $_SESSION['error'] = "Veuillez remplir tous les champs obligatoires.";
    } else {
        // Ajouter la communication
        if (ajouterCommunication($titre, $contenu, $id_ut)) {
            $message = "Communication envoyée avec succès !";
        } else {
            $message = "Erreur lors de l'envoi de la communication.";
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_comm'])) {
    if (supprimerCommunication($_POST['id_comm'])) {
        $messagesup = "Communication supprimée avec succès.";
    } else {
        $messagesup = "Erreur lors de la suppression de la communication.";
    }

    

    }
}
$communications = getCommunications(); 
?>