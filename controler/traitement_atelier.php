<?php
// --------------------------------------------------
//         recuperation des ateliers proposer
// --------------------------------------------------

$ateliers = req_ateliers($bdd);

$sortie = '';
$slide = 0;
foreach ($ateliers as $atelier) {
    $id_atelier = $atelier['id_atelier'];
    // recuperation des images
    $images = req_img_atelier($bdd,$id_atelier);
    
    $carousel_indicators = '';
    $carousel_inner = '';
    $i = 0;
    
    foreach ($images as $donnees) {
        $nom_img = $donnees['nom_img_atelier'];
        $carousel_indicators .= carousel_indicators_ateliers($i, $nom_img);
        $carousel_inner .= carousel_inner_ateliers($i, $nom_img);
        $i++;
    }

    $carousel = carousel($slide,$carousel_indicators,$carousel_inner );

    $slide ++;

    // recuperation des paragraphes
    $donnees = req_paragraphes_ateliers($bdd, $id_atelier);
    $nbr_paragraphes = $donnees[0];
    $paragraphes = $donnees[1];

    $part1 = '';
    for ($i = 0; $i <= floor($nbr_paragraphes/2); $i++) {
        $part1 .= '
        <h3>'.$paragraphes[$i]['titre_descriptif'].'</h3>
        <p>'.nl2br($paragraphes[$i]['texte_descriptif']).'</p>
        ';
    }
    $part2 = '';
    for ($i = floor($nbr_paragraphes/2)+1; $i < $nbr_paragraphes; $i++) {
        $part2 .= '
        <h3>'.$paragraphes[$i]['titre_descriptif'].'</h3>
        <p>'.nl2br($paragraphes[$i]['texte_descriptif']).'</p>
        ';
    }


    // recuperation des horaires
    $liste_horaires = req_horaires_atelier($bdd,$id_atelier);

    $horaires = '';
    foreach ($liste_horaires as $donnees) {
        $horaires .= '<li>Le '.date('d-m-Y à H:i',$donnees['date_atelier']).' reste : '.($atelier['nombre_participant_max'] - $donnees['nbr_participant']).' places</li>';
    }

    if (isset($_SESSION['id_client'])) {
        $bouton = '<a href="index.php?page=131&c='.$id_atelier.'" class="btn btn-primary">Inscrivez vous</a>';  
    }
    else {
        $bouton = '<a href="index.php?page=6&ins=1" class="btn btn-primary">Connectez-vous pour vous inscrire</a>';
    }

    // sortie finale
    $couleur1 = couleurBgAleatoire();
    $couleur2 = couleurBgAleatoire();
    $sortie .= '
    <section class="col-12 my-5 position-relative">
        <div class="position-absolute atelier_form d-none d-lg-block" style="height: 30vw; width: 30vw; '.$couleur1.'"></div>
        <h2>'.$atelier['nom_atelier'].'</h2>
        <div class="row my-5">
            <div class="col-lg-6 col-12 pb-5">
                '.$carousel.'
            </div>
            <div class="col-lg-6 col-12">'.$part1.'</div>
            <div class="col-lg-6 col-12">'.$part2.'</div>
            <aside class="col-lg-6 col-12 d-flex justify-content-center align-items-center flex-column position-relative" >
                <div class="position-absolute top-0 start-0 w-100 h-100" style="opacity: 50%;'.$couleur2.'"></div>
                <h3>Horaires</h3>
                <ul>'.$horaires.'</ul>
                '.$bouton.'
            </aside>
        </div>
    </section>
    ';
}

?>