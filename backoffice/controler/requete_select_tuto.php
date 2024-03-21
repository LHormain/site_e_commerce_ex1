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
if (isset($_POST['id_portfolio'],
$_POST['id_tutoriel']) 
&& $_POST['id_portfolio'] != NULL
&& $_POST['id_tutoriel'] != NULL
) {
    $id_portfolio = intval($_POST['id_portfolio']);
    $id_tutoriel = intval($_POST['id_tutoriel']);

    // mise à jour du tuto choisis
    $requete = "UPDATE portfolio_tutoriels SET id_tutoriel = :id_tutoriel
                WHERE id_portfolio = :id_portfolio"; 
    $req4 = $bdd->prepare($requete);
    $req4->bindValue(':id_tutoriel', $id_tutoriel, PDO::PARAM_INT);
    $req4->bindValue(':id_portfolio', $id_portfolio, PDO::PARAM_INT);
    $req4 -> execute();
    // $tableau_donnees = json_encode($req4->fetchAll());
    // echo $tableau_donnees;
}

?>