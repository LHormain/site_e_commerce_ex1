<?php
$dossier = '../public/assets/img/site';
$texte_page_courante = '';
$timestamp = time();

// récupération des données pour un update
if (isset($_GET['id'])
&& $_GET['id'] != NULL
){
    $id_produit = intval($_GET['id']);
    $texte_page_courante = '<h2>Modifier les champs, tous les champs sont obligatoires</h2>';
    $donnees = req_produit($bdd,$id_produit);

    $nom_produit = $donnees['nom_produit'];
    $description_produit = $donnees['description_produit'];
    $prix_produit = $donnees['prix_produit'];
    $poids_produit = $donnees['poids_produit'];
    $dimension_produit = $donnees['dimension_produit'];
    $composition_produit = $donnees['composition_produit'];
    $couleur_produit = $donnees['id_couleur'];
    $usage_produit = $donnees['id_usage'];
    // $stock_produit = $donnees['stock_produit'];
    $promo_saison_produit = $donnees['promo_saison_produit'];
    $id_sous_cat = $donnees['id_sous_cat'];

    $donnees = req_cat_de_sous_cat($bdd,$id_sous_cat);
    $id_cat = $donnees['id_cat'];
    
}
else {
    $texte_page_courante = '<h2>Remplissez les champs, tous les champs sont obligatoires</h2>';
    $nom_produit = '';
    $description_produit = '';
    $prix_produit = '';
    $poids_produit = '';
    $dimension_produit = ''; 
    $composition_produit = '';
    $couleur_produit = '';
    $usage_produit = '';
    $stock_produit = '';
    $promo_saison_produit = '';
    $id_sous_cat = '';
    $id_cat = '';
}

// INSERT

    if (isset($_POST['nom_produit'],
        $_POST['description_produit'], 
        $_POST['prix_produit'], 
        $_POST['poids_produit'], 
        $_POST['dimension_produit'], 
        $_POST['composition_produit'], 
        $_POST['couleur_produit'], 
        $_POST['usage_produit'], 
        // $_POST['stock_produit'], 
        $_POST['promo_saison_produit'], 
        $_POST['id_sous_cat']
        ) 
        && $_POST['nom_produit'] != NULL
        && $_POST['description_produit'] != NULL
        && $_POST['prix_produit'] != NULL
        && $_POST['poids_produit'] != NULL
        && $_POST['dimension_produit'] != NULL
        && $_POST['composition_produit'] != NULL
        && $_POST['couleur_produit'] != NULL
        && $_POST['usage_produit'] != NULL
        // && $_POST['stock_produit'] != NULL
        && $_POST['promo_saison_produit'] != NULL
        && $_POST['id_sous_cat'] != NULL
        ) {
            $nom_produit = htmlspecialchars($_POST['nom_produit']);
            $description_produit = htmlspecialchars($_POST['description_produit']);
            $prix_produit = htmlspecialchars($_POST['prix_produit']);
            $poids_produit = htmlspecialchars($_POST['poids_produit']);
            $dimension_produit = htmlspecialchars($_POST['dimension_produit']);
            $composition_produit = htmlspecialchars($_POST['composition_produit']);
            $couleur_produit = htmlspecialchars($_POST['couleur_produit']);
            $usage_produit = htmlspecialchars($_POST['usage_produit']);
            // $stock_produit = htmlspecialchars($_POST['stock_produit']);
            $promo_saison_produit = htmlspecialchars($_POST['promo_saison_produit']);
            $id_sous_cat = htmlspecialchars($_POST['id_sous_cat']);

            // si le prix à une virgule changement par point
            if (str_contains($prix_produit, ',')) {
               $prix_produit = str_replace(',', '.', $prix_produit);
            }
                
            if (isset($_GET['id'])
            && $_GET['id'] != NULL
            ){
                $id_produit = intval($_GET['id']);
                // UPDATE 
                req_update_produit($bdd,$id_produit,$nom_produit,$description_produit,$prix_produit,$poids_produit,$dimension_produit,$composition_produit,$couleur_produit,$usage_produit,$promo_saison_produit,$id_sous_cat);
            }
            else {
                // INSERT
                req_insert_produit($bdd,$nom_produit,$description_produit,$prix_produit,$poids_produit,$dimension_produit,$composition_produit,$couleur_produit,$usage_produit,$promo_saison_produit,$id_sous_cat);
            }
            
            $texte_page_courante =' <h2>L\'opération à été réalisé avec succès</h2>';
               
    }

// récupération des catégories dans la BDD
$categories = req_cat_afficher($bdd);

$select_cat = '';
foreach ($categories as $donnees) {
    if ($donnees['id_cat'] == $id_cat) {
        $select_cat .= '
        <option value="'.$donnees['id_cat'].'" selected >'.$donnees['nom_categorie'].'</option>
        ';
    }
    else {
        $select_cat .= '
        <option value="'.$donnees['id_cat'].'">'.$donnees['nom_categorie'].'</option>
        ';  
    }
}

// recuperation de sous cat dans la bdd 
$sous_categories = req_sous_cat_afficher($bdd,$id_cat);

$select_sous_cat = '';
foreach ($sous_categories as $donnees) {
    if ($donnees['id_sous_cat'] == $id_sous_cat) {
        $select_sous_cat.= '
        <option value="'.$donnees['id_sous_cat'].'" selected >'.$donnees['nom_sous_categorie'].'</option>
        '; 
    }
    else {
        $select_sous_cat .= '
        <option value="'.$donnees['id_sous_cat'].'">'.$donnees['nom_sous_categorie'].'</option>
        ';  
    }
}

// récupération des couleurs
$couleurs = req_couleur($bdd);

$select_couleurs ='';
foreach ($couleurs as $donnees) {
    if ($donnees['id_couleur'] == $couleur_produit) {
        $select_couleurs .= '
        <option value="'.$donnees['id_couleur'].'" selected>'.$donnees['nom_couleur'].'</option>
        ';
    }
    else {
        $select_couleurs .= '
        <option value="'.$donnees['id_couleur'].'">'.$donnees['nom_couleur'].'</option>
        ';  
    }
}

//récupérations des différents types d'usages des produits
$usages = req_usage($bdd);

$select_usages = '';
foreach ($usages as $donnees) {
    if ($donnees['id_usage'] == $usage_produit) {
        $select_usages .= '
        <option value="'.$donnees['id_usage'].'" selected>'.$donnees['nom_usage'].'</option>
        ';
    }
    else {
        $select_usages .= '
        <option value="'.$donnees['id_usage'].'">'.$donnees['nom_usage'].'</option>
        ';  
    }
}
?>