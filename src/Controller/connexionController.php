<?php
$error_message = '';
if (isset($_SESSION['connexion_error'])) {
    $error_message = $_SESSION['connexion_error'];
    unset($_SESSION['connexion_error']);
}
?>