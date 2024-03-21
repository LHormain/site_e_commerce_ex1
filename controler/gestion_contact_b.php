<?php

include('../modele/connexion_bdd.php');

if (isset($_GET['token'],
          $_GET['etat'])
&& $_GET['token'] != NULL
&& $_GET['token'] != NULL
) {
    $token = htmlspecialchars($_GET['token']);
    $etat = intval($_GET['etat']);

    if ($etat == 1) {
        // accepter
        $requete = "UPDATE `referances_commandes` SET `id_etat_commande`= 1 WHERE `token_commande`= :token";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':token', $token, PDO::PARAM_STR);
        $req -> execute();

        // efface le panier correspondant, enregistre les stats et met à jour les stock
        $requete = "SELECT * FROM referances_commandes 
                    WHERE `token_commande`= :token";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':token', $token, PDO::PARAM_STR);
        $req -> execute();
        $commande = $req -> fetch();
    
        // enregistrer date, montant dans stat???
        // met a jour les stocks
        $requete = "SELECT * FROM commandes WHERE id_commande = :id_commande";
        $req = $bdd -> prepare($requete);
        $req -> bindValue (':id_commande', $commande['id_commande'], PDO::PARAM_INT);
        $req -> execute();
        $donnees = $req -> fetchAll();
        foreach ($donnees as $produit) {
            $requete = "UPDATE produits SET stock_produit = stock_produit - :stock 
                        WHERE id_produit = :id_produit";
            $req = $bdd -> prepare($requete);
            $req -> bindValue(':stock', $produit['quantite_produit'], PDO::PARAM_STR);
            $req -> bindValue(':id_produit', $produit['id_produit'], PDO::PARAM_INT);
            $req -> execute();
        }
    
        //supprime le panier correspondant
        $requete = "DELETE FROM paniers WHERE id_commande = :id_commande";
        $req = $bdd -> prepare($requete);
        $req -> bindValue (':id_commande', $commande['id_commande'], PDO::PARAM_INT);
        $req -> execute();
    }
    else {
        //refuser
        $requete = "UPDATE `referances_commandes` SET `id_etat_commande`= 2, id_livraison = 4 WHERE `token_commande`= :token";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':token', $token, PDO::PARAM_STR);
        $req -> execute();

        //sélectionne la commande
        $requete = "SELECT * FROM referances_commandes 
                    WHERE `token_commande`= :token";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':token', $token, PDO::PARAM_STR);
        $req -> execute();
        $commande = $req -> fetch();

        // réenregistre le panier avec un nouveau numéro de commande et des nouveaux numéro de panier (sinon pb avec transfert dans table commande)
        $new_id_commande = time();
        $requete = "SELECT * FROM paniers WHERE id_commande = :id_commande";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_commande', $commande['id_commande'], PDO::PARAM_INT);
        $req -> execute();

        $old_panier = $req -> fetchAll();
        foreach ($old_panier as $key) {
            $requete = "INSERT INTO paniers VALUES (0,$new_id_commande,:quantite_produit,:prix_unitaire_produit,:id_produit,:id_client)";
            $req = $bdd -> prepare($requete);
            $req -> bindValue(':quantite_produit', $key['quantite_produit'], PDO::PARAM_STR);
            $req -> bindValue(':prix_unitaire_produit', $key['prix_unitaire_produit'], PDO::PARAM_STR);
            $req -> bindValue(':id_produit', $key['id_produit'], PDO::PARAM_INT);
            $req -> bindValue(':id_client', $key['id_client'], PDO::PARAM_INT);
            $req -> execute();
        }
        
        // suppression de l'ancien panier
        $requete = " DELETE FROM paniers WHERE id_commande = :id_commande";
        $req = $bdd -> prepare($requete);
        $req -> bindValue(':id_commande', $commande['id_commande'], PDO::PARAM_INT);
        $req -> execute();

        

    }


}


?>