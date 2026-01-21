<?php
require_once __DIR__ . '/../Controller/messagerieController.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet">
    <title>Messagerie - EcoGestUM</title>
</head>
<body>
<div class="profil-page" style="background-image:url('<?= getenv('BASE_URL'); ?>src/assets/Images/ConnexionImg.png');">
    <div class="messagerie-page">
        <div class="back-arrow" onclick="window.location.href='<?= getenv('BASE_URL'); ?>accueil'">
            <svg viewBox="0 0 24 24" fill="none" stroke="#1B2963" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="messagerie-container">
            <div class="messagerie-list">
                <?php foreach ($conversations as $conv): ?>
                    <div class="messagerie-list-item <?= ($conv['id_conv'] == $selectedConv ? 'active' : '') ?>"
                        onclick="window.location.href='?conv=<?= $conv['id_conv']; ?>'">
                        <?= htmlspecialchars($conv['nom_user']) ?>
                        <a href="?page=messagerie&action=delete&conv=<?= $conv['id_conv'] ?>" 
                        class="messagerie-delete-btn" 
                        title="Supprimer la conversation" 
                        onclick="return confirm('Supprimer la conversation ?')">🗑️</a>
                    </div>
                <?php endforeach; ?>
                <div class="messagerie-list-item" style="background:#e3e9f7;">
                    <!-- FORMULAIRE -->
                    <form class="messagerie-add-conv" method="POST" action="?page=messagerie">
                        <input class="messagerie-email-input" type="email" name="new_conv_email" placeholder="Ajouter un email..." required />
                        <button class="messagerie-add-btn" type="submit">➕</button>
                    </form>
                    <!-- MESSAGE ERREUR -->
                    <?php if ($error_message): ?>
                        <div class="messagerie-error"><?= htmlspecialchars($error_message) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="messagerie-chat">
                <div class="messagerie-chat-header">
                    <?php
                    $headerName = '';
                    foreach ($conversations as $conv) {
                        if ($conv['id_conv'] == $selectedConv) {
                            $headerName = $conv['nom_user'];
                        }
                    }
                    ?>
                    <?= htmlspecialchars($headerName) ?>
                </div>
                <div class="messagerie-chat-messages">
                    <?php foreach ($messages as $msg): ?>
                        <div class="messagerie-message <?= $msg['id_ut'] == $user_id ? 'self' : 'other' ?>">
                            <div class="message-content"><?= htmlspecialchars($msg['contenu_mess']) ?></div>
                            <div class="message-date"><?= date('H:i', strtotime($msg['date_envoi_mess'])) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if ($selectedConv): ?>
                    <?php
                    $dest_id = '';
                    foreach ($conversations as $conv) {
                        if ($conv['id_conv'] == $selectedConv && isset($conv['id_dest'])) {
                            $dest_id = $conv['id_dest'];
                            break;
                        }
                    }
                    ?>
                    <form class="messagerie-form" method="POST"
                          action="?page=messagerie<?= $selectedConv ? '&conv='.htmlspecialchars($selectedConv) : '' ?>">
                        <input type="hidden" name="conv_id" value="<?= htmlspecialchars($selectedConv) ?>">
                        <input type="hidden" name="dest_id" value="<?= htmlspecialchars($dest_id) ?>">
                        <input type="text" name="message" placeholder="Écrire un message..." required />
                        <button type="submit">Envoyer</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
