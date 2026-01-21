<?php
require_once __DIR__ . '/../Model/ModelChefDep.php';
$id_ut = $_SESSION['user']['id_ut'];
$id_dept = get_idDept($id_ut);

if (!$id_dept) {
    echo "Erreur : Aucun département associé à cet utilisateur.";
    exit;
}
// Récupération du mois et année (depuis URL ou actuel)
$mois = isset($_GET['mois']) ? (int)$_GET['mois'] : date('n');
$annee = isset($_GET['annee']) ? (int)$_GET['annee'] : date('Y');
$nom_mois = getNomMois($mois);

// Récupération des statistiques
$stats_mois_actuel = getStatsMois($mois, $annee, $id_dept);
$repartition = getRepartitionObjetsParCategorieDept($id_dept);

?>