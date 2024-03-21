<?php
// ------------------------------------------------------------
//                             accueil BO
// ------------------------------------------------------------
function req_aff_nbr_messages($bdd) {
    $requete = "SELECT COUNT(id_contact) AS nbr_messages FROM contacts 
                WHERE lu_message = 0 ";
    $req = $bdd->prepare($requete);
    $req -> execute();
    
    $donnees = $req -> fetch();
    return $donnees;
}

// ------------------------------------------------------------
//               fonction pour les parties gestion produits
// ------------------------------------------------------------
//-----------
//catégories
//-----------
function req_img_cat_select($bdd,$id_cat) {
    $requete = "SELECT * FROM categories
                INNER JOIN images_site ON categories.id_img_site = images_site.id_img_site
                WHERE categories.id_cat = :id_cat";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_cat', $id_cat, PDO::PARAM_INT); 
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_sup_cat($bdd,$id_cat) {
    $requete = "DELETE FROM categories WHERE id_cat = :id_cat"; // ne pas oublier le where !!!
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
    $req -> execute();
}
function req_sup_img_site($bdd, $id_img_site) {
    $requete = "DELETE FROM images_site WHERE id_img_site = :id_img_site";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_site', $id_img_site, PDO::PARAM_INT);
    $req -> execute();
}
function req_cat($bdd) {
    $requete = "SELECT * FROM categories 
                INNER JOIN images_site ON categories.id_img_site = images_site.id_img_site"; 
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
function table_cat_gestion($donnees) {
    $boite = '
    <tr class="table-primary" >
        <td scope="row">'.$donnees['nom_categorie'].'</td>
        <td><img src="../public/assets/img/site/'.$donnees['nom_img_site'].'" class="mignature_table"></td>';
        
    if ($donnees['afficher_categorie'] == 1) { 
        $boite .= '
            <td><button type="button" class="btn btn-link btn_aff" id="'.$donnees['id_cat'].'" value="'.$donnees['afficher_categorie'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
    }
    else {
        $boite .= '
            <td><button type="button" class="btn btn-link btn_aff" id="'.$donnees['id_cat'].'" value="'.$donnees['afficher_categorie'].'" ><img src="public/assets/img/verifier.png" class="icones_table" alt=""></button></td>';
    }
    $boite .= '
        <td><a href="index.php?page=31&c=1&id='.$donnees['id_cat'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
        <td><a href="index.php?page=31&c=2&sup='.$donnees['id_cat'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
    </tr>
    ';
    return $boite;
}
function req_cat_select($bdd,$id_cat) {
    $requete = "SELECT * FROM `categories` WHERE id_cat = :id_cat";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req->fetch();
    return $donnees;
}
function req_img_site_update($bdd,$image_categorie,$id_img_site) {
    $requete = "UPDATE `images_site` SET nom_img_site = :image_categorie 
                WHERE id_img_site = :id_img_site"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':image_categorie', $image_categorie, PDO::PARAM_STR);
    $req->bindValue(':id_img_site', $id_img_site, PDO::PARAM_INT);
    $req -> execute();
}
function req_update_cat($bdd,$id_cat,$nom_categorie,$description_categorie) {
    $requete = "UPDATE `categories` SET nom_categorie = :nom_categorie, 
                                        description_categorie = :description_categorie 
                WHERE id_cat = :id_cat"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_cat', $id_cat, PDO::PARAM_INT); 
    $req->bindValue(':nom_categorie', $nom_categorie, PDO::PARAM_STR);  
    $req->bindValue(':description_categorie',$description_categorie, PDO::PARAM_STR); 
    $req -> execute();
}
function req_insert_img_site($bdd,$image_categorie) {
    // enregistre l'image dans la table : images_site
                    
    $requete = "INSERT INTO `images_site` VALUES (0, :nom_img_site, 0 )";
    $req = $bdd->prepare($requete);
    $req->bindValue(':nom_img_site', $image_categorie, PDO::PARAM_STR);
    $req -> execute();

    // récupère l'id de l'image enregistré
    $requete = "SELECT * FROM images_site 
                ORDER BY id_img_site DESC
                LIMIT 1";
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req->fetch();
    $id_img_site = $donnees['id_img_site'];
    
    return $id_img_site;
}
function req_insert_cat($bdd,$image_categorie,$nom_categorie,$description_categorie) {
    $id_img_site =req_insert_img_site($bdd,$image_categorie);
    
    // enregistre l'entré dans la table catégorie
    $requete = "INSERT INTO `categories`(`id_cat`, `nom_categorie`, `description_categorie`, `afficher_categorie`, `id_img_site`) 
                VALUES (0,:nom_categorie, :description_categorie, 1, :id_img_site)"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_site', $id_img_site, PDO::PARAM_INT); 
    $req->bindValue(':nom_categorie', $nom_categorie, PDO::PARAM_STR);  
    $req->bindValue(':description_categorie',$description_categorie, PDO::PARAM_STR); 
    $req -> execute();
}
//----------------
// sous categories
//----------------
function req_cat_de_sous_cat($bdd,$id_sous_cat) {
    $requete = "SELECT * FROM `sous_categories` WHERE `id_sous_cat` = :id_sous_cat";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_img_sous_cat($bdd,$id_sous_cat) {
    $requete = "SELECT * FROM sous_categories
                INNER JOIN images_site ON sous_categories.id_img_site = images_site.id_img_site
                WHERE sous_categories.id_sous_cat = :id_sous_cat";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT); 
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_sup_sous_cat($bdd,$id_sous_cat) {
    $requete = "DELETE FROM sous_categories WHERE id_sous_cat = :id_sous_cat"; // ne pas oublier le where !!!
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT);
    $req -> execute();
}
function req_sous_categories($bdd,$ordre_req) {
    $requete = 'SELECT * FROM sous_categories 
                INNER JOIN categories ON categories.id_cat = sous_categories.id_cat
                INNER JOIN images_site ON images_site.id_img_site = sous_categories.id_img_site
                '.$ordre_req; 
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
function table_sous_cat_gestion($donnees) {
    $boite = '
    <tr class="table-primary" >
        <td scope="row">'.$donnees['nom_sous_categorie'].'</td>
        <td><img src="../public/assets/img/site/'.$donnees['nom_img_site'].'" class="mignature_table"></td>
        <td>'.$donnees['id_cat'].' - '.$donnees['nom_categorie'].'</td>';
    if ($donnees['afficher_sous_categorie'] == 1) {
        $boite .='
            <td><button type="button" class="btn btn-link btn_aff" id="'.$donnees['id_sous_cat'].'" value="'.$donnees['afficher_sous_categorie'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
    }
    else {
        $boite .='
            <td><button type="button" class="btn btn-link btn_aff" id="'.$donnees['id_sous_cat'].'" value="'.$donnees['afficher_sous_categorie'].'" ><img src="public/assets/img/verifier.png" class="icones_table" alt=""></button></td>';
    }
    $boite .='
        <td><a href="index.php?page=32&c=1&id='.$donnees['id_sous_cat'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
        <td><a href="index.php?page=32&c=2&sup='.$donnees['id_sous_cat'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt=""></a></td>
    </tr>
    ';
    return $boite;
}
function req_update_img_sous_cat($bdd,$image_sous_categorie,$id_img_site) {
    $requete = "UPDATE `images_site` SET nom_img_site = :image_sous_categorie 
                WHERE id_img_site = :id_img_site"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':image_sous_categorie', $image_sous_categorie, PDO::PARAM_STR);
    $req->bindValue(':id_img_site', $id_img_site, PDO::PARAM_INT);
    $req -> execute();
}
function req_update_sous_cat($bdd,$id_sous_cat,$nom_sous_categorie,$description_sous_categorie,$id_cat) {
    $requete = "UPDATE `sous_categories` SET nom_sous_categorie = :nom_sous_categorie,  
                                             description_sous_categorie = :description_sous_categorie,
                                             id_cat = :id_cat 
                WHERE id_sous_cat = :id_sous_cat"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT); 
    $req->bindValue(':nom_sous_categorie', $nom_sous_categorie, PDO::PARAM_STR);  
    $req->bindValue(':description_sous_categorie',$description_sous_categorie, PDO::PARAM_STR); 
    $req->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
    $req -> execute();

}
function req_insert_sous_cat($bdd,$image_sous_categorie,$nom_sous_categorie,$description_sous_categorie,$id_cat) {
    // enregistre l'image dans la table : images_site
    $id_img_site = req_insert_img_site($bdd,$image_sous_categorie);
    $requete = "INSERT INTO `sous_categories`(`id_sous_cat`, `nom_sous_categorie`,  `description_sous_categorie`, `afficher_sous_categorie`, `id_img_site`, `id_cat`) 
                VALUES (0,:nom_sous_categorie, :description_sous_categorie, 1,:id_img_site, :id_cat)"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_site', $id_img_site, PDO::PARAM_INT); 
    $req->bindValue(':nom_sous_categorie', $nom_sous_categorie, PDO::PARAM_STR);  
    $req->bindValue(':description_sous_categorie',$description_sous_categorie, PDO::PARAM_STR); 
    $req->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
    $req -> execute();
}
//-----------
// produits
//-----------
function req_produit($bdd,$id_produit) {
    $requete = "SELECT * FROM produits WHERE id_produit = :id_produit";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_sup_produit($bdd,$id_produit) {
    $requete = "DELETE FROM images_produits WHERE id_produit = :id_produit"; // ne pas oublier le where !!!
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req -> execute();
    // supprime le produit
    $requete = "DELETE FROM produits WHERE id_produit = :id_produit"; // ne pas oublier le where !!!
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req -> execute();
}
function req_produits($bdd,$id_cat,$ordre_req) {
    $requete = 'SELECT * FROM produits 
                INNER JOIN sous_categories ON produits.id_sous_cat = sous_categories.id_sous_cat
                WHERE sous_categories.id_cat = :id_cat 
                '.$ordre_req; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_cat', $id_cat, PDO::PARAM_INT); 
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_liste_p_sans_img($bdd) {
    $requete = "SELECT produits.id_produit FROM produits
                EXCEPT
                (SELECT images_produits.id_produit FROM images_produits)";
    $req2 = $bdd -> prepare($requete);
    $req2 -> execute();
    $donnees = $req2 -> fetchAll();
    return $donnees;
}
function table_produit_gestion($donnees, $prod_sans_img) { 
    $boite = '
    <tr class="table-primary" >
        <td scope="row">'.$donnees['nom_produit'].'</td>
        <td><a href="index.php?page=33&c=2&id_produit='.$donnees['id_produit'].'"><img src="public/assets/img/image-gallery.png" class="icones_table modifier" alt=""></a></td>';
    if (in_array($donnees['id_produit'], $prod_sans_img)) { // si pas d'image
        $ajout_img = 'ajout_img';
    }
    else {
        $ajout_img = '';
    }
    $boite .= '
        <td><a href="index.php?page=33&c=1&id_produit='.$donnees['id_produit'].'"><img src="public/assets/img/pictures.png" class="icones_table modifier '.$ajout_img.'" alt=""></a></td>';
    $boite.= '
        <td>'.$donnees['prix_produit'].'</td>
        <td id="'.$donnees['id_produit'].'"><input type="text" id="stock'.$donnees['id_produit'].'" value="'.$donnees['stock_produit'].'" class="input_dispo" ></td>
        <td>'.$donnees['id_sous_cat'].' - '.$donnees['nom_sous_categorie'].'</td>';

    if ($donnees['promo_saison_produit'] == 1) { //si dans promo
        $boite .='
            <td><button type="button" class="btn btn-link btn_promo" id="promo'.$donnees['id_produit'].'"value="'.$donnees['promo_saison_produit'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
    } 
    else {
        $boite .='
            <td><button type="button" class="btn btn-link btn_promo" id="promo'.$donnees['id_produit'].'"value="'.$donnees['promo_saison_produit'].'"><img src="public/assets/img/verifier.png" class="icones_table" alt=""></button></td>';
    }
    
    if ($donnees['afficher_produit'] == 1) { // si afficher
        $boite .='
            <td><button type="button" class="btn btn-link btn_aff" id="aff'.$donnees['id_produit'].'"value="'.$donnees['afficher_produit'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
    }
    else {
        $boite .='
            <td><button type="button" class="btn btn-link btn_aff" id="aff'.$donnees['id_produit'].'"value="'.$donnees['afficher_produit'].'"><img src="public/assets/img/verifier.png" class="icones_table" alt=""></button></td>';
    }
    $boite .= '
        <td><a href="index.php?page=3&c=1&id='.$donnees['id_produit'].'&idcat='.$donnees['id_cat'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
        <td><a href="index.php?page=3&c=2&sup='.$donnees['id_produit'].'&idcat='.$donnees['id_cat'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt=""></a></td>
    </tr>
    ';
    return $boite;
}
function req_update_produit($bdd,$id_produit,$nom_produit,$description_produit,$prix_produit,$poids_produit,$dimension_produit,$composition_produit,$couleur_produit,$usage_produit,$promo_saison_produit,$id_sous_cat) {
    $requete = "UPDATE `produits` 
                SET nom_produit = :nom_produit, 
                    description_produit = :description_produit, 
                    prix_produit = :prix_produit,
                    poids_produit = :poids_produit,
                    dimension_produit = :dimension_produit,
                    composition_produit = :composition_produit,
                    promo_saison_produit = :promo_saison_produit,
                    id_usage = :usage_produit,
                    id_couleur = :couleur_produit,
                    id_sous_cat = :id_sous_cat
                WHERE id_produit = :id_produit"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT); 
    $req->bindValue(':nom_produit', $nom_produit, PDO::PARAM_STR);
    $req->bindValue(':description_produit', $description_produit, PDO::PARAM_STR); 
    $req->bindValue(':prix_produit', $prix_produit, PDO::PARAM_STR); 
    $req->bindValue(':poids_produit', $poids_produit, PDO::PARAM_STR);  
    $req->bindValue(':dimension_produit', $dimension_produit, PDO::PARAM_STR); 
    $req->bindValue(':composition_produit', $composition_produit, PDO::PARAM_STR); 
    $req->bindValue(':couleur_produit', $couleur_produit, PDO::PARAM_STR); 
    $req->bindValue(':usage_produit', $usage_produit, PDO::PARAM_STR); 
    // $req->bindValue(':stock_produit', $stock_produit, PDO::PARAM_INT); 
    $req->bindValue(':promo_saison_produit', $promo_saison_produit, PDO::PARAM_INT); 
    $req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT); 
    $req -> execute();
}
function req_insert_produit($bdd,$nom_produit,$description_produit,$prix_produit,$poids_produit,$dimension_produit,$composition_produit,$couleur_produit,$usage_produit,$promo_saison_produit,$id_sous_cat) {
    $requete = "INSERT INTO `produits`(`id_produit`, 
                             `nom_produit`, 
                             `description_produit`, 
                             `prix_produit`, 
                             `poids_produit`, 
                             `dimension_produit`, 
                             `composition_produit`, 
                             `stock_produit`, 
                             `promo_saison_produit`,
                             `afficher_produit`, 
                             `id_usage`, 
                             `id_couleur`, 
                             `id_sous_cat`)
                VALUES (0,
                        :nom_produit, 
                        :description_produit, 
                        :prix_produit,
                        :poids_produit, 
                        :dimension_produit, 
                        :composition_produit, 
                        10,
                        :promo_saison_produit,
                        0, 
                        :usage_produit, 
                        :couleur_produit, 
                        :id_sous_cat)"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':nom_produit', $nom_produit, PDO::PARAM_STR);
    $req->bindValue(':description_produit', $description_produit, PDO::PARAM_STR); 
    $req->bindValue(':prix_produit', $prix_produit, PDO::PARAM_STR); 
    $req->bindValue(':poids_produit', $poids_produit, PDO::PARAM_STR);  
    $req->bindValue(':dimension_produit', $dimension_produit, PDO::PARAM_STR); 
    $req->bindValue(':composition_produit', $composition_produit, PDO::PARAM_STR); 
    $req->bindValue(':couleur_produit', $couleur_produit, PDO::PARAM_STR); 
    $req->bindValue(':usage_produit', $usage_produit, PDO::PARAM_STR); 
    // $req->bindValue(':stock_produit', $stock_produit, PDO::PARAM_INT); 
    $req->bindValue(':promo_saison_produit', $promo_saison_produit, PDO::PARAM_INT); 
    $req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT); 
    $req -> execute();
}
function req_cat_afficher($bdd) {
    $requete = "SELECT * FROM categories 
    WHERE afficher_categorie = 1"; 
    $req3 = $bdd->prepare($requete);
    $req3 -> execute();
    $donnees = $req3 -> fetchAll();
    return $donnees;
}
function req_sous_cat_afficher($bdd,$id_cat) {
    $requete = "SELECT * FROM sous_categories 
                WHERE id_cat = :id_cat AND afficher_sous_categorie = 1
                "; 
    $req2 = $bdd->prepare($requete);
    $req2->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
    $req2 -> execute();
    $donnees = $req2 -> fetchAll();
    return $donnees;
}
function req_couleur($bdd) {
    $requete = "SELECT * FROM couleurs "; 
    $req5 = $bdd->prepare($requete);
    $req5 -> execute();
    $donnees = $req5 -> fetchAll();
    return $donnees;
}
function req_usage($bdd) {
    $requete = "SELECT * FROM usages "; 
    $req6 = $bdd->prepare($requete);
    $req6 -> execute();
    $donnees = $req6 -> fetchAll();
    return $donnees;
}
//-----------
// images
//-----------
function req_select_img_produit($bdd,$id_image) {
    $requete = "SELECT * FROM images_produits
                WHERE id_img = :id_image";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_image', $id_image, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_sup_img_produit($bdd,$id_image) {
    $requete = "DELETE FROM images_produits 
                WHERE id_img = :id_image"; // ne pas oublier le where !!!
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_image', $id_image, PDO::PARAM_INT);
    $req -> execute();
}
function req_images_produit($bdd,$id_produit,$req_where) {
    $requete = 'SELECT * FROM images_produits 
                INNER JOIN produits ON images_produits.id_produit = produits.id_produit
                '.$req_where.'
                '; 
    $req = $bdd->prepare($requete);
    if ($req_where != '') {
        $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT); 
    }
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
function table_img_produit_gestion($donnees) {
    $boite = '
    <tr class="table-primary" >
        <td scope="row"><img src="../public/assets/img/produits/'.$donnees['nom_image'].'" class="mignature_table"></td>
        <td>'.$donnees['id_produit'].' - '.$donnees['nom_produit'].'</td>
        <td id="'.$donnees['id_img'].'"><input type="text" id="position'.$donnees['id_img'].'" value="'.$donnees['position_image'].'" class="input_dispo"></td>';
        
        if ($donnees['afficher_image'] == 1) {
            $boite .='
            <td><button type="button" class="btn btn-link btn_aff" id="aff'.$donnees['id_img'].'" value="'.$donnees['afficher_image'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
        }
        else {
            $boite .='
            <td><button type="button" class="btn btn-link btn_aff" id="aff'.$donnees['id_img'].'" value="'.$donnees['afficher_image'].'"><img src="public/assets/img/verifier.png" class="icones_table" alt=""></button></td>';
        }
    $boite .='
        <td><a href="index.php?page=33&c=1&id='.$donnees['id_img'].'&id_produit='.$donnees['id_produit'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
        <td><a href="index.php?page=33&c=2&sup='.$donnees['id_img'].'&id_produit='.$donnees['id_produit'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
    </tr>
    ';
    return $boite;
}
function req_img_update_produit($bdd,$id_img,$nom_image) {
    $requete = "UPDATE `images_produits` SET nom_image = :nom_image 
                WHERE id_img = :id_img"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img', $id_img, PDO::PARAM_INT);
    $req->bindValue(':nom_image', $nom_image, PDO::PARAM_STR);  
    $req -> execute();
}
function req_img_insert_produit($bdd,$id_produit,$nom_image) {
    // vérification si il existe déjà une image pour ce produit et ajoute image avec position après la dernière
    $requete = "SELECT * FROM produits
                INNER JOIN images_produits ON produits.id_produit = images_produits.id_produit
                WHERE produits.id_produit = :id_produit
                ";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req -> execute();

    $i = 0;
    while($donnees = $req->fetch()) {
    if ($donnees['position_image'] > $i) { $i = $donnees['position_image'];}
    }
    $position_image = $i + 1;

    // INSERT
    $requete = "INSERT INTO `images_produits`(`id_img`, `nom_image`, `afficher_image`, `position_image`, `id_produit`) 
                VALUES (0,:nom_image, 1, $position_image, :id_produit)"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req->bindValue(':nom_image', $nom_image, PDO::PARAM_STR);  
    $req -> execute();
}
//----------------------------------------------------------------------------------------------------
//                                           gestion du site 
//----------------------------------------------------------------------------------------------------

//-------------
// carousel
//-------------
function req_img_carousel($bdd,$id_slide) {
    $requete = "SELECT * FROM carousel_slides
                INNER JOIN images_site ON images_site.id_img_site = carousel_slides.id_img_site
                WHERE carousel_slides.id_slide = :id_slide";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_slide', $id_slide, PDO::PARAM_INT); 
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_sup_carousel($bdd,$id_slide) {
    $requete = "DELETE FROM carousel_slides WHERE id_slide = :id_slide"; // ne pas oublier le where !!!
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_slide', $id_slide, PDO::PARAM_INT);
    $req -> execute();
}
function req_sup_img_carousel($bdd,$id_img_site) {
    $requete = "DELETE FROM images_site WHERE id_img_site = :id_img_site";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_site', $id_img_site, PDO::PARAM_INT);
    $req -> execute();
}
function req_carousels($bdd) {
    $requete = "SELECT * FROM carousel_slides
                INNER JOIN images_site ON carousel_slides.id_img_site = images_site.id_img_site
                INNER JOIN sous_categories ON carousel_slides.id_sous_cat = sous_categories.id_sous_cat ";
    $req = $bdd->prepare($requete);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
function table_carousel_gestion($donnees) {
    $boite = '';

    foreach ($donnees as $slide) {
        $boite .= '
        <tr class="table-primary" >
            <td scope="row">'.$slide['titre_slide'].'</td>
            <td>'.$slide['texte_slide'].'</td>
            <td><img src="../public/assets/img/site/'.$slide['nom_img_site'].'" class="mignature_table"></td>
            <td>'.$slide['nom_sous_categorie'].'</td>';
            if ($slide['afficher_slide'] == 1) {
                $boite .= '
                    <td><button type="button" class="btn btn-link btn_aff" id="'.$slide['id_slide'].'" value="'.$slide['afficher_slide'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
            }
            else {
                $boite .= '
                    <td><button type="button" class="btn btn-link btn_aff" id="'.$slide['id_slide'].'" value="'.$slide['afficher_slide'].'"><img src="public/assets/img/verifier.png" class="icones_table " alt=""></button></td>';
            }
        $boite .= '
            <td><a href="index.php?page=4&c=1&id='.$slide['id_slide'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
            <td><a href="index.php?page=4&c=2&sup='.$slide['id_slide'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt=""></a></td>
        </tr>
        ';
    }
    return $boite;
}
function req_carousel_slide($bdd,$id_slide) {
    $requete = "SELECT * FROM carousel_slides
                INNER JOIN images_site ON carousel_slides.id_img_site = images_site.id_img_site
                INNER JOIN sous_categories ON carousel_slides.id_sous_cat = sous_categories.id_sous_cat
                WHERE carousel_slides.id_slide = :id_slide";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_slide', $id_slide, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_update_img_carousel($bdd,$nom_img_site,$id_img_site) {
    $requete = "UPDATE `images_site` SET nom_img_site = :nom_img_site 
                WHERE id_img_site = :id_img_site"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':nom_img_site', $nom_img_site, PDO::PARAM_STR);
    $req->bindValue(':id_img_site', $id_img_site, PDO::PARAM_INT);
    $req -> execute();
}
function req_update_carousel($bdd,$id_sous_cat,$titre_slide,$texte_slide,$id_slide) {
    $requete = "UPDATE `carousel_slides` SET titre_slide = :titre_slide,  
                                             texte_slide = :texte_slide, 
                                             id_sous_cat = :id_sous_cat 
                WHERE id_slide = :id_slide"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT); 
    $req->bindValue(':titre_slide', $titre_slide, PDO::PARAM_STR);  
    $req->bindValue(':texte_slide',$texte_slide, PDO::PARAM_STR); 
    $req->bindValue(':id_slide', $id_slide, PDO::PARAM_INT);
    $req -> execute();
}
function req_insert_img_carousel($bdd,$nom_image) {
    $requete = "INSERT INTO `images_site` VALUES (0, :nom_img_site, 0 )";
    $req = $bdd->prepare($requete);
    $req->bindValue(':nom_img_site', $nom_image, PDO::PARAM_STR);
    $req -> execute();

    // récupère l'id de l'image enregistré
    $requete = "SELECT * FROM images_site 
                ORDER BY id_img_site DESC
                LIMIT 1";
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_insert_carousel($bdd,$texte_slide,$titre_slide,$id_img_site,$id_sous_cat) {
    $requete = "INSERT INTO `carousel_slides`(`id_slide`, `texte_slide`, `titre_slide`, `afficher_slide`, `id_img_site`, `id_sous_cat`) 
                VALUES (0,:texte_slide, :titre_slide, 0, :id_img_site, :id_sous_cat)"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':texte_slide', $texte_slide, PDO::PARAM_STR); 
    $req->bindValue(':titre_slide', $titre_slide, PDO::PARAM_STR);  
    $req->bindValue(':id_img_site',$id_img_site, PDO::PARAM_INT); 
    $req->bindValue(':id_sous_cat',$id_sous_cat, PDO::PARAM_INT); 
    $req -> execute();
}
//-----------
// jumbotron
//-----------
function req_sup_parag_jumbo($bdd,$id_paragraphe) {
    $requete = "DELETE FROM jumbotron_paragraphes
        WHERE id_paragraphe = :id_paragraphe";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
    $req -> execute();
}
function req_all_parag_jumbo($bdd) {
    $requete = "SELECT * FROM jumbotron_paragraphes";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_parag_jumbo($bdd,$id_paragraphe) {
    $requete = "SELECT * FROM jumbotron_paragraphes WHERE id_paragraphe = :id_paragraphe";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function table_jumbotron_gestion($donnees) {
    $boite = '
    <tr class="table-primary" >
        <td scope="row">'.$donnees['titre_paragraphe'].'</td>
        <td>'.$donnees['texte_paragraphe'].'</td> ';
    if ($donnees['taille_paragraphe'] == 1) {
        $boite .= '
            <td>pleine page</td>';
    }
    else {
        $boite .= '
            <td>demi page</td>
        ';
    }
    if ($donnees['afficher_paragraphe'] == 1) {
        $boite .= '
            <td><button type="button" class="btn btn-link btn_aff" id="'.$donnees['id_paragraphe'].'" value="'.$donnees['afficher_paragraphe'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
    }
    else {
        $boite .= '
            <td><button type="button" class="btn btn-link btn_aff" id="'.$donnees['id_paragraphe'].'" value="'.$donnees['afficher_paragraphe'].'" ><img src="public/assets/img/verifier.png" class="icones_table" alt=""></button></td>';
    }
    $boite .= '
        <td><a href="index.php?page=5&c=1&id='.$donnees['id_paragraphe'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
        <td><a href="index.php?page=5&c=2&sup='.$donnees['id_paragraphe'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
    </tr>
    ';
    return $boite;
}
function req_update_jumbo($bdd,$id_paragraphe,$texte_paragraphe,$taille_paragraphe,$titre_paragraphe) {
    $requete = "UPDATE `jumbotron_paragraphes` SET `titre_paragraphe`= :titre_paragraphe,
                                                    `texte_paragraphe`=:texte_paragraphe,
                                                    `taille_paragraphe`=:taille_paragraphe 
                WHERE id_paragraphe = :id_paragraphe ";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
    $req -> bindValue(':titre_paragraphe', $titre_paragraphe,  PDO::PARAM_STR);
    $req -> bindValue(':texte_paragraphe', $texte_paragraphe,  PDO::PARAM_STR);
    $req -> bindValue(':taille_paragraphe', $taille_paragraphe, PDO::PARAM_INT);
    $req -> execute();
}
function req_insert_jumbo($bdd,$titre_paragraphe,$texte_paragraphe,$taille_paragraphe) {
    $id_jumbotron = 1;
    $requete = "INSERT INTO `jumbotron_paragraphes`(`id_paragraphe`, `titre_paragraphe`, `texte_paragraphe`, `taille_paragraphe`, `afficher_paragraphe`, `id_jumbotron`) 
                VALUES (0,:titre_paragraphe,:texte_paragraphe,:taille_paragraphe,0,$id_jumbotron)";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':titre_paragraphe', $titre_paragraphe,  PDO::PARAM_STR);
    $req -> bindValue(':texte_paragraphe', $texte_paragraphe,  PDO::PARAM_STR);
    $req -> bindValue(':taille_paragraphe', $taille_paragraphe, PDO::PARAM_INT);
    $req -> execute();
}
//-------
function req_sup_img_jumbo($bdd,$id_img_jumbo) {
    $requete = "DELETE FROM images_jumbotron 
                WHERE id_img_jumbo = :id_img_jumbo"; // ne pas oublier le where !!!
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_jumbo', $id_img_jumbo, PDO::PARAM_INT);
    $req -> execute();
}
function req_img_jumbo($bdd,$id_img_jumbo) {
    $requete = "SELECT * FROM images_jumbotron
                WHERE id_img_jumbo = :id_img_jumbo";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_jumbo', $id_img_jumbo, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_all_img_jumbo($bdd) {
    $requete = "SELECT * FROM images_jumbotron";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    
    $donnees2 = $req -> fetchAll();
    return $donnees2;
}
function table_jumbotron_gestion_img($donnees2) {
    $boite = '
    <tr class="table-primary" >
        <td scope="row"><img src="../public/assets/img/site/'.$donnees2['nom_img_jumbotron'].'" class="mignature_table"></td>';
    if ($donnees2['position_img_jumbotron'] == 1) {
        $boite .= '
            <td>droite</td>';
    }
    elseif ($donnees2['position_img_jumbotron'] == 2) {
        $boite .= '
            <td>Milieux</td>';
    }
    else {
        $boite .= '
            <td>Gauche</td>';
    }
    $boite .= '
        <td><a href="index.php?page=5&c=3&id='.$donnees2['id_img_jumbo'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
        <td><a href="index.php?page=5&c=2&supimg='.$donnees2['id_img_jumbo'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt=""></a></td>
    </tr>
    ';
    return $boite;
}
function req_update_img_jumbo($bdd,$id_img_jumbo,$nom_img_jumbotron,$position_img_jumbotron) {
    $requete = "UPDATE `images_jumbotron` SET nom_img_jumbotron = :nom_img_jumbotron,
                                              position_img_jumbotron = :position_img_jumbotron 
                WHERE id_img_jumbo = :id_img_jumbo"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_jumbo', $id_img_jumbo, PDO::PARAM_INT);
    $req->bindValue(':nom_img_jumbotron', $nom_img_jumbotron, PDO::PARAM_STR);  
    $req->bindValue(':position_img_jumbotron', $position_img_jumbotron, PDO::PARAM_INT);  
    $req -> execute();
}
function req_insert_img_jumbo($bdd,$nom_img_jumbotron,$position_img_jumbotron) {
    $requete = "INSERT INTO `images_jumbotron`(`id_img_jumbo`, `position_img_jumbotron`, `nom_img_jumbotron`, `id_jumbotron`) 
                VALUES (0,:position_img_jumbotron,:nom_img_jumbotron, 1)"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':nom_img_jumbotron', $nom_img_jumbotron, PDO::PARAM_STR);  
    $req->bindValue(':position_img_jumbotron', $position_img_jumbotron, PDO::PARAM_INT);  
    $req -> execute();
}
//---------------------
//    tutoriels
//---------------------
function req_tuto($bdd,$id_tutoriel) {
    $requete = "SELECT * FROM tutoriels 
                WHERE id_tutoriel = :id_tutoriel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_All_tuto($bdd) {
    $requete = "SELECT * FROM tutoriels
                INNER JOIN images_site ON tutoriels.id_img_site = images_site.id_img_site";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    
    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_img_tuto_name($bdd, $id_tutoriel) {
    $requete = "SELECT * FROM tutoriels 
                INNER JOIN images_site ON tutoriels.id_img_site = images_site.id_img_site
                WHERE tutoriels.id_tutoriel = :id_tutoriel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
function req_update_tuto($bdd,$id_tutoriel,$titre_tutoriel,$texte_tutoriel,$video_tutoriel) {
    $requete = "UPDATE tutoriels SET titre_tutoriel = :titre_tutoriel, 
                                    texte_tutoriel = :texte_tutoriel, 
                                    video_tutoriel = :video_tutoriel 
                WHERE id_tutoriel = :id_tutoriel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> bindValue(':titre_tutoriel', $titre_tutoriel, PDO::PARAM_STR);
    $req -> bindValue(':texte_tutoriel', $texte_tutoriel, PDO::PARAM_STR);
    $req -> bindValue(':video_tutoriel', $video_tutoriel, PDO::PARAM_STR);
    $req -> execute();
}
function req_insert_tuto($bdd,$id_img_site,$titre_tutoriel,$texte_tutoriel,$video_tutoriel) {
    $requete = "INSERT INTO tutoriels VALUES (0,:titre_tutoriel,:texte_tutoriel,:video_tutoriel,$id_img_site)";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':titre_tutoriel', $titre_tutoriel, PDO::PARAM_STR);
    $req -> bindValue(':texte_tutoriel', $texte_tutoriel, PDO::PARAM_STR);
    $req -> bindValue(':video_tutoriel', $video_tutoriel, PDO::PARAM_STR);
    $req -> execute();
}
function req_sup_tuto($bdd,$id_tuto) {
    $requete = "DELETE FROM tutoriels WHERE id_tutoriel = :id_tutoriel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> execute();
}
function table_tuto($donnees) {
    $table = '';
    foreach ($donnees as $ligne) {
        $table .= '
        <tr class="table-primary" >
            <td scope="row">'.$ligne['titre_tutoriel'].'</td>
            <td><img src="../public/assets/img/site/'.$ligne['nom_img_site'].'" class="img-fluid mignature_table"></td>
            <td>'.str_replace('<iframe', '<iframe sandbox="allow-scripts allow-same-origin"', htmlspecialchars_decode($ligne['video_tutoriel'])).'</td>
            <td><a href="index.php?page=6&c=4&id='.$ligne['id_tutoriel'].'">Liste du materiel</a></td>
            <td><a href="index.php?page=6&c=1&id='.$ligne['id_tutoriel'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
            <td><a href="index.php?page=6&c=2&sup='.$ligne['id_tutoriel'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt=""></a></td>
        </tr>
        ';

    }
return $table;
}
// portfolio accueil
function req_tuto_portfolio($bdd,$i) {
    $requete = "SELECT * FROM portfolio_tutoriels 
                WHERE id_portfolio = $i";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    $tuto_select = $req -> fetch();
    return $tuto_select;
}
function req_portfolio($bdd) {
    $requete = "SELECT * FROM portfolio_tutoriels 
                INNER JOIN tutoriels ON portfolio_tutoriels.id_tutoriel = tutoriels.id_tutoriel
                INNER JOIN images_site ON images_site.id_img_site = tutoriels.id_img_site
                ORDER BY portfolio_tutoriels.id_portfolio";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $portfolio = $req -> fetchAll();
    return $portfolio;
}
// liste des matériaux
function req_materiel($bdd,$id_materiel) {
    $requete = "SELECT * FROM materiaux_tutoriels 
                WHERE id_materiel = :id_materiel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_materiel', $id_materiel, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_update_materiel($bdd,$intitule_materiel,$description_materiel,$id_materiel) {
    $requete = "UPDATE materiaux_tutoriels SET intitule_materiel = :intitule_materiel,
                                                description_materiel = :description_materiel
                WHERE id_materiel = :id_materiel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':intitule_materiel', $intitule_materiel, PDO::PARAM_STR);
    $req -> bindValue(':description_materiel', $description_materiel, PDO::PARAM_STR);
    $req -> bindValue(':id_materiel', $id_materiel, PDO::PARAM_INT);
    $req -> execute();
}
function req_insert_materiel($bdd,$intitule_materiel,$description_materiel,$id_tutoriel) {
    $requete = "INSERT INTO materiaux_tutoriels VALUES (0, :intitule_materiel, :description_materiel, :id_tutoriel)";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':intitule_materiel', $intitule_materiel, PDO::PARAM_STR);
    $req -> bindValue(':description_materiel', $description_materiel, PDO::PARAM_STR);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> execute();
}
function req_sup_materiel($bdd,$id_materiel) {
    $requete = "DELETE FROM materiaux_tutoriels WHERE id_materiel = :id_materiel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_materiel', $id_materiel, PDO::PARAM_INT);
    $req -> execute();
}
function req_all_materiel($bdd,$id_tutoriel) {
    $requete = "SELECT * FROM materiaux_tutoriels
                WHERE id_tutoriel = :id_tutoriel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> execute();

    $liste_materiaux = $req -> fetchAll();
    return $liste_materiaux;
}
function table_materiel($liste_materiaux,$id_tutoriel) {
    $table = '';
    foreach ($liste_materiaux as $ligne) {
        $table .= '
        <tr class="table-primary" >
            <td scope="row">'.$ligne['intitule_materiel'].'</td>
            <td>'.$ligne['description_materiel'].'</td>
            <td><a href="index.php?page=6&c=4&id='.$id_tutoriel.'&mat='.$ligne['id_materiel'].'" ><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""</a></td>
            <td><a href="index.php?page=6&c=4&id='.$id_tutoriel.'&sup='.$ligne['id_materiel'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt=""></a></td>
        </tr>
        ';

    }
    return $table;
}
//-----------
// ateliers
//-----------
function req_sup_ateliers($bdd, $id_atelier) {
    // supprime les inscriptions
    $requete = "DELETE FROM inscriptions WHERE id_atelier = :id_atelier";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT); 
    $req -> execute();
    // supprime les dates
    $requete = "DELETE FROM horaires WHERE id_atelier = :id_atelier";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT); 
    $req -> execute();
    // supprime le descriptif
    $requete = "DELETE FROM descriptifs_ateliers WHERE id_atelier = :id_atelier";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT); 
    $req -> execute();
    // supprime les images
    $requete = "SELECT * FROM images_ateliers
                WHERE id_atelier = :id_atelier";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT); 
    $req -> execute();
    while ($donnees = $req->fetch()) {
        $chemin = '../public/assets/img/site/'.$donnees['nom_img_atelier'];
        if (file_exists($chemin)) {
            unlink($chemin);
        }
    }
    $requete = "DELETE FROM images_ateliers WHERE id_atelier = :id_atelier";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT); 
    $req -> execute();

    // supprime l'atelier
    $requete = "DELETE FROM ateliers WHERE id_atelier = :id_atelier";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT); 
    $req -> execute();
}
function req_tous_ateliers($bdd) {
    $requete = "SELECT * FROM ateliers";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_ateliers($bdd,$id_atelier) {
    $requete = "SELECT * FROM ateliers 
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_ateliers_img($bdd,$lignes) {
    $requete = "SELECT * FROM images_ateliers 
                WHERE id_atelier = :id_atelier 
                LIMIT 1";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $lignes['id_atelier'], PDO::PARAM_INT);
    $req -> execute();

    $image = $req -> fetch();
    return $image;
}
function table_ateliers_gestion($bdd,$donnees) {
    $table = '';
    foreach ($donnees as $lignes) {
        $image = req_ateliers_img($bdd,$lignes);

        if (isset($image['nom_img_atelier'])) {
            $nom_image = '<img src="../public/assets/img/site/'.$image['nom_img_atelier'].'" class="mignature_table">';
        }
        else {
            $nom_image = 'Gérer';
        }

        if ($lignes['afficher_atelier'] == 1) {
            $affichage = '<td><button type="button" class="btn btn-link btn_aff" id="'.$lignes['id_atelier'].'" value="'.$lignes['afficher_atelier'].'"><img src="public/assets/img/verifier.png" class="icones_table afficher" alt=""></button></td>';
        }
        else {
            $affichage = '<td><button type="button" class="btn btn-link btn_aff" id="'.$lignes['id_atelier'].'" value="'.$lignes['afficher_atelier'].'"><img src="public/assets/img/verifier.png" class="icones_table" alt=""></button></td>';
        }

        $table .= '
        <tr class="table-primary">
            <td scope="row">'.$lignes['nom_atelier'].'</td>
            <td>'.$lignes['nombre_participant_max'].'</td>
            <td><a href="index.php?page=12&c=3&id='.$lignes['id_atelier'].'">Voir</a></td>
            <td>'.$lignes['prix_atelier'].'</td>
            <td><a href="index.php?page=12&c=61&id='.$lignes['id_atelier'].'">'.$nom_image.'</a></td>
            <td><a href="index.php?page=12&c=41&id='.$lignes['id_atelier'].'">Gérer</a></td>
            <td><a href="index.php?page=12&c=51&id='.$lignes['id_atelier'].'">Gérer</a></td>
            '.$affichage.'
            <td><a href="index.php?page=12&c=1&id='.$lignes['id_atelier'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
            <td><a href="index.php?page=12&c=2&sup='.$lignes['id_atelier'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ? Attention cette suppression effacera aussi les inscriptions.\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
        </tr>
        ';
    }
    return $table;
}
function req_atelier_update($bdd,$nom_atelier,$nombre_participant_max,$prix_atelier,$duree_atelier,$id_atelier) {
    $requete = "UPDATE `ateliers` SET `nom_atelier`=:nom_atelier,
                                      `nombre_participant_max`=:nombre_participant_max,
                                      `prix_atelier`=:prix_atelier,
                                      `duree_atelier`=:duree_atelier
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':nom_atelier', $nom_atelier, PDO::PARAM_STR);
    $req -> bindValue(':nombre_participant_max', $nombre_participant_max, PDO::PARAM_INT);
    $req -> bindValue(':prix_atelier', $prix_atelier, PDO::PARAM_STR);
    $req -> bindValue(':duree_atelier', $duree_atelier, PDO::PARAM_INT);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();
}
function req_atelier_insert($bdd,$nom_atelier,$nombre_participant_max,$prix_atelier,$duree_atelier) {
    $requete = "INSERT INTO `ateliers`(`id_atelier`, `nom_atelier`, `nombre_participant_max`, `prix_atelier`, `duree_atelier`, `afficher_atelier`) 
                VALUES (0,:nom_atelier,:nombre_participant_max,:prix_atelier,:duree_atelier,0)";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':nom_atelier', $nom_atelier, PDO::PARAM_STR);
    $req -> bindValue(':nombre_participant_max', $nombre_participant_max, PDO::PARAM_INT);
    $req -> bindValue(':prix_atelier', $prix_atelier, PDO::PARAM_STR);
    $req -> bindValue(':duree_atelier', $duree_atelier, PDO::PARAM_INT);
    $req -> execute();

    $requete = "SELECT id_atelier FROM ateliers 
                ORDER BY id_atelier DESC 
                LIMIT 1";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
//images
function req_sup_image_atelier($bdd,$id_img_atelier) {

    $requete = "DELETE FROM images_ateliers WHERE id_img_atelier = :id_img_atelier";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img_atelier', $id_img_atelier, PDO::PARAM_INT); 
    $req -> execute();

}
function req_images_atelier($bdd,$id_atelier) {
    $requete = "SELECT * FROM images_ateliers 
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $images = $req -> fetchAll();
    return $images;
}
function table_ateliers_gestion_img($images) {
    $table = '';
    foreach ($images as $lignes) {
        $table .= '
        <tr class="table-primary">
            <td scope="row"><img src="../public/assets/img/site/'.$lignes['nom_img_atelier'].'" class="mignature_table"></td>
            <td><a href="index.php?page=12&c=6&id='.$lignes['id_atelier'].'&img='.$lignes['id_img_atelier'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
            <td><a href="index.php?page=12&c=61&id='.$lignes['id_atelier'].'&sup='.$lignes['id_img_atelier'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
        </tr>
        ';
    }
    return $table;
}
function req_img_atelier($bdd,$id_img_atelier) {
    $id_img_atelier = intval($_GET['img']);
    $requete = "SELECT * FROM images_ateliers 
                WHERE id_img_atelier = :id_img_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_img_atelier', $id_img_atelier, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_img_update_atelier($bdd,$id_img,$nom_image) {
    $requete = "UPDATE `images_ateliers` SET nom_img_atelier = :nom_image 
                WHERE id_img_atelier = :id_img"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_img', $id_img, PDO::PARAM_INT); 
    $req->bindValue(':nom_image', $nom_image, PDO::PARAM_STR);  
    $req -> execute();     
}
function req_img_insert_atelier($bdd,$id_atelier,$nom_image) {
    $requete = "INSERT INTO `images_ateliers`(`id_img_atelier`, `nom_img_atelier`, `id_atelier`) 
                VALUES (0,:nom_image,:id_atelier)"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req->bindValue(':nom_image', $nom_image, PDO::PARAM_STR);  
    $req -> execute();
}
// horaires
function req_sup_horaire($bdd,$id_horaire) {
    $requete = "DELETE FROM horaires WHERE id_horaire = :id_horaire";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT); 
    $req -> execute();
}
function req_si_reservation($bdd,$id_horaire) {
    $requete = "SELECT * FROM inscriptions 
                WHERE id_horaire = :id_horaire";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT); 
    $req -> execute();

    $donnees = $req -> rowCount();
    if ($donnees != 0) {
        $test = 1;
    }
    else {
        $test = 0;
    }
    return $test;
}
function req_horaires_atelier($bdd,$id_atelier) {
    $requete = "SELECT * FROM horaires 
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $horaire = $req -> fetchAll();
    return $horaire;
}
function table_ateliers_gestion_horaire($bdd,$horaire) {
    $table = '';
    foreach ($horaire as $lignes) {
        $test = req_si_reservation($bdd,$lignes['id_horaire']);
        if ($test == 1) {
            // si il existe des inscriptions ne peut pas supprimer
            $liens = '';
            $message = 'alert(\'Cette horaire ne peut être supprimée. Des clients se sont inscrit à cette date.\')';
        }
        else {
            $liens = 'href="index.php?page=12&c=41&id='.$lignes['id_atelier'].'&sup='.$lignes['id_horaire'].'"';
            $message = 'return(confirm(\'Voulez vous supprimer cette entrée ?\'))';
        }
        $table .= '
        <tr class="table-primary">
            <td scope="row">'.date('d-m-Y à H:i',$lignes['date_atelier']).'</td>
            <td><a href="index.php?page=12&c=4&id='.$lignes['id_atelier'].'&h='.$lignes['id_horaire'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
            <td><a  '.$liens.' onclick="'.$message.'" ><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
        </tr>
        ';
    }
    return $table;
}
function req_horaire($bdd,$id_horaire) {
    $requete = "SELECT * FROM horaires 
                WHERE id_horaire = :id_horaire";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_update_horaire($bdd,$id_horaire,$date_atelier) {
    $requete = "UPDATE `horaires` SET `date_atelier`=:date_atelier 
                WHERE id_horaire = :id_horaire";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT);
    $req -> bindValue(':date_atelier', $date_atelier, PDO::PARAM_INT);
    $req -> execute();
}
function req_insert_horaire($bdd,$id_atelier,$date_atelier) {
    $requete = "INSERT INTO `horaires`(`id_horaire`, `date_atelier`, `nbr_participant`, `id_atelier`) 
                VALUES (0,:date_atelier,0,:id_atelier) ";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
        $req -> bindValue(':date_atelier', $date_atelier, PDO::PARAM_INT);
        $req -> execute();
}
// paragraphes
function req_sup_paragraphe($bdd,$id_descriptif) {
    $requete = "DELETE FROM descriptifs_ateliers WHERE id_descriptif = :id_descriptif";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_descriptif', $id_descriptif, PDO::PARAM_INT); 
    $req -> execute();
}
function req_paragraphes($bdd,$id_atelier) {
    $requete = "SELECT * FROM descriptifs_ateliers 
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $paragraphes = $req -> fetchAll();
    return $paragraphes;
}
function table_ateliers_gestion_paragraphes($paragraphes) {
    $table = '';
    foreach ($paragraphes as $lignes) {
        $table .= '
        <tr class="table-primary">
            <td scope="row">'.$lignes['titre_descriptif'].'</td>
            <td>'.substr($lignes['texte_descriptif'], 0,50).'...</td>
            <td id="'.$lignes['id_descriptif'].'">
                <input type="text" id="position'.$lignes['id_descriptif'].'" value="'.$lignes['position_descriptif'].'" class="input_dispo">
            </td>
            <td><a href="index.php?page=12&c=5&id='.$lignes['id_atelier'].'&d='.$lignes['id_descriptif'].'"><img src="public/assets/img/roue-dentee.png" class="icones_table modifier" alt=""></a></td>
            <td><a href="index.php?page=12&c=51&id='.$lignes['id_atelier'].'&sup='.$lignes['id_descriptif'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
        </tr>
        ';
    }
    return $table;
}
function req_paragraphe_atelier($bdd, $id_descriptif) {
    $requete = "SELECT * FROM descriptifs_ateliers  
                WHERE id_descriptif = :id_descriptif";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_descriptif', $id_descriptif, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_parag_update_atelier($bdd,$id_descriptif,$titre_descriptif,$texte_descriptif) {
    $requete = "UPDATE `descriptifs_ateliers` SET `titre_descriptif`=:titre_descriptif, 
                                                   texte_descriptif=:texte_descriptif 
                WHERE id_descriptif = :id_descriptif";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_descriptif', $id_descriptif, PDO::PARAM_INT);
    $req -> bindValue(':titre_descriptif', $titre_descriptif, PDO::PARAM_STR);
    $req -> bindValue(':texte_descriptif', $texte_descriptif, PDO::PARAM_STR);
    $req -> execute();
}
function res_parag_insert_atelier($bdd,$id_atelier,$titre_descriptif,$texte_descriptif) {
    // regarde si il existe deja un paragraphe et si oui cherche la position la plus grande
    $requete = "SELECT * FROM descriptifs_ateliers 
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $i = 0;
    while($donnees = $req->fetch()) {
        if ($donnees['position_descriptif'] > $i) { $i = $donnees['position_descriptif'];}
    }
    $position_descriptif = $i + 1;

    $requete = "INSERT INTO `descriptifs_ateliers`(`id_descriptif`, `titre_descriptif`, `texte_descriptif`, `position_descriptif`, `id_atelier`) 
                VALUES (0,:titre_descriptif,:texte_descriptif,$position_descriptif,:id_atelier) ";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> bindValue(':titre_descriptif', $titre_descriptif, PDO::PARAM_STR);
    $req -> bindValue(':texte_descriptif', $texte_descriptif, PDO::PARAM_STR);
    $req -> execute();
}
//inscriptions
function req_inscriptions($bdd,$id_atelier) {
    $requete = "SELECT * FROM inscriptions 
                INNER JOIN clients ON inscriptions.id_client = clients.id_client
                INNER JOIN horaires ON inscriptions.id_horaire = horaires.id_horaire
                WHERE inscriptions.id_atelier = :id_atelier
                ORDER BY horaires.date_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $inscriptions = $req -> fetchAll();
    return $inscriptions;
}
function req_stat_inscriptions($bdd,$id_atelier) {
    $requete = "SELECT * FROM horaires 
                INNER JOIN ateliers ON horaires.id_atelier = ateliers.id_atelier
                WHERE horaires.id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $horaires = $req -> fetchAll();
    return $horaires;
}
function table_ateliers_gestion_inscriptions($inscriptions) {
    $table = '';
    foreach ($inscriptions as $lignes) {
        $table .= '
        <tr class="table-primary">
            <td scope="row">'.$lignes['prenom_client'].' '.$lignes['nom_client'].'</td>
            <td>'.date('d-m-Y à H:i',$lignes['date_atelier']).'</td>
            <td>'.$lignes['nbr_inscrit'].'</td>
            <td><a href="mailto:'.$lignes['mail_client'].'"><img src="public/assets/img/feather-pen.png" alt="" class="icones_table modifier"></a></td>
            <td><a href="index.php?page=12&c=41&suph='.$lignes['id_horaire'].'&supc='.$lignes['id_client'].'&supa='.$lignes['id_atelier'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt="" ></a></td>
        </tr>
        ';
    }
    return $table;
}
//----------------------------------------------------------------------------------------------------
//                                  table pour partie administratif
//----------------------------------------------------------------------------------------------------

//-------------
// contact
//-------------
function req_delete_contact($bdd,$id_contact) {
    $requete = "DELETE FROM contacts WHERE id_contact = :id_contact";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_contact', $id_contact, PDO::PARAM_INT);
    $req -> execute();
}
function req_contacts($bdd,$ordre_req) {
    $requete = 'SELECT * FROM `contacts` 
                '.$ordre_req;
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_message($bdd,$id_contact) {
    // update le statu du message en lue
    $requete = "UPDATE `contacts` SET `lu_message`= 1 
                WHERE id_contact = :id_contact";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_contact', $id_contact, PDO::PARAM_INT);
    $req -> execute();

    // récupère le message pour affichage
    $requete = "SELECT * FROM `contacts` 
                WHERE id_contact = :id_contact";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_contact', $id_contact, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function table_contact_gestion($donnees) {
    if ($donnees['lu_message'] == 0) {
        $badge = '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        Nouveau
        <span class="visually-hidden">unread messages</span>
      </span>';
    }
    else {
        $badge ='';
    }

    $boite = '
    <tr class="table-primary" >
        <td scope="row" class="position-relative">'.date('d/m/Y à H:i',$donnees['date_message']).$badge.'</td>
        <td>'.$donnees['nom_contact'].'</td>
        <td>'.$donnees['mail_contact'].'</td>
        <td>'.$donnees['tel_contact'].'</td>
        <td>'.$donnees['entreprise_contact'].'</td>
        <td>'.$donnees['categorie_contact'].'</td>
        <td><a href="index.php?page=8&c=1&id='.$donnees['id_contact'].'"><img src="public/assets/img/letter.png" class="icones_table modifier" alt=""></a></td>
        <td><a href="mailto:'.$donnees['mail_contact'].'" name="'.$donnees['id_contact'].'" value="'.$donnees['repondu_message'].'" class="btn_aff"><img src="public/assets/img/feather-pen.png" alt="" class="icones_table modifier"></a></td>';
    if ($donnees['lu_message'] == 1) {
        $boite .= '<td><img src="public/assets/img/verifier.png" alt="" class="icones_table afficher"></td>';
    }
    else {
        $boite .= '<td><img src="public/assets/img/verifier.png" alt="" class="icones_table "></td>';
    }
    if ($donnees['repondu_message'] == 1) {
        $boite .= '<td id='.$donnees['id_contact'].'><img src="public/assets/img/verifier.png" alt="" class="icones_table afficher"></td>';
    }
    else {
        $boite .= '<td id='.$donnees['id_contact'].'><img src="public/assets/img/verifier.png" alt="" class="icones_table "></td>';
    }
    $boite .= '
        <td><a href="index.php?page=8&sup='.$donnees['id_contact'].'" onclick="return(confirm(\'Voulez vous supprimer cette entrée ?\'))"><img src="public/assets/img/poubelle.png" class="icones_table supprimer" alt=""></a></td>
    </tr>
    ';

    return $boite;
}
//----------
// clients
//----------
function req_clients($bdd,$ordre_req) {
    $requete = 'SELECT * FROM clients 
                '.$ordre_req;
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_adresse_livraison($bdd,$id_client) {
    $requete2 = "SELECT * FROM adresses
                WHERE id_client = :id_client AND livraison_client = 1";
    $req2 = $bdd->prepare($requete2);
    $req2->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req2 -> execute();
    
    $donnees2 = $req2 -> fetchAll();
    return $donnees2;
}
function req_adresse_facturation($bdd,$id_client) {
    $requete2 = "SELECT * FROM adresses
                WHERE id_client = :id_client AND facturation_client = 1";
    $req2 = $bdd->prepare($requete2);
    $req2->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req2 -> execute();
    
    $donnees3 = $req2 -> fetch();
    return $donnees3;
}
function table_clients_gestion($donnees, $donnees2, $donnees3) {
    if ($donnees['id_cat_client'] == 2) { // pour ne pas afficher l'admin

        // adresse livraison
        if(isset($donnees2) && $donnees2 != NULL) {
            $i = 1;
            $livraison = '<td>';
            foreach ($donnees2 as $ligne) {
                $livraison .= 'adresse '.$i.' :
                '.$ligne['rue_client'].'<br>'.$ligne['code_p_client'].' '.$ligne['ville_client'].'<br>'.$ligne['pays_client'].'<br>'.$ligne['complement_adresse_client'];
                $i++;
            }
            $livraison .= '</td>';
        }
        else {
            $livraison = '<td></td>';
        }
        // adresse facturation
        if(isset($donnees3) && $donnees3 != NULL) {
            $f_rue_client =$donnees3['rue_client'];
            $f_code_p_client =$donnees3['code_p_client'];
            $f_ville_client =$donnees3['ville_client'];
            $f_pays_client =$donnees3['pays_client'];
            $f_cplm_a_client =$donnees3['complement_adresse_client'];
            }
            else {
                $f_rue_client = '';
                $f_code_p_client = '';
                $f_ville_client = '';
                $f_pays_client = '';
                $f_cplm_a_client = '';
            }
        $boite = '
        <tr class="table-primary" id="'.$donnees['id_client'].'">
            <td scope="row">'.$donnees['identifiant_client'].'</td>
            <td>'.date('d/m/Y à H:i',$donnees['identifiant_client']).'</td>
            <td>'.$donnees['nom_client'].'</td>
            <td>'.$donnees['prenom_client'].'</td>
            <td>'.$donnees['mail_client'].'</td>
            <td>'.$donnees['tel_client'].'</td>
            '.$livraison.'
            <td>'.$f_rue_client.'<br>'.$f_code_p_client.' '.$f_ville_client.'<br>'.$f_pays_client.'<br>'.$f_cplm_a_client.'</td>
    
            <td><a href="index.php?page=9&id='.$donnees['id_client'].'">voir</a></td>
            
            <td><a href="index.php?page=10&id='.$donnees['id_client'].'">voir</a></td>
            
        </tr>
        ';
        return $boite;
    }

}
//---------
// panier
//---------
function req_commandes($bdd,$where_req,$ordre_req,$id_client) {
    $requete = 'SELECT id_commande FROM paniers 
                '.$where_req.'
                GROUP BY id_commande 
                '.$ordre_req;
    $req = $bdd-> prepare($requete);
    if ($where_req != '') {
    $req ->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    }
    $req -> execute();

    $commandes = $req-> fetchAll();
    return $commandes;
}
function req_panier_ligne($bdd,$id_commande) {
    $requete = "SELECT * FROM paniers 
                INNER JOIN produits ON paniers.id_produit = produits.id_produit
                WHERE paniers.id_commande = :id_commande";
    $req = $bdd-> prepare($requete);
    $req ->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $commande = $req -> fetchAll();
    return $commande;
}
function req_panier_nom($bdd,$ligne) {
    $requete = "SELECT * FROM clients 
                INNER JOIN adresses ON clients.id_client = adresses.id_client
                WHERE clients.id_client = :id_client AND adresses.livraison_client = 1";
    $req = $bdd-> prepare($requete);
    $req ->bindValue(':id_client', $ligne['id_client'], PDO::PARAM_INT);
    $req -> execute();
    $nom = $req -> fetch();
    return $nom;
}
function table_panier_gestion($bdd,$commandes) {
    $table = '';
    foreach ($commandes as $lignes) {
        // toutes les lignes paniers d'une id_commande precise
        $commande = req_panier_ligne($bdd,$lignes['id_commande']);

        $panier = $lignes['id_commande'];
        $date = date('d/m/Y', $panier);
        $nbr_produit = count($commande);
        $prix = 0;
        foreach ($commande as $ligne){
            $prix += $ligne['quantite_produit']*$ligne['prix_unitaire_produit'];
        }

        // récupère les infos sur le clients
        if ($ligne['id_client'] != '') {
            $nom = req_panier_nom($bdd,$ligne);
            $nom_client = '<a href="index.php?page=7#'.$ligne['id_client'].'">'.$nom['prenom_client'].' '.$nom['nom_client'].'</a>';
        }
        else {
            $nom_client = 'visiteur';
        }

        $table .= '
        <tr class="table-primary">
            <td>'.$panier.'</td>
            <td>'.$date.'</td>
            <td>'.$nbr_produit.'</td>
            <td>'.number_format($prix,2,",", " ").'</td>
            <td>'.$nom_client.'</td>
            <td><a href="index.php?page=91&pan='.$panier.'">Voir</a></td>
        </tr>
        ';
        
    }
    return $table;
}
function req_purge_panier_sans_client($bdd) {
    // supprimer les paniers sans clients vieux de plus de 48 heures
    $date = time() - 48*3600;
    $requete = "DELETE FROM paniers WHERE id_commande < $date AND id_client IS NULL";
    $req = $bdd -> prepare($requete);
    $req -> execute();
}
function req_relance($bdd) {
    // relance de paniers clients de plus de 48 heures
    $date = time() - 48*3600;
    $requete = "SELECT * FROM paniers
                WHERE id_commande < $date AND id_client IS NOT NULL";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $clients = $req -> fetchAll();
    return $clients;
}
//----------------------------------------------------------------
//                         commande
//----------------------------------------------------------------
function req_commandes_effectuee($bdd,$id_client,$req_where,$req_ordre) {
    $requete = 'SELECT * FROM referances_commandes
            INNER JOIN etats_commandes ON referances_commandes.id_etat_commande = etats_commandes.id_etat_commande
            INNER JOIN clients ON referances_commandes.id_client = clients.id_client
            '.$req_where
            .$req_ordre;
    $req = $bdd -> prepare($requete);
    if ($req_where != '') {
        $req -> bindValue(':id_client', $id_client, PDO::PARAM_INT);
    }
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_produits_commande($bdd,$id_commande) {
    $requete = "SELECT * FROM commandes
                INNER JOIN produits ON commandes.id_produit = produits.id_produit
                WHERE commandes.id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $nbr = $req ->  rowCount();
    $donnees = $req -> fetchAll();

    $sortie = [$nbr,$donnees];
    return $sortie;
}
function req_statut_livrer($bdd) {
    $requete = "SELECT * FROM etats_livraisons";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
function table_commandes($bdd,$donnees) {
    $table = '';
    foreach ($donnees as $ligne) {
        $contenu = req_produits_commande($bdd,$ligne['id_commande']);
        $recapitulatif = req_date_commande($bdd,$ligne['id_commande']);
        $nbr = $contenu[0];
        $livraison = req_statut_livrer($bdd);
    
        $table .= '
        <tr class="table-primary" >
            <td scope="row"><a href="index.php?page=7#'.$ligne['id_client'].'" >'.$ligne['prenom_client'].' '.$ligne['nom_client'].'</a></td>
            <td>'.$ligne['id_commande'].'</td>
            <td>'.date('d-m-Y à H:i', $ligne['date_commande']).'</td>
            <td>'.$nbr.'</td>';
        if ($recapitulatif['id_livraison'] == 3) {
            $table .= '
                <td><a href="index.php?page=91&fac='.$ligne['id_commande'].'">Voir facture</a></td>';
        }
        else {
            $table .= '
                <td><a href="index.php?page=91&com='.$ligne['id_commande'].'">Voir commande</a></td>';
        }
        $table .= '
            <td>'.$ligne['montant_commande'].'</td>
            ';
        if ($ligne['id_etat_commande'] == 2) {
            $table .= '
            <td class="bg-danger text-white">'.$ligne['nom_etat_commande'].'</td>
            <td>---</td>';
        }
        else {
            $table.= '
            <td class="bg-info">'.$ligne['nom_etat_commande'].'</td>
            <td>
                <select class="form-select select_livrer" name="" id="'.$ligne['id_commande'].'"
                ';
            if ($ligne['id_livraison'] == 3) {
                $table .= 'disabled';
            }
            $table .= '>';
            foreach ($livraison as $key) {
                if ($key['id_livraison'] == $ligne['id_livraison']) {
    
                    $table .= '<option value="'.$key['id_livraison'].'"selected>'.$key['nom_etat_livraison'].'</option>';
                }
                else {
                    $table .= '<option value="'.$key['id_livraison'].'">'.$key['nom_etat_livraison'].'</option>';
    
                }
            }
            $table .= '
                </select>
            </td>';
        }
        $table .= '
        </tr>
        ';
    }
    return $table;
}

function table_detail_panier($bdd,$produits) {
    $table = '';
    $prix_tot = 0;
    $poids_tot = 0;
    foreach ($produits as $ligne) {
        $client = req_panier_nom($bdd,$ligne);
        $prix_tot += $ligne['quantite_produit']*$ligne['prix_unitaire_produit'];
        $poids_tot += $ligne['quantite_produit']*$ligne['poids_produit'];
        $table .= '
        <tr class="table-primary" >
            <td scope="row">'.$ligne['nom_produit'].'</td>
            <td>'.$ligne['quantite_produit'].'</td>
            <td>'.$ligne['prix_unitaire_produit'].'</td>
            <td>'.($ligne['quantite_produit']*$ligne['prix_unitaire_produit']).'</td>
        </tr>
        ';
    }
    $sortie = [$client,$table,$prix_tot,$poids_tot];
    return $sortie;
}

function req_date_commande($bdd,$id_commande) {
    $requete = "SELECT * FROM referances_commandes WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $date = $req -> fetch();
    return $date;
}

function req_facture($bdd,$id_commande) {
    $requete = "SELECT * FROM facture WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $facture = $req -> fetch();
    return $facture;
}

function req_livraison($bdd,$id_commande) {
    // adresse de livraison d'une commande precise. 
    $requete = "SELECT * FROM referances_commandes
                INNER JOIN adresses ON referances_commandes.id_adresse = adresses.id_adresse
                WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetch();

    return $donnees;
}
?>