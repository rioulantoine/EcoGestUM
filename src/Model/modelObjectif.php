<?php
require_once __DIR__ . '/modelBDD.php';
// Récupère tous les objectifs de développement durable avec leur statut
function getObjectifs() {
    $pdo= get_bdd();
    $sql = "
        SELECT 
            obj.id_objectif,
            obj.nom_objectif,
            obj.desc_objectif,
            obj.date_ajout_objectif,
            statut.nom_statut_objectif AS statut
        FROM
            OBJECTIF_DEVELOPPEMENT_DURABLE AS obj
        INNER JOIN
            STATUT_OBJECTIF AS statut
            ON obj.id_statut_objectif = statut.id_statut_objectif
        ORDER BY
            obj.id_objectif ASC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
