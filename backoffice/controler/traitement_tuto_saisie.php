<?php
$dossier = '../public/assets/img/site';
$texte_page_courante = '';
$timestamp = time();

// pour un update
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_tutoriel = intval($_GET['id']);
    $texte_page_courante = '<h2>Modifier les champs</h2>';

    $donnees = req_tuto($bdd,$id_tutoriel);
    
    $titre_tutoriel = $donnees['titre_tutoriel'];
    $texte_tutoriel = $donnees['texte_tutoriel'];
    $video_tutoriel = $donnees['video_tutoriel'];
}
else {
    $titre_tutoriel = '';
    $texte_tutoriel = '';
    $video_tutoriel = '';
}


if (isset($_POST['titre_tutoriel'],
$_POST['texte_tutoriel'],
$_POST['video_tutoriel'],
$_POST['nom_img_site'])
&& $_POST['titre_tutoriel']
&& $_POST['texte_tutoriel']
&& $_POST['video_tutoriel']
&& $_POST['nom_img_site']
) {
    $titre_tutoriel = htmlspecialchars($_POST['titre_tutoriel']) ;
    $texte_tutoriel = htmlspecialchars($_POST['texte_tutoriel']) ;
    $video_tutoriel = htmlspecialchars($_POST['video_tutoriel']) ;
    $nom_img_site = htmlspecialchars($_POST['nom_img_site']).$timestamp;

    if (isset($_FILES['photo']) && $_FILES['photo'] != NULL) {

        $extensions_valides = array('jpeg','jpg','png', 'gif', 'webp'); 
        $extension_upload = substr(strrchr($_FILES['photo']['name'],'.'),1);

        if(in_array($extension_upload, $extensions_valides)) {     
            $nom_img_site = $nom_img_site.'.'.$extension_upload;
            $chemin = $dossier."/".$nom_img_site;       
            $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);  
            if($resultat) {
                echo '<h2 class="mt-5">Transfert reussi</h2>';   
                if (isset($_GET['id'])) {
                    //UPDATE
                    // supprime l'ancienne image du fichier et update la nouvelle à la place dans la table
                    $donnees = req_img_tuto_name($bdd, $id_tutoriel);
                    $id_img_site = $donnees['id_img_site'];
                    $chemin = '../public/assets/img/site/'.$donnees['nom_img_site'];
                    if (file_exists($chemin)) {
                        unlink($chemin);
                    }
                    req_update_img_carousel($bdd,$nom_img_site,$id_img_site);

                    // update le tuto
                    req_update_tuto($bdd,$id_tutoriel,$titre_tutoriel,$texte_tutoriel,$video_tutoriel);
                }
                else {
                    // INSERT
                    // enregistre l'image
                    $donnees = req_insert_img_carousel($bdd,$nom_img_site);
                    $id_img_site = $donnees['id_img_site'];
    
                    // enregistre le tuto
                    req_insert_tuto($bdd,$id_img_site,$titre_tutoriel,$texte_tutoriel,$video_tutoriel);
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