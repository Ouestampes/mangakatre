<?php error_reporting(0);?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Les mignardises</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
    <style>
        .card-img-top{
            height: 50%;
        }
        .div-title , .modal-header {
            font-size:1.5em;
            font-family: 'Playfair Display', serif; 
            background-color:#006400;
            color:white;
        } 
        .accordion-button{
            font-weight:bold;
        }
    </style>
</head>
  <body style="background-image:url('buffet.jpg')">
    <div class="text-center div-title">
        LES MIGNARDISES - Un jeu Forum Thalie
    </div> 
    <div class="container-fluid !direction !spacing mt-2">
            <?php
                $dossiers = array("cards", "questions");
                $i = 0;
                echo '<div class="row mb-3">';
                foreach ($dossiers as $dossier) {
                    $fichiers = array_filter(
                        scandir(__DIR__ . DIRECTORY_SEPARATOR . $dossier),
                        function ($var) {return end(explode(".", $var)) == "html";});
                    if($dossier == "cards"){

                        $fichiers_visibles = array_filter($fichiers, function($var){
                            return !isset($_COOKIE["card" . explode(".", $var)[0]]);
                        });
                        shuffle($fichiers_visibles);
                        if(count($fichiers_visibles) > 3) {
                            $fichiers_visibles = array_slice($fichiers_visibles, 0 , 3);
                        }
                    } else {
                        $fichiers_visibles = $fichiers;
                    }
                    
                    foreach ($fichiers_visibles as $fichier) {
                        echo '<div class="col">';
                        include "$dossier/$fichier";
                        echo '</div>';
                        if ($i % 3 == 2) {
                            echo '</div><div class="row mb-3">';
                        }
                        $i++;
                    }
                }
                echo "</div>";
            ?>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            document.querySelectorAll(".card").forEach(card => card.style["background-color"]="#98FB98");
            document.querySelectorAll(".card-img-top").forEach(bouton => 
                bouton.addEventListener("click", function(e){
                    e.target.parentNode.style["background-color"]="#F08080";
                    e.target.parentNode.classList.add("done")
                    razAccordions();
                    Cookies.set(e.target.parentNode.id, "done");
                }
            ))
            document.querySelectorAll(".card-body ").forEach(bouton => 
                bouton.addEventListener("click", function(e){
                    var parentNode = e.target.parentNode;
                    if(parentNode.classList.contains("done")){
                        parentNode.style["background-color"]="#98FB98";
                        parentNode.classList.remove("done")
                    } else {
                        e.target.parentNode.style["background-color"]="#F08080";
                        e.target.parentNode.classList.add("done")
                    }
                    razAccordions();
                }
            ))
            var headers = document.getElementsByClassName('accordion-button');
            for (var i = 0; i < headers.length;) {
                headers.item(i).style.color = "black"
                headers.item(i++).style.backgroundColor = "#98FB98"
                headers.item(i).style.color = "black"
                headers.item(i++).style.backgroundColor = "#FFDEAD"
                headers.item(i).style.color = "white"
                headers.item(i++).style.backgroundColor = "#FF4500"
            }
        });

        function razAccordions(){
            document.querySelectorAll('.collapse').forEach(collapseElement => {
                let collapse =  new bootstrap.Collapse(collapseElement, {toggle:false});
                if(collapseElement.id.endsWith("One")){
                    collapse.show();
                } else {
                    collapse.hide();
                }
            })
        }
    </script>


  </body>
</html>
