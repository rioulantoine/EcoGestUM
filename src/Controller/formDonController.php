<?php
require_once __DIR__ . '/../Model/modelRechercheObjet.php';
$error_message = $_SESSION['formDon_error'] ?? '';
unset($_SESSION['formDon_error']);
$etats_objet = get_etats_objet();
$categories = get_categories_objet();
?>