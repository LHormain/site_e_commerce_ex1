<?php
$user = 'root';
$pass = '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=etoffe_en_ligne',$user,$pass); // concerne la base
}
catch(PDOException $e) {
    die('Erreur : '.$e->getMessage());
}

$ortie = 'pas ok';
if (isset($_POST['id_produit'], $_POST['quantite_produit'], $_POST['prix_unitaire'], $_POST['id_commande'])
&& $_POST['id_produit'] != NULL
&& $_POST['quantite_produit'] != NULL
&& $_POST['prix_unitaire'] != NULL
&& $_POST['id_commande'] != NULL
){
    $id_produit = intval($_POST['id_produit']);
    $quantite_produit = intval($_POST['quantite_produit']);
    $prix_unitaire_produit = intval($_POST['prix_unitaire']);
    $id_commande = intval($_POST['id_commande']);
    
    if (isset($_POST['identifiant_client']) && $_POST['identifiant_client'] != NULL) {
        $identifiant_client = intval($_POST['identifiant_client']);
        // si co
        $requete = "SELECT * FROM clients 
                    WHERE identifiant_client = :identifiant_client";
        $req = $bdd->prepare($requete);
        $req->bindValue(':identifiant_client', $identifiant_client, PDO::PARAM_INT);
        $req -> execute();

        $id_client_fetch = $req -> fetch();
        $id_client = $id_client_fetch['id_client']; 
    }
    else {
        // si pas co crée identifiant provisoire? utilise NULL?
        $identifiant_client = time();
        $id_client = 'NULL'; 
    }

    if ($quantite_produit != 0) { 

        // test si produit existe deja dans le panier
        $requete = "SELECT quantite_produit FROM paniers 
                    WHERE id_commande = :id_commande AND id_produit = :id_produit";
        $req3 = $bdd->prepare($requete);
        $req3->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
        $req3->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
        $req3 -> execute();
        $test = $req3 -> fetch();
    
        if (isset($test) && $test != NULL) {
            // UPDATE de la quantité 
            $quantite_produit = $quantite_produit + $test['quantite_produit'];
    
            $requete = "UPDATE paniers SET `quantite_produit`= :quantite_produit 
                        WHERE id_commande = :id_commande AND id_produit = :id_produit";
            $req3 = $bdd->prepare($requete);
            $req3->bindValue(':quantite_produit', $quantite_produit, PDO::PARAM_STR);
            $req3->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
            $req3->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
            $req3 -> execute();

            $sortie = "ok";
            
        }
        else {
            // INSERT
            $requete = "INSERT INTO `paniers`(`id_panier`, `id_commande`, `quantite_produit`, `prix_unitaire_produit`, `id_produit`, `id_client`) 
                        VALUES (0,:id_commande,:quantite_produit,:prix_unitaire_produit,:id_produit,:id_client)
                        ";
            $req3 = $bdd->prepare($requete);
            $req3->bindValue(':quantite_produit', $quantite_produit, PDO::PARAM_STR);
            $req3->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
            $req3->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
            $req3->bindValue(':id_client', $id_client, PDO::PARAM_STR);
            $req3->bindValue(':prix_unitaire_produit', $prix_unitaire_produit, PDO::PARAM_STR);
            $req3 -> execute();

            $sortie = "ok";
        }
    }

    // $sortie = json_encode($req -> fetchAll());
    echo $sortie;
}

?>