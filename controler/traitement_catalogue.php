<?php
 // couleur aléatoire pour l'arrière plan du titre
 $titre_couleur = bandeauTitreCat();

 // ------------------------------------------------------------------------
 //          récupération des données pour le haut de la page
 //                     (en tête et fils d'ariane)
 // ------------------------------------------------------------------------
 $texte_sous_categorie = '';
 $id_client = '';
 //catégorie
 if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = htmlspecialchars($_GET['c']);
    
    $donnees = req_categories($bdd,$c);
    $categorie = $donnees['nom_categorie'];
    $texte_categorie = $donnees['description_categorie'];
}
else {
    $categorie = '';
    $c = '';
}
// sous catégorie
if (isset($_GET['sc']) && $_GET['sc'] != NULL) {
    $sc = htmlspecialchars($_GET['sc']);

    $donnees = req_sous_categories($bdd,$sc);
    $sous_cat = $donnees['nom_sous_categorie'];
    $texte_sous_categorie = $donnees['description_sous_categorie'];

}
else {
    $sous_cat = '';
    $sc = '';
}
// promo et nouveauté
if (isset($_GET['promo']) && $_GET['promo'] != NULL) {
    $promo = htmlspecialchars($_GET['promo']);

    if ($promo == 1) {
        $categorie = 'Promotion';
    }
    elseif ($promo == 2) {
        $categorie = 'Nouveauté';
    }
    $sous_cat = '';
    $c = 0;
    $texte_sous_categorie = '';
}
else {
    $promo = '';
}
// favoris du client co
if (isset($_GET['fav']) && $_GET['fav'] != NULL) {
    $fav = intval($_GET['fav']);
    $sc ='';
    $c = '';
    $texte_sous_categorie = '';
    $categorie = 'Mes favoris';
}
else {
    $fav = '';
}
$titre = titreCatalogue($categorie, $sous_cat);
$ariane = filsAriane($categorie, $sous_cat, $c);

 //----------------------------------------------------------------------
 //                                  pagination
 //----------------------------------------------------------------------
// récupération du nombre de page
if ($sc != '') {
    $routeur = 'c='.$c.'&sc='.$sc;
    $req_inner = '';
    $req_where = 'WHERE produits.id_sous_cat = :id_sous_cat '; // aussi utilisé pour affichage
    $req_order = '';
}
elseif ($promo == 1) {
    $routeur = 'promo='.$promo;
    $req_inner = '';
    $req_where ='WHERE produits.promo_saison_produit = 1 ';
    $req_order = '';
}
elseif ($promo == 2) {
    $routeur = 'promo='.$promo;
    $req_inner = '';
    $req_where ='WHERE produits.promo_saison_produit = 1 ';
    $req_order = 'ORDER BY produits.id_produit DESC';
}
elseif ($fav == 1) {
    $routeur = 'fav='.$fav;
    $req_inner = 'INNER JOIN favoris ON produits.id_produit = favoris.id_produit ';
    $req_where = 'WHERE favoris.id_client = :id_client ';
    $req_order = '';

    $donnees = req_id_client($bdd);
    $id_client = $donnees['id_client'];
}
else {
    $req_where = 'WHERE produits.id_sous_cat = 1';
    $req_order = '';
    $req_inner = '';
}
    $nbr_entree = req_nbr_entre_catalogue($bdd,$sc,$fav,$req_inner,$req_where);

$nbr_entree_page =  12; // nombre de produit affiché par page
if ($nbr_entree != '') {
    $calcul = $nbr_entree/$nbr_entree_page;
    $nbr_pages = ceil($calcul);
}
else {
    $nbr_pages = 0;
}

if (isset($_GET['ep']) && $_GET['ep'] != NULL) {
    $page_courante = htmlspecialchars($_GET['ep']);
}
else
{
    $page_courante = 1;
}

// page précédente
$pagination = '
            <li class="page-item "';
    if ($page_courante <= 1) {
        $pagination .= 'disabled';
    }
$pagination .= '>
                <a class="page-link" href=';
    if ($page_courante <= 1) { $pagination .= '"#"';} else { $pagination .= '"index.php?page=2&'.$routeur.'&ep='.($page_courante-1).'"';} // la page courante moins 1
$pagination .= ' >Précédent</a>
            </li>
';
// boucle sur i = 1 à nbr total de page avec lien vers la page i , ep = numero de la page d'entrees
for ($i = 1; $i <= $nbr_pages; $i++ ){
    $pagination .= '
        <li class="page-item "';
    if ($page_courante == $i) {
        $pagination .= 'active';
    }
    $pagination .= '>
                <a class="page-link" href="index.php?page=2&'.$routeur.'&ep='.$i.'" ';
    if ($page_courante == $i) { $pagination .= 'active';}  
        $pagination .= ' >'.$i.'</a>
            </li>
';
}
// page suivante
$pagination .= '
            <li class="page-item "';
    if ($page_courante >= $nbr_pages) {
        $pagination .= 'disabled';
    }
$pagination .= '>
                <a class="page-link" href=';
    if ($page_courante >= $nbr_pages) { $pagination .= '"#"';} else { $pagination .= '"index.php?page=2&'.$routeur.'&ep='.($page_courante+1).'"';} // la page courante plus 1
$pagination .= ' >Suivante</a>
            </li>
';

 //-----------------------------------------------------------------------
 //                 récupération données pour la recherche
 //-----------------------------------------------------------------------
// creation barre de recherche
 $couleurs = req_colors($bdd);

 $select_couleurs = '';
 foreach ($couleurs as $donnees) {
    $select_couleurs .= '
    <div class="col-4">
        <input type="checkbox" name="couleur[]" id="couleur'.$donnees['id_couleur'].'" value="'.$donnees['id_couleur'].'"><label for="couleur'.$donnees['id_couleur'].'">'.$donnees['nom_couleur'].'</label>
    </div>
    ';
 }

$usages = req_usages($bdd);

 $select_usages = '';
 foreach ($usages as $donnees) {
    $select_usages .= '
    <option value="'.$donnees['id_usage'].'">'.$donnees['nom_usage'].'</option>
    ';  
 }

 // traitement
 // couleur
 $nbr_couleur = 0;
 if (isset($_POST['couleur'])
    && $_POST['couleur'] != NULL
    ) {
        $requete_couleur = '';
        $couleur = $_POST['couleur'];
        for ($i = 0; $i < count($couleur); $i++) {
            if ($nbr_couleur == 0) {
                $requete_couleur .= ' AND (produits.id_couleur = '.htmlspecialchars($couleur[$i]);
            }
            else {
                $requete_couleur .= ' OR produits.id_couleur = '.htmlspecialchars($couleur[$i]);
            }
            $nbr_couleur += 1;
        }
        $requete_couleur .=')';

    }
    else {
        $requete_couleur = ' ';
    }
// usage
    if (isset($_POST['usage'])
&& $_POST['usage'] != NULL
) {

    $usage = htmlspecialchars($_POST['usage']);
    $requete_usage = ' AND produits.id_usage = '.$usage;

}
else {
    $requete_usage = ' ';
}
// budget
if (isset($_POST['budget_max'], 
$_POST['budget_min'])
&& $_POST['budget_max'] != NULL
&& $_POST['budget_min'] != NULL
) {
    $budget_max = htmlspecialchars($_POST['budget_max']);
    $budget_min = htmlspecialchars($_POST['budget_min']);

    $requete_budget = ' AND (produits.prix_produit < '.$budget_max.' AND produits.prix_produit > '.$budget_min.')';

}
else {
    $requete_budget = ' ';
}
 // ------------------------------------------------------------------------
 //                      récupération des produits
 // ------------------------------------------------------------------------
 // récupération avec la sous catégorie
 $offset = ($page_courante-1)*$nbr_entree_page;

$produits = req_catalogue($bdd,$sc,$fav,$offset,$req_inner,$req_where,$req_order,$requete_usage,$requete_couleur,$requete_budget,$nbr_entree_page,$id_client);

 $catalogue = '';
 foreach ($produits as $donnees) {
    $nom_image = trouve_nom_image($bdd,$donnees['id_produit']); // pour pouvoir afficher les produits sans images
    $catalogue .= card($donnees['nom_produit'], $donnees['prix_produit'], $nom_image, $donnees['id_produit'],$donnees['id_cat'],$donnees['id_sous_cat']);
 }
?>