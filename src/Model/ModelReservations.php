    <?php
    require_once __DIR__ . '/modelBDD.php';

    // Affiche les réservations de l’utilisateur qui n’ont PAS encore fait l’objet d’un signalement
    function get_user_reservations_sans_signalement($user_id) {
        $pdo = get_bdd();
        $stmt = $pdo->prepare("
            SELECT r.id_res, o.nom_obj_recycl
            FROM RESERVATION r
            JOIN OBJET_RECYCLABLE o ON r.id_obj_recycl = o.id_obj_recycl
            WHERE r.id_ut = ?
            AND r.id_res NOT IN (
                SELECT id_res FROM SIGNALEMENT_OBJET
            )
            ORDER BY r.date_res DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    function getUserReservationsDetails($user_id)
    {
        $pdo = get_bdd();
        $stmt = $pdo->prepare("
            SELECT 
                r.id_res, r.date_res, r.date_exp_res,
                o.nom_obj_recycl, o.desc_obj_recycl, o.loca_obj_recycl,
                et.nom_etat_obj,
                p.lien_photo
            FROM RESERVATION r
            JOIN OBJET_RECYCLABLE o ON r.id_obj_recycl = o.id_obj_recycl
            LEFT JOIN PHOTO_OBJET po ON po.id_obj_recycl = o.id_obj_recycl
            LEFT JOIN PHOTO p ON po.id_photo = p.id_photo
            LEFT JOIN ETAT_OBJET et ON o.id_etat_obj = et.id_etat_obj
            WHERE r.id_ut = ?
            AND r.id_res NOT IN (
                SELECT id_res FROM SIGNALEMENT_OBJET
            )
            ORDER BY r.date_res DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Supprimer une réservation (récupéré)
function deleteReservationByIdAndUser(int $id_res, int $id_ut): bool {
    $pdo = get_bdd();
    $sql = "DELETE FROM RESERVATION WHERE id_res = ? AND id_ut = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id_res, $id_ut]);
}

// Récupérer l'objet lié à une réservation
function getObjetIdByReservation(int $id_res, int $id_ut): ?int {
    $pdo = get_bdd();
    $sql = "SELECT id_obj_recycl FROM RESERVATION WHERE id_res = ? AND id_ut = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_res, $id_ut]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? (int)$row['id_obj_recycl'] : null;
}

// Mettre un objet en "disponible"
function setObjetDisponible(int $id_obj): bool {
    $pdo = get_bdd();
    $sql = "UPDATE OBJET_RECYCLABLE SET id_statut_recyclage_obj = 1 WHERE id_obj_recycl = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id_obj]);
}


?>
