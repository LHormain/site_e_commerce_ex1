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
if (isset($_POST['id_livraison'], $_POST['id_commande']) 
&& $_POST['id_livraison'] != NULL
&& $_POST['id_commande'] != NULL
) {
    $id_livraison = intval($_POST['id_livraison']);
    $id_commande = intval($_POST['id_commande']);
}
else {
    $id_livraison = 1;
    $id_commande = 1;
}
// mise à jour de l'etat de livraison 
$requete = "UPDATE `referances_commandes` SET `id_livraison`= :id_livraison
            WHERE `id_commande`= :id_commande"; 
$req4 = $bdd->prepare($requete);
$req4->bindValue(':id_livraison', $id_livraison, PDO::PARAM_INT);
$req4->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
$req4 -> execute();

// création d'un id_facture
if ($id_livraison == 3) {
    $requete = "INSERT INTO facture VALUES (0,:id_commande)";
    $req4 = $bdd->prepare($requete);
    $req4->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req4 -> execute();
}

// $tableau_donnees = json_encode($req4->fetchAll());
// echo $tableau_donnees;
?>