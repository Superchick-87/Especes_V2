<?php
header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");


?>
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

<!-- <body class="pattern-dots-sm"> -->
<body class="fond">
    <!-- <div class="fond"> -->
    <?php
    include(dirname(__FILE__) . '/includes/accesserver.php');
    include(dirname(__FILE__) . '/includes/ddc.php');
    include(dirname(__FILE__) . '/includes/Apostrophe.php');
    // include(dirname(__FILE__) . '/includes/search.php');

    @$loc = apostropheencode($_POST['loc']);
    @$dep = $_POST['Dep'];

    echo $loc . '<br>';
    $commune = substr($loc, 0, -5);
    echo $commune . '<br>';

    $dep = dep(substr($loc, -4));
    echo $dep . '<br>';
    /*----------  Connexion à la bdd  ----------*/
    $connexion = new PDO("mysql:host=$serveur;dbname=$database;charset=utf8", $login, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*----------  Récupération et affichage des données  ----------*/
    $codeCommune = "SELECT CodeCommune FROM $table WHERE Commune = '$commune' AND Dep = '$dep'";
    $latCommune = "SELECT LatCommune FROM $table WHERE Commune = '$commune' AND Dep = '$dep'";
    $longCommune = "SELECT LongCommune FROM $table WHERE Commune = '$commune' AND Dep = '$dep'";
    $Renc = $connexion->query($codeCommune);
    $data = $Renc->fetch();

    $Rencx = $connexion->query($latCommune);
    $datax = $Rencx->fetch();

    $Rencxx = $connexion->query($longCommune);
    $dataxx = $Rencxx->fetch();

    echo "<input id='CodeCommune'  type='text' value=" . $data['CodeCommune'] . ">";
    echo "<input id='LatCommune'  type='text' value=" . $datax['LatCommune'] . ">";
    echo "<input id='LongCommune'  type='text' value=" . $dataxx['LongCommune'] . ">";
    echo "<input id='dep'  type='text' value=" . $dep . ">";
    echo "<input id='loc'  type='text' value=" . $loc  . ">";
    echo '<div id="viz" class="map" >
        <svg id="map">
        </svg>
    </div>
    <div class="x row dashboard-cards"></div></br>
    <div id="txtHint">
    </div>';

    ?>
<!-- </div> -->
</body>

</html>
<script src="js/afficheCarte.js"></script>
<script>
    
    function showData() {
    var locCode = document.getElementById('CodeCommune').value;
    if (locCode != "") {
        console.log(locCode);

        var callBackSuccess = function(data) {
            console.log(data);
            var element = document.getElementById('txtHint');
            var tableau = new Array();
            var k = 0;

            Object.keys(data).forEach(key => {
                //console.log(key, data[key]);
                var l = 0;
                var cdref = new Array();
                Object.keys(data[key]).forEach(key2 => {
                    // console.log(key,key2, data[key][key2]);
                    cdref[l++] = data[key][key2];
                })
                tableau[k++] = {
                    'nom': key,
                    'cdref': cdref
                };
            });



            for (let i = 0; i <= tableau.length - 1; i++) {
                const matches = document.querySelector('.x');
                matches.innerHTML +=
                    '<div   id="' + camelize(tableau[i].nom) + '" class="card col-md-4 ' + camelize(tableau[i].nom) + '">' +
                    // '<audio id="audio' + i + '" src="media/SON_' + camelize(tableau[i].nom) + '.mp3"></audio>' +
                    '<div class="card-title bordHaut ' + camelize(tableau[i].nom) + '">' +
                    '<div style="display:flex;">' +
                    '<img class="picto" src=images/' + camelize(tableau[i].nom) + '.png>' +
                    '<div  class="filetTitre">' +
                    '<h2>' + tableau[i].nom + '</h2>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="card-flap flap1">' +
                    '<div class="card-description">' +
                    '<ul class="y task-list">' +
                    '</div>' +
                    '<div class="card-flap flap2">' +
                    '<div class="card-actions">' +
                    '<a class="btn" href="#">Fermer</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                var n = 0;

                for (let j = 0; j <= tableau[i].cdref.length - 1; j++) {
                    var url2 = "https://taxref.mnhn.fr/api/taxa/" + tableau[i].cdref[j].cd_ref + "/media";
                    var callBackSuccess2 = function(data2) {
                        console.log(data2);
                        const mat = document.querySelectorAll('.y');
                        console.log(tableau[i].cdref[j].cd_ref)
                        // if (tableau[i].cdref[j].enjeu_conservation == 'Très fort') {
                            
                            mat[i].innerHTML +=
                            '<li>' +
                            "<h3>" + tableau[i].cdref[j].nom_vern + "</h3>" +
                            "<h4>" + tableau[i].cdref[j].lb_nom + "</h4>" +
                            "<img class='visu' src='" + data2?._embedded?.media[0]?._links?.thumbnailFile?.href + "'>" +
                            "<legend>Photo : " + data2?._embedded?.media[0]?.copyright + "</legend>" +
                            '<p>Enjeu conservation : ' + tableau[i].cdref[j].enjeu_conservation + "</p>" +
                            "<p>Nombre d/'observation(s) : " + tableau[i].cdref[j].nb_obs + "</p>" +
                            '</li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        // }
                    }

                    $.get(url2, callBackSuccess2).done(function() {})
                        .fail(function() {
                            alert("erreur");
                        })
                        .always(function() {
                            // body...
                        });
                };
            };
            card();
        };


        var url = "https://observatoire-fauna.fr/api/sudouest_especes_menacees_autour_ma_commune?commune=" + locCode;
        $.get(url, callBackSuccess).done(function() {})
            .fail(function() {
                alert("erreur");
            })
            .always(function() {

            });
    }
    }
    showData();
</script>
<script src="js/card.js"></script>
<script src="js/camelize.js">
    camelize()
</script>
<!-- 
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script> -->