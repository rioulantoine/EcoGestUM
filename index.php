<?php

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Model/modelUtilisateur.php';
require_once __DIR__ . '/src/Model/ModelNotif.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();
$page = $_GET['page'] ?? 'accueil';
$section = $_GET['section'] ?? null;
$action= $_GET['action'] ?? null;

$role = null;
if (isset($_SESSION['user']['roles'][0])) {
    $role = get_nom_role($_SESSION['user']['roles'][0]);
}

// Router les pages
switch ($page) {
    case 'accueil':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/accueil.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'connexion':
        require_once __DIR__ . '/src/view/connexion.php';
        break;

    case 'inscription':
        require_once __DIR__ . '/src/view/inscription.php';
        break;

    case 'mot-de-passe-oublie.php':
        require_once __DIR__ . '/src/view/mdpOublie.php';
        break;

    case 'traitement_connexion':
        require_once __DIR__ . '/src/Controller/traitement_connexion.php';
        break;

    case 'deconnexion':
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . getenv('BASE_URL') . 'accueil');
        break;

    case 'traitement_inscription':
        require_once __DIR__ . '/src/Controller/traitement_inscription.php';
        break;

    case 'profil':
        require_once __DIR__ . '/src/view/profil.php';
        break;

    case 'notifications':
        require_once __DIR__ . '/src/view/notifications.php';
        break;

    case 'statistiques':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/statistiques.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'notre-politique':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/notre-politique.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'espace-reprise':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/espace-reprise.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'evenements':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/evenements.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'carte':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/carte.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'messagerie':
        require_once __DIR__ . '/src/Controller/messagerieController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'], $_POST['conv_id'], $_POST['dest_id'])) {
            sendMessage($_POST['conv_id'], $_SESSION['user']['id_ut'], $_POST['dest_id'], $_POST['message']);
            header('Location: ?page=messagerie&conv=' . urlencode($_POST['conv_id']));
            exit;
        }
        require_once __DIR__ . '/src/view/messagerie.php';
        break;

    case 'form-besoin-objet':
        require_once __DIR__.'/src/view/form-besoin-objet.php';
        break;

    case 'traitement_form-besoin-objet':
        require_once __DIR__.'/src/Controller/formBesoinTraitementController.php';
        break;

    case 'besoins-objet-enseignants':
        require_once __DIR__ . '/src/Controller/besoinsObjEnseignantsController.php';
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__.'/src/view/besoins-objet-enseignants.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'traitement_besoinObjEnseignant':
        require_once __DIR__.'/src/Controller/traitement_besoinObjEnseignant.php';
        break;

    case 'objectifs':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/objectifs.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;


    case 'mesReservation':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/mes-reservations.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;
     case 'recuperer_reservation':
         require_once __DIR__ . '/src/Controller/reservationsController.php';
         break;
    case 'mesInscriptions':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/vos-inscriptions.php';
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;

    case 'rechercheObjet':
        require_once __DIR__ . '/src/Controller/rechercheObjetController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['action'])
            && $_POST['action'] === 'reserver') {
            reserver_objet_action();
        }
        require_once __DIR__ . '/src/view/Templates/header.php';
        afficher_recherche_objet();
        require_once __DIR__ . '/src/view/Templates/footer.php';
        break;


    case 'formDon':
        require_once __DIR__.'/src/view/form-don.php';
        break;

    case 'traitement_formDon':
        require_once __DIR__.'/src/Controller/formDonTraitementController.php';
        break;

    case 'dashboard':
        require_once __DIR__ . '/src/view/Templates/header.php';
        require_once __DIR__ . '/src/view/Templates/menu-dashboard.php';
        if ($role === 'Présidence') {
            switch ($section) {
                case 'impact':
                    require_once __DIR__ . '/src/view/Dashboard/presidence-impact.php';
                    break;
                case 'communication':
                    require_once __DIR__ . '/src/view/Dashboard/presidence-communication.php';
                    break;
                        
                case 'rapport':
                    require_once __DIR__ . '/src/view/Dashboard/presidence-rapport.php';
                    break;
            
                default:
                    require_once __DIR__ . '/src/view/Dashboard/presidence-accueil.php';
            }
        } elseif ($role === 'Chef de département') {
            switch ($section) {
                case 'inventaire':
                    require_once __DIR__ . '/src/view/Dashboard/chefdep-inventaire.php';
                    break;
                case 'communication':
                    require_once __DIR__ . '/src/view/Dashboard/chefdep-communication.php';
                    break;
                case 'impact':
                    require_once __DIR__ . '/src/view/Dashboard/chefdep-impact.php';
                    break;
                case 'historique':
                    require_once __DIR__ . '/src/view/Dashboard/chefdep-historique-operation.php';
                    break;
                default:
                    require_once __DIR__ . '/src/view/Dashboard/chefdep-acceuil.php';
            }
        }
        break;

    case 'communications':
    require_once __DIR__ . '/src/view/Templates/header.php';
    require_once __DIR__ . '/src/view/communications-officielles.php';
    require_once __DIR__ . '/src/view/Templates/footer.php';
    break;
    
    case 'signalementObj':
        require_once __DIR__ . '/src/view/signalement-objet.php';
        break;

    case 'traitement_signalement':
        require_once __DIR__ . '/src/Controller/SignalementController.php';
        break;

    case 'telecharger_rapport':
        require_once __DIR__ . '/src/Controller/telechargerRapportController.php';
        break;



    default:
        http_response_code(404);
        require_once __DIR__ . '/src/view/Templates/erreur.php';
        break;
}
?>
