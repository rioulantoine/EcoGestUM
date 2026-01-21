<?php require_once __DIR__ . '/../Controller/MesReservationsController.php'; ?>
<section class="headerPages">
    <nav class="breadcrumb">
        <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
        <span class="breadcrumbseparator">&gt;</span>
        <a href="<?php echo getenv('BASE_URL'); ?>espace-reprise" class="breadcrumbitem">Espace-Reprise</a>
        <span class="breadcrumbseparator">&gt;</span>
        <span class="breadcrumbitem active">Mes réservations</span>
    </nav>
    <h1 class="breadcrumb_title">Mes réservations</h1>
</section>
<main class="main-content">
    <?php if ($message): ?>
        <div class="message-success"><?php echo $message; ?></div>
    <?php endif; ?>
    <section class="reservation-cards">
        <?php
            if (empty($reservations)) {
                echo "<p class='res-empty'>Aucune réservation en cours.</p>";
            } else {
                foreach ($reservations as $res) {
                    $photo = $res['lien_photo'];
                    if ($photo && strpos($photo, 'http') === 0) {
                        $photoSrc = $photo;
                    } elseif ($photo) {
                        $photoSrc = getenv('BASE_URL') . 'src/assets/imgCache/' . htmlspecialchars($photo);
                    } else {
                        $photoSrc = getenv('BASE_URL') . 'src/assets/imgCache/default.png';
                    }
        ?>
        <div class="reservation-card">
            <?php if (!empty($photoSrc)): ?>
                <img class="reservation-img" src="<?php echo $photoSrc; ?>" alt="<?php echo htmlspecialchars($res['nom_obj_recycl']); ?>">
            <?php endif; ?>
            <div class="reservation-info">
                <h2 class="reservation-title"><?php echo htmlspecialchars($res['nom_obj_recycl']); ?></h2>
                <?php if (!empty($res['desc_obj_recycl'])): ?>
                    <div class="reservation-attr"><?php echo htmlspecialchars($res['desc_obj_recycl']); ?></div>
                <?php endif; ?>
                <?php if (!empty($res['nometatobj'])): ?>
                    <div class="reservation-attr">État : <?php echo htmlspecialchars($res['nometatobj']); ?></div>
                <?php endif; ?>
                <?php if (!empty($res['loca_obj_recycl'])): ?>
                    <div class="reservation-attr">Emplacement : <?php echo htmlspecialchars($res['loca_obj_recycl']); ?></div>
                <?php endif; ?>
                <?php if (!empty($res['dateexpres'])): ?>
                    <div class="reservation-attr">Date de retrait possible : <?php echo htmlspecialchars(date('d/m/Y', strtotime($res['dateexpres']))); ?></div>
                    <div class="reservation-attr"><b>Expiration :</b> <?php echo htmlspecialchars(date('d/m/Y', strtotime($res['dateexpres']))); ?></div>
                <?php endif; ?>
                <p class="reservation-id">Réservation n° <?php echo htmlspecialchars($res['id_res']); ?></p>
            </div>
            <div class="btns-res-row">
                <form method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                    <input type="hidden" name="id_res" value="<?php echo htmlspecialchars($res['id_res']); ?>">
                    <button type="submit" name="annuler_res" class="btn-annuler-res">Annuler ma réservation</button>
                </form>
                <form method="post" onsubmit="return confirm('Confirmez-vous avoir récupéré cet objet ?');">
                    <input type="hidden" name="id_res" value="<?php echo htmlspecialchars($res['id_res']); ?>">
                    <button type="submit" name="recuperer_res" class="btn-recuperer-res">Récupéré</button>
                </form>

            </div>
        </div>
        <?php
                }
            }
        ?>
    </section>
</main>
