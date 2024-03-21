<?php
//--------------------------------------
//                    DELETE
//--------------------------------------
///image
if (isset($_GET['supimg'])
&& $_GET['supimg'] != NULL) {
    $id_img_jumbo = intval($_GET['supimg']);

    $donnees =req_img_jumbo($bdd,$id_img_jumbo);
    $chemin = '../public/assets/img/site/'.$donnees['nom_img_jumbotron'];
    if (file_exists($chemin)) {
        unlink($chemin);
    }

    req_sup_img_jumbo($bdd,$id_img_jumbo);
}
///paragraphe
if (isset($_GET['sup'])
&& $_GET['sup'] != NULL) {
    $id_paragraphe = intval($_GET['sup']);

    req_sup_parag_jumbo($bdd,$id_paragraphe);
}

//--------------------------------------------
//                  Affichage
//--------------------------------------------
$donnees = req_all_parag_jumbo($bdd);

$table_paragraphe = '';
foreach ($donnees as $paragraphe) {
    $table_paragraphe .= table_jumbotron_gestion($paragraphe);
}

$donnees2 = req_all_img_jumbo($bdd);

$table_image = '';
foreach ($donnees2 as $image) {
    $table_image .= table_jumbotron_gestion_img($image);
}
?>
