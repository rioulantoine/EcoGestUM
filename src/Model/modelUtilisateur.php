<?php
require_once 'ModelChefDep.php';
// Récupère les informations d'un utilisateur par son ID
function get_user_info($id) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT u.*, un.nom_univ, comp.nom_comp, dept.nom_dept
                           FROM UTILISATEUR u
                           LEFT JOIN UNIVERSITE un ON un.id_univ = u.id_univ
                           LEFT JOIN COMPOSANTE comp ON comp.id_comp = u.id_comp
                           LEFT JOIN DEPARTEMENT dept ON dept.id_dept = u.id_dept
                           WHERE u.id_ut = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Met à jour l'email d'un utilisateur
function update_user_email($id, $new_email) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("UPDATE UTILISATEUR SET email_ut = ? WHERE id_ut = ?");
    $stmt->execute([$new_email, $id]);
}
// Inscrit un nouvel utilisateur avec un rôle par défaut (4)
function inscription_utilisateur($nom, $prenom, $email, $mdp, $id_univ, $id_comp, $id_dept, $idrole = 4) {
    $pdo = get_bdd();
    $pdo->beginTransaction();
    try {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare(
            "INSERT INTO UTILISATEUR (nom_ut, pren_ut, email_ut, mdp_ut, id_univ, id_comp, id_dept)
                VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$nom, $prenom, $email, $hash, $id_univ, $id_comp, $id_dept]);
        $id_ut = $pdo->lastInsertId();

        $stmtRole = $pdo->prepare("INSERT INTO ROLE_UTILISATEUR (id_role, id_ut) VALUES (?, ?)");
        $stmtRole->execute([$idrole, $id_ut]);

        $pdo->commit();
        return $id_ut;
    } catch(Exception $e){
        $pdo->rollBack();
        echo "Erreur SQL : " . $e->getMessage(); 
        return false;
    }
}
// Authentifie un utilisateur et récupère ses rôles
function connexion_utilisateur($email, $motdepasse) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE email_ut=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && ($user['mdp_ut'] === $motdepasse || password_verify($motdepasse, $user['mdp_ut']))) {
        // Chercher les rôles
        $stmtRole = $pdo->prepare("SELECT id_role FROM ROLE_UTILISATEUR WHERE id_ut=?");
        $stmtRole->execute([$user['id_ut']]);
        $roles = $stmtRole->fetchAll(PDO::FETCH_COLUMN);
        $user['id_dept'] = get_idDept($user['id_ut']);
        $user['roles'] = $roles;
        return $user;
    }
    return false;
}
// Vérifie si un email existe déjà dans la base de données
function email_existe($email) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE email_ut=?");
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}
// Récupère le nom d'un rôle par son ID
function get_nom_role($id_role) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT nom_role FROM ROLES WHERE id_role = ?");
    $stmt->execute([$id_role]);
    return $stmt->fetchColumn();
}
// Récupère toutes les universités
function get_universites() {
    $pdo = get_bdd();
    $stmt = $pdo->query("SELECT id_univ, nom_univ FROM UNIVERSITE");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère toutes les composantes
function get_composantes() {
    $pdo = get_bdd();
    $stmt = $pdo->query("SELECT id_comp, nom_comp FROM COMPOSANTE");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère tous les départements
function get_departements() {
    $pdo = get_bdd();
    $stmt = $pdo->query("SELECT id_dept, nom_dept FROM DEPARTEMENT");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>