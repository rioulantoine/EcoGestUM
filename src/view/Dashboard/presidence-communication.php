
<?php
require_once __DIR__ . '/../../Controller/communicationController.php';
?>

<div class="dashboard-main-content">
    <div class="dashboard-container">
        <?php if ($message): ?>
            <div class="message-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <!-- Formulaire d'ajout de communication -->
        <section class="communication-form-section">
            <h2 class="section-title">Envoyer une Communication Officielle</h2>
            
            <form method="POST" class="communication-form">

                <div class="form-group">
                    <label for="titre" class="form-label">Objet de la communication</label>
                    <input 
                        type="text" 
                        id="titre" 
                        name="titre" 
                        class="form-input" 
                        placeholder="Saisissez l'objet de la communication"
                        maxlength="200"
                        required
                    />
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description de la communication</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-textarea" 
                        placeholder="Saisissez la description complète de la communication"
                        rows="10"
                        required
                    ></textarea>
                </div>

                <div class="form-group">
                    <label for="pieces-jointes" class="form-label">Pièces jointes</label>
                    <div class="file-input-wrapper">
                        <input 
                            type="file" 
                            id="pieces-jointes" 
                            name="pieces_jointes[]" 
                            class="file-input"
                            multiple
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png"
                        />
                        <label for="pieces-jointes" class="file-label">
                            <span class="file-icon">📎</span> Ajouter des pièces jointes
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-envoyer">ENVOYER</button>
            </form>
        </section>
    </div>
</div>