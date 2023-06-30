<!DOCTYPE html>
<html lang="en">
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="js/1121_jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.1/d3.min.js"></script>

  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/style2.css">
  <link href="https://unpkg.com/pattern.css" rel="stylesheet">
  <title>Les vigies, découvrez les espèces à protéger dans votre commune en Nouvelle-Aquitaine [par la rédaction de Sud Ouest]</title>
</head>

<body>
  <div class="fond"></div>
  <div class="content">
    <?php
    include(dirname(__FILE__) . '/includes/accesserver.php');
    include(dirname(__FILE__) . '/includes/Apostrophe.php');
    ?>
    <h1 class="titreFdBlanc"><mark>Découvrez les espèces sauvages observées près de chez vous</mark></h1>
    <!-- </br> -->
    <div class="d1"></div>
    <h3 class="txtMajeur">Indiquez le nom d'une commune de Nouvelle-Aquitaine</h3>
    <?php
    include(dirname(__FILE__) . '/includes/search.php');
    ?>
    <p class="txtMajeur">Saisissez les premières lettres d'une commune de Nouvelle-Aquitaine pour faire votre choix dans la liste qui s'affiche. Puis cliquez sur la loupe ou "Je lance la recherche" pour découvrir les espèces sauvages observées dans cette commune.</p>
    <?php
    ?>
    <!-- <section id="solutions" style="display: block;">
      <button class="accordion">- Sources -</button>
      <div class="panel flex-container">
        <?php
        include(dirname(__FILE__) . '/includes/sources.php');
        ?>
      </div>
    </section> -->
  </div>
  <div class="blocLogo">
    <img class="logo" src="images/Logo_LesVigies.png" alt="Les Vigies">
    <img class="logo" src="images/Logo_SO.png" alt="Sud Ouest">
  </div>
</body>
<script src="js/accordeon.js"></script>
<script>
  window.onload = autocompletion();
  /* Fonction sert à l'autocompletion */
  function autocompletion() {
    var gpA10 = [<?php echo "'", include(dirname(__FILE__) . '/includes/menu.php'), "'"; ?>];
    console.log(gpA10);
    $("#locSearch").autocomplete({
      source: gpA10
    });
  };
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

</html>