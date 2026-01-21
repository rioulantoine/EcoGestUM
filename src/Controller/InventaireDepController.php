<?php
require_once __DIR__ . '/../Model/modelRechercheObjet.php';
require_once __DIR__ . '/../Model/modelInventaireDep.php';


// Sécurité session
if (!isset($_SESSION['user'])) {
    header('Location: ' . getenv('BASE_URL') . 'connexion');
    exit;
}
$id_ut = $_SESSION['user']['id_ut'];
$id_inv = get_inventaire_by_idut($id_ut);

// Filtres
$page     = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage  = 10;
$search   = isset($_GET['search']) ? trim($_GET['search']) : '';
$etat     = isset($_GET['etat']) ? $_GET['etat'] : '';
$categorie= isset($_GET['categorie']) ? $_GET['categorie'] : '';

// Données pour la vue
$inventaire  = invdep_get_objets_by_inventaire($id_inv, $page, $perPage, $search, $etat, $categorie);
$nb_objets   = invdep_get_nb_objets_inventaire($id_inv, $search, $etat, $categorie);
$nb_pages    = ceil($nb_objets / $perPage);
$categories  = invdep_get_categories_inventaire($id_inv);
$etats       = get_etats_objet();
?>
