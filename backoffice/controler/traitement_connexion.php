<?php

$pwd = $_POST['pwd'];
$username = htmlspecialchars($_POST['username']);

// bon mot de pass = robert et bon nom d'utilisateur robert
if ( $username == 'admin@mail.com') {
    include('modele/connexion_bdd.php');

    $requete = "SELECT * FROM clients WHERE mail_client = :nom AND id_cat_client = 1";
    $req = $bdd->prepare($requete);
    $req -> bindValue(':nom', $username, PDO::PARAM_STR);
    $req -> execute();

    $user = $req -> fetch();

    if (password_verify($pwd, $user['mdp_client'])) {
        $_SESSION['connexion'] = true;
        header("location:index.php");
    }
    else {
        header("location:index.php?page=1");
    }
} 
else {
    // le mot de passe est faux
    header("location:index.php");
}

?>