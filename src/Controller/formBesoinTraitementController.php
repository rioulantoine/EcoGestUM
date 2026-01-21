<?php

require_once __DIR__ . '/../Model/modelDemandeObjet.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categorie = $_POST['categorie_besoin'];
    $nom = $_POST['nom_besoin'];
    $desc = $_POST['description_besoin'];
    $localisation = $_POST['localisation_besoin'];
    $raison = $_POST['raison_besoin'];
    $date = date('Y-m-d');
    $idStatut = 1; // "En attente de réponse"
    $idUtilisateur = $_SESSION['user']['id_ut'];

    $description_complete = "[Raison] " . $raison . "\n" . $desc;

    ajouterDemandeObjet($categorie, $nom, $description_complete, $date, $localisation, $idStatut, $idUtilisateur);

    header("Location: ?page=espace-reprise&success=besoin");
    exit();
} else {
    header("Location: ?page=espace-reprise");
    exit();
}

?>