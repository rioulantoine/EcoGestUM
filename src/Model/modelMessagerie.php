<?php
require_once __DIR__ . '/modelBDD.php';

// Cherche un utilisateur par email
function getUserByEmail($email) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT id_ut, nom_ut FROM UTILISATEUR WHERE email_ut = :email");
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Récupère ou crée la boîte de réception pour un utilisateur
function getOrCreateBoiteDeReception($id_ut) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT id_bdr FROM BOITE_DE_RECEPTION WHERE id_ut = :id_ut");
    $stmt->execute(['id_ut' => $id_ut]);
    $bdr = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($bdr) return $bdr['id_bdr'];
    $stmt = $pdo->prepare("INSERT INTO BOITE_DE_RECEPTION (id_ut) VALUES (:id_ut)");
    $stmt->execute(['id_ut' => $id_ut]);
    return $pdo->lastInsertId();
}

// Crée une conversation partagée dans les deux boîtes de réception, une fois par utilisateur
function createConversationForBothUsers($user_id, $dest_id) {
    $pdo = get_bdd();
    $user_bdr = getOrCreateBoiteDeReception($user_id);
    $dest_bdr = getOrCreateBoiteDeReception($dest_id);

    // Crée pour le premier utilisateur (auto_increment donne id_conv)
    $stmtA = $pdo->prepare("INSERT INTO CONVERSATION (id_bdr) VALUES (:id_bdr)");
    $stmtA->execute(['id_bdr' => $user_bdr]);
    $id_conv = $pdo->lastInsertId();

    // Crée l'entrée pour le destinataire (si bdr différentes)
    if ($user_bdr != $dest_bdr) {
        $stmtB = $pdo->prepare("INSERT INTO CONVERSATION (id_conv, id_bdr) VALUES (:id_conv, :id_bdr)");
        $stmtB->execute(['id_conv' => $id_conv, 'id_bdr' => $dest_bdr]);
    }
    return $id_conv;
}

// Envoie un message dans la conversation (dans tous les cas, précise bien les deux user)
function sendMessage($conv_id, $user_id, $dest_id, $message) {
    $pdo = get_bdd();
    $sql = "INSERT INTO MESSAGE (contenu_mess, date_envoi_mess, id_ut, id_ut_1, id_conv) 
            VALUES (:message, NOW(), :user_id, :dest_id, :conv_id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'message' => $message,
        'user_id' => $user_id,
        'dest_id' => $dest_id,
        'conv_id' => $conv_id
    ]);
}

// Récupère toutes les conversations d'un utilisateur
function getUserConversations($user_id) {
    $pdo = get_bdd();
    $sql = "
        SELECT c.id_conv,
               COALESCE(u.nom_ut, '???') AS nom_user,
               COALESCE(partner.id_ut, 0) AS id_dest
        FROM CONVERSATION c
        JOIN BOITE_DE_RECEPTION bdr ON c.id_bdr = bdr.id_bdr
        LEFT JOIN (
            SELECT m1.id_conv,
                   CASE WHEN m1.id_ut = :user_id THEN m1.id_ut_1 ELSE m1.id_ut END AS id_ut,
                   MAX(m1.date_envoi_mess) as max_date
            FROM MESSAGE m1
            WHERE m1.id_ut = :user_id OR m1.id_ut_1 = :user_id
            GROUP BY m1.id_conv
        ) AS partner ON c.id_conv = partner.id_conv
        LEFT JOIN UTILISATEUR u ON u.id_ut = partner.id_ut
        WHERE bdr.id_ut = :user_id
        GROUP BY c.id_conv
        ORDER BY c.id_conv DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère tous les messages d'une conversation
function getConversationMessages($conv_id) {
    $pdo = get_bdd();
    $sql = "SELECT id_ut, contenu_mess, date_envoi_mess FROM MESSAGE WHERE id_conv = :conv_id ORDER BY date_envoi_mess ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['conv_id' => $conv_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Supprime pour les deux utilisateurs
function deleteConversationEverywhere($conv_id) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("DELETE FROM CONVERSATION WHERE id_conv = :id_conv");
    $stmt->execute(['id_conv' => $conv_id]);
}

// Vérifie s'il existe déjà un fil de message entre deux users
function findConversationBetweenUsers($user_id, $dest_id) {
    $pdo = get_bdd();
    $sql = "
        SELECT m.id_conv
        FROM MESSAGE m
        WHERE (m.id_ut = :user_id AND m.id_ut_1 = :dest_id)
           OR (m.id_ut = :dest_id AND m.id_ut_1 = :user_id)
        LIMIT 1
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'dest_id' => $dest_id
    ]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    return $existing ? $existing['id_conv'] : false;
}
?>
