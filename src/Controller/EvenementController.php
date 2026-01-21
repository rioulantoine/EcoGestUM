<?php
require_once __DIR__ . '/../Model/modelEvenement.php';

$message = '';
$user_id = $_SESSION['user']['id_ut'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscrire_event'])) {
    $event_id = (int)$_POST['id_event'];
    $event_name = getEventNameById($event_id);
    if ($user_id && $event_id) {
        if (inscrireEvent($event_id, $user_id)) {
            $message = "Inscription réussie à l'événement !";
            envoyer_notification($user_id, "Inscription réussie à l'événement : " . htmlspecialchars($event_name), 1);
        } else {
            $message = "Vous êtes déjà inscrit à cet événement.";
        }
    } else {
        $message = "Erreur d'inscription.";
    }
}
$events = getEvents();
$imgIndex = 1;
$message = $message ?? '';

$idUt = $_SESSION['id_ut'] ?? null;
    if ($idUt) {

      exit;
    }
?>
