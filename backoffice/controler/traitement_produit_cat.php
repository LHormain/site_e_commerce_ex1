<?php
// récupération des catégories dans la BDD
$categories = req_cat($bdd);
 
$select_cat = '';
foreach ($categories as $donnees) {
    $select_cat .= '
    <option value="'.$donnees['id_cat'].'">'.$donnees['nom_categorie'].'</option>
    ';  
}
?>