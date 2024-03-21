<?php
//---------------------------------------------
//               Les fonctions 
//---------------------------------------------

//---------------------------------------------------------
// gestion couleur site si utilise les couleurs du logo
//---------------------------------------------------------
// couleur aléatoire 
function couleurAleatoire() {
    $couleurs = array("rose", "rosepoudre","rouge", "rouge50");
    // $couleurs = array("rose","rosepoudre","mauve","rouge","orange","jaune","bleu","bleuciel","vert");
    $couleur = array_rand(array_flip($couleurs), 1);
    return $couleur;
     
}
// couleur aléatoire pour le carré coloré dans chaque section pour les services
function couleurBgAleatoire() {
    $couleur = couleurAleatoire();
    return 'background-color: var(--'.$couleur.');';
     
}
// couleur aléatoire pour l'arrière plan du titre des pages sous cat et catalogue
function bandeauTitreCat() {
    $couleur = couleurAleatoire();
    $titre_couleur = 'background-color: var(--'.$couleur.');';
    if ($couleur == 'rose' || $couleur == 'rouge' || $couleur == 'vert' || $couleur == 'bleu') {
        $titre_couleur .= "color: var(--blanc);";
    }
    return $titre_couleur;
}


// -------------------------------------------------------------------------
//                         gestion images
// -------------------------------------------------------------------------
// si il n'existe pas d'image remplacer par le logo du site
function image_par_default($chemin, $nom_img) {
    if ($nom_img == '' ) {
        $chemin_img = 'public/assets/img/logo/logo_v4.png';
    }
    else {
        $chemin_img = $chemin.$nom_img;
    }
    
    return $chemin_img;
}
// récupère nom de l'image pour card
function trouve_nom_image($bdd,$id_produit) {

    $requete = "SELECT nom_image FROM images_produits 
                WHERE id_produit = $id_produit AND afficher_image = 1
                ORDER BY position_image 
                LIMIT 1";
    $req2 = $bdd->prepare($requete);
    $req2 -> execute();

    $donnees2 = $req2 -> fetch();
    if ($donnees2 != '') {
        $nom_image = $donnees2['nom_image'];
    }
    else {
        $nom_image = '';
    }
    return $nom_image;
}
// -------------------------------------------------------------------------
//                               produits
// -------------------------------------------------------------------------
// Card pour les produits partout dans le site
function card($nom, $prix, $nom_img, $reference, $c, $sc) {
    include('modele/connexion_bdd.php');
    $boite = '
    <div class="col-lg-3 col-md-6 col-12 position-relative my-3 card border-0 ">
        <div class="position-relative ">
            <a href="index.php?page=3&id='.$reference.'&c='.$c.'&sc='.$sc.'">
                <img src="'.image_par_default('public/assets/img/produits/', $nom_img).'" alt="" class="card-img-top ">
            </a>';
    if (isset($_SESSION['id_client'])) {
        // btn ajout fav ssi connecté
        $image = recherche_si_fav($bdd,$reference);
        $boite .= '
            <button type="button" class="btn btn-link position-absolute bottom-0 end-0 card_produit" id="'.$reference.'" value="'.$_SESSION['id_client'].'" >
                <img src="public/assets/img/icones/'.$image.'" alt="" class=" img-fluid icones btn_jaime">
            </button>';
    }
    $boite .= '
        </div>
        <div class=" card-body">
            <h2 class="card-title">'.$nom.'</h2> 
        </div>
        <div class="card-footer row mx-0 border-top-0">
            <p class="col-8">'.$prix.' €/m</p>
            <p class="col-4">
                <a href="index.php?page=3&id='.$reference.'&c='.$c.'&sc='.$sc.'" class="btn btn-primary ">Aperçu</a>
            </p>
        </div>
    </div>
    ';
    return $boite;
}
// choix de l’icône coeur en fonction de si produit dans fav ou non du client co?
function recherche_si_fav($bdd,$id_produit) {
    $image = 'coeur2.png';
    if (isset($_SESSION['id_client'])) {

        $identifiant_client = intval($_SESSION['id_client']);
        // récupère le client
        $id_client = req_clients_identifiant($bdd,$identifiant_client);

        // vérifie si deja dans favoris
        $requete = "SELECT * FROM favoris 
                    WHERE id_produit = :id_produit AND id_client = :id_client";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_client', $id_client['id_client'], PDO::PARAM_INT);
        $req -> bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
        $req -> execute();

        $si_fav = $req -> rowCount();
        if ($si_fav == 0) {
            $image = 'coeur2.png';
        }
        else {
            $image = 'coeur1.png';
        }
    }
    return $image;
}
// avis clients
function avisClient($note, $date, $titre_avis, $texte_avis, $nom_client) {
    $avis = '
    <div class="col-lg-3 col-md-5 avis m-md-3 p-3">
                    <div class="d-flex justify-content-between">
                        <div>';
    for ($i = 0; $i < $note; $i++) {
        $avis .= '<i class="fa-solid fa-star" style="color: var(--jaune);"></i>';
    }
    for ($i = $note; $i < 5; $i++) {
        $avis .= '<i class="fa-regular fa-star" style="color: var(--jaune);"></i>';
    }
    $avis .=            '</div>
                        <p class="d-inline">'.$date.'</p>
                    </div>

                    <h5>'.$titre_avis.'</h5>
                    <p>'.$texte_avis.'</p>
                    <p>'.$nom_client.'</p>
                </div>
    ';
    return $avis;
}
// récupération produit
function req_produit($bdd,$id_produit) {
    $requete = "SELECT * FROM produits 
                INNER JOIN couleurs ON produits.id_couleur = couleurs.id_couleur
                INNER JOIN usages ON produits.id_usage = usages.id_usage
                WHERE produits.id_produit = :id_produit "; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req->fetch();
    return $donnees;
}
function req_img_produit($bdd,$id_produit) {
    $requete = "SELECT * FROM  images_produits 
                WHERE id_produit = :id_produit 
                ORDER BY position_image
                "; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req -> execute();
    $images = $req-> fetchAll();
    $nbr = $req -> rowCount();
    $donnees = [$images,$nbr];
    return $donnees;
}
// carousel des produits sur page produit
function carousel_indicators($i, $nom_img) {
    if ($i == 0) {
        $carousel_indicators = '
            <button type="button" data-bs-target="#carouselImage" data-bs-slide-to="'.$i.'" class="active" aria-current="true" aria-label="Slide '.($i+1).'"> 
                <img src="'.image_par_default('public/assets/img/produits/',$nom_img).'" alt="" class="img-fluid d-block border_indicator">
            </button>
        ';
    }
    else {
        $carousel_indicators = '
            <button type="button" data-bs-target="#carouselImage" data-bs-slide-to="'.$i.'" aria-label="Slide '.($i+1).'"> 
                <img src="'.image_par_default('public/assets/img/produits/',$nom_img).'" alt="" class="img-fluid d-block border_indicator">
            </button>
        ';
    }

    return $carousel_indicators;
}
function carousel_inner($i, $nom_img) {
    if ($i == 0) {
        $carousel_inner = '
        <div class="carousel-item active">
            <img src="'.image_par_default('public/assets/img/produits/',$nom_img).'" class="d-block w-100" alt="...">
        </div>
    ';
    }
    else {
        $carousel_inner = '
            <div class="carousel-item">
                <img src="'.image_par_default('public/assets/img/produits/',$nom_img).'" class="d-block w-100 " alt="...">
            </div>
        ';
    }

    return $carousel_inner;
}
// suggestions produits
function req_suggestion($bdd, $sc) {
    $requete = "SELECT * FROM produits 
                INNER JOIN images_produits ON produits.id_produit = images_produits.id_produit
                WHERE produits.id_sous_cat = :id_sous_cat  AND produits.afficher_produit = 1
                GROUP BY produits.id_produit
                LIMIT 4"; 
    $req2 = $bdd->prepare($requete);
    $req2->bindValue(':id_sous_cat', $sc, PDO::PARAM_INT);
    $req2 -> execute();

    $donnees = $req2 -> fetchAll();
    return $donnees;
}
// -------------------------------------------------------------------------
//                    categories et sous categories 
// -------------------------------------------------------------------------
// Card pour les sous catégories
function card_sous_cat($c,$sc,$t_sous_cat,$nom_img) {
    $boite = '
    <div class="card col-lg-3 col-md-5 text-center m-3 p-0">
        <a href="index.php?page=2&c='.$c.'&sc='.$sc.'">
            <div class="card-header">
                '.$t_sous_cat.'
            </div>
            <div class="card-body">
                <img src="'.image_par_default('public/assets/img/site/',$nom_img).'" alt="" class="img-fluid">
            </div>
        </a>
    </div>
    ';
    return $boite;
}
// fils d’Ariane / breadcrumb et titre de la page du catalogue de produit
function filsAriane($categorie, $sous_cat, $c) {
    if ($categorie == '' && $sous_cat == '') {
        $ariane = '<li class="breadcrumb-item active" aria-current="page">Tout nos produit</li>';
    }
    elseif ($categorie != '' && $sous_cat == '') {
        $ariane = '
            
            <li class="breadcrumb-item active" aria-current="page">'.$categorie.'</li>
            ';
    }
    else {
        $ariane = '
            
            <li class="breadcrumb-item"><a href="index.php?page=20&c='.$c.'">'.$categorie.'</a></li>
            <li class="breadcrumb-item active" aria-current="page">'.$sous_cat.'</li>
            ';
    }

    return $ariane;
}

// titre des pages du catalogues de produit
function titreCatalogue($categorie, $sous_cat) {
    if ($categorie == '' && $sous_cat == '') {
        $titre = 'Tous nos produits';
    }
    elseif ($categorie != '' && $sous_cat == '') {
        $titre = $categorie;
    }
    else {
        $titre = $sous_cat;
    }

    return $titre;
}
// récupération de la  catégorie pour le catalogue
function req_categories($bdd,$c) {
    $requete = "SELECT * FROM categories 
                WHERE id_cat = :id_cat"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_cat', $c, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetch();
    return $donnees;
}
// récupération toutes les sous cats 
function req_toutes_sous_cats($bdd,$c) {
    $requete = "SELECT * FROM sous_categories 
                INNER JOIN images_site ON sous_categories.id_img_site = images_site.id_img_site
                WHERE sous_categories.id_cat = :id_cat AND sous_categories.afficher_sous_categorie = 1"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_cat', $c, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
// récupération de la sous catégorie pour le catalogue
function req_sous_categories($bdd,$sc) {
    $requete = "SELECT * FROM sous_categories 
                WHERE id_sous_cat = :id_sous_cat"; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_sous_cat', $sc, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req->fetch();
    return $donnees;
}
// Card pour les catégories page d'accueil
function card_cat($categorie, $id, $nom_img) {
    $boite = '
    <div class="card col-12 col-md-5 col-lg-3 m-3 p-0 text-center">
        <div class="card-header ">
            '.$categorie.'
        </div>
        <div class="card-body position-relative">
            <a href="index.php?page=20&c='.$id.'" >
                <h4 class="card-title position-absolute top-50 w-100 text-center card-cat h3">Découvrir</h4>
                <img src="'.image_par_default('public/assets/img/site/',$nom_img).'" class="img-fluid rounded-top " alt="" >
            </a>
        </div>
    
    </div>
    ';
    return $boite;
}
// recuperation de l'id du client à partie de l'identifiant stocké dans  la session id_client
function req_id_client($bdd) {
    $donnees = '';
    if (isset($_SESSION['id_client'])) {
        $requete = "SELECT * FROM clients 
                    WHERE identifiant_client = :identifiant_client";
        $req = $bdd->prepare($requete);
        $req->bindValue(':identifiant_client', $_SESSION['id_client'], PDO::PARAM_INT);
        $req -> execute();
        $donnees = $req -> fetch();
    }
    return $donnees;
}
// nombre entrées affichée
function req_nbr_entre_catalogue($bdd,$sc,$fav,$req_inner,$req_where) {
    $donnees = req_id_client($bdd);
    $requete = 'SELECT * FROM produits 
                '.$req_inner.'
                '.$req_where.'
                AND produits.afficher_produit = 1
                ';
    $reqP = $bdd->prepare($requete);
    if ($sc != '') {
        $reqP->bindValue(':id_sous_cat', $sc, PDO::PARAM_INT);
    }
    if ($fav == 1) {
        $id_client = $donnees['id_client'];
        $reqP->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    }
    $reqP -> execute();
    $nbr_entree = $reqP -> rowCount();
    return $nbr_entree;
}
// creation recherche par couleur
function req_colors($bdd) {
    $requete = "SELECT * FROM couleurs";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
//création recherche par usage
function req_usages($bdd) {
    $requete = "SELECT * FROM usages";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
//récupération des produits pour le catalogues
function req_catalogue($bdd,$sc,$fav,$offset,$req_inner,$req_where,$req_order,$requete_usage,$requete_couleur,$requete_budget,$nbr_entree_page,$id_client) {
    $requete = 'SELECT * FROM produits 
                '.$req_inner.'
                INNER JOIN sous_categories ON produits.id_sous_cat = sous_categories.id_sous_cat
                '.$req_where.'
                 AND produits.afficher_produit = 1'
                .$requete_usage
                .$requete_couleur
                .$requete_budget.'
                GROUP BY produits.id_produit
                '.$req_order.'
                LIMIT '.$offset.', '.$nbr_entree_page.'
                '; 
    $req = $bdd->prepare($requete);
    if ($sc != '') {
        $req->bindValue(':id_sous_cat', $sc, PDO::PARAM_INT);
    }
    if ($fav == 1) {
        $req->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    }
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
// -------------------------------------------------------------------------
//                    pour connexion et inscription
// -------------------------------------------------------------------------
function update_panier_si_existe($bdd,$id_client) {
    
    $requete = "SELECT COUNT(id_commande) AS test FROM paniers 
                WHERE id_commande = :id_commande";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_commande', $_SESSION['id_commande'], PDO::PARAM_INT);
    $req -> execute();  
    $test_panier = $req -> fetch();

    if ($test_panier['test'] > 0) {
        $requete = "UPDATE `paniers` SET `id_client`= :id_client 
                    WHERE id_commande = :id_commande";
        $req = $bdd->prepare($requete);
        $req->bindValue(':id_client', $id_client['id_client'], PDO::PARAM_INT); 
        $req->bindValue(':id_commande', $_SESSION['id_commande'], PDO::PARAM_INT);
        $req -> execute(); 
    }
}
// mail pour co
function req_mail($bdd,$username) {
    $requete = "SELECT * FROM clients 
                WHERE mail_client = :username";  // version mail
    // $requete = "SELECT * FROM clients WHERE username_client = :username"; // version identifiant
    $req = $bdd->prepare($requete);
    $req -> bindValue(':username', $username, PDO::PARAM_STR);
    $req -> execute();

    $user = $req -> fetch();
    $compte = $req -> rowCount(); 
    $donnees = [$user,$compte];
    return $donnees;
}
// récupération données clients
function req_clients($bdd, $id_client) {
    $requete = "SELECT * FROM clients 
                WHERE id_client = :id_client"; // version id
    $req = $bdd -> prepare($requete);
    $req -> bindValue('id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();

    $client = $req -> fetch();
    return $client;
}
function req_clients_identifiant($bdd,$identifiant) {
    $requete = "SELECT * FROM clients 
                WHERE identifiant_client = :identifiant"; // version id
    $req = $bdd -> prepare($requete);
    $req -> bindValue('identifiant', $identifiant, PDO::PARAM_INT);
    $req -> execute();

    $client = $req -> fetch();
    return $client;
}
function req_adresses($bdd,$id_client,$test) {
    if ($test == 1) {
        //  adresse de livraison
        $requete = "SELECT * FROM adresses 
                    WHERE id_client = :id_client AND livraison_client = 1";
    }
    elseif ($test == 2) {
        // adresse facturation
        $requete = "SELECT * FROM adresses 
                    WHERE id_client = :id_client AND facturation_client = 1";
    }
    $req = $bdd -> prepare($requete);
    $req -> bindValue('id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_adresse($bdd,$id_adresse) {
    $requete = "SELECT * FROM adresses
                WHERE id_adresse = :id_adresse";
    $req = $bdd -> prepare($requete);
    $req -> bindValue('id_adresse', $id_adresse, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
// inscription client
function req_inscription_client($bdd,$identifiant_client,$username_client,$nom_client,$prenom_client,$mail_client,$tel_client,$mdp_hash,$rue_client,$code_p_client,$ville_client,$pays_client,$complement_adresse_client) {
    $requete = "INSERT INTO `clients`(`id_client`, `identifiant_client`, `username_client`, `nom_client`, `prenom_client`, `mail_client`, `tel_client`, `mdp_client`) 
                VALUES (0,:identifiant_client,:username_client,:nom_client,:prenom_client,:mail_client,:tel_client,:mdp_client)";
$req = $bdd->prepare($requete);
$req->bindValue(':identifiant_client', $identifiant_client, PDO::PARAM_INT); 
$req->bindValue(':username_client', $username_client, PDO::PARAM_STR); 
$req->bindValue(':nom_client', $nom_client, PDO::PARAM_STR); 
$req->bindValue(':prenom_client', $prenom_client, PDO::PARAM_STR); 
$req->bindValue(':mail_client', $mail_client, PDO::PARAM_STR); 
$req->bindValue(':tel_client', $tel_client, PDO::PARAM_STR); 
$req->bindValue(':mdp_client', $mdp_hash, PDO::PARAM_STR); 
$req -> execute();

$requete = "SELECT id_client FROM clients 
            ORDER BY id_client DESC 
            LIMIT 1";
$req = $bdd->prepare($requete);
$req -> execute();
$id_client = $req -> fetch();

// livraison
$requete = "INSERT INTO `adresses`(`id_adresse`, `rue_client`, `code_p_client`, `ville_client`, `pays_client`, `livraison_client`, `facturation_client`, `complement_adresse_client`, `id_client`) 
            VALUES (0,:rue_client,:code_p_client,:ville_client,:pays_client,1,0,:complement_adresse_client,:id_client)";
$req = $bdd->prepare($requete);
$req->bindValue(':rue_client', $rue_client, PDO::PARAM_STR); 
$req->bindValue(':code_p_client', $code_p_client, PDO::PARAM_STR); 
$req->bindValue(':ville_client', $ville_client, PDO::PARAM_STR); 
$req->bindValue(':pays_client', $pays_client, PDO::PARAM_STR); 
$req->bindValue(':complement_adresse_client', $complement_adresse_client, PDO::PARAM_STR); 
$req->bindValue(':id_client', $id_client['id_client'], PDO::PARAM_INT); 
$req -> execute();        
//facturation
$requete = "INSERT INTO `adresses`(`id_adresse`, `rue_client`, `code_p_client`, `ville_client`, `pays_client`, `livraison_client`, `facturation_client`, `complement_adresse_client`, `id_client`) 
            VALUES (0,:rue_client,:code_p_client,:ville_client,:pays_client,0,1,:complement_adresse_client,:id_client)";
$req = $bdd->prepare($requete);
$req->bindValue(':rue_client', $rue_client, PDO::PARAM_STR); 
$req->bindValue(':code_p_client', $code_p_client, PDO::PARAM_STR); 
$req->bindValue(':ville_client', $ville_client, PDO::PARAM_STR); 
$req->bindValue(':pays_client', $pays_client, PDO::PARAM_STR); 
$req->bindValue(':complement_adresse_client', $complement_adresse_client, PDO::PARAM_STR); 
$req->bindValue(':id_client', $id_client['id_client'], PDO::PARAM_INT); 
$req -> execute(); 

return $id_client['id_client'];
}
// mise à jour du client
function req_maj_client($bdd,$username_client,$nom_client,$prenom_client,$mail_client,$tel_client,$id_client,$test,$rue_client,$code_p_client,$ville_client,$pays_client,$complement_adresse_client) {
    $requete = "UPDATE `clients` SET `username_client`= :username_client,
                                     `nom_client`= :nom_client,
                                     `prenom_client`= :prenom_client,
                                     `mail_client`= :mail_client,
                                     `tel_client`= :tel_client
                WHERE id_client = :id_client
                ";
    $req = $bdd->prepare($requete);
    $req -> bindValue(':username_client', $username_client, PDO::PARAM_STR); 
    $req -> bindValue(':nom_client', $nom_client, PDO::PARAM_STR); 
    $req -> bindValue(':prenom_client', $prenom_client, PDO::PARAM_STR); 
    $req -> bindValue(':mail_client', $mail_client, PDO::PARAM_STR); 
    $req -> bindValue(':tel_client', $tel_client, PDO::PARAM_STR); 
    $req -> bindValue('id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();

    if ($test != 0) { // adresse livraison et facturation update

        $requete = "UPDATE `adresses` SET `rue_client`= :rue_client,
                                      `code_p_client`= :code_p_client,
                                      `ville_client`= :ville_client,
                                      `pays_client`= :pays_client,
                                      `complement_adresse_client`= :complement_adresse_client 
                WHERE id_adresse = :id_adresse";
        $req = $bdd->prepare($requete);
        $req -> bindValue('rue_client', $rue_client, PDO::PARAM_STR);
        $req -> bindValue('code_p_client', $code_p_client, PDO::PARAM_STR);
        $req -> bindValue('ville_client', $ville_client, PDO::PARAM_STR);
        $req -> bindValue('pays_client', $pays_client, PDO::PARAM_STR);
        $req -> bindValue('complement_adresse_client', $complement_adresse_client, PDO::PARAM_STR);
        $req -> bindValue('id_adresse', $test, PDO::PARAM_INT);
        $req -> execute();
    }
    else { // ajout d'une adresse de livraison
        $requete = "INSERT INTO `adresses`(`id_adresse`, `rue_client`, `code_p_client`, `ville_client`, `pays_client`, `livraison_client`, `facturation_client`, `complement_adresse_client`, `id_client`) 
        VALUES (0,:rue_client,:code_p_client,:ville_client,:pays_client,1,0,:complement_adresse_client,:id_client)";
        $req = $bdd->prepare($requete);
        $req -> bindValue('rue_client', $rue_client, PDO::PARAM_STR);
        $req -> bindValue('code_p_client', $code_p_client, PDO::PARAM_STR);
        $req -> bindValue('ville_client', $ville_client, PDO::PARAM_STR);
        $req -> bindValue('pays_client', $pays_client, PDO::PARAM_STR);
        $req -> bindValue('complement_adresse_client', $complement_adresse_client, PDO::PARAM_STR);
        $req -> bindValue('id_client', $id_client, PDO::PARAM_INT);
        $req -> execute();
    }
}
// demande mdp oublier
function req_token($bdd, $expiration_date, $token_hash,$mail) {
    $requete = "UPDATE `clients` SET `token`=:token_hash,
                                     `expiration_date`=:expiration_date 
                WHERE mail_client = :mail AND id_cat_client = 2";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':expiration_date', $expiration_date, PDO::PARAM_INT);
    $req -> bindValue(':token_hash', $token_hash, PDO::PARAM_STR);
    $req -> bindValue(':mail', $mail, PDO::PARAM_STR);
    $req -> execute();

    $nbr = $req -> rowCount();
    return $nbr;
}
function req_cherche_token($bdd) {
    $requete = "SELECT * FROM clients 
                WHERE token != 'NULL'";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    
    $liste_token = $req -> fetchAll();
    return $liste_token;
}
function req_update_mdp($bdd,$id_user,$mdp_hash) {
    $requete = "UPDATE clients SET `mdp_client`=:mdp_hash, 
                                   `token`= NULL,
                                   `expiration_date`= NULL
                WHERE  id_client = $id_user";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':mdp_hash', $mdp_hash, PDO::PARAM_STR);
    $req -> execute();
}
// -------------------------------------------------------------------------
//                              Accueil
// -------------------------------------------------------------------------
// récupération du carousel
function req_carousel($bdd) {
    $requete = "SELECT * FROM carousel_slides
                INNER JOIN images_site ON carousel_slides.id_img_site = images_site.id_img_site
                INNER JOIN sous_categories ON carousel_slides.id_sous_cat = sous_categories.id_sous_cat
                WHERE carousel_slides.afficher_slide = 1
    ";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    
    $donnees = $req -> fetchAll();
    return $donnees;
}
// affichage du carousel
function carousel_indicators_accueil($i) {
    if ($i == 0) {
        $carousel_indicators = '
        <button type="button" data-bs-target="#carouselAccueil" data-bs-slide-to="'.$i.'" class="active" aria-current="true" aria-label="Slide '.($i+1).'"></button>
        ';
    }
    else {
        $carousel_indicators = '
        <button type="button" data-bs-target="#carouselAccueil" data-bs-slide-to="'.$i.'" aria-label="Slide '.($i+1).'"></button>
        ';
    }
    return $carousel_indicators;
}
function carousel_inner_accueil($slide,$i) {
    if ($i == 0) {
        $carousel_inner = '
        <div class="carousel-item active " data-bs-interval="10000">
            <div class="d-block w-100 text-center">
                <img src="public/assets/img/site/'.$slide['nom_img_site'].'" class="img-fluid" alt="...">
            </div>
            <div class="carousel-caption d-none d-md-block">
                <h1>'.$slide['titre_slide'].'</h1>
                <p>'.$slide['texte_slide'].'</p>
                <a class="btn btn-primary" href="index.php?page=2&c='.$slide['id_cat'].'&sc='.$slide['id_sous_cat'].'" role="button">Découvrir</a>
            </div>
        </div>
        ';
    }
    else {
        $carousel_inner = '
        <div class="carousel-item " data-bs-interval="10000">
            <div class="d-block w-100 text-center">
                <img src="public/assets/img/site/'.$slide['nom_img_site'].'" class="img-fluid" alt="...">
            </div>
            <div class="carousel-caption d-none d-md-block">
                <h1>'.$slide['titre_slide'].'</h1>
                <p>'.$slide['texte_slide'].'</p>
                <a class="btn btn-primary" href="index.php?page=2&c='.$slide['id_cat'].'&sc='.$slide['id_sous_cat'].'" role="button">Découvrir</a>
            </div>
        </div>
        ';
    }
    return $carousel_inner;
}
// récupération catégories
function req_select_cat($bdd) {
    $requete = "SELECT * FROM categories 
                INNER JOIN images_site ON categories.id_img_site = images_site.id_img_site
                WHERE categories.afficher_categorie = 1"; 
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
// récupération des nouveautés
function req_select_new_produit($bdd) {
    $requete = "SELECT * FROM produits
                INNER JOIN images_produits ON produits.id_produit = images_produits.id_produit 
                INNER JOIN sous_categories ON produits.id_sous_cat = sous_categories.id_sous_cat
                WHERE produits.afficher_produit = 1 AND images_produits.afficher_image = 1
                GROUP BY produits.id_produit
                ORDER BY produits.id_produit DESC
                LIMIT 4
                ";
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
// récupération jumbotron
function req_jumbotron($bdd) {
    $requete = "SELECT * FROM jumbotron_paragraphes 
                WHERE afficher_paragraphe = 1";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    
    $donnees = $req -> fetchAll();
    return $donnees;
}
// récupère images jumbotron 
function req_img_jumbotron($bdd, $position) {
    $requete = "SELECT * FROM images_jumbotron 
                WHERE position_img_jumbotron = $position 
                LIMIT 1";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    
    $donnees = $req -> fetch(); 
    return $donnees;
}
// récupération produits promo
function req_select_promo_produit($bdd) {
    $requete = "SELECT * FROM produits 
                INNER JOIN images_produits ON produits.id_produit = images_produits.id_produit
                INNER JOIN sous_categories ON produits.id_sous_cat = sous_categories.id_sous_cat
                WHERE produits.promo_saison_produit = 1 AND produits.afficher_produit = 1
                GROUP BY produits.id_produit
                LIMIT 4
                "; 
    $req = $bdd->prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
//portfolio tutoriels
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
//------------------------------------------------------------------------
//                        tutoriels
//------------------------------------------------------------------------
// tous les tutos
function req_tutos($bdd) {
    $requete = "SELECT * FROM tutoriels
    INNER JOIN images_site ON images_site.id_img_site = tutoriels.id_img_site";
$req = $bdd -> prepare($requete);
$req -> execute();

$tutos = $req -> fetchAll();
return $tutos;
}
function req_tuto($bdd, $id_tutoriel) {
    $requete = "SELECT * FROM tutoriels 
                WHERE id_tutoriel = :id_tutoriel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetch();
    return $donnees;
}
function req_materiaux($bdd, $id_tutoriel) {
    $requete = "SELECT * FROM materiaux_tutoriels 
                WHERE id_tutoriel = :id_tutoriel";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
//-------------------------------------------------------------------------
//                          page client
//-------------------------------------------------------------------------
// panier sur la page client
function req_commandes($bdd,$id_client) {
    $requete = "SELECT id_commande FROM paniers 
                WHERE id_client = :id_client 
                GROUP BY id_commande";
    $req = $bdd-> prepare($requete);
    $req ->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();

    $commandes = $req-> fetchAll();
    return $commandes;
}
function req_commande_payer($bdd,$id_client) {
    $requete = "SELECT * FROM referances_commandes
                INNER JOIN etats_commandes ON referances_commandes.id_etat_commande = etats_commandes.id_etat_commande
                INNER JOIN etats_livraisons ON referances_commandes.id_livraison = etats_livraisons.id_livraison
                WHERE referances_commandes.id_client = :id_client
                order BY referances_commandes.id_commande";
    $req = $bdd-> prepare($requete);
    $req ->bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();

    $commandes = $req-> fetchAll();
    return $commandes;
}
function gestion_paniers($bdd,$commandes) {
    $table = '';
    foreach ($commandes as $lignes) {
        // toutes les lignes paniers d'une id_commande precise
        $commande = req_select_panier($bdd,$lignes['id_commande']);

        $panier = $lignes['id_commande'];
        $date = date('d/m/Y', $panier);
        $nbr_produit = count($commande);
        $prix = 0;
        foreach ($commande as $ligne){
            $prix += $ligne['quantite_produit']*$ligne['prix_unitaire_produit'];
        }

        $table .= '
        <tr>
            <td>'.$panier.'</td>
            <td>'.$date.'</td>
            <td>'.$nbr_produit.'</td>
            <td>'.$prix.'</td>
            <td><a href="index.php?page=62&id='.$lignes['id_commande'].'"><img src="public/assets/img/icones/trolley.png" class="img-fluids icones"></a></td>
            <td><a href="index.php?page=62&mod='.$lignes['id_commande'].'"onclick="return(confirm(\'Voulez vous modifier cette commande ? Cette action fusionnera le panier en cours avec le panier sélectionné et est irréversible\'))"><img src="public/assets/img/icones/trolley.png" class="img-fluids icones"></a></td>
            <td class="text-center"><a href="index.php?page=62&id='.$lignes['id_commande'].'"><img src="public/assets/img/icones/box.png" alt="" class="img-fluid icones"></a></td>
            <td class="text-center"><a href="index.php?page=6&sup='.$lignes['id_commande'].'" onclick="return(confirm(\'Voulez vous supprimer cette commande ?\'))"><img src="public/assets/img/icones/btn_supp.png" alt="" class="img-fluid icones"></a></td>
        </tr>
        ';
    }
    return $table;
}
function gestion_commandes($bdd,$commandes_payer) {
    $table = '';
    foreach ($commandes_payer as $ligne) {
        $commande = req_select_commande($bdd,$ligne['id_commande']);
        $nbr_produit = count($commande);
        if ($ligne['id_etat_commande'] != 3) { // ne fait pas apparaître les commandes en attente de payement.
            $table .= '
            <tr class="" >
                <td scope="row">'.$ligne['id_commande'].'</td>
                <td>'.date('d/m/Y',$ligne['date_commande']).'</td>
                <td>'.$nbr_produit.'</td>
                <td>'.$ligne['montant_commande'].'</td> ';
            if ($ligne['id_livraison'] == 3) {
                $table .= '<td><a href="index.php?page=630&id='.$ligne['id_commande'].'&fac=1">facture</a></td>';
            }
            else {
                $table .= '
                    <td><a href="index.php?page=630&id='.$ligne['id_commande'].'&fac=0">voir</a></td>';
            }
            if ($ligne['id_etat_commande'] == 2) {
                $table .= '
                    <td class="bg-danger text-white">'.$ligne['nom_etat_commande'].'</td>
                    <td> --- </td>';
            }
            else {
                $table .= '
                    <td class="bg-success">'.$ligne['nom_etat_commande'].'</td>
                    <td>'.$ligne['nom_etat_livraison'].'</td>';
            }
            $table .= ' 
            </tr>
            ';

        }
    }
    return $table;
}
// suppression panier
function req_sup_panier($bdd, $id_commande) {
    $requete = "DELETE FROM paniers WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();
}
//gestion ateliers
function req_gestion_ateliers($bdd,$id_client) {
    $requete = "SELECT * FROM inscriptions
                INNER JOIN ateliers ON inscriptions.id_atelier = ateliers.id_atelier
                INNER JOIN horaires ON inscriptions.id_horaire = horaires.id_horaire
                WHERE inscriptions.id_client = :id_client";
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_client', $id_client, PDO::PARAM_INT); 
    $req -> execute(); 

    $ateliers = $req -> fetchAll();
    return $ateliers;
}
function gestion_ateliers($ateliers) {
    $table = '';
    foreach ($ateliers as $atelier) {
        $table .= '
        <tr>
            <td>'.$atelier['nom_atelier'].'</td>
            <td>'.date('d-m-Y à H:i',$atelier['date_atelier']).'</td>
            <td>'.$atelier['nbr_inscrit'].'</td>
            <td>'.$atelier['prix_atelier'].'</td>';
        if ($atelier['annuler'] == 0) {
            $table .= '
                <td><button type="button" class="btn btn-link annuler" id="'.$atelier['id_horaire'].'" value="'.$atelier['id_atelier'].'" name="'.$atelier['id_client'].'">Demande d\'annulation</button></td>';
        }
        else {
            $table .= '<td><button type="button" class="btn btn-link" disabled>Annulation en cours de traitement</button></td>';
        }
        $table .= '
        </tr>
        ';
    }

    return $table;
}
function req_produits_commande($bdd,$id_commande) {
    $requete = "SELECT * FROM referances_commandes
                INNER JOIN commandes ON referances_commandes.id_commande = commandes.id_commande
                INNER JOIN produits ON commandes.id_produit = produits.id_produit
                WHERE referances_commandes.id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $produits = $req -> fetchAll();
    return $produits;
}
function req_client_adresse2($bdd, $id_client) {
    $requete = "SELECT * FROM clients
                INNER JOIN adresses ON clients.id_client = adresses.id_client
                WHERE clients.id_client = :id_client ";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();

    $client = $req -> fetchAll();
    return $client;
}
//--------------------------------------------------------------------------
//                          page panier
//--------------------------------------------------------------------------
// ssi deja dans panier
function req_test_panier($bdd,$id_produit,$id_commande) {
    $requete = "SELECT quantite_produit FROM paniers 
                WHERE id_commande = :id_commande AND id_produit = :id_produit";
    $req3 = $bdd->prepare($requete);
    $req3->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req3->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req3 -> execute();
    $test = $req3 -> fetch();
    return $test;
}
// update panier
function req_update_panier($bdd, $id_commande,$quantite_produit,$id_produit) {
    $requete = "UPDATE paniers SET `quantite_produit`= :quantite_produit 
                WHERE id_commande = :id_commande AND id_produit = :id_produit";
    $req3 = $bdd->prepare($requete);
    $req3->bindValue(':quantite_produit', $quantite_produit, PDO::PARAM_STR);
    $req3->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req3->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req3 -> execute();
}
// insert panier
function req_insert_panier($bdd,$id_commande,$id_client,$quantite_produit,$id_produit,$prix_unitaire_produit) {
    $requete = "INSERT INTO `paniers`(`id_panier`, `id_commande`, `quantite_produit`, `prix_unitaire_produit`, `id_produit`, `id_client`) 
                VALUES (0,:id_commande,:quantite_produit,:prix_unitaire_produit,:id_produit,$id_client)
                ";
    $req3 = $bdd->prepare($requete);
    $req3->bindValue(':quantite_produit', $quantite_produit, PDO::PARAM_STR);
    $req3->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
    $req3->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    // $req3->bindValue(':id_client', $id_client, PDO::PARAM_STR);
    $req3->bindValue(':prix_unitaire_produit', $prix_unitaire_produit, PDO::PARAM_STR);
    $req3 -> execute();
}
// recherche produit pour affichage
function req_panier($bdd,$id_commande) {
    $requete = "SELECT * FROM paniers 
                INNER JOIN produits ON paniers.id_produit = produits.id_produit
                WHERE paniers.id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
// écrit panier
function panier($image, $produit, $prix) {
    $chemin = 'public/assets/img/produits/';
    $chemin_image = image_par_default($chemin, $image);
    
    $stock_tampons = 5;
    $stock = $produit['stock_produit'] - $stock_tampons;

    $liste_panier = '
    <tr class="align-middle">
        <td><img src="'.$chemin_image.'" class="img-fluid img_panier"> '.$produit['nom_produit'].'</td>
        <td class="text-center " >
            <button type="button" class="btn btn-button-light moins" id="m'.$produit['id_panier'].'" ><i class="fa-solid fa-minus" style="color: #b47b77;"></i></button>
            <input type="number" id="produit'.$produit['id_panier'].'" value="'.$produit['quantite_produit'].'" class="input_quantite "  min=1 max="'.$stock.'">
            <button type="button" class="btn btn-button-light plus" id="p'.$produit['id_panier'].'" ><i class="fa-solid fa-plus" style="color: #b47b77;"></i></button>
        </td>
        
        <td class="text-center">'.number_format($produit['prix_unitaire_produit'],2,',',' ').'</td>
        <td class="text-center" id="prix'.$produit['id_panier'].'">'.number_format($prix,2,',',' ').'</td>
        <td><a href="index.php?page=62&sup='.$produit['id_panier'].'"><img src="public/assets/img/icones/btn_supp.png" class="img-fluid icones" alt="" ></a></td>
    </tr>
    ';
    return $liste_panier;
}
// fusionne un ancien panier avec le panier actuel
function req_vieux_panier($bdd,$id_commande_old,$id_commande_new){
    // cherche les doublons, additionne les quantité et supprime les anciennes entrées en double avec les nouvelles
    $panier_old = req_select_panier($bdd,$id_commande_old);

    foreach ($panier_old as $produit) {
        $requete = "SELECT * FROM paniers 
                    WHERE id_commande = :id_commande_new AND id_produit = :id_produit";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_commande_new', $id_commande_new, PDO::PARAM_INT);
        $req -> bindValue(':id_produit', $produit['id_produit'], PDO::PARAM_INT);
        $req -> execute();

        $test = $req -> fetch();
        if (($test != '') && ($id_commande_new != $id_commande_old)) {
            $new_quantite = $produit['quantite_produit'] + $test['quantite_produit'];
            $requete = "UPDATE paniers SET quantite_produit = $new_quantite 
                        WHERE id_commande = :id_commande_new AND id_produit = :id_produit";
            $req = $bdd -> prepare($requete);
            $req -> bindValue(':id_commande_new', $id_commande_new, PDO::PARAM_INT);
            $req -> bindValue(':id_produit', $produit['id_produit'], PDO::PARAM_INT);
            $req -> execute();

            $requete = "DELETE FROM paniers WHERE id_commande = :id_commande_old AND id_produit = :id_produit";
            $req = $bdd -> prepare($requete);
            $req -> bindValue(':id_commande_old', $id_commande_old, PDO::PARAM_INT);
            $req -> bindValue(':id_produit', $produit['id_produit'], PDO::PARAM_INT);
            $req -> execute();
        }
    }

    // update l'ancien panier à la session en cours
    $requete = "UPDATE paniers SET id_commande = :id_commande_new 
                WHERE id_commande = :id_commande_old";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande_new', $id_commande_new, PDO::PARAM_INT);
    $req -> bindValue(':id_commande_old', $id_commande_old, PDO::PARAM_INT);
    $req -> execute();
}
// supprime un produit du panier (à remplacer par une mise à 0 de la quantité?)
function req_sup_produit_panier($bdd,$id_panier) {
    $requete = "DELETE FROM paniers WHERE id_panier = :id_panier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_panier', $id_panier, PDO::PARAM_INT);
    $req -> execute();
}

//--------------------------------------------------------------------------
//                              commande
//--------------------------------------------------------------------------
// récupère un panier précis
function req_select_panier($bdd,$id_commande) {
    $requete = "SELECT * FROM paniers 
                WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
function req_select_panier2($bdd,$id_commande) {
    $requete = "SELECT * FROM paniers 
                INNER JOIN produits ON paniers.id_produit =produits.id_produit
                WHERE paniers.id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
// récupère une commande précise
function req_select_commande($bdd,$id_commande) {
    $requete = "SELECT * FROM commandes 
                WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetchAll();
    return $donnees;
}
// récupère client plus adresse de livraison 
function req_client_adresse($bdd, $id_client) {
    $requete = "SELECT * FROM clients 
                INNER JOIN adresses ON clients.id_client = adresses.id_client
                WHERE clients.identifiant_client = :id_client AND adresses.livraison_client = 1";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();
    $client = $req -> fetch();
    return $client;
}
//test si il y a deja cette id_commande
function req_test_commande($bdd, $id_commande) {
    $requete = "SELECT * FROM referances_commandes WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande',$id_commande,PDO::PARAM_INT);
    $req -> execute();

    $test = $req -> rowCount();
    return $test;
}
function req_test_commande_payer($bdd, $id_commande) {
    // etat commande = 3 => paiement en attente
    //               = 1 => payé
    //               = 2 => paiement refusé
    $requete = "SELECT * FROM referances_commandes WHERE id_commande = :id_commande AND id_etat_commande != 3";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande',$id_commande,PDO::PARAM_INT);
    $req -> execute();

    $test = $req -> rowCount();
    return $test;
}
// déplace le panier dans commande
function req_panier_a_commande($bdd,$id_commande) {
    $test = req_test_commande($bdd, $id_commande);
    if ($test == 0 ) {
        $requete = "INSERT INTO commandes (SELECT * FROM paniers WHERE id_commande = :id_commande)";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
        $req -> execute();
    }
    else {
        // update la commande pas encore payée
        $requete = "INSERT INTO commandes (SELECT * FROM paniers WHERE id_commande = :id_commande) ON DUPLICATE KEY UPDATE commandes.id_panier = paniers.id_panier";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_commande',$id_commande,PDO::PARAM_INT);
        $req -> execute();
    }

}
// enregistre le token pour la banque et l'associe au client et à la commande
function req_save_token($bdd,$id_commande,$jour,$token,$id_client,$montant_commande,$livraison) {
    // test si il y a deja cette id_commande
    $test = req_test_commande($bdd,$id_commande);

    if ($test != 0) {
        // update la commande pas encore payer
        $requete = "UPDATE referances_commandes SET date_commande = :date_commande,
                                                    montant_commande = :montant_commande,
                                                    token_commande = :token_commande,
                                                    id_adresse = :livraison
                    WHERE id_commande = :id_commande";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_commande',$id_commande,PDO::PARAM_INT);
        $req -> bindValue(':date_commande',$jour,PDO::PARAM_INT);
        $req -> bindValue(':montant_commande',$montant_commande,PDO::PARAM_STR);
        $req -> bindValue(':token_commande',$token,PDO::PARAM_STR);
        $req -> bindValue(':livraison',$livraison,PDO::PARAM_INT);
        $req -> execute();
    }
    else {
        // insert 
        $requete = "INSERT INTO `referances_commandes` VALUES (:id_commande, :date_commande,:montant_commande, :token_commande,3, :id_client,1,:livraison)";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_commande',$id_commande,PDO::PARAM_INT);
        $req -> bindValue(':date_commande',$jour,PDO::PARAM_INT);
        $req -> bindValue(':montant_commande',$montant_commande,PDO::PARAM_STR);
        $req -> bindValue(':token_commande',$token,PDO::PARAM_STR);
        $req -> bindValue(':id_client',$id_client,PDO::PARAM_INT);
        $req -> bindValue(':livraison',$livraison,PDO::PARAM_INT);
        $req -> execute();

    }

}
// test si token unique
function req_token_unique($bdd,$token) {
    $requete = "SELECT * FROM referances_commandes WHERE token_commande = :token";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':token', $token, PDO::PARAM_STR);
    $req -> execute();
    $test = $req -> rowCount();
    return $test;
}
// test si il existe des produits dans la commande
function req_test_commande2($bdd,$id_commande) {
    $requete = "SELECT * FROM commandes WHERE id_commande = :id_commande";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande',$id_commande,PDO::PARAM_INT);
    $req -> execute();

    $test = $req -> rowCount();
    return $test;
}

// // fonction calcul du prix final 
// function calcul_prix_tot($prix_ht,$pays, $poids) {
//     $taux_remise = 5; // exemple de promos sur tout le magasin
//     $taux_tva = 20;  // 20% 
//     $frai_port = 2 + 0.1*$poids; // emballage + transport + assurance + frai divers prépa commande

//     $prix_tot_rem = $prix_total*(1-$taux_remise/100);
//     $prix_tot_ttc = $prix_tot_rem*(1+$taux_tva/100);
//     $prix_livraison = $prix_tot_ttc + $frai_port;

//     $prix = [$frai_port,$prix_tot_rem,$prix_tot_ttc,$prix_livraison];
//     return $prix;
// }
//--------------------------------------------------------------------------
//                              ateliers
//--------------------------------------------------------------------------
// récupération des ateliers
function req_ateliers($bdd) {
    $requete = "SELECT * FROM ateliers 
                WHERE afficher_atelier = 1";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $ateliers = $req -> fetchAll();
    return $ateliers;
}
//récupérations images ateliers
function req_img_atelier($bdd,$id_atelier) {
    $requete = "SELECT * FROM images_ateliers 
                WHERE id_atelier = $id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
// carousel des ateliers
function carousel_indicators_ateliers($i, $nom_img) {
    if ($i == 0) {
        $carousel_indicators = '
            <button type="button" data-bs-target="#carouselImage" data-bs-slide-to="'.$i.'" class="active" aria-current="true" aria-label="Slide '.($i+1).'"> 
                <img src="'.image_par_default('public/assets/img/site/',$nom_img).'" alt="" class="img-fluid d-block border_indicator img_atelier">
            </button>
        ';
    }
    else {
        $carousel_indicators = '
            <button type="button" data-bs-target="#carouselImage" data-bs-slide-to="'.$i.'" aria-label="Slide '.($i+1).'"> 
                <img src="'.image_par_default('public/assets/img/site/',$nom_img).'" alt="" class="img-fluid d-block border_indicator img_atelier">
            </button>
        ';
    }

    return $carousel_indicators;
}
function carousel_inner_ateliers($i, $nom_img) {
    if ($i == 0) {
        $carousel_inner = '
        <div class="carousel-item active">
            <img src="'.image_par_default('public/assets/img/site/',$nom_img).'" class="d-block w-100 img_atelier" alt="...">
        </div>
    ';
    }
    else {
        $carousel_inner = '
            <div class="carousel-item">
                <img src="'.image_par_default('public/assets/img/site/',$nom_img).'" class="d-block w-100 img_atelier " alt="...">
            </div>
        ';
    }

    return $carousel_inner;
}

function carousel($slide,$carousel_indicators,$carousel_inner ) {
    $carousel = '
    <div id="carouselImage'.$slide.'" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators justify-content-evenly">
            '.$carousel_indicators.'
        </div>
        <div class="carousel-inner">
            '.$carousel_inner.'
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImage'.$slide.'" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
                <img src="public/assets/img/site/fleche-gauche-dans-un-cercle.png" alt="" class="img-fluid w-100">
            </span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselImage'.$slide.'" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true">
                <img src="public/assets/img/site/fleche-gauche-dans-un-cercle.png" alt="" class="img-fluid w-100">
            </span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
    ';
    return $carousel;
}
//récupération des paragraphes
function req_paragraphes_ateliers($bdd, $id_atelier) {
    $requete = "SELECT * FROM descriptifs_ateliers 
                WHERE id_atelier = $id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> execute();

    $nbr_paragraphes = $req -> rowCount();
    $paragraphes = $req -> fetchAll();
    $donnees = [$nbr_paragraphes, $paragraphes];
    return $donnees;
}
// récupération des horaires 
function req_horaires_atelier($bdd,$id_atelier) {
    $requete = "SELECT * FROM horaires 
                WHERE id_atelier = $id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    $donnees = $req -> fetchAll();
    return $donnees;
}
// inscription à un atelier 
function req_inscription_atelier($bdd,$id_client,$id_atelier,$id_horaire,$nbr_inscrit) {
    $requete = "INSERT INTO `inscriptions`(`id_client`, `id_atelier`, `id_horaire`, `nbr_inscrit`) 
                VALUES (:id_client,:id_atelier,:id_horaire,:nbr_inscrit)";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT);
    $req -> bindValue(':nbr_inscrit', $nbr_inscrit, PDO::PARAM_INT);
    $req -> execute();

    // mise à jour du nombre de participant
    $requete = "SELECT * FROM horaires 
                WHERE id_horaire = :id_horaire";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT);
    $req -> execute();

    $nbr = $req -> fetch();

    $requete = "UPDATE horaires SET nbr_participant = :nbr_inscrit 
                WHERE id_horaire = :id_horaire";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT);
    $req -> bindValue(':nbr_inscrit', $nbr['nbr_participant']+$nbr_inscrit, PDO::PARAM_INT);
    $req -> execute();

    return $nbr['date_atelier'];
}
// preparation du form d'inscription
function req_formulaire_atelier($bdd,$c,) {
    $requete = "SELECT * FROM ateliers 
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue('id_atelier', $c, PDO::PARAM_INT);
    $req -> execute();

    $atelier = $req -> fetch();

    
    $requete = "SELECT * FROM horaires
                WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue('id_atelier', $c, PDO::PARAM_INT);
    $req -> execute();
    
    $horaire = $req -> fetchAll();

    $donnees = [$atelier,$horaire];
    return $donnees;
}
function req_ateliers_client($bdd,$id_client,$id_atelier) {
    $requete = "SELECT * FROM inscriptions 
                WHERE id_client = :id_client AND id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();

    $donnees = $req -> fetchAll();
    $liste_inscriptions = array();
    foreach ($donnees as $key) {
        $liste_inscriptions[] = $key['id_horaire'];
    }
    return $liste_inscriptions;
}
//-----------------------------------------------------------------
//                              Contact
//-----------------------------------------------------------------
function req_contact($bdd,$date_message,$nom_contact,$mail_contact,$tel_contact,$entreprise_contact,$categorie_contact,$message_contact) {
    $requete = "INSERT INTO `contacts`(`id_contact`, `nom_contact`, `mail_contact`, `tel_contact`, `entreprise_contact`, `categorie_contact`, `message_contact`, `date_message`, `lu_message`, `repondu_message`) 
                VALUES (0,:nom_contact,:mail_contact,:tel_contact,:entreprise_contact,:categorie_contact,:message_contact,$date_message,0,0)
    ";
    $req = $bdd->prepare($requete);
    $req->bindValue(':nom_contact', $nom_contact, PDO::PARAM_STR);  
    $req->bindValue(':mail_contact', $mail_contact, PDO::PARAM_STR);  
    $req->bindValue(':tel_contact', $tel_contact, PDO::PARAM_STR);  
    $req->bindValue(':entreprise_contact', $entreprise_contact, PDO::PARAM_STR);  
    $req->bindValue(':categorie_contact', $categorie_contact, PDO::PARAM_STR);  
    $req->bindValue(':message_contact', $message_contact, PDO::PARAM_STR);  
    $req -> execute();
}
?>