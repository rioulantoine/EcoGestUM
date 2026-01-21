<?php
require_once __DIR__ . '/../Model/ModelReservations.php';

$user_id = $_SESSION['user']['id_ut'] ?? null;
$message = '';

// Récupéré
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recuperer_res']) && !empty($_POST['id_res'])) {
    $id_res = (int)$_POST['id_res'];

    if ($user_id && deleteReservationByIdAndUser($id_res, $user_id)) {
        $message = "Vous avez récupéré votre objet.";
        envoyer_notification($user_id, "Vous avez récupéré un objet. Il n'apparaîtera plus dans 'vos reservations'", 2);
    }
}

// Annuler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['annuler_res']) && !empty($_POST['id_res'])) {
    $id_res = (int)$_POST['id_res'];

    if ($user_id) {
        $id_obj = getObjetIdByReservation($id_res, $user_id);
        if ($id_obj !== null) {
            deleteReservationByIdAndUser($id_res, $user_id);
            setObjetDisponible($id_obj);
            $message = "Votre réservation est annulée et l’objet est de nouveau disponible.";
            envoyer_notification($user_id, "Votre réservation d'objet a été annulée.", 2);
        }
    }
}

// Rechargement des réservations
$reservations = $user_id ? getUserReservationsDetails($user_id) : [];
