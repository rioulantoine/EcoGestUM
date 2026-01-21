<?php
require_once __DIR__ . '/../Model/ModelNotif.php';
$user_id = $_SESSION['user']['id_ut'] ?? null;

// Gestion de la suppression POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idnotification'])) {
    $notifId = (int)$_POST['idnotification'];
    delete_notification_user($notifId, $user_id);
}

// Récupération des notifications (toujours après éventuelle suppression)
$notifications = [];
if ($user_id) {
    $notifications = get_notifs_user($user_id);
}
?>
