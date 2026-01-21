<?php require_once __DIR__ . '/../../Controller/HistoriqueOpRecyclageController.php'; ?>
<div class="histop-main-content">
    <div class="histop-header">
        <h1 class="histop-title">Historique des opérations de recyclage</h1>
        <div class="histop-searchzone">
            <form method="get" action="">
                <input type="hidden" name="page" value="dashboard" />
                <input type="hidden" name="section" value="historique" />
                <input type="text" name="search" class="histop-searchbar" placeholder="Rechercher une opération..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
                <select name="categorie" class="histop-categorie-select">
                    <option value="">Toutes catégories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id_cat_obj']; ?>" <?php if ($categorie == $cat['id_cat_obj']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($cat['nom_cat_obj']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="histop-search-btn" type="submit">Filtrer</button>
            </form>
        </div>
    </div>
    <div class="histop-table-section">
        <table class="histop-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Quantité récupérée</th>
                    <th>Types d'objets</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($operations as $op): ?>
                <tr>
                    <td><?php echo htmlspecialchars($op['date_op_recycl']); ?></td>
                    <td><?php echo htmlspecialchars($op['nom_op_recycl']); ?></td>
                    <td><?php echo htmlspecialchars($op['quantite']); ?> objets</td>
                    <td>
                        <?php foreach ($op['types'] as $type): ?>
                            <span class="histop-type histop-type-<?php echo strtolower(str_replace(' ', '-', $type)); ?>">
                                <?php echo htmlspecialchars($type); ?>
                            </span>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="histop-pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page-1; ?>&search=<?php echo urlencode($search); ?>&categorie=<?php echo urlencode($categorie); ?>" class="histop-pag-btn">‹</a>
            <?php endif; ?>
            <?php for ($i=1; $i<=$nb_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&categorie=<?php echo urlencode($categorie); ?>" class="histop-pag-btn<?php if ($i==$page) echo ' current'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $nb_pages): ?>
                <a href="?page=<?php echo $page+1; ?>&search=<?php echo urlencode($search); ?>&categorie=<?php echo urlencode($categorie); ?>" class="histop-pag-btn">›</a>
            <?php endif; ?>
        </div>
    </div>
</div>
