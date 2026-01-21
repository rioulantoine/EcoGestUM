<?php
require_once __DIR__ . '/modelBDD.php'; 

// Récupère tous les événements
function getEvents() {
    $pdo = get_bdd();
    $sql = "
        SELECT 
            id_event,
            nom_event,
            desc_event,
            date_event,
            prix_event
        FROM
            EVENEMENT
        ORDER BY
            date_event ASC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Inscrire un utilisateur à un événement
function inscrireEvent($id_event, $id_ut) {
    $pdo = get_bdd();
    $check = $pdo->prepare('SELECT COUNT(*) FROM BILLET WHERE id_event = ? AND id_ut = ?');
    $check->execute([$id_event, $id_ut]);
    if ($check->fetchColumn() == 0) {
        $stmt = $pdo->prepare('INSERT INTO BILLET (id_event, id_ut) VALUES (?, ?)');
        $stmt->execute([$id_event, $id_ut]);
        return true;
    }
    return false;
}
// Récupère les inscriptions d'un utilisateur
function getInscriptions($user_id) {
    $pdo = get_bdd();
    $sql = "
        SELECT 
            e.id_event,
            e.nom_event,
            e.desc_event,
            e.date_event,
            e.prix_event
        FROM EVENEMENT e
        INNER JOIN BILLET b ON e.id_event = b.id_event
        WHERE b.id_ut = ?
        ORDER BY e.date_event ASC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère les événements d'un utilisateur
function getUserEvents($user_id) {
    return getInscriptions($user_id);
}
// Récupère le nom d'un événement par son ID
function getEventNameById($event_id) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare('SELECT nom_event FROM EVENEMENT WHERE id_event = ?');
    $stmt->execute([$event_id]);
    return $stmt->fetchColumn();
}
?>
