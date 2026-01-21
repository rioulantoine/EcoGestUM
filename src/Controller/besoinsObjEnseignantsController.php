<?php
require_once __DIR__ . '/../Model/modelBesoinEnseignant.php';
require_once __DIR__ . '/../Model/modelRechercheObjet.php';

// Initialiser tout pour la vue
$search = $_GET['search'] ?? '';
$categorie = $_GET['categorie'] ?? '';
$page = isset($_GET['num']) ? max(1, (int)$_GET['num']) : 1;
$parPage = 6;

$total = get_nb_besoins_enseignants($search, $categorie);
$nbPages = max(1, ceil($total / $parPage));
if ($page > $nbPages) $page = $nbPages;
$categories = get_categories_objet();
$besoins = get_besoins_enseignants($page, $parPage, $search, $categorie);

?>