<?php
require_once __DIR__ . '/modelStatistiqueRapport.php';
function get_idDept($id_ut){
    $pdo = get_bdd();
    
    // Le chef a directement id_dept dans UTILISATEUR
    $sql = "SELECT id_dept FROM UTILISATEUR WHERE id_ut = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_ut]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result ? $result['id_dept'] : null;
}

function getRepartitionObjetsParCategorieDept($id_dept) {
    $pdo = get_bdd();
    
    // OBJET_RECYCLABLE a un champ id_dept directement
    $sql = "
        SELECT 
            cat.nom_cat_obj,
            COUNT(o.id_obj_recycl) as nombre
        FROM OBJET_RECYCLABLE o
        INNER JOIN INVENTAIRE inv ON o.id_inv = inv.id_inv
        INNER JOIN DEPARTEMENT d ON inv.id_inv = d.id_inv
        INNER JOIN CATEGORIE_OBJET cat ON o.id_cat_obj = cat.id_cat_obj
        WHERE d.id_dept = ?
        GROUP BY cat.id_cat_obj, cat.nom_cat_obj
        ORDER BY nombre DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_dept]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getStatsMois($mois, $annee, $id_dept) {
    $pdo = get_bdd();
    
    // Nouveaux objets via INVENTAIRE
    $sql_nouveaux = "
        SELECT COUNT(*) 
        FROM OBJET_RECYCLABLE o
        INNER JOIN INVENTAIRE inv ON o.id_inv = inv.id_inv
        INNER JOIN DEPARTEMENT d ON inv.id_inv = d.id_inv
        WHERE MONTH(o.date_obj_recycl) = ? 
        AND YEAR(o.date_obj_recycl) = ? 
        AND d.id_dept = ?
    ";
    $stmt = $pdo->prepare($sql_nouveaux);
    $stmt->execute([$mois, $annee, $id_dept]);
    $nouveaux_objets = $stmt->fetchColumn();
    
   $sql_recycles = "
    SELECT COUNT(*) 
    FROM OBJET_RECYCLABLE o
    INNER JOIN INVENTAIRE inv ON o.id_inv = inv.id_inv
    INNER JOIN DEPARTEMENT d ON inv.id_inv = d.id_inv
    WHERE MONTH(o.date_obj_recycl) = ? 
    AND YEAR(o.date_obj_recycl) = ? 
    AND o.id_statut_recyclage_obj = 2 
    AND d.id_dept = ?
";

    $stmt = $pdo->prepare($sql_recycles);
    $stmt->execute([$mois, $annee, $id_dept]);
    $objets_recycles = $stmt->fetchColumn();
    
    // Événements (via UNIVERSITE, pas de lien direct avec département)
    // On prend tous les événements de l'université pour le moment
    $sql_events = "
        SELECT COUNT(*) 
        FROM EVENEMENT e
        INNER JOIN UNIVERSITE u ON e.id_univ = u.id_univ
        WHERE MONTH(e.date_event) = ? 
        AND YEAR(e.date_event) = ?
    ";
    $stmt = $pdo->prepare($sql_events);
    $stmt->execute([$mois, $annee]);
    $events = $stmt->fetchColumn();
    
    return [
        'nouveaux_objets' => $nouveaux_objets,
        'objets_recycles' => $objets_recycles,
        'evenements' => $events
    ];
}

function get_nb_objets_recycles_dept($id_dept) {
    $pdo = get_bdd();
    $sql = "
        SELECT COUNT(*)
        FROM OBJET_RECYCLABLE o
        INNER JOIN INVENTAIRE inv ON o.id_inv = inv.id_inv
        INNER JOIN DEPARTEMENT d ON inv.id_inv = d.id_inv
        WHERE o.id_statut_recyclage_obj = 2
        AND d.id_dept = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_dept]);
    return $stmt->fetchColumn();
}
function getNewObjParMoisDept($mois, $annee, $id_dept) {
    $pdo = get_bdd();
    $sql = "
        SELECT COUNT(*)
        FROM OBJET_RECYCLABLE o
        INNER JOIN INVENTAIRE inv ON o.id_inv = inv.id_inv
        INNER JOIN DEPARTEMENT d ON inv.id_inv = d.id_inv
        WHERE MONTH(o.date_obj_recycl) = ?
        AND YEAR(o.date_obj_recycl) = ?
        AND d.id_dept = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mois, $annee, $id_dept]);
    return $stmt->fetchColumn();
}
function get_nb_donateurs_dept($id_dept) {
    $pdo = get_bdd();
    // Récupérer l'id de l'inventaire du département
    $sql = "
        SELECT COUNT(DISTINCT fd.id_ut)
        FROM FORMULAIRE_DONATION fd
        INNER JOIN OBJET_RECYCLABLE o ON fd.id_obj_recycl = o.id_obj_recycl
        INNER JOIN INVENTAIRE inv ON o.id_inv = inv.id_inv
        INNER JOIN DEPARTEMENT d ON inv.id_inv = d.id_inv
        WHERE d.id_dept = ?
          AND fd.id_ut IS NOT NULL
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_dept]);
    return $stmt->fetchColumn();
}
?>
