<!-- Affichage des notifications de succès -->
<?php if (isset($_GET['success']) && $_GET['success'] === 'don') : ?>
    <div class="espace-notif-success">Objet ajouté avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] === 'signalement') : ?>
    <div class="espace-notif-success">Signalement enregistré avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['success']) && $_GET['success'] === 'besoin') : ?>
    <?php envoyer_notification($_SESSION['user']['id_ut'],"Votre demande d'objet a bien été prise en compte et transmise à la plateforme.",4); ?>
    <div class="espace-notif-success">Formulaire de besoin d'objet publié !</div>
<?php endif; ?>
<div class="container-espace-reprise">
    <div class="action-block">
        <span class="action-title">ACCÉDER À L’ESPACE DÉDIÉ À LA RÉUTILISATION</span>
        <a href="rechercheObjet">
            <button class="action-btn">Rechercher un objet</button>
        </a>
    </div>
    <div class="action-block">
        <span class="action-title">FORMULAIRE DE DONATION D’OBJET INUTILISÉE</span>
        <a href="formDon">
            <button class="action-btn">Donner un objet</button>
        </a>
    </div>
    <div class="action-block">
        <span class="action-title">SIGNALER UN OBJET INAPPROPRIÉ OU CASSÉ</span>
        <a href="signalementObj">
            <button class="action-btn">Signaler un objet</button>
        </a>
    </div>
    <div class="action-block">
        <span class="action-title">VOIR VOS COMMANDES RÉSERVÉES</span>
        <a href="mesReservation">
            <button class="action-btn">Mes réservations</button>
        </a>
    </div>
    <div class="action-block">
        <span class="action-title">CARTE INTERACTIVE DES POINTS DE RETRAIT</span>
        <a href="carte">
            <button class="action-btn">Carte</button>
        </a>
    </div>
    <?php if (isset($_SESSION['user']['roles']) && in_array(3, $_SESSION['user']['roles'])) : ?>
    <div class="action-block">
        <span class="action-title">FORMULAIRE DE DEMANDE D'OBJET</span>
        <a href="form-besoin-objet">
            <button class="action-btn">Demander un objet</button>
        </a>
    </div>
    <div class="action-block">
        <span class="action-title">ACCES AUX BESOINS DES ENSEIGNANTS </span>
        <a href="besoins-objet-enseignants">
            <button class="action-btn">Objets demandés</button>
        </a>
    </div>
    <?php endif; ?>

</div>
