<?php

$tutos = req_tutos($bdd);

$liste = '';

foreach ($tutos as $ligne) {
    $liste .= '
    <div class="col-lg-2 p-2">
        <img src="public/assets/img/site/'.$ligne['nom_img_site'].'" class="img-fluid">
    </div>
    <div class="col-lg-10 p-2 ">
        <h2>'.$ligne['titre_tutoriel'].'</h2>
        <p>'.$ligne['texte_tutoriel'].'</p>
        <a href="index.php?page=15&id='.$ligne['id_tutoriel'].'" class="btn btn-primary">Voir plus</a>
    </div>
    ';
}

?>

<!-- <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe> -->