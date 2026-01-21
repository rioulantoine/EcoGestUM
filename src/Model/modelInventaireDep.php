<?php
require_once __DIR__ . '/modelBDD.php';
require_once __DIR__ . '/modelRechercheObjet.php';
// Récupère les objets recyclables d'un inventaire donné avec pagination et filtres optionnels
function invdep_get_objets_by_inventaire($id_inv, $page = 1, $parPage = 10, $search = '', $etat = '', $categorie = '') {
    $pdo = get_bdd();
    $offset = ($page - 1) * $parPage;
    $where = "WHERE o.id_inv = :id_inv";

    if ($search !== '') {
        $where .= " AND (o.nom_obj_recycl LIKE :search OR o.desc_obj_recycl LIKE :search)";
    }
    if ($etat !== '') {
        $where .= " AND o.id_etat_obj = :etat";
    }
    if ($categorie !== '') {
        $where .= " AND o.id_cat_obj = :categorie";
    }

    $sql = "
        SELECT 
            o.id_obj_recycl,
            cat.nom_cat_obj AS categorie,
            o.nom_obj_recycl AS nom,
            o.desc_obj_recycl AS description,
            o.loca_obj_recycl AS localisation,
            et.nom_etat_obj AS etat
        FROM OBJET_RECYCLABLE o
        INNER JOIN CATEGORIE_OBJET cat ON o.id_cat_obj = cat.id_cat_obj
        INNER JOIN ETAT_OBJET et ON o.id_etat_obj = et.id_etat_obj
        $where
        ORDER BY o.date_obj_recycl DESC
        LIMIT :offset, :parPage
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_inv', $id_inv, PDO::PARAM_INT);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($etat !== '') $stmt->bindValue(':etat', $etat);
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':parPage', (int)$parPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère le nombre total d'objets dans un inventaire donné avec des filtres optionnels
function invdep_get_nb_objets_inventaire($id_inv, $search = '', $etat = '', $categorie = '') {
    $pdo = get_bdd();
    $where = "WHERE id_inv = :id_inv";
    if ($search !== '') $where .= " AND (nom_obj_recycl LIKE :search OR desc_obj_recycl LIKE :search)";
    if ($etat !== '') $where .= " AND id_etat_obj = :etat";
    if ($categorie !== '') $where .= " AND id_cat_obj = :categorie";
    $sql = "SELECT COUNT(*) as total FROM OBJET_RECYCLABLE $where";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_inv', $id_inv, PDO::PARAM_INT);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($etat !== '') $stmt->bindValue(':etat', $etat);
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->execute();
    return (int)$stmt->fetch()['total'];
}
// Récupère toutes les catégories d'objets présentes dans un inventaire donné
function invdep_get_categories_inventaire($id_inv) {
    $pdo = get_bdd();
    $sql = "SELECT DISTINCT cat.id_cat_obj, cat.nom_cat_obj
            FROM OBJET_RECYCLABLE o
            INNER JOIN CATEGORIE_OBJET cat ON o.id_cat_obj = cat.id_cat_obj
            WHERE o.id_inv = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_inv]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
