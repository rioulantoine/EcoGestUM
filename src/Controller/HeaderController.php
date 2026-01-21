<?php
require_once __DIR__ . '/../Model/modelUtilisateur.php';

$user_id = $_SESSION['user']['id_ut'] ?? null;

// URL de base
$baseUrl = getenv('BASE_URL');

// Si l'utilisateur est connecté, on laisse chaque lien aller vers sla page
if ($user_id) {
    $redirect_espace_reprise = $baseUrl . 'espace-reprise';
    $redirect_evenements     = $baseUrl . 'evenements';
    $redirect_messagerie     = $baseUrl . 'messagerie';
} else {
    $redirect_espace_reprise = $baseUrl . 'connexion';
    $redirect_evenements     = $baseUrl . 'connexion';
    $redirect_messagerie     = $baseUrl . 'connexion';
}
?>
