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
  <title>Espèces</title>
</head>

<body>
<div class="fond"></div>
    <div class="content">
  <?php
  include(dirname(__FILE__) . '/includes/accesserver.php');
  include(dirname(__FILE__) . '/includes/Apostrophe.php');
  ?>
  <h1><mark>Ipsum dolor sit amet consectetur</mark></h1>
  <h3>Rechercher, ipsum dolor sit amet consectetur adipisicing elit.</h3>
  <?php
  include(dirname(__FILE__) . '/includes/search.php');
  ?>
  <h3>Adipisicing elit. Sit inventore nihil sed ipsam similique obcaecati commodi quas impedit. Ducimus amet veritatis asperiores, tempore officiis odio quidem veniam cum! Voluptas, sit.</h3>
    <p>Ipsum dolor sit amet consectetur adipisicing elit. Sit inventore nihil sed ipsam similique obcaecati commodi quas impedit.</p>
    <?php
  ?>
  <section id="solutions" style="display: block;">
  <button class="accordion">- Sources -</button>
  <div class="panel flex-container">
    <?php 
      include(dirname(__FILE__) . '/includes/sources.php');
    ?>
		 </div>
    </section>
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