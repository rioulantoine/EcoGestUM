<nav class="menu-burger-zone">
  <input type="checkbox" id="menu-toggle" class="menu-toggle" />
  <label for="menu-toggle" class="menu-icon">&#9776;</label>
  <div class="menu-dropdown">
    <ul class="menu-list">
    <?php if(get_nom_role($_SESSION['user']['roles'][0]) == 'Présidence'): ?>
        <li><a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=impact">Impact</a></li>
        <li><a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=communication">Communication</a></li>
        <li><a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=rapport">Générer Rapport</a></li>
    <?php else: ?>
        <li><a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=inventaire">Inventaire</a></li>
        <li><a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=communication">Communication</a></li>
        <li><a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=impact">Impact</a></li>
        <li><a href="<?php echo getenv('BASE_URL'); ?>dashboard?section=historique">Historique</a></li> 
    <?php endif; ?>
    </ul>
  </div>
</nav>
