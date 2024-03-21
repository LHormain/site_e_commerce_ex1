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
if (isset($_POST['position_descriptif'],
          $_POST['id_descriptif']) 
          && $_POST['position_descriptif'] != NULL
          && $_POST['id_descriptif'] != NULL
    ) {
    $position_descriptif = intval($_POST['position_descriptif']);
    $id_descriptif = intval($_POST['id_descriptif']);
}
else {
    $position_descriptif = 0;
    $id_descriptif = 0;
}

// // cherche l'atelier
$requete = "SELECT * FROM descriptifs_ateliers WHERE id_descriptif = :id_descriptif";
$req = $bdd->prepare($requete);
$req -> bindValue(':id_descriptif', $id_descriptif, PDO::PARAM_INT);
$req -> execute();
$descriptif = $req -> fetch();

//cherche si position deja affecter pour l'atelier
$requete = "SELECT * FROM descriptifs_ateliers 
            WHERE id_atelier = :id_atelier AND position_descriptif = :position_descriptif";
$req = $bdd->prepare($requete);
$req->bindValue(':id_atelier', $descriptif['id_atelier'], PDO::PARAM_INT);
$req->bindValue(':position_descriptif', $position_descriptif, PDO::PARAM_INT);
$req -> execute();

$double = $req -> fetch();
$test = $req -> rowCount();

if ($test != 0) {
    // si la position est deja prise affecte l'ancienne position du descriptif  1 au descriptif  trouvé
    $requete = "UPDATE `descriptifs_ateliers`
                SET position_descriptif = :position_descriptif
                WHERE id_descriptif = :id_descriptif
                    "; 
    $req = $bdd->prepare($requete);
    $req->bindValue(':id_descriptif', $double['id_descriptif'], PDO::PARAM_INT);
    $req->bindValue(':position_descriptif', $descriptif['position_descriptif'], PDO::PARAM_INT);
    $req -> execute();
}

// recuperation de sous cat dans la bdd 
$requete = "UPDATE `descriptifs_ateliers`
            SET position_descriptif = :position_descriptif
            WHERE id_descriptif = :id_descriptif
                "; 
$req4 = $bdd->prepare($requete);
$req4->bindValue(':id_descriptif', $id_descriptif, PDO::PARAM_INT);
$req4->bindValue(':position_descriptif', $position_descriptif, PDO::PARAM_INT);
$req4 -> execute();
// $tableau_donnees = json_encode($req4->fetchAll());
// echo $tableau_donnees;
?>