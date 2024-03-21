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
if (isset($_POST['afficher_paragraphe'],
          $_POST['id_paragraphe']) 
          && $_POST['afficher_paragraphe'] != NULL
          && $_POST['id_paragraphe'] != NULL
    ) {
    $afficher_paragraphe = intval($_POST['afficher_paragraphe']);
    $id_paragraphe = intval($_POST['id_paragraphe']);

    if ($afficher_paragraphe == 1) {
        $afficher_paragraphe = 0;
    }
    else {
        $afficher_paragraphe = 1;
    }
}
else {
    $afficher_paragraphe = 0;
    $id_paragraphe = 0;
}
// recuperation de sous cat dans la bdd 
$requete = "UPDATE `jumbotron_paragraphes` SET afficher_paragraphe = :afficher_paragraphe WHERE id_paragraphe = :id_paragraphe";
$req = $bdd->prepare($requete);
$req->bindValue(':id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
$req->bindValue(':afficher_paragraphe', $afficher_paragraphe, PDO::PARAM_INT);
$req -> execute();

$requete = "SELECT * FROM jumbotron_paragraphes WHERE id_paragraphe = :id_paragraphe";
$req = $bdd->prepare($requete);
$req->bindValue(':id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
$req -> execute();

$tableau_donnees = json_encode($req->fetchAll());
echo $tableau_donnees;
?>