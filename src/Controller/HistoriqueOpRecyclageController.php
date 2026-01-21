<?php
require_once __DIR__ . '/../Model/modelBDD.php';
require_once __DIR__ . '/../Model/modelHistoriqueOpRecyclage.php';

// Sécurité session
if (!isset($_SESSION['user'])) {
    header('Location: ' . getenv('BASE_URL') . 'connexion');
    exit;
}

$id_ut = $_SESSION['user']['id_ut'];
$id_inv = get_inventaire_by_idut($id_ut);

// Filtres
$page      = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage   = 10;
$search    = isset($_GET['search']) ? trim($_GET['search']) : '';
$categorie = isset($_GET['categorie']) ? $_GET['categorie'] : '';

// Données
$operations = historique_get_operations($id_inv, $page, $perPage, $search, $categorie);
$nb_operations = historique_get_nb_operations($id_inv, $search, $categorie);
$nb_pages = ceil($nb_operations / $perPage);
$categories = historique_get_categories_operations($id_inv);
?>
