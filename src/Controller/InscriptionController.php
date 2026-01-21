<?php
require_once __DIR__ . '/../Model/modelUtilisateur.php';
$errors = [];
if (!empty($_SESSION['inscription_error'])) {
  $errors = $_SESSION['inscription_error'];
  unset($_SESSION['inscription_error']);
}
$universites = get_universites();
$composantes = get_composantes();
$departements = get_departements();
?>