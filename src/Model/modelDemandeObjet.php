<?php 
require_once __DIR__ . '/modelBDD.php'; 
//Ajoute une nouvelle demande d'objet
function ajouterDemandeObjet($categorie, $nom, $desc, $date, $localisation, $idStatut, $idUtilisateur) {
    $pdo = get_bdd();
    $sql = 'INSERT INTO DEMANDE_OBJET 
        (id_cat_obj, nom_demande_obj, desc_demande_obj, date_demande_obj, loca_demande_obj, id_statut_demande_obj, id_ut) 
        VALUES (:categorie, :nom, :desc, :date, :loc, :idStatut, :idUser)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':categorie' => $categorie,
        ':nom' => $nom,
        ':desc' => $desc,
        ':date' => $date,
        ':loc' => $localisation,
        ':idStatut' => $idStatut,
        ':idUser' => $idUtilisateur
    ]);
    return $pdo->lastInsertId();
}
?>