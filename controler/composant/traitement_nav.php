<?php
    // genere le menu déroulant tous nos produits
    $requete = "SELECT * FROM categories 
    WHERE afficher_categorie = 1
    ";
    $req = $bdd->prepare($requete);
    $req -> execute();

    
    $resultat = '';
    
    while ($donnees = $req->fetch()) {
        $resultat .=  '
        <li ><a class="dropdown-item" href="index.php?page=20&c='.$donnees['id_cat'].'">'.$donnees['nom_categorie'].'</a></li>
        <ul>
        ';
        $requete = "SELECT * FROM sous_categories 
                    WHERE id_cat = :id_cat AND afficher_sous_categorie = 1
        ";
        $req2 = $bdd->prepare($requete);
        $req2->bindValue(':id_cat', $donnees['id_cat'], PDO::PARAM_INT);
        $req2 -> execute();
        while ($donnees2 = $req2->fetch()) {
            $resultat .= '
            <li><a class="dropdown-item" href="index.php?page=2&c='.$donnees2['id_cat'].'&sc='.$donnees2['id_sous_cat'].'">'.$donnees2['nom_sous_categorie'].'</a></li> 
            ';
        }
        $resultat .= '
            </ul>
        ';
        }
?>