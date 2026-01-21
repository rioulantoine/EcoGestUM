<?php
require_once __DIR__ . '/modelBDD.php'; 

// Compte le nombre total de besoins d'enseignants avec option filtres
function get_nb_besoins_enseignants($search = '', $categorie = '') {
    $pdo = get_bdd();
    $where = '';
    if ($search !== '') {
        $where .= " AND (nom_demande_obj LIKE :search OR desc_demande_obj LIKE :search)";
    }
    if ($categorie !== '') {
        $where .= " AND d.id_cat_obj = :categorie";  // AJOUT DU PREFIXE D. !
    }
    $sql = "SELECT COUNT(*) AS total FROM DEMANDE_OBJET d WHERE 1 $where"; // AJOUT DU ALIAS D ICI AUSSI
    $stmt = $pdo->prepare($sql);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->execute();
    return (int)$stmt->fetchColumn();
}


// Retourne la liste paginée des besoins d'enseignants, avec filtres recherche/catégorie
function get_besoins_enseignants($page = 1, $parPage = 6, $search = '', $categorie = '') {
    $pdo = get_bdd();
    $offset = ($page - 1) * $parPage;
    $where = '';
    if ($search !== '') {
        $where .= " AND (nom_demande_obj LIKE :search OR desc_demande_obj LIKE :search)";
    }
    if ($categorie !== '') {
        $where .= " AND d.id_cat_obj = :categorie";
    }

    $sql = "
        SELECT d.*, u.nom_ut AS nom_enseignant, u.pren_ut, cat.nom_cat_obj,
               IFNULL(p.lien_photo, 'default.png') AS photo
        FROM DEMANDE_OBJET d
        LEFT JOIN UTILISATEUR u ON d.id_ut = u.id_ut
        LEFT JOIN CATEGORIE_OBJET cat ON d.id_cat_obj = cat.id_cat_obj
        LEFT JOIN PHOTO_OBJET po ON d.id_demande_obj = po.id_obj_recycl
        LEFT JOIN PHOTO p ON po.id_photo = p.id_photo
        WHERE 1 $where
        ORDER BY d.date_demande_obj DESC
        LIMIT $offset, $parPage
    ";
    $stmt = $pdo->prepare($sql);
    if ($search !== '') $stmt->bindValue(':search', "%$search%");
    if ($categorie !== '') $stmt->bindValue(':categorie', $categorie);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateBesoinEnseignant($idDemandeObj, $idUtilisateur) {
    $pdo = get_bdd();
    $sql = "UPDATE DEMANDE_OBJET SET id_statut_demande_obj = 2, id_ut = :idUtilisateur WHERE id_demande_obj = :idDemandeObj";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':idDemandeObj' => $idDemandeObj,
        ':idUtilisateur' => $idUtilisateur
    ]);
}

function getAuteurBesoin($idDemandeObj) {
    $pdo = get_bdd();
    $stmt = $pdo->prepare("SELECT id_ut FROM DEMANDE_OBJET WHERE id_demande_obj = ?");
    $stmt->execute([$idDemandeObj]);
    return $stmt->fetchColumn();
}

function supprimerBesoinEnseignant($idDemandeObj) {
    $pdo = get_bdd();
    $sql = "DELETE FROM DEMANDE_OBJET WHERE id_demande_obj = :idDemandeObj";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idDemandeObj' => $idDemandeObj]);
}

function envoyerMessageReponseBesoin($idBesoin, $idUtilisateur, $idDestinataire) {
    $pdo = get_bdd();
    // Récupère les infos pour le message 
    $stmt = $pdo->prepare("SELECT nom_demande_obj, desc_demande_obj FROM DEMANDE_OBJET WHERE id_demande_obj = ?");
    $stmt->execute([$idBesoin]);
    $besoin = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$besoin) return;

    $convId = findConversationBetweenUsers($idUtilisateur, $idDestinataire);
    if (!$convId) {
        $convId = createConversationForBothUsers($idUtilisateur, $idDestinataire);
    }

    $message = "Bonjour, j'ai un objet qui correspond à votre demande : \"{$besoin['nom_demande_obj']}\" ({$besoin['desc_demande_obj']})";
    sendMessage($convId, $idUtilisateur, $idDestinataire, $message);
}
?>
