<?php

// DELETE
if (isset($_GET['sup'])
&& $_GET['sup'] != NULL) {
    $id_slide = intval($_GET['sup']);

     // sélectionne l'id de l'image
    $donnees = req_img_carousel($bdd,$id_slide);
    $id_img_site = $donnees['id_img_site'];
    $chemin = '../public/assets/img/site/'.$donnees['nom_img_site'];
    if (file_exists($chemin)) {
        unlink($chemin);
    }

    req_sup_carousel($bdd,$id_slide);

    req_sup_img_carousel($bdd,$id_img_site);
} 

//  affichage
$donnees =req_carousels($bdd);

$table = table_carousel_gestion($donnees);
?>