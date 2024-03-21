<?php
//recuperation des données pour update
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_paragraphe = htmlspecialchars($_GET['id']);

    $donnees =req_parag_jumbo($bdd,$id_paragraphe);
    $titre_paragraphe = $donnees['titre_paragraphe'];
    $texte_paragraphe = $donnees['texte_paragraphe'];
    $taille_paragraphe = $donnees['taille_paragraphe'];

    $texte_page = 'Modifier les champs';
}
else {
    $titre_paragraphe = '';
    $texte_paragraphe = '';
    $taille_paragraphe = '';

    $texte_page = 'Remplissez tous les champs';
}

if (isset($_POST['titre_paragraphe'],
$_POST['texte_paragraphe'],
$_POST['taille_paragraphe']
)
&& $_POST['titre_paragraphe'] != NULL
&& $_POST['texte_paragraphe'] != NULL
&& $_POST['taille_paragraphe'] != NULL
) {
    $titre_paragraphe = htmlspecialchars($_POST['titre_paragraphe']);
    $texte_paragraphe = htmlspecialchars($_POST['texte_paragraphe']);
    $taille_paragraphe = htmlspecialchars($_POST['taille_paragraphe']);

    $id_jumbotron = 1;

    if (isset($_GET['id']) && $_GET['id'] != NULL) {
        $id_paragraphe = htmlspecialchars($_GET['id']);
        //UPDATE
        req_update_jumbo($bdd,$id_paragraphe,$texte_paragraphe,$taille_paragraphe,$titre_paragraphe);
    }
    else {
        // INSERT
        req_insert_jumbo($bdd,$titre_paragraphe,$texte_paragraphe,$taille_paragraphe);
    }


    $texte_page = 'Enregistrement correctement effectué';
}

?>