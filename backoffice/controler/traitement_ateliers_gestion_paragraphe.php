<?php
// supprimer un paragraphe
if (isset($_GET['sup']) && $_GET['sup'] != NULL) {
    $id_descriptif = intval($_GET['sup']);

    req_sup_paragraphe($bdd,$id_descriptif);
}

//récupération des données
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_atelier = intval($_GET['id']);

    $donnees = req_ateliers($bdd,$id_atelier);

    $paragraphes = req_paragraphes($bdd,$id_atelier);

    $table = table_ateliers_gestion_paragraphes($paragraphes);
}
?>