<?php
require_once __DIR__ . '/../Model/modelBesoinEnseignant.php';
require_once __DIR__ . '/../Model/ModelNotif.php';
require_once __DIR__ . '/../Model/modelMessagerie.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id_demande_obj'])) {
    $idBesoin = (int)$_POST['id_demande_obj'];
    $idUtilisateur = $_SESSION['user']['id_ut'];

    // Récupère l'auteur original AVANT update
    $idAuteur = getAuteurBesoin($idBesoin);

    updateBesoinEnseignant($idBesoin, $idUtilisateur);
    envoyer_notification($idUtilisateur, "Vous avez répondu à un besoin d'objet d'un enseignant", 1);
    if ($idAuteur) {
        envoyer_notification($idAuteur, "Votre besoin d'objet a reçu une réponse d'un enseignant", 2);
    }
    envoyerMessageReponseBesoin($idBesoin, $idUtilisateur, $idAuteur); // Passe le bon destinataire
    supprimerBesoinEnseignant($idBesoin);

    header('Location: ?page=besoins-objet-enseignants&success=reponse');
    exit();


} else {
    header('Location: ?page=besoins-objet-enseignants');
    exit();
}
?>
