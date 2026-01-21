<?php
require_once __DIR__ . '/../Model/modelStatistiqueRapport.php';
$data = getRepartitionObjetsParCategorie();
$nb_objets_recycles = get_nb_objets_reserves();
$nb_nouv_obj = getNewObjParMoisAuto();
$mois = date('n');
$annee = date('Y');
?>