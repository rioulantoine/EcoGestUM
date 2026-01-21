
<?php
require_once __DIR__ . '/modelBDD.php'; 
// Récupère le nombre de nouveaux objets recyclables ajoutés ce mois-ci et enregistre les statistiques mensuelles
function getNewObjParMoisAuto() {
    $pdo = get_bdd();
    $jour = date('j');
    $mois = date('n');
    $annee = date('Y'); 

    $nb_jours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);

    $sql1 = "SELECT COUNT(*) FROM OBJET_RECYCLABLE WHERE MONTH(date_obj_recycl) = ? AND YEAR(date_obj_recycl) = ?";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute([$mois, $annee]);
    $nouveaux_objets = $stmt1->fetchColumn();

   setNewStatsparMois($nb_jours, 'Nouveaux objets recyclables '. getNomMois($mois) . '/' . $annee, $nouveaux_objets);
            
    return $nouveaux_objets;
}
// Enregistre les statistiques mensuelles dans la base de données
function setNewStatsparMois($nb_jours,$titreStats, $nouveaux_objets) {
    $pdo = get_bdd();
    $jour = date('j');
    if($jour == $nb_jours){

        $sql = "INSERT INTO STATISTIQUES (nom_stats, val_stats,id_periode) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $titreStats,
            $nouveaux_objets,
            1
        ]);
        }
}
// Récupère le nom du mois à partir de son numéro
function getNomMois($mois) {
    $noms = [
        1 => "janvier", 2 => "février", 3 => "mars", 4 => "avril", 5 => "mai",
        6 => "juin", 7 => "juillet", 8 => "août", 9 => "septembre",
        10 => "octobre", 11 => "novembre", 12 => "décembre"
    ];
    return $noms[intval($mois)];
    
}
// Récupère la répartition des objets recyclables par catégorie
function getRepartitionObjetsParCategorie() {
    $pdo = get_bdd();
    $sql = "
        SELECT 
            cat.nom_cat_obj,
            COUNT(o.id_obj_recycl) as nombre
        FROM OBJET_RECYCLABLE o
        INNER JOIN INVENTAIRE inv ON o.id_inv = inv.id_inv
        INNER JOIN DEPARTEMENT d ON inv.id_inv = d.id_inv
        INNER JOIN CATEGORIE_OBJET cat ON o.id_cat_obj = cat.id_cat_obj
        GROUP BY cat.id_cat_obj, cat.nom_cat_obj
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
    