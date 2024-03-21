<?php
$dossier = '../public/assets/img/site';
$texte_page = '';
$timestamp = time();

// récupération des données pour un update
if (isset($_GET['id'])
&& $_GET['id'] != NULL
){
    $id_img_jumbo = intval($_GET['id']);
    $texte_page_courante = '<h2>Modifier les champs, tous les champs sont obligatoires</h2>';

    $donnees = req_img_jumbo($bdd,$id_img_jumbo);
    $nom_img_jumbotron = substr($donnees['nom_img_jumbotron'], 0, strrpos($donnees['nom_img_jumbotron'], "."));
    $position_img_jumbotron = $donnees['position_img_jumbotron'];
}
else {
    $texte_page_courante = '<h2>Remplissez les champs, tous les champs sont obligatoires</h2>';
    $nom_img_jumbotron = '';
    $position_img_jumbotron = '';
}

// INSERT et update
if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
    if (isset($_POST['nom_img_jumbotron'],
    $_POST['position_img_jumbotron']
        ) 
        && $_POST['nom_img_jumbotron'] != NULL
        && $_POST['position_img_jumbotron'] != NULL
        ) {
            $nom_img_jumbotron = htmlspecialchars($_POST['nom_img_jumbotron']).$timestamp;
            $position_img_jumbotron = htmlspecialchars($_POST['position_img_jumbotron']);

        $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
     	$extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);

         if(in_array($extension_upload, $extensions_valides)) {     
            $nom_img_jumbotron = $nom_img_jumbotron.'.'.$extension_upload;
            $chemin = $dossier."/".$nom_img_jumbotron;       
            $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
            if($resultat) {
                echo '<h2 class="mt-5">Transfert reussi</h2>';   
                
                if (isset($_GET['id'])
                && $_GET['id'] != NULL
                ){
                    $id_img_jumbo = intval($_GET['id']);

                    // supprime l'ancienne image dans le dossier
                    $donnees = req_img_jumbo($bdd,$id_img_jumbo);
                    $chemin = '../public/assets/img/site/'.$donnees['nom_img_jumbotron'];
                    if (file_exists($chemin)) {
                        unlink($chemin);
                    }

                    // UPDATE  nouvelle image
                    req_update_img_jumbo($bdd,$id_img_jumbo,$nom_img_jumbotron,$position_img_jumbotron);
                }
                else
                {
                    // INSERT
                    req_insert_img_jumbo($bdd,$nom_img_jumbotron,$position_img_jumbotron);
                }

        
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
?>