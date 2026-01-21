<?php
require_once __DIR__ . '/modelStatistiqueRapport.php';

//Récupère les statistiques mensuelles pour l'université
function getStatsMoisUniversite($mois, $annee) {
    $pdo = get_bdd();
    
    // Nouveaux objets du mois
    $sql_nouveaux = "
        SELECT COUNT(*) 
        FROM OBJET_RECYCLABLE 
        WHERE MONTH(date_obj_recycl) = ? 
        AND YEAR(date_obj_recycl) = ?
    ";
    $stmt = $pdo->prepare($sql_nouveaux);
    $stmt->execute([$mois, $annee]);
    $nouveaux_objets = $stmt->fetchColumn();
    
    // Objets recyclés du mois
    $sql_recycles = "
        SELECT COUNT(*) 
        FROM OBJET_RECYCLABLE 
        WHERE MONTH(date_obj_recycl) = ? 
        AND YEAR(date_obj_recycl) = ? 
        AND id_statut_recyclage_obj = 3
    ";
    $stmt = $pdo->prepare($sql_recycles);
    $stmt->execute([$mois, $annee]);
    $objets_recycles = $stmt->fetchColumn();
    
    // Événements du mois
    $sql_events = "
        SELECT COUNT(*) 
        FROM EVENEMENT 
        WHERE MONTH(date_event) = ? 
        AND YEAR(date_event) = ?
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
?>
