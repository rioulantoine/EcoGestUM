<h1 style="text-align:center; margin: 32px 0 36px 0; font-size:2em; font-weight:700;">
    Objets Recyclables Disponibles
</h1>

<form method="get" class="search-filter-bar" style="margin: 0 auto 30px auto; display: flex; gap:16px; justify-content:center;">
    <input type="hidden" name="page" value="rechercheObjet" />
    <input type="text" name="search" placeholder="Rechercher…" value="<?= htmlspecialchars($search) ?>" class="search-box" />

    <select name="etat" class="etat-select">
        <option value="">Tous états</option>
        <?php foreach ($etats as $e): ?>
            <option
                value="<?= htmlspecialchars($e['id_etat_obj']) ?>"
                <?= ($etat == $e['id_etat_obj'] ? 'selected' : '') ?>
            >
                <?= htmlspecialchars($e['nom_etat_obj']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="categorie" class="categorie-select">
        <option value="">Toutes catégories</option>
        <?php foreach ($cats as $cat): ?>
            <option
                value="<?= htmlspecialchars($cat['id_cat_obj']) ?>"
                <?= ($categorie == $cat['id_cat_obj'] ? 'selected' : '') ?>
            >
                <?= htmlspecialchars($cat['nom_cat_obj']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="search-btn">Filtrer</button>
</form>

<?php if (!empty($success)): ?>
    <div class="message-success">Réservation effectuée avec succès !</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="message-error">Réservation impossible : déjà réservé ou erreur.</div>
<?php endif; ?>

<div class="objets-grid">
<?php foreach ($objets as $obj): ?>
    <?php
        $photo = $obj['lien_photo'];
        if (strpos($photo, 'http') === 0) {
            $photoSrc = $photo;
        } else {
            $photoSrc = getenv('BASE_URL') . 'src/assets/imgCache/' . htmlspecialchars($photo);
        }
    ?>
    <div class="objet-card"
        data-nom="<?= htmlspecialchars($obj['nom_obj_recycl']) ?>"
        data-desc="<?= htmlspecialchars($obj['desc_obj_recycl']) ?>"
        data-cat="<?= htmlspecialchars($obj['nom_cat_obj']) ?>"
        data-etat="<?= htmlspecialchars($obj['nom_etat_obj']) ?>"
        data-lieu="<?= htmlspecialchars($obj['loca_obj_recycl']) ?>"
        data-photo="<?= htmlspecialchars($obj['lien_photo']) ?>"
        data-id="<?= (int)$obj['id_obj_recycl'] ?>"
    >
        <img src="<?= $photoSrc ?>" alt="<?= htmlspecialchars($obj['nom_obj_recycl']) ?>" />
        <div class="objet-info">
            <strong><?= htmlspecialchars($obj['nom_obj_recycl']) ?></strong>
            <p><?= htmlspecialchars($obj['loca_obj_recycl']) ?></p>
            <span class="etat"><?= htmlspecialchars($obj['nom_etat_obj']) ?></span>
            <span class="categorie"><?= htmlspecialchars($obj['nom_cat_obj']) ?></span>
        </div>
    </div>
<?php endforeach; ?>
</div>

<div class="pagination">
    <?php for ($i = 1; $i <= $nbPages; $i++): ?>
        <a href="?page=rechercheObjet&num=<?= $i ?>&search=<?= urlencode($search) ?>&etat=<?= urlencode($etat) ?>&categorie=<?= urlencode($categorie) ?>"
           class="pagination-btn<?= ($page == $i ? ' active' : '') ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>

<?php require_once __DIR__ . '/Templates/popupObjet.php'; ?>

<script src="<?= getenv('BASE_URL'); ?>src/assets/js/popupObjet.js"></script>
