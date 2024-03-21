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
if (isset($_POST['afficher_sous_categorie'],
          $_POST['id_sous_cat']) 
          && $_POST['afficher_sous_categorie'] != NULL
          && $_POST['id_sous_cat'] != NULL
    ) {
    $afficher_sous_categorie = intval($_POST['afficher_sous_categorie']);
    $id_sous_cat = intval($_POST['id_sous_cat']);

    if ($afficher_sous_categorie == 1) {
        $afficher_sous_categorie = 0;
    }
    else {
        $afficher_sous_categorie = 1;
    }
}
else {
    $afficher_sous_categorie = 0;
    $id_sous_cat = 0;
}
// recuperation de sous cat dans la bdd 
$requete = "UPDATE `sous_categories` SET afficher_sous_categorie = :afficher_sous_categorie WHERE id_sous_cat = :id_sous_cat";
$req = $bdd->prepare($requete);
$req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT);
$req->bindValue(':afficher_sous_categorie', $afficher_sous_categorie, PDO::PARAM_INT);
$req -> execute();

$requete = "SELECT * FROM sous_categories WHERE id_sous_cat = :id_sous_cat";
$req = $bdd->prepare($requete);
$req->bindValue(':id_sous_cat', $id_sous_cat, PDO::PARAM_INT);
$req -> execute();

$tableau_donnees = json_encode($req->fetchAll());
echo $tableau_donnees;
?>