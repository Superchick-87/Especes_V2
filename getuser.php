<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/1121_jquery-ui.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.1/d3.min.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/style2.css">
    <link href="https://unpkg.com/pattern.css" rel="stylesheet">
    <title>Les vigies, découvrez les espèces à protéger dans votre commune en Nouvelle-Aquitaine [par la rédaction de Sud Ouest]</title>

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->


</head>

<body>
    <script>
        jQuery(document).ready(function() {
            var duration = 500;
            jQuery(window).scroll(function() {
                if (jQuery(this).scrollTop() > 100) {
                    // Si un défillement de 100 pixels ou plus.
                    // Ajoute le bouton
                    jQuery('.cRetour').fadeIn(duration);
                } else {
                    // Sinon enlève le bouton
                    jQuery('.cRetour').fadeOut(duration);
                }
            });

            jQuery('.cRetour').click(function(event) {
                // Un clic provoque le retour en haut animé.
                event.preventDefault();
                jQuery('html, body').animate({
                    scrollTop: 0
                }, duration);
                return false;
            })
        });
    </script>



    <div class="fond"></div>
    <div class="content">

        <?php
        include(dirname(__FILE__) . '/includes/accesserver.php');
        include(dirname(__FILE__) . '/includes/ddc.php');
        include(dirname(__FILE__) . '/includes/Apostrophe.php');

        @$loc = apostropheencode($_POST['loc']);
        @$dep = $_POST['Dep'];

        // echo $loc . '<br>';
        $commune = substr($loc, 0, -5);
        // echo $commune . '<br>';

        $dep = dep(substr($loc, -4));
        // echo $dep . '<br>';
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
        $mm = '';
        if ($commune == true) {
            // echo '<span id="nbreTotal"></span>';
            // echo "<input id='CodeCommune' style='display:none;' type='text' value=" . $data['CodeCommune'] . ">";
            echo '<h2 class="titreFdBlanc"><mark><span id="nbreTotal"></span><span> espèces observées près de ' . apostrophedecode($commune) . '</span></mark></h2>';
            echo '<h5 class="txtMajeur" style="margin-bottom: 30px;">Dans un rayon de 5 km depuis janvier 2000</h5>';
            echo "<input id='CodeCommune' style='display:none;' type='text' value=" . $data['CodeCommune'] . ">";
            echo "<input id='LatCommune'  style='display:none;' type='text' value=" . $datax['LatCommune'] . ">";
            echo "<input id='LongCommune'  style='display:none' type='text' value=" . $dataxx['LongCommune'] . ">";
            echo "<input id='dep'  style='display:none' type='text' value=" . $dep . ">";
            echo '<input id="loc"  style="display:none;" type="text" value="' . apostrophedecode($commune) . '">';
            echo '
            <div style="display:flex;flex-wrap: wrap;justify-content: center;">
                <div style="display:flex; justify-content: center; margin:0px 10px 5px 10px">
                    <input id="stopButton" onclick="mutePage()" type="button" value="" class="son sonOn"/>
                    <input id="playButton" onclick="muteNoPage()" type="button" value="" class="son sonOff"/>
                </div>
                <input type="button" value="" class="accordion carte" style="margin:0px 10px 5px 10px"/>
                
                <div class="panel" style="order: 0; flex: 1 0 100%; ">
                
                    <div id="viz" class="map" >
                        <svg id="map">
                        </svg>
                    </div>           
                </div>
            </div>
           
            
    <div class="x row dashboard-cards"></div></br>
    <div id="txtHint">
    <h3 class="blanc">Changer de commune</h3>';
            include(dirname(__FILE__) . '/includes/search.php');
        ?>
    </div>
    </br>
    <div class="avSource">
        <h3>Comprendre les indicateurs</h3>
        <h5>Le statut de chaque espèce est déterminé selon les critères des listes rouges de l'Union Internationale pour la Conservation de la Nature (UICN).</h5>
        <hr>
        <div class="notice">
            <img class="noticeImg" src="images/notice_01.svg" alt="Notice 1">
            <img class="noticeImg" src="images/notice_02.svg" alt="Notice 2">
            <img class="noticeImg" src="images/notice_03.svg" alt="Notice 3">
        </div>
        <hr>
        <div class="container">
            <p>L'enjeu de conservation de chaque espèce résulte du croisement entre sa valeur patrimoniale et un risque ou une menace identifiée (habitat, seuils environnementaux, interdépendance avec d'autres espèces, capacité à se déplacer sur de nouveaux territoires, etc). Il est évalué pour chaque espèce selon une typologie allant de "Faible" à "Très fort".</p>
        </div>
        <hr>
        <!-- <div class="container"> -->
        <p class="textPlus">Les données diffusées reflètent l’état d’avancement des connaissances partagées et disponibles dans le cadre de la mise en œuvre du Système d'information de l'inventaire du patrimoine (SINP). Elles ne sauraient être considérées comme exhaustives. Ces données font l'objet d'un processus de validation : seules celles considérées certaines ou probables sont diffusées, ainsi que celles pour lesquelles la méthode n'est pas applicable.</p>
        <!-- </div> -->
    </div>
    <div class="txtMajeur">
        <img src="images/mail.png" alt="Mail">
        <p>Votre avis nous intéresse !</p>
        <a class="linkMail" href="mailto:infographies@sudouest.fr">
            <p>infographies@sudouest.fr</p>
        </a>
    </div>
    </br>
    <section id="solutions" style="display: block;">
        <button class="accordion">Sources et crédits</button>
        <div class="panel flex-container">
            <?php
            include(dirname(__FILE__) . '/includes/sources.php');
            ?>
        </div>
    </section>
    </br>
    </div>
    </div>
<?php
        } else {
            echo '<h1><mark>Aucune information n\'a été trouvée !</mark></h1>
           
            <h3 class="blanc">Nouvelle recherche</h3>';
            include(dirname(__FILE__) . '/includes/search.php');
        };
?>
</div>
</br>
<section id="solutions" style="display: block;">
    <button class="accordion">- Sources -</button>
    <div class="panel flex-container">
        <?php
        include(dirname(__FILE__) . '/includes/sources.php');
        ?>
    </div>
</section>
<div class="blocLogo">
    <a href="index.php"><img class="logo" src="images/Logo_LesVigies.png" alt="Les Vigies"></a>
    <img class="logo" src="images/Logo_SO.png" alt="Sud Ouest">
</div>

<div class="cRetour"></div>
</body>

</html>
<script src="js/afficheCarte.js"></script>
<script>
    function showData() {

        var locCode = document.getElementById('CodeCommune').value;
        if (locCode != "") {
            // console.log(locCode);

            var callBackSuccess = function(data) {
                console.log(data);
                var element = document.getElementById('txtHint');
                var tableau = new Array();
                var k = 0;

                Object.keys(data).forEach(key => {
                    // console.log(key, data[key]);
                    var l = 0;
                    var cdref = new Array();
                    Object.keys(data[key]).forEach(key2 => {
                        // console.log(key,key2, data[key][key2]);
                        cdref[l++] = data[key][key2];
                    })

                    tableau[k++] = {
                        'nom': key,
                        'cdref': cdref.sort(function(a, b) {
                            return b.nb_obs - a.nb_obs;
                        })
                    };
                    // tableau[k++] = {
                    //     'nom': key,
                    //     'cdref': cdref
                    // };
                });
                console.log(tableau)


                for (let i = 0; i <= tableau.length - 1; i++) {
                    const matches = document.querySelector('.x');
                    matches.innerHTML +=
                        '<div onclick="play(' + i + ')"  id="' + camelize(tableau[i].nom) + '" class="card col-md-4 ' + camelize(tableau[i].nom) + '">' +
                        // '<div onclick="change_mute()" id="stop">stop</div>'+
                        '<audio id="audio' + i + '" src="media/SON_' + camelize(tableau[i].nom) + '.mp3"></audio>' +
                        '<div class="card-title bordHaut ' + camelize(tableau[i].nom) + '">' +
                        '<div style="display:flex;">' +
                        '<img class="picto" src=images/' + camelize(tableau[i].nom) + '.png>' +
                        '<div  class="filetTitre">' +
                        '<h2>' + nomEsp(tableau[i].nom) + '</h2>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="card-flap flap1">' +
                        '<div class="card-description">' +
                        '<ul class="y task-list">' +
                        '</div>' +
                        '<div class="card-flap flap2">' +
                        '<div class="card-actions">' +
                        '<a class="btn" href="#">Replier pour voir une autre catégorie</a>' +
                        '</div>' +
                        '</div>' +
                        '<div style="height:70px;">' +
                        '</div>' +
                        '</div>';
                    var n = 0;

                    for (let j = 0; j <= tableau[i].cdref.length - 1; j++) {
                        var url2 = "https://taxref.mnhn.fr/api/taxa/" + tableau[i].cdref[j].cd_ref + "/media";
                        var callBackSuccess2 = function(data2) {
                            // console.log(data2);
                            const mat = document.querySelectorAll('.y');
                            // console.log(tableau[i].cdref[j].uri_fiche_espece);
                            // console.log(tableau[i].cdref[j].cd_ref)
                            // if (tableau[i].cdref[j].enjeu_conservation == 'Très fort') {

                            // tableau[i].cdref.sort(function(a, b) {
                            //     return b.nb_obs - a.nb_obs;
                            // });
                            mat[i].innerHTML +=
                                '<li>' +
                                "<h3 class='nomCom'>" + suppArticle(displayNulTxt(tableau[i].cdref[j].nom_vern)) + "</h3>" +
                                "<h4 class='nomLatin'>" + tableau[i].cdref[j].lb_nom + "</h4>" +
                                "<img class='w visu' src='" + data2?._embedded?.media[0]?._links?.thumbnailFile?.href + "'>" +
                                "<legend>Photo : " + data2?._embedded?.media[0]?.copyright + "</legend>" +

                                '<div class="menaceBloc">' +
                                '<img class="menace" src="images/' + tableau[i].cdref[j].categorie_menace + '.svg" alt="' + tableau[i].cdref[j].categorie_menace + '">' +
                                '<p class="menacext ' + tableau[i].cdref[j].categorie_menace.toUpperCase() + '">' + menace(tableau[i].cdref[j].categorie_menace) + '</p>' +
                                '</div>' +

                                '<div class="fiche">' +
                                '<div class="pictoFiche">' +
                                '<div class="txtFiche txt' + displayNul(tableau[i].cdref[j].enjeu_conservation) + '">' + displayNulTxt(tableau[i].cdref[j].enjeu_conservation) + '</div>' +
                                '<div class="obs ' + displayNul(tableau[i].cdref[j].enjeu_conservation) + '"></div>' +
                                '<p>Enjeu de conservation</p>' +
                                '</div>' +
                                '<div class="pictoFiche">' +
                                '<div class="txtFiche">' + tableau[i].cdref[j].nb_obs + '</div>' +
                                '<div class="obs vues"></div>' +
                                '<p>Observation(s)</p>' +
                                '</div>' +
                                '</div>' +
                                '<div class="linkBloc">' +
                                '<img class="menace" src="images/linkFile.svg" alt="Lien vers la fiche">' +
                                '<input class="linkB" type=button onclick=window.open("' + tableau[i].cdref[j].uri_fiche_espece + '","_blank");  value="Pour aller plus loin avec FAUNA"/>' +
                                '</div>' +
                                '</li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            // }
                        }

                        $.get(url2, callBackSuccess2).done(function() {})
                            .fail(function() {
                                // alert("erreur");
                            })
                            .always(function() {
                                supp();
                                nomCom();
                                const nomCo = document.querySelectorAll(".nomCom");
                                var elem = document.getElementById("nbreTotal");
                                elem.innerHTML = nomCo.length;
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
    displayNul();
</script>

<script src="js/accordeon.js"></script>
<script src="js/card.js"></script>
<script src="js/camelize.js">
    camelize()
</script>

<script src="js/suppArticle.js">
    suppArticle()
</script>
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

<script>
    /**
     * agrège le son
     */
    function play(idx) {
        var audio = document.getElementById("audio" + idx);
        audio.play();
    }

    var test = document.getElementById('stopButton');
    var testp = document.getElementById('playButton');

    /**
     * mute tous les sons
     */
    document.getElementById('playButton').style.display = "none";

    function muteMe(elem) {
        elem.muted = true;
        document.getElementById('stopButton').style.display = "none";
        document.getElementById('playButton').style.display = "block";
    } // Try to mute all video and audio elements on the page
    function mutePage() {
        var elems = document.querySelectorAll("video, audio");

        [].forEach.call(elems, function(elem) {
            muteMe(elem);
        });
    }
    /**
     * no mute tous les sons
     */
    function muteNoMe(elem) {
        elem.muted = false;
        document.getElementById('stopButton').style.display = "block";
        document.getElementById('playButton').style.display = "none";
    } // Try to mute all video and audio elements on the page
    function muteNoPage() {
        var elems = document.querySelectorAll("video, audio");

        [].forEach.call(elems, function(elem) {
            muteNoMe(elem);
        });
    }

    /**
     * met le volume à 0 NE FONCTIONNE PAS SR IPHONE
     */

    // testp.style.display = "none";
    // test.addEventListener('click', () => {
    //     document.querySelectorAll('audio').forEach(el => el.volume = 0);
    //     test.style.display = "none";
    //     testp.style.display = "block";
    // });

    /**
     * met le volume à 1
     */
    // testp.addEventListener('click', () => {
    //     document.querySelectorAll('audio').forEach(el => el.volume = 1);
    //     test.style.display = "block";
    //     testp.style.display = "none";
    // });
</script>

<script>
    /**
     * Sert à supprimer le bloc image et légende si 'undifined'
     */
    function supp() {
        var legend = document.querySelectorAll("legend");
        var image = document.querySelectorAll(".w");
        // console.log(image.length);
        for (let g = 0; g < image.length; g++) {
            if (image[g].src == "https://infographie.sudouest.fr/Les-Vigies-des-especes-a-proteger/undefined") {
                // if (image[g].src == "http://localhost:8888/Especes_V2/undefined") {
                // if (image[g].src == "https://superchick.fr/Especes/undefined") {
                image[g].style.display = "none";
                legend[g].style.display = "none";
            }
        }
    }
    /**
     * FIN - Sert à supprimer le bloc image et légende si 'undifined'
     */

    /**
     * Sert à appeler la class 'NonEvaluee' quand les données des enjeux sont null 
     */
    function displayNul(str) {
        if (str === null) {
            return str = 'NonEvaluee';
        } else {
            return camelize(str);
        }
    };
    /**
     * FIN - Sert à appeler la class 'NonEvaluee' quand les données des enjeux sont null
     */

    /**
     * Sert à afficher 'Non évaluée' quand les données des enjeux sont null dans le innerHTML
     */
    function displayNulTxt(str) {
        if (str === null) {
            return str = 'Non évaluée';
        } else {
            return str;
        }
    };
    /**
     * FIN - Sert à afficher 'Non évaluée' quand les données des enjeux sont null dans le innerHTML
     */

    /**
     * Sert à intervertir le nom commun avec le nom latin quand nom commun null
     */
    function nomCom() {
        var nomLatin = document.getElementsByClassName('nomLatin');
        var nomCom = document.getElementsByClassName('nomCom');
        for (let v = 0; v < nomCom.length; v++) {
            if (nomCom[v].innerHTML === 'Non évaluée') {
                nomCom[v].innerHTML = nomLatin[v].innerHTML;
                nomLatin[v].style.display = "none";
            }
        }
    }

    /**
     * FIN - Sert à intervertir le nom commun avec le nom latin quand nom commun null
     */

    /**
     * Sert à afficher la légende correspondant aux pictos
     */
    function menace(str) {
        if (str === 'EX') {
            return str = 'Éteint';
        }
        if (str === 'EW') {
            return str = 'Éteint à l\'état sauvage';
        }
        if (str === 'CR') {
            return str = 'En danger critique d\'extinction';
        }
        if (str === 'EN') {
            return str = 'Espèce en danger';
        }
        if (str === 'VU') {
            return str = 'Espèce vulnérable';
        }
        if (str === 'NT') {
            return str = 'Espèce quasi menacée';
        }
        if (str === 'LC') {
            return str = 'Préoccupation mineure';
        }
        if (str === 'DD') {
            return str = 'Données insuffisantes';
        }
        if (str === 'NE') {
            return str = 'Non-Évaluée';
        }
    };
    /**
     * Fin - Sert à afficher la légende correspondant aux pictos
     */
</script>