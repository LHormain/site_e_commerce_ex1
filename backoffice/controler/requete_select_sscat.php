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
if (isset($_POST['id_cat']) && $_POST['id_cat'] != NULL) {
    $id_cat = intval($_POST['id_cat']);
}
else {
    $id_cat = 1;
}
// recuperation de sous cat dans la bdd 
$requete = "SELECT * FROM sous_categories 
            WHERE id_cat = :id_cat AND afficher_sous_categorie = 1
                "; 
$req4 = $bdd->prepare($requete);
$req4->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
$req4 -> execute();
$tableau_donnees = json_encode($req4->fetchAll());
echo $tableau_donnees;
?>