<?php
require_once __DIR__ . '/../Model/modelStatistiqueRapport.php';
require_once __DIR__ . '/../Model/modelBDD.php';


$id_ut = $_SESSION['user']['id_ut'];
$id_dept = get_idDept($id_ut);

$data = getRepartitionObjetsParCategorieDept($id_dept);
$nb_objets_recycles = get_nb_objets_recycles_dept($id_dept);
$mois = date('n');
$annee = date('Y');
$nb_nouv_obj = getNewObjParMoisDept($mois, $annee, $id_dept);
$nb_donateurs = get_nb_donateurs_dept($id_dept);


?>