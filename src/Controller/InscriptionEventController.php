<?php
require_once __DIR__ . '/../Model/modelEvenement.php';
require_once __DIR__ . '/../Model/modelBDD.php';

$user_id = $_SESSION['user']['id_ut'] ?? null;
$message = '';

// Gestion annulation (suppression de l’inscription à un événement)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annuler_event']) && !empty($_POST['id_event'])) {
    $id_event = (int)$_POST['id_event'];
    if ($user_id) {
        $pdo = get_bdd();
        $stmt = $pdo->prepare("DELETE FROM BILLET WHERE id_event = ? AND id_ut = ?");
        $stmt->execute([$id_event, $user_id]);
        $message = "Votre inscription à l'événement a été annulée.";
        $event_name = getEventNameById($id_event);
        envoyer_notification($user_id, "Annulation de l'inscription pour l'événement : " . htmlspecialchars($event_name), 2);

    }
}

$userEvents = [];
if ($user_id) {
    $userEvents = getUserEvents($user_id);
}
?>
