<?php
$dossier = '../public/assets/img/produits';
$texte_page_courante = '';
$timestamp = time();

// si regarde les images d'un produit précis
if (isset($_GET['id_produit']) && $_GET['id_produit'] != NULL) {
    $id_produit = htmlspecialchars($_GET['id_produit']);

    $nom_produit = req_produit($bdd,$id_produit);

    $boutons = '
    <a  class="btn btn-primary" href="index.php?page=33&c=1&id_produit='.$id_produit.'" role="button" >Ajouter une image</a>
    <a  class="btn btn-primary" href="index.php?page=33&c=2&id_produit='.$id_produit.'" role="button">Gestion</a>
    ';
}
else {
    $boutons= '
    <button name="" id="" class="btn btn-primary" href="index.php?page=33&c=1" role="button" disabled>Saisie</button>
    <a name="" id="" class="btn btn-primary" href="index.php?page=33&c=2" role="button">Gestion</a>';
}
// récupération des données pour un update
if (isset($_GET['id'])
&& $_GET['id'] != NULL
){
    $id_img = intval($_GET['id']);
    $texte_page_courante = '<h2>Modifier les champs, tous les champs sont obligatoires</h2>';

    $donnees = req_select_img_produit($bdd,$id_img);
    $nom_image = substr($donnees['nom_image'], 0, strrpos($donnees['nom_image'], ".")); // inutile
    $id_produit = $donnees['id_produit'];
}
else {
    $texte_page_courante = '<h2>Remplissez les champs, tous les champs sont obligatoires</h2>';
    $nom_image = '';
    $id_produit = '';
}

// INSERT et update
if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {
    if (isset($_POST['nom_image']
        ) 
        && $_POST['nom_image'] != NULL
        ) {
            $nom_image = htmlspecialchars($_POST['nom_image']).$timestamp;

        $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
     	$extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);

         if(in_array($extension_upload, $extensions_valides)) {     
            $nom_image = $nom_image.'.'.$extension_upload;
            $chemin = $dossier."/".$nom_image;       
            $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
            if($resultat) {
                echo '<h2 class="mt-5">Transfert reussi</h2>';   
                
                if (isset($_GET['id'])
                && $_GET['id'] != NULL
                ){
                    $id_img = intval($_GET['id']);

                    // supprime l'ancienne image dans le dossier
                    $donnees = req_select_img_produit($bdd,$id_img);
                    $chemin = '../public/assets/img/produits/'.$donnees['nom_image'];
                    if (file_exists($chemin)) {
                        unlink($chemin);
                    }

                    // UPDATE  nouvelle image
                    req_img_update_produit($bdd,$id_img,$nom_image);
                }
                elseif (isset($_GET['id_produit'])
                && $_GET['id_produit'] != NULL
                )  {
                    $id_produit = intval($_GET['id_produit']);

                    req_img_insert_produit($bdd,$id_produit,$nom_image);
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