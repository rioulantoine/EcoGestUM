<?php 
require_once __DIR__ . '/../Controller/communicationController.php';
?>

<section class="headerPages"> 
    <nav class="breadcrumb">
        <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="breadcrumbitem">Accueil</a>
        <span class="breadcrumbseparator">></span>
        <span class="breadcrumbitem active">Communications Officielles</span>
    </nav>
    <h1 class="breadcrumb_title">Communications Officielles</h1>
</section>
<?php if ($messagesup): ?>
            <div class="message-success"><?php echo htmlspecialchars($messagesup); ?></div>
<?php endif; ?>

<div class="communications-container">
    <?php     
    if (empty($communications)): 
    ?>
        <div class="no-communications">
            <p>Aucune communication officielle pour le moment.</p>
        </div>
    <?php else: ?>
        <?php foreach ($communications as $comm): ?>
            <div class="communication-card">
                <div class="communication-header">
                    <h2 class="communication-title">
                        <?php echo htmlspecialchars($comm['titre_comm']); ?>
                    </h2>
                    <span class="communication-date">
                        <?php echo date('d/m/Y', strtotime($comm['date_comm'])); ?>
                    </span>
                </div>
                

                <div class="communication-content">
                    <p class="communication-description">
                        <?php echo nl2br(htmlspecialchars($comm['contenu_comm'])); ?>
                    </p>
                </div>
                
                <div class="communication-footer">
                    <div class="communication-author">
                        <span class="author-label">Publié par :</span>
                        <span class="author-name">
                            <?php echo htmlspecialchars($comm['nom_ut'] . ' ' . $comm['pren_ut']); ?>
                        </span>
                    </div>
                    <?php if (get_nom_role($_SESSION['user']['roles'][0])==='Présidence'): ?>
                    <form method="POST" action="<?php echo getenv('BASE_URL'); ?>communications?action=supprimer">
                        <input type="hidden" name="id_comm" value="<?php echo $comm['id_comm']; ?>">
                        <button type="submit" class="btn-delete-link" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette communication ?');" >
                            Supprimer
                        </button>
                    </form>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>