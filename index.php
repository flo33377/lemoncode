
<!DOCTYPE html>
<html lang="fr">

<?php // dépendances
include_once(__DIR__ . "/src/main.php");
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./public/css/design-system.css">

  <meta name="theme-color" content="#0000">

  <script src="./public/js/js-functions.js" defer></script>

  <link rel="apple-touch-icon" sizes="180x180" href="https://fneto-prod.fr/next-dev/public/img/next-dev-favicon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="https://fneto-prod.fr/next-dev/public/img/next-dev-favicon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://fneto-prod.fr/next-dev/public/img/next-dev-favicon.png">

  <title>Next Dev</title>
</head>


<body>

<!-- injection des données du menu -->
<?php if($index_cours) : ?>
<script> 
  const indexCours = <?php echo json_encode($index_cours); ?>;
  const BASE_URL = "<?= BASE_URL ?>";
</script>

<?php else : 
    // cas index non trouvé ?>
    <p class="warning_message">Données introuvables.<br>
    Merci de réessayer plus tard.</p>
<?php endif ?>

  <header id="header">

    <svg id="menu_button" viewBox="0 0 24 24" aria-label="Menu" role="button">
      <line class="bar top" x1="3" y1="6"  x2="21" y2="6" />
      <line class="bar middle" x1="3" y1="12" x2="21" y2="12" />
      <line class="bar bottom" x1="3" y1="18" x2="21" y2="18" />
    </svg>


    <div>
      <a href='<?= BASE_URL ?>'>
        <img src="https://fneto-prod.fr/next-dev/public/img/next-dev-logo.png" alt="logo Next Dev">
      </a>
    </div>

    <div></div>

  </header>


  <div id="burger_menu">
  <!-- contenu injecté en JS -->
  </div>
  

  <main id='content'>

  <?php include($content); ?>


  <div id="nav_courses_bar">
    <div>
      <?php if ($prev): ?>
        <a href="<?= BASE_URL ?>?cours=<?= $prev ?>"> < Cours précédent</a>
      <?php endif; ?>
    </div>

    <div>
      <?php if ($next): ?>
        <a href="<?= BASE_URL ?>?cours=<?= $next ?>">Cours suivant ></a>
      <?php endif; ?>
    </div>
  </div>

  </main>

  <footer>
    <p>© Copyright <?= date('Y') ?><br>Florian Neto. Tous droits réservés.</p>
  </footer>


</body>

</html>