<?php
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_tutoriel = intval($_GET['id']);
    
    $donnees = req_tuto($bdd, $id_tutoriel);
    $materiaux = req_materiaux($bdd, $id_tutoriel);

    $video = str_replace('<iframe', '<iframe sandbox="allow-scripts allow-same-origin"', htmlspecialchars_decode($donnees['video_tutoriel']));

    $liste_materiaux = '';
    foreach ($materiaux as $ligne) {
        $liste_materiaux .= '
        <li>
            <span class="produit" >'.$ligne['intitule_materiel'].' : </span>
            '.$ligne['description_materiel'].'
        </li>
        ';
    }
}

?>