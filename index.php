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
  <title>Espèces</title>
</head>

<body>

  <?php
  include(dirname(__FILE__) . '/includes/accesserver.php');
  ?>
  <form action="getuser.php" method="post">
    <input id="loc" type="search" value="" name="loc"></br>
    <div id="recherceDesk">
      <input id="GoDesk" type="submit" value="RECHERCHER" class="recherceDesk">
    </div>
    <div id="recherceMob">
      <input id="GoMob" type="submit" value="" class="rechercheMob">
    </div>
  </form>

</body>

<script>
  window.onload = autocompletion();
  /* Fonction sert à l'autocompletion */
  function autocompletion() {
    var gpA10 = [<?php echo "'", include(dirname(__FILE__) . '/includes/menu.php'), "'"; ?>];
    console.log(gpA10);
    $("#loc").autocomplete({
      source: gpA10
    });
  };
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<!-- <script src="js/card.js"></script> -->
<!-- <script src="js/camelize.js">
  camelize()
</script> -->


</html>