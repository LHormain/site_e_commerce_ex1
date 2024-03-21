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
if (isset($_POST['promo_saison_produit'],
          $_POST['id_produit']) 
          && $_POST['promo_saison_produit'] != NULL
          && $_POST['id_produit'] != NULL
    ) {
    $promo_saison_produit = intval($_POST['promo_saison_produit']);
    $id_produit = intval($_POST['id_produit']);

    if ($promo_saison_produit == 1) {
        $promo_saison_produit = 0;
    }
    else {
        $promo_saison_produit = 1;
    }
}
else {
    $promo_saison_produit = 0;
    $id_produit = 0;
}
// recuperation de sous cat dans la bdd 
$requete = "UPDATE `produits` SET promo_saison_produit = :promo_saison_produit WHERE id_produit = :id_produit";
$req = $bdd->prepare($requete);
$req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
$req->bindValue(':promo_saison_produit', $promo_saison_produit, PDO::PARAM_INT);
$req -> execute();

$requete = "SELECT * FROM produits WHERE id_produit = :id_produit";
$req = $bdd->prepare($requete);
$req->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
$req -> execute();

$tableau_donnees = json_encode($req->fetchAll());
echo $tableau_donnees;
?>