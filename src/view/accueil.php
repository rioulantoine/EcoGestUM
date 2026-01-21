<?php 
require_once __DIR__ . '/../Controller/AccueilController.php';
?>
<main class="main-content">
    <!-- Section Hero avec compteur -->
    <section class="hero-section" style="background-image: url('<?php echo getenv('BASE_URL')."src/assets/Images/ObjRecyclTotalImg.png"; ?>');">
        <div class="counter-card">
            <div class="counter-label">Déjà</div>
            <div class="counter-number"><?= $nb_objets_recycles ?></div>
            <div class="counter-text">objets recyclés</div>
        </div>
    </section>

    <!-- Section Donation Campus & Moi -->
    <section class="donation-section">
        <div class="donation-card">
            <img src="<?php echo getenv('BASE_URL')."src/assets/Images/FormulaireDonAcceuil.png"; ?>" alt="Campus & Moi" class="donation-icon">
            <?php if ($user_id): ?>
            <a href="<?php echo getenv('BASE_URL'); ?>formDon" class="donation-btn">Formulaire de donation</a>
            <?php else: ?>
            <a href="<?php echo getenv('BASE_URL'); ?>connexion" class="donation-btn">Formulaire de donation</a>
            <?php endif; ?>
        </div>
        <div class="donation-content">
            <h2>Vous avez des objets en bon état dont vous ne vous servez plus ?</h2>
            <p>Donnez-les pour qu'ils puissent être réutilisés par d'autres membres de l'université !</p>
        </div>
    </section>

    <!-- Section Pourquoi nous battons nous -->
    <section class="why-section">
        <h2 class="why-title">Pourquoi nous battons nous ?</h2>
        <div class="why-cards">
            <div class="why-card">
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a" alt="Notre politique d'entraide" class="why-card-image">
                <div class="why-card-content">
                    <h3 class="why-card-title">Notre politique d'entraide</h3>
                    <p class="why-card-text">Avec EcoGestUM, nous encourageons le partage et la réutilisation des objets entre étudiants. Notre politique vise à réduire les déchets et à favoriser l'accès aux ressources pour tous. Ensemble, construisons un campus plus solidaire et durable !</p>
                    <button class="why-card-btn">Voir notre Politique</button>
                </div>
            </div>
            <div class="why-card">
                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09" alt="Réduction impact carbone" class="why-card-image">
                <div class="why-card-content">
                    <h3 class="why-card-title">Réduction impact carbone</h3>
                    <p class="why-card-text">Avec EcoGestUM, nous encourageons le recyclage et la réutilisation d'un réduire les déchets et les émissions de CO₂. Chaque objet sauvé, c'est un pas de plus vers un campus plus vert et responsable. Ensemble, agissons pour un avenir durable !</p>
                    <button class="why-card-btn">Voir les Statistiques</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Communications officielles -->
    <section class="communications-section">
        <h2 class="communications-title">Communications Officielles</h2>
        <p class="communications-text">Restez informé des dernières actualités et annonces importantes d'EcoGestUM</p>
        <?php if ($user_id): ?>
            <a href="<?php echo getenv('BASE_URL'); ?>communications" class="communications-btn">Voir plus</a>
        <?php else: ?>
            <a href="<?php echo getenv('BASE_URL'); ?>connexion" class="communications-btn">Voir plus</a>
        <?php endif; ?>    </section>

        <!-- Section Points de collecte -->
        <section class="collect-section">
            <h2 class="collect-title">RENDEZ-VOUS À NOS POINTS DE COLLECTE</h2>
            <p class="collect-text">Découvrez nos points de collectes et de distribution d'objets et matériaux sur notre carte interactive</p>
            <?php if ($user_id): ?>
                <a href="<?= getenv('BASE_URL'); ?>carte" class="collect-btn">Voir la carte</a>
            <?php else: ?>
                <a href="<?= getenv('BASE_URL'); ?>connexion" class="collect-btn">Voir la carte</a>
            <?php endif; ?>
        </section>


</main>

<script>
  window.accueilData = {
    nbObjetsRecycles: <?= (int)$nb_objets_recycles ?>,
    baseUrl: "<?= getenv('BASE_URL'); ?>"
  };
</script>
<script src="<?= getenv('BASE_URL'); ?>src/assets/js/Accueil.js"></script>
