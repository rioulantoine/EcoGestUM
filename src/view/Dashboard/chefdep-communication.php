<?php
require_once __DIR__ . '/../../Controller/communicationChefDepController.php';
?>
<div class="dashboard-main-content">
    <div class="dashboard-container">
        <?php if ($message): ?>
            <div class="message-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <section class="communication-form-section">
            <h2 class="section-title">Envoyer une notification à un utilisateur</h2>
            <form method="POST" class="communication-form">
                <div class="form-group">
                    <label for="destinataires" class="form-label">Destinataires (login ou email)</label>
                    <input 
                        type="text" 
                        id="destinataires" 
                        name="destinataires" 
                        class="form-input" 
                        placeholder="Login ou email du destinataire"
                        maxlength="200"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="titre" class="form-label">Objet de la notification</label>
                    <input 
                        type="text" 
                        id="titre" 
                        name="titre" 
                        class="form-input" 
                        placeholder="Titre / objet"
                        maxlength="200"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="description" class="form-label">Description de la notification</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-textarea" 
                        placeholder="Description complète"
                        rows="10"
                        required
                    ></textarea>
                </div>
                <input type="hidden" name="type_notif" value="1">
                <button type="submit" class="btn-envoyer">ENVOYER</button>
            </form>
        </section>
    </div>
</div>
