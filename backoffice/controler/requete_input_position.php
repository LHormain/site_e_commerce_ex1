<?php
$user = 'root';
$pass = '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=etoffe_en_ligne',$user,$pass); // concerne la base
}
catch(PDOException $e) {
    die('Erreur : '.$e->getMessage());
}


// récupération des catégories 
if (isset($_POST['position_image'],
          $_POST['id_image']) 
          && $_POST['position_image'] != NULL
          && $_POST['id_image'] != NULL
    ) {
    $position_image = intval($_POST['position_image']);
    $id_image = intval($_POST['id_image']);
}
else {
    $position_image = 0;
    $id_image = 0;
}

// // cherche le produit
$requete = "SELECT * FROM images_produits WHERE id_img = :id_image1";
$req = $bdd->prepare($requete);
$req -> bindValue(':id_image1', $id_image, PDO::PARAM_INT);
$req -> execute();
$image = $req -> fetch();

//cherche si position deja affecter pour le produit
$requete = "SELECT * FROM images_produits 
            WHERE id_produit = :id_produit AND position_image = :position_image";
$req = $bdd->prepare($requete);
$req->bindValue(':id_produit', $image['id_produit'], PDO::PARAM_INT);
$req->bindValue(':position_image', $position_image, PDO::PARAM_INT);
$req -> execute();

$double = $req -> fetch();
$test = $req -> rowCount();

if ($test != 0) {
    // si la position est deja prise affecte l'ancienne position de l'image 1 à l'image trouvé
    $requete = "UPDATE `images_produits`
                SET position_image = :position_image
                WHERE id_img = :id_image2
                    "; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_image2', $double['id_img'], PDO::PARAM_INT);
    $req->bindValue(':position_image', $image['position_image'], PDO::PARAM_INT);
    $req -> execute();
}

// met la nouvelle position à l'image 1
$requete = "UPDATE `images_produits`
            SET position_image = :position_image
            WHERE id_img = :id_image
                "; 
$req4 = $bdd->prepare($requete);
$req4->bindValue(':id_image', $id_image, PDO::PARAM_INT);
$req4->bindValue(':position_image', $position_image, PDO::PARAM_INT);
$req4 -> execute();
// $tableau_donnees = json_encode($req4->fetchAll());
// echo $tableau_donnees;
?>