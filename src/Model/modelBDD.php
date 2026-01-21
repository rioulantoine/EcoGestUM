<?php
function get_bdd(){
    $hostname = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
    $db_name = $_ENV['DB_NAME'];

    $dsn = "mysql:host=$hostname;dbname=$db_name;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);
    return $pdo;
}
// Fonction pour obtenir le nombre d'objets recyclés
function get_nb_objets_reserves() {
    $pdo = get_bdd();
    $sql = "SELECT COUNT(*) AS total
            FROM  OBJET_RECYCLABLE
            WHERE id_statut_recyclage_obj != 1"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return (int)$stmt->fetchColumn();
}
// Fonction pour obtenir l'inventaire associé à un utilisateur
function get_inventaire_by_idut($idut) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT id_dept, id_comp, id_univ FROM UTILISATEUR WHERE id_ut = ?");
    $stmt->execute([$idut]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($user['id_dept'])) {
        $stmt2 = $pdo->prepare("SELECT id_inv FROM DEPARTEMENT WHERE id_dept = ?");
        $stmt2->execute([$user['id_dept']]);
        $id_inv = $stmt2->fetchColumn();
        if ($id_inv) return $id_inv;
    }
    if (!empty($user['id_comp'])) {
        $stmt2 = $pdo->prepare("SELECT id_inv FROM COMPOSANTE WHERE id_comp = ?");
        $stmt2->execute([$user['id_comp']]);
        $id_inv = $stmt2->fetchColumn();
        if ($id_inv) return $id_inv;
    }
    if (!empty($user['id_univ'])) {
        $stmt2 = $pdo->prepare("SELECT id_inv FROM UNIVERSITE WHERE id_univ = ?");
        $stmt2->execute([$user['id_univ']]);
        $id_inv = $stmt2->fetchColumn();
        if ($id_inv) return $id_inv;
    }
    return null;
}
?>