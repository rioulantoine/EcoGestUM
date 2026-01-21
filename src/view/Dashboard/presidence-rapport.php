<?php
require_once __DIR__ . '/../../Controller/rapportController.php';
?>

<div class="dashboard-main-content">
    <div class="dashboard-container">
        
        <section class="rapport-form-section">
            <h2 class="section-title">Personnalisez votre rapport</h2>
            <?php if ($messagesup): ?>
                <div class="message-success"><?php echo htmlspecialchars($messagesup); ?></div>
            <?php endif; ?>
            <form method="POST" action="<?php echo getenv('BASE_URL'); ?>dashboard?section=rapport&action=generer" class="rapport-form">
                
                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input 
                        type="text" 
                        id="nom" 
                        name="nom" 
                        class="form-input" 
                        placeholder="Nom du rapport"
                        required
                    />
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-textarea" 
                        placeholder="Description du rapport"
                        rows="6"
                    ></textarea>
                </div>

                <div class="form-group">
                    <label for="periode" class="form-label">Période</label>
                    <select id="periode" name="periode" class="form-select" required>
                        <option value="">-- Sélectionner une période --</option>
                        <option value="trimestriel">Trimestrielle</option>
                        <option value="semestriel">Semestrielle</option>
                        <option value="annuel">Annuel</option>
                    </select>
                </div>

                <button type="submit" class="btn-generer">
                    Générer le rapport
                </button>
            </form>
        </section>

        <!-- Historique des rapports -->
        <section class="rapports-history-section">
            <h2 class="section-title">Historique des Rapports</h2>
            
            <?php             
            if (empty($rapports)): 
            ?>
                <div class="no-data">
                    <p>Aucun rapport généré pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="rapports-list">
                    <?php foreach ($rapports as $rapport): ?>
                        <div class="rapport-card-item">
                            <div class="rapport-card-header">
                                <h3 class="rapport-card-title">
                                    <?php echo htmlspecialchars($rapport['nom_rapport']); ?>
                                </h3>
                                <span class="rapport-card-date">
                                    <?php echo date('d/m/Y', strtotime($rapport['date_creation'])); ?>
                                </span>
                            </div>

                            <p class="rapport-card-description"><?php echo htmlspecialchars($rapport['desc_rapport']); ?></p>

                            <div class="rapport-card-footer">
                                <div class="rapport-card-info">
                                    <span class="rapport-card-periode">
                                        Période : <?php echo ucfirst($rapport['nom_periode']); ?>
                                    </span>
                                    <span class="rapport-card-author">
                                        Créé par : <?php echo htmlspecialchars($rapport['nom_ut'] . ' ' . $rapport['pren_ut']); ?>
                                    </span>
                                </div>
                                <a 
                                    href="rapport.pdf?id=<?php echo urlencode($rapport['id_rapport']); ?>" 
                                    download class="btn-telecharger-rapport">
                                    📥 Télécharger
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>
