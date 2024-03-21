<?php
$texte_page_courante = '';


// récupération de l'atelier
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_atelier = intval($_GET['id']);

    $donnees = req_ateliers($bdd,$id_atelier);
    $nom_atelier = $donnees['nom_atelier'];
}
// ---------------------------------------------
//    récupération des données pour un update
// ---------------------------------------------
if (isset($_GET['d'])
&& $_GET['d'] != NULL
){
    $id_descriptif = intval($_GET['d']);
    $donnees = req_paragraphe_atelier($bdd, $id_descriptif);

    $titre_descriptif = $donnees['titre_descriptif'];
    $texte_descriptif = $donnees['texte_descriptif'];
    $titre = 'Modification d\'un';
}
else {
    $titre_descriptif = '';
    $texte_descriptif = '';
    $titre = 'Saisie d\'un nouveau';
}
// traitement
if (isset($_POST['titre_descriptif'],
          $_POST['texte_descriptif']
          ) 
&& $_POST['titre_descriptif'] != NULL
&& $_POST['texte_descriptif'] != NULL
) {
    $titre_descriptif = htmlspecialchars($_POST['titre_descriptif']); 
    $texte_descriptif = htmlspecialchars($_POST['texte_descriptif']); 

    if (isset($_GET['d']) && $_GET['d'] != NULL) {
        // update
        req_parag_update_atelier($bdd,$id_descriptif,$titre_descriptif,$texte_descriptif);
        
    }
    else {
        // insert
        res_parag_insert_atelier($bdd,$id_atelier,$titre_descriptif,$texte_descriptif);
    }
    

    $texte_page_courante = 'Le paragraphe a bien été enregistrée.';
}
?>