<?php
// include ('accesserver.php');


include('Apostrophe.php');
try {
  $connexion = new PDO("mysql:host=$serveur;dbname=$database;charset=utf8", $login, $pass);
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $foncsqlMenu = "SELECT  DISTINCT CodeCommune, Commune, Dep FROM $table  WHERE REG_NOM = 'Nouvelle-Aquitaine'";

  $requeteidMenu = $connexion->prepare($foncsqlMenu);
  $requeteidMenu->execute();
  $Menu = $requeteidMenu->fetchall();


  $a = 0;
  $b = 0;
  $c = 0;
  while ($a < count($Menu)) {
    $textMenu = apostropheencode($Menu[$a++]['Commune'] . " (" . $Menu[$b++]['Dep']) . ")','";
    // $textMenu = apostropheencode($Menu[$c++]['CodeCommune']." ".$Menu[$a++]['Commune']." " ." (".$Menu[$b++]['Dep'].")")."','";

    echo $textMenu;
    // echo '<pre>';
    // print_r($textMenu);
    // echo '</pre>';
  };
} catch (PDOException $e) {
  echo 'Echec de la connexion : ' . $e->getmessage();
}
