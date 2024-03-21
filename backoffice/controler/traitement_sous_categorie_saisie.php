<?php
$dossier = '../public/assets/img/site';
$texte_page_courante = '';
$timestamp = time();
                
//------------------------------------------------------------------------------------
//                                    Update 
//------------------------------------------------------------------------------------
if (isset($_GET['id'])
&& $_GET['id'] != NULL
){
    $id_sous_cat = intval($_GET['id']);
    $texte_page_courante = '<h2>Modifier les champs, l\'image et la sous catégorie sont modifiable indépendamment</h2>';

    $donnees = req_img_sous_cat($bdd,$id_sous_cat);

    $nom_sous_categorie = $donnees['nom_sous_categorie'];
    $description_sous_categorie = $donnees['description_sous_categorie'];
    $id_cat = $donnees['id_cat'];

    // récupération dans images de l'image correspondant
    $image_sous_categorie = substr($donnees['nom_img_site'], 0, strrpos($donnees['nom_img_site'], "."));

    //------------------------------------------
    //             update image
    //------------------------------------------
    if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
        if (isset($_POST['image_sous_categorie']) 
            && $_POST['image_sous_categorie'] != NULL
            ) {
                $image_sous_categorie = htmlspecialchars($_POST['image_sous_categorie']).$timestamp;

            $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
            $extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);

            if(in_array($extension_upload, $extensions_valides)) {     
                $image_sous_categorie = $image_sous_categorie.'.'.$extension_upload;
                $chemin = $dossier."/".$image_sous_categorie;       
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
                if($resultat) {
                    echo '<h2 class="mt-5">Transfert reussi</h2>';   
                    
                    // sélectionne l'id de l'image et supprime l'ancienne du dossier
                    $donnees = req_img_sous_cat($bdd,$id_sous_cat);
                    $id_img_site = $donnees['id_img_site'];
                    $chemin = '../public/assets/img/site/'.$donnees['nom_img_site'];
                    if (file_exists($chemin)) {
                        unlink($chemin);
                    }

                    // enregistre la nouvelle image dans la table images_site
                    req_update_img_sous_cat($bdd,$image_sous_categorie,$id_img_site);

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
    //         update sous categorie
    //------------------------------------------
    if (isset($_POST['nom_sous_categorie'],
        $_POST['description_sous_categorie'], 
        $_POST['id_cat']
        ) 
        && $_POST['nom_sous_categorie'] != NULL
        && $_POST['description_sous_categorie'] != NULL
        && $_POST['id_cat'] != NULL
        ) {
            $nom_sous_categorie = htmlspecialchars($_POST['nom_sous_categorie']);
            $description_sous_categorie = htmlspecialchars($_POST['description_sous_categorie']);
            $id_cat = htmlspecialchars($_POST['id_cat']);

            // enregistre le reste des entrées
            req_update_sous_cat($bdd,$id_sous_cat,$nom_sous_categorie,$description_sous_categorie,$id_cat);

            $texte_page_courante =' <h2>L\'opération à été réalisé avec succès</h2>';
    }
}
else {
    $texte_page_courante = '<h2>Remplissez les champs, tous les champs sont obligatoires</h2>';
    $nom_sous_categorie = '';
    $description_sous_categorie = '';
    $image_sous_categorie = '';
    $id_cat = '';

    //------------------------------------------------------------------------------------
    //                                         INSERT
    //------------------------------------------------------------------------------------
    if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
        if (isset($_POST['nom_sous_categorie'],
            $_POST['description_sous_categorie'], 
            $_POST['image_sous_categorie'],
            $_POST['id_cat']
            ) 
            && $_POST['nom_sous_categorie'] != NULL
            && $_POST['description_sous_categorie'] != NULL
            && $_POST['image_sous_categorie'] != NULL
            && $_POST['id_cat'] != NULL
            ) {
                $nom_sous_categorie = htmlspecialchars($_POST['nom_sous_categorie']);
                $description_sous_categorie = htmlspecialchars($_POST['description_sous_categorie']);
                $image_sous_categorie = htmlspecialchars($_POST['image_sous_categorie']).$timestamp;
                $id_cat = htmlspecialchars($_POST['id_cat']);
    
            $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
             $extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);
    
             if(in_array($extension_upload, $extensions_valides)) {     
                $image_sous_categorie = $image_sous_categorie.'.'.$extension_upload;
                $chemin = $dossier."/".$image_sous_categorie;       
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
                if($resultat) {
                    echo '<h2 class="mt-5">Transfert reussi</h2>';   
                    
                    // enregistre l'entré dans la table sous_catégorie
                    req_insert_sous_cat($bdd,$image_sous_categorie,$nom_sous_categorie,$description_sous_categorie,$id_cat);
            
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
        else {
            // $texte_page_courante = '<h2>Erreur. Tous les champs sont obligatoire</h2>';
        }
    }
    else {
        // $texte_page_courante = '<h2>Erreur. Tous les champs sont obligatoire</h2>';
    }
}

//-----------------------------------------------------
// récupération des catégories dans la BDD
//-----------------------------------------------------
$categories = req_cat_afficher($bdd);

$select_cat = '';
foreach ($categories as $donnees) {
    # code...
    if ($donnees['id_cat'] == $id_cat) {
        $select_cat .= '
        <option value="'.$donnees['id_cat'].'" selected>'.$donnees['nom_categorie'].'</option>
        ';
    }
    else {
        $select_cat .= '
        <option value="'.$donnees['id_cat'].'">'.$donnees['nom_categorie'].'</option>
        ';  
    } 
}
?>