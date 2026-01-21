<?php require_once __DIR__ . '/../../Controller/InventaireDepController.php'; ?>
<div class="invdep-main-content">
    <div class="invdep-header">
        <h1 class="invdep-title">Inventaire du département</h1>
        <div class="invdep-searchzone">
            <form method="get" action="">
                <input type="hidden" name="page" value="dashboard" />
                <input type="hidden" name="section" value="inventaire" />
                <input type="text" name="search" class="invdep-searchbar" placeholder="Rechercher un objet..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
                <select name="etat" class="invdep-etat-select">
                    <option value="">Tous états</option>
                    <?php foreach ($etats as $e): ?>
                        <option value="<?php echo $e['id_etat_obj']; ?>" <?php if ($etat == $e['id_etat_obj']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($e['nom_etat_obj']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="categorie" class="invdep-categorie-select">
                    <option value="">Toutes catégories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id_cat_obj']; ?>" <?php if ($categorie == $cat['id_cat_obj']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($cat['nom_cat_obj']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="invdep-search-btn" type="submit">Filtrer</button>
            </form>

        </div>
    </div>
    <div class="invdep-table-section">
        <table class="invdep-table">
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Localisation</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($inventaire as $objet): ?>
                <tr>
                    <td>
                        <span class="invdep-cat invdep-cat-<?php echo strtolower($objet['categorie']); ?>">
                            <?php echo htmlspecialchars($objet['categorie']); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($objet['nom']); ?></td>
                    <td><?php echo htmlspecialchars($objet['description']); ?></td>
                    <td><?php echo htmlspecialchars($objet['localisation']); ?></td>
                    <td>
                        <span class="invdep-etat invdep-etat-<?php echo strtolower(str_replace(' ', '-', $objet['etat'])); ?>">
                            <?php echo htmlspecialchars($objet['etat']); ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="invdep-pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&etat=<?php echo urlencode($etat); ?>&categorie=<?php echo urlencode($categorie); ?>" class="invdep-pag-btn">‹</a>
            <?php endif; ?>
            <?php for ($i=1; $i<=$nb_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&etat=<?php echo urlencode($etat); ?>&categorie=<?php echo urlencode($categorie); ?>" class="invdep-pag-btn<?php if ($i==$page) echo ' current'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $nb_pages): ?>
                <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&etat=<?php echo urlencode($etat); ?>&categorie=<?php echo urlencode($categorie); ?>" class="invdep-pag-btn">›</a>
            <?php endif; ?>
        </div>
    </div>
</div>
