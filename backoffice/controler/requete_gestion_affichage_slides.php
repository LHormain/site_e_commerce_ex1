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
if (isset($_POST['afficher_slide'],
          $_POST['id_slide']) 
          && $_POST['afficher_slide'] != NULL
          && $_POST['id_slide'] != NULL
    ) {
    $afficher_slide = intval($_POST['afficher_slide']);
    $id_slide = intval($_POST['id_slide']);

    if ($afficher_slide == 1) {
        $afficher_slide = 0;
    }
    else {
        $afficher_slide = 1;
    }
}
else {
    $afficher_slide = 0;
    $id_slide = 0;
}
// recuperation de sous cat dans la bdd 
$requete = "UPDATE `carousel_slides` SET afficher_slide = :afficher_slide WHERE id_slide = :id_slide";
$req = $bdd->prepare($requete);
$req->bindValue(':id_slide', $id_slide, PDO::PARAM_INT);
$req->bindValue(':afficher_slide', $afficher_slide, PDO::PARAM_INT);
$req -> execute();

$requete = "SELECT * FROM carousel_slides WHERE id_slide = :id_slide";
$req = $bdd->prepare($requete);
$req->bindValue(':id_slide', $id_slide, PDO::PARAM_INT);
$req -> execute();

$tableau_donnees = json_encode($req->fetchAll());
echo $tableau_donnees;
?>