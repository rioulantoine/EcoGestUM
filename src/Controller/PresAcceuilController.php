<?php
require_once __DIR__ . '/../Model/ModelPresidence.php';

// Récupération du mois et année (depuis URL ou actuel)
$mois = isset($_GET['mois']) ? (int)$_GET['mois'] : date('n');
$annee = isset($_GET['annee']) ? (int)$_GET['annee'] : date('Y');
$nom_mois = getNomMois($mois);

// Récupération des statistiques pour le mois sélectionné
$stats_mois_actuel = getStatsMoisUniversite($mois, $annee);
$nb_nouv_obj = $stats_mois_actuel['nouveaux_objets'];
$nb_obj_recycles = $stats_mois_actuel['objets_recycles'];
$nb_events = $stats_mois_actuel['evenements'];

// Variables vides pour la compatibilité du JS (diagramme non utilisé)
$repartition = [];
?>
