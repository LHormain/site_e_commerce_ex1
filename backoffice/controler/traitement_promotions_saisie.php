<?php
$dossier = '../public/assets/img/site';
$texte_page_courante = '';
$timestamp = time();


if (isset($_GET['id'])
&& $_GET['id'] != NULL
){
    // récupération des données pour un update
    $id_slide = intval($_GET['id']);
    $texte_page_courante = '<h2>Modifier les champs</h2>';

    $donnees = req_carousel_slide($bdd,$id_slide);

    $titre_slide = $donnees['titre_slide'];
    $texte_slide = $donnees['texte_slide'];
    $id_cat = $donnees['id_cat'];
    $id_sous_cat = $donnees['id_sous_cat'];

    $nom_image = substr($donnees['nom_img_site'], 0, strrpos($donnees['nom_img_site'], "."));

}
else {
    $id_slide = '';
    $nom_image = '';
    
    $titre_slide = '';
    $texte_slide = '';
    $id_cat = '';
    $id_sous_cat = '';
}

//---------------------------------------------------
//             remplissage des selects
//---------------------------------------------------
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

// recuperation de sous cat dans la bdd (utile pour update)
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

//-----------------------------------------------
//                INSERT ET UPDATE
//-----------------------------------------------
if (isset($_GET['id'])
&& $_GET['id'] != NULL) {
    //------------------------------------------------
    //               UPDATE IMAGE
    //------------------------------------------------
    if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
        if (isset($_POST['nom_img_site']) 
            && $_POST['nom_img_site'] != NULL
            ) {
            $nom_img_site = htmlspecialchars($_POST['nom_img_site']).$timestamp;

            $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
            $extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);

            if(in_array($extension_upload, $extensions_valides)) {     
                $nom_img_site = $nom_img_site.'.'.$extension_upload;
                $chemin = $dossier."/".$nom_img_site;       
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
                if($resultat) {
                    echo '<h2 class="mt-5">Transfert reussi</h2>';   
                    
                    // sélectionne l'id de l'image et supprime l'ancienne du dossier
                    $donnees = req_img_carousel($bdd,$id_slide);
                    $id_img_site = $donnees['id_img_site'];
                    $chemin = '../public/assets/img/site/'.$donnees['nom_img_site'];
                    if (file_exists($chemin)) {
                        unlink($chemin);
                    }

                    // enregistre la nouvelle image dans la table images_site
                    req_update_img_carousel($bdd,$nom_img_site,$id_img_site);

                    $texte_page_courante =' <h2>L\'opération à été réalisé avec succès</h2>';
                } 
                else {
                    $texte_page_courante = '<h2>Un problème s\'est produit.</h2>';
                }
            }
            else {
                $texte_page_courante =' <h2>votre fichier n\'est pas valide.</h2>';
            }
        }
    }
    //------------------------------------------
    //         UPDATE SLIDE
    //------------------------------------------
    if (isset($_POST['titre_slide'],
        $_POST['texte_slide'], 
        $_POST['id_sous_cat']
        ) 
        && $_POST['titre_slide'] != NULL
        && $_POST['texte_slide'] != NULL
        && $_POST['id_sous_cat'] != NULL
        ) {
            $titre_slide = htmlspecialchars($_POST['titre_slide']);
            $texte_slide = htmlspecialchars($_POST['texte_slide']);
            $id_sous_cat = htmlspecialchars($_POST['id_sous_cat']);

            // enregistre le reste des entrées
            req_update_carousel($bdd,$id_sous_cat,$titre_slide,$texte_slide,$id_slide);
    
            $texte_page_courante =' <h2>L\'opération à été réalisé avec succès</h2>';
    }
}
else {
    //------------------------------------------------
    //                      INSERT
    //------------------------------------------------
    if (isset($_POST['nom_img_site'],
    $_POST['titre_slide'],
    $_POST['texte_slide'],
    $_POST['id_sous_cat']
    )
    && $_POST['nom_img_site'] != NULL
    && $_POST['titre_slide'] != NULL
    && $_POST['texte_slide'] != NULL
    && $_POST['id_sous_cat'] != NULL
    ) {
        $nom_image = htmlspecialchars($_POST['nom_img_site']).$timestamp;
        $titre_slide = htmlspecialchars($_POST['titre_slide']);
        $texte_slide = htmlspecialchars($_POST['texte_slide']);
        $id_sous_cat = htmlspecialchars($_POST['id_sous_cat']);
    
        // enregistrement de l'image dans images_site
        if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
    
            $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
             $extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);
    
            if(in_array($extension_upload, $extensions_valides)) {     
                $nom_image = $nom_image.'.'.$extension_upload;
                $chemin = $dossier."/".$nom_image;       
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
                if($resultat) {
                    echo '<h2 class="mt-5">Transfert reussi</h2>';   
                    // enregistre l'image dans la table : images_site
                                        
                    $donnees = req_insert_img_carousel($bdd,$nom_image);
                    $id_img_site = $donnees['id_img_site'];
    
                    // enregistre l'entré dans la table 
                    req_insert_carousel($bdd,$texte_slide,$titre_slide,$id_img_site,$id_sous_cat) ;
                    
                    $texte_page_courante =' <h2>L\'opération à été réalisé avec succès</h2>';
                } 
                else {
                $texte_page_courante = '<h2>Un problème s\'est produit.</h2>';
                }
            }
            else {
            $texte_page_courante =' <h2>votre fichier n\'est pas valide.</h2>';
            }
        }
    }
}
?>