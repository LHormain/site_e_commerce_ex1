<?php
$user = 'root';
$pass = '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=etoffe_en_ligne',$user,$pass); // concerne la base
}
catch(PDOException $e) {
    die('Erreur : '.$e->getMessage());
}

//-------------------------------------------------
//              pour ajax sur panier
//-------------------------------------------------
// récupération des catégories 
if (isset($_POST['quantite_produit'],
          $_POST['id_panier']) 
          && $_POST['quantite_produit'] != NULL
          && $_POST['id_panier'] != NULL
    ) {
    $quantite_produit = htmlspecialchars($_POST['quantite_produit']);
    $id_panier = intval($_POST['id_panier']);
}
else {
    $quantite_produit = 0;
    $id_panier = 0;
}
// recuperation de sous cat dans la bdd 
$requete = "UPDATE `paniers`
            SET quantite_produit = :quantite_produit
            WHERE id_panier = :id_panier
                "; 
$req4 = $bdd->prepare($requete);
$req4->bindValue(':id_panier', $id_panier, PDO::PARAM_INT);
$req4->bindValue(':quantite_produit', $quantite_produit, PDO::PARAM_INT);
$req4 -> execute();
$tableau_donnees = json_encode($req4->fetchAll());
echo $tableau_donnees;
?>