<?php
require_once __DIR__ . '/../Model/modelBDD.php';
// Ajoute un objet recyclable et retourne son ID
function ajouter_objet_recyclable($categorie, $nom, $description, $localisation, $etat, $idinv) {
    $pdo = get_bdd();
    $sql = "INSERT INTO OBJET_RECYCLABLE (id_cat_obj, nom_obj_recycl, desc_obj_recycl, loca_obj_recycl, id_etat_obj, id_statut_recyclage_obj, date_obj_recycl, id_inv)
        VALUES (?, ?, ?, ?, ?, 1, NOW(), ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categorie, $nom, $description, $localisation, $etat, $idinv]);
    return $pdo->lastInsertId();
}

// Ajoute une entrée pour photo dans le formulaire de donation
function ajouter_photo_objet($id_objet, $filename) {
    $pdo = get_bdd();
    $pdo->beginTransaction();
    $pdo->prepare("INSERT INTO PHOTO(lien_photo) VALUES (?)")->execute([$filename]);
    $id_photo = $pdo->lastInsertId();
    $pdo->prepare("INSERT INTO PHOTO_OBJET(id_photo, id_obj_recycl) VALUES (?, ?)")->execute([$id_photo, $id_objet]);
    $pdo->commit();
}

?>