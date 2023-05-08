<?php

include ('Apostrophe.php');
// include ('accesserver.php');
try{
  $connexion = new PDO("mysql:host=$serveur;dbname=$database;charset=utf8", $login, $pass);
  $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  $foncsqlMenu = "SELECT CodeCommune, Commune, Dep FROM $table";
  
  $requeteidMenu = $connexion->prepare($foncsqlMenu);
  $requeteidMenu->execute();
  $Menu = $requeteidMenu->fetchall();
  

    $a=0;
    $b=0;
    $c=0;
    while ($a < count($Menu)) {
      $textMenu = apostropheencode($Menu[$a++]['Commune']." (".$Menu[$b++]['Dep']).")','";
      $textMenu2 = $Menu[$c++]['CodeCommune'];
      // $textMenu = substr(apostropheencode($Menu[$c++]['CodeCommune']."".$Menu[$a++]['Commune']),5)."','";
      echo $textMenu2;
    }
    // print_r($textMenu2);
}
catch(PDOException $e){
  echo 'Echec de la connexion : ' .$e->getmessage();
}

  ?> 