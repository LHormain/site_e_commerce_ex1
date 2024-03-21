<?php
$dossier = '../public/assets/img/site';
$texte_page_courante = '';
$timestamp = time();

//------------------------------------------------------------------------------------
//                                          update
//------------------------------------------------------------------------------------
if (isset($_GET['id'])
&& $_GET['id'] != NULL
){
    $id_cat = intval($_GET['id']);
    $texte_page_courante = '<h2>Modifier les champs, l\'image et la sous catégorie sont modifiable indépendamment</h2>';
    // récupération dans catégorie
    $donnees = req_cat_select($bdd,$id_cat);

    $nom_categorie = $donnees['nom_categorie'];
    $description_categorie = $donnees['description_categorie'];

    // récupération dans image de l'image correspondant
    $donnees = req_img_cat_select($bdd,$id_cat);
    $image_categorie = substr($donnees['nom_img_site'], 0, strrpos($donnees['nom_img_site'], "."));

    //---------------------------------
    //          Image update
    //---------------------------------
    if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
        if (isset($_POST['image_categorie']) 
        && $_POST['image_categorie'] != NULL
        ) {
            $image_categorie = htmlspecialchars($_POST['image_categorie']).$timestamp;

            $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
            $extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);

            if(in_array($extension_upload, $extensions_valides)) {     
                $image_categorie = $image_categorie.'.'.$extension_upload;
                $chemin = $dossier."/".$image_categorie;       
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
                if($resultat) {
                    echo '<h2 class="mt-5">Transfert reussi</h2>';   
                    
                    // sélectionne l'id de l'image et supprime l'ancienne dans le dossier
                    $donnees = req_img_cat_select($bdd,$id_cat);
                    $id_img_site = $donnees['id_img_site'];
                    $chemin = '../public/assets/img/site/'.$donnees['nom_img_site'];
                    if (file_exists($chemin)) {
                        unlink($chemin);
                    }

                    // enregistre la nouvelle image dans la table images_site
                    req_img_site_update($bdd,$image_categorie,$id_img_site);
                    
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

    //---------------------------
    // categorie update
    //---------------------------
    if (isset($_POST['nom_categorie'],
    $_POST['description_categorie']
    ) 
    && $_POST['nom_categorie'] != NULL
    && $_POST['description_categorie'] != NULL
    ) {
        $nom_categorie = htmlspecialchars($_POST['nom_categorie']);
        $description_categorie = htmlspecialchars($_POST['description_categorie']);

        // UPDATE 
        // enregistre le reste des entrées
        req_update_cat($bdd,$id_cat,$nom_categorie,$description_categorie);

        $texte_page_courante =' <h2>L\'opération à été réalisé avec succès</h2>';
    }
}
else {
    $texte_page_courante = '<h2>Remplissez les champs, tous les champs sont obligatoires</h2>';
    $nom_categorie = '';
    $description_categorie = '';
    $image_categorie = '';

    //------------------------------------------------------------------------------------
    //                                 INSERT nouvelle catégorie
    //------------------------------------------------------------------------------------
    if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
        if (isset($_POST['nom_categorie'],
        $_POST['description_categorie'], 
        $_POST['image_categorie']
        ) 
        && $_POST['nom_categorie'] != NULL
        && $_POST['description_categorie'] != NULL
        && $_POST['image_categorie'] != NULL
        ) {
            $nom_categorie = htmlspecialchars($_POST['nom_categorie']);
            $description_categorie = htmlspecialchars($_POST['description_categorie']);
            $image_categorie = htmlspecialchars($_POST['image_categorie']).$timestamp;
    
            $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
             $extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);
    
            if(in_array($extension_upload, $extensions_valides)) {     
                $image_categorie = $image_categorie.'.'.$extension_upload;
                $chemin = $dossier."/".$image_categorie;       
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
                if($resultat) {
                    echo '<h2 class="mt-5">Transfert reussi</h2>';   
                    
                    req_insert_cat($bdd,$image_categorie,$nom_categorie,$description_categorie);
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
            // $texte_page_courante = '<h2>Saisie : tous les champs sont obligatoire</h2>';
        }
    }
    else {
        // $texte_page_courante = '<h2>Saisie : tous les champs sont obligatoire</h2>';
    }
}



?>