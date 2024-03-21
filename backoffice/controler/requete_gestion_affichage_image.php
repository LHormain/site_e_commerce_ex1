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
if (isset($_POST['afficher_image'],
          $_POST['id_img']) 
          && $_POST['afficher_image'] != NULL
          && $_POST['id_img'] != NULL
    ) {
    $afficher_image = intval($_POST['afficher_image']);
    $id_img = intval($_POST['id_img']);

    if ($afficher_image == 1) {
        $afficher_image = 0;
    }
    else {
        $afficher_image = 1;
    }
}
else {
    $afficher_image = 0;
    $id_img = 0;
}
// recuperation de sous cat dans la bdd 
$requete = "UPDATE `images_produits` SET afficher_image = :afficher_image WHERE id_img = :id_img";
$req = $bdd->prepare($requete);
$req->bindValue(':id_img', $id_img, PDO::PARAM_INT);
$req->bindValue(':afficher_image', $afficher_image, PDO::PARAM_INT);
$req -> execute();

$requete = "SELECT * FROM images_produits WHERE id_img = :id_img";
$req = $bdd->prepare($requete);
$req->bindValue(':id_img', $id_img, PDO::PARAM_INT);
$req -> execute();

$tableau_donnees = json_encode($req->fetchAll());
echo $tableau_donnees;
?>