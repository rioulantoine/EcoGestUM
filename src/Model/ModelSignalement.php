<?php
require_once __DIR__ . '/modelBDD.php';

// Insère le signalement dans la table et chaque photo liée à la réservation
function inserer_signalement_objet($description, $idres, $photoNamesSaved) {
    $pdo = get_bdd();
    $pdo->beginTransaction();
    try {
        foreach($photoNamesSaved as $file) {
            // Ajoute la photo, récupère l’id généré
            $stmtPhoto = $pdo->prepare("INSERT INTO PHOTO (lien_photo) VALUES (?)");
            $stmtPhoto->execute([$file]);
            $idphoto = $pdo->lastInsertId();

            // Insère le signalement (1 signalement par photo, si plusieurs photos)
            $stmtSignalement = $pdo->prepare("INSERT INTO SIGNALEMENT_OBJET (desc_signalement_obj, id_photo, id_res) VALUES (?, ?, ?)");
            $stmtSignalement->execute([$description, $idphoto, $idres]);
        }
        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}
?>
