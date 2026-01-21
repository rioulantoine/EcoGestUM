<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Erreur | EcoGestUM</title>
  <link href="<?php echo getenv('BASE_URL'); ?>src/assets/css/style.css" rel="stylesheet" />
</head>
<body>
  <div class="error-main-box">
<video class="error-gif" src="<?php echo getenv('BASE_URL'); ?>src/assets/Images/cry.mp4" autoplay loop muted playsinline></video>
    <div class="error-title">Oups, une erreur est survenue</div>
    <div class="error-desc">
      ERREUR 404<br>
    </div>
    <a href="<?php echo getenv('BASE_URL'); ?>accueil" class="error-btn-home">Revenir à l’accueil</a>
  </div>
</body>
</html>
