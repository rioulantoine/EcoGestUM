<section class="headerPages">
  <nav class="breadcrumb">
    <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
    <span class="breadcrumbseparator">&gt;</span>
    <a href="<?php echo getenv('BASE_URL'); ?>espace-reprise" class="breadcrumbitem">Espace Reprise</a>
    <span class="breadcrumbseparator">&gt;</span>
    <span class="breadcrumbitem active">Carte interactive</span>
  </nav>
  <h1 class="carte__title">Carte interactive</h1>
</section>

<main class="main-content-carte">
  <section class="carte-section">
    <div class="carte-wrapper">
      <div id="map" class="carte-img"></div>
    </div>
    <div class="cards-lieux">
      <div class="lieu-card" data-card="campus">
        <img src="<?php echo getenv('BASE_URL')."src/assets/Images/campus.png"; ?>" alt="Campus" class="lieu-img">
        <h2>Retrait campus</h2>
        <p><strong>Description :</strong><br>Récupérez facilement votre commande directement sur le campus de l’Université du Mans, au cœur de la vie étudiante. Un point pratique et rapide, à deux pas de vos salles de cours et de la bibliothèque.</p>
        <div class="lieu-addr">Le Mans Université, campus principal<br>Avenue Olivier Messiaen</div>
        <a
          href="https://www.google.com/maps/search/?api=1&query=Le+Mans+Universit%C3%A9+Avenue+Olivier+Messiaen+72000+Le+Mans"
          target="_blank"
          class="map-btn"
          data-marker="campus"
        >Voir sur maps</a>
      </div>

      <div class="lieu-card" data-card="rep">
        <img src="<?php echo getenv('BASE_URL')."src/assets/Images/rep.png"; ?>" alt="République" class="lieu-img">
        <h2>Retrait place de république</h2>
        <p><strong>Description :</strong><br> Profitez d’un retrait en plein centre-ville du Mans, sur la place de République. Idéal pour combiner vos courses, vos sorties ou un café en terrasse avec la récupération de votre commande.</p>
        <div class="lieu-addr">13 Place de la République,<br>72000 Le Mans</div>
        <a
          href="https://www.google.com/maps/search/?api=1&query=13+Place+de+la+R%C3%A9publique+72000+Le+Mans"
          target="_blank"
          class="map-btn"
          data-marker="rep"
        >Voir sur maps</a>
      </div>

      <div class="lieu-card" data-card="saint">
        <img src="<?php echo getenv('BASE_URL')."src/assets/Images/saint-sat.png"; ?>" alt="Saint-Saturnin" class="lieu-img">
        <h2>Retrait Saint-Saturnin</h2>
        <p><strong>Description :</strong><br>Un point de retrait pratique situé dans la zone commerciale de Saint-Saturnin, parfait pour récupérer votre commande en même temps que vos autres achats.</p>
        <div class="lieu-addr">Rue de la Mairie,<br>72650 Saint-Saturnin</div>
        <a
          href="https://www.google.com/maps/search/?api=1&query=Rue+de+la+Mairie+72650+Saint-Saturnin"
          target="_blank"
          class="map-btn"
          data-marker="saint"
        >Voir sur maps</a>
      </div>
    </div>
  </section>
</main>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""></script>
<script src="<?php echo getenv('BASE_URL'); ?>src/assets/js/Carte.js"></script>
