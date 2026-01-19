
<?php if(isset($errorMessage) && $errorMessage == "unknown_project") : ?>
    <div id="error_message">Ce project est introuvable, merci d'utiliser les liens ci-dessous</div>
<?php endif ?>

<div id="banner_hp">
    <h1 class="subtitle green">Next Dev</h1>
    <h2>Un ensemble de ressources gratuites pour apprendre le développement web facilement : cours, astuces et code prêt à l'emploi.</h2>
    <h3>HTML, CSS, JavaScript, PHP, SQL</h3>
</div>


<?php
/* echo '<pre>';
print_r($_SESSION);
echo '<pre>'; */
print_r($title);
?>

<h4 class="subtitle white">Découvrir les cours</h4>

<div id="langages_table">

    <div>
        <a class="langage_option basics" href="<?= BASE_URL ?>?summary=basics">
            <img src="https://fneto-prod.fr/next-dev/public/img/web.png" alt="logo bases du web">
            <p>Les bases du développement web</p>
        </a>
    </div>

    <div>
        <a class="langage_option html" href="<?= BASE_URL ?>?summary=html">
            <img src="https://fneto-prod.fr/next-dev/public/img/html.png" alt="logo html">
            <p>HTML</p>
        </a>
    </div>

    <div>
        <a class="langage_option css" href="<?= BASE_URL ?>?summary=css">
            <img src="https://fneto-prod.fr/next-dev/public/img/css.png" alt="logo css">
            <p>CSS</p>
        </a>
    </div>

    <div>
        <a class="langage_option js" href="<?= BASE_URL ?>?summary=js">
            <img src="https://fneto-prod.fr/next-dev/public/img/javascript.png" alt="logo js">
            <p>Javascript</p>
        </a>
    </div>

    <div>
        <a class="langage_option php" href="<?= BASE_URL ?>?summary=php">
            <img src="https://fneto-prod.fr/next-dev/public/img/php.png" alt="logo php">
            <p>PHP</p>
        </a>
    </div>

</div>

<h4 class="subtitle white">Trucs et astuces</h4>
<p>A venir ...</p>

