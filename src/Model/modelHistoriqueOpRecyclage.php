<?php
require_once __DIR__ . '/modelBDD.php';

// Récupère les opérations + quantités + types
function historique_get_operations($id_inv, $page=1, $parPage=10, $search='', $categorie='') {
    $pdo = get_bdd();
    $offset = ($page - 1) * $parPage;
    $where = "WHERE op.id_dept = (SELECT id_dept FROM DEPARTEMENT WHERE id_inv = :id_inv)";
    if ($search !== '') {
        $where .= " AND op.nom_op_recycl LIKE :search";
    }
    if ($categorie !== '') {
        $where .= " AND cat.id_cat_obj = :categorie";
    }
    $sql = "
        SELECT op.date_op_recycl, op.nom_op_recycl,
            COUNT(obj.id_obj_recycl) AS quantite,
            GROUP_CONCAT(DISTINCT cat.nom_cat_obj) AS types
        FROM OPERATION_RECYCLAGE op
        LEFT JOIN OBJET_RECYCLABLE obj ON obj.id_op_recycl = op.id_op_recycl
        LEFT JOIN CATEGORIE_OBJET cat ON obj.id_cat_obj = cat.id_cat_obj
        $where
        GROUP BY op.id_op_recycl
        ORDER BY op.date_op_recycl DESC
        LIMIT :offset, :parPage
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_inv', $id_inv, PDO::PARAM_INT);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':parPage', (int)$parPage, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as &$row) {
        $row['types'] = $row['types'] ? explode(',', $row['types']) : [];
    }
    return $rows;
}
// Nombre total d’opérations pour la pagination
function historique_get_nb_operations($id_inv, $search='', $categorie='') {
    $pdo = get_bdd();
    $where = "WHERE op.id_dept = (SELECT id_dept FROM DEPARTEMENT WHERE id_inv = :id_inv)";
    if ($search !== '') $where .= " AND op.nom_op_recycl LIKE :search";
    if ($categorie !== '') $where .= " AND cat.id_cat_obj = :categorie";
    $sql = "
        SELECT COUNT(DISTINCT op.id_op_recycl) AS total
        FROM OPERATION_RECYCLAGE op
        LEFT JOIN OBJET_RECYCLABLE obj ON obj.id_op_recycl = op.id_op_recycl
        LEFT JOIN CATEGORIE_OBJET cat ON obj.id_cat_obj = cat.id_cat_obj
        $where
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_inv', $id_inv, PDO::PARAM_INT);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->execute();
    return (int)$stmt->fetch()['total'];
}

// Les catégories d’objets passées dans les opérations
function historique_get_categories_operations($id_inv) {
    $pdo = get_bdd();
    $sql = "
        SELECT DISTINCT cat.id_cat_obj, cat.nom_cat_obj
        FROM OPERATION_RECYCLAGE op
        LEFT JOIN OBJET_RECYCLABLE obj ON obj.id_op_recycl = op.id_op_recycl
        LEFT JOIN CATEGORIE_OBJET cat ON obj.id_cat_obj = cat.id_cat_obj
        WHERE op.id_dept = (SELECT id_dept FROM DEPARTEMENT WHERE id_inv = ?)
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_inv]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
