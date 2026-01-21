<?php
require_once __DIR__ . '/../Model/modelBDD.php';
require_once __DIR__ . '/../Model/ModelNotif.php';
require_once __DIR__ . '/../Model/modelRechercheObjet.php';

function reserver_objet_action() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ?page=rechercheObjet&error=1');
        exit;
    }

    $idObj = $_POST['id_obj_recycl'] ?? null;
    $idUt  = $_SESSION['user']['id_ut'] ?? null;

    if ($idObj && $idUt) {
        $ok = reserver_objet($idObj, $idUt);

        if ($ok) {
            envoyer_notification($idUt, "Un nouvel objet ajouté à vos réservations", 1);

            $idAuteur = getAuteurObjetRecyclable($idObj);
            if ($idAuteur && $idAuteur != $idUt) {
                envoyer_notification($idAuteur, "Votre objet recyclé a été réservé par un autre utilisateur", 1);
            }

            header('Location: ?page=rechercheObjet&success=1');
        } else {
            header('Location: ?page=rechercheObjet&error=1');
        }
        exit;
    }

    header('Location: ?page=rechercheObjet&error=1');
    exit;
}

function afficher_recherche_objet() {
    $search    = $_GET['search'] ?? '';
    $etat      = $_GET['etat'] ?? '';
    $categorie = $_GET['categorie'] ?? '';
    $page      = isset($_GET['num']) ? max(1, (int)$_GET['num']) : 1;
    $parPage   = 9;

    $total   = get_nb_objets_disponibles($search, $etat, $categorie);
    $nbPages = max(1, ceil($total / $parPage));
    if ($page > $nbPages) {
        $page = $nbPages;
    }

    $objets = get_objets_disponibles($page, $parPage, $search, $etat, $categorie);

    $etats = get_etats_objet();
    $cats  = get_categories_objet();
    $success = isset($_GET['success']);
    $error   = isset($_GET['error']);

    // Inclure la vue
    require __DIR__ . '/../view/recherche-objet.php';
}
