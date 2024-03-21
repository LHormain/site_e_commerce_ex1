<?php
$texte_page_courante = '';
// -----------------------------------------------------------
//                traitement de la connexion
// -----------------------------------------------------------
if (isset($_POST['pwd'], $_POST['username']) && $_POST['pwd'] != NULL && $_POST['username']) {
    // action de connection

    $pwd = $_POST['pwd'];
    $username = htmlspecialchars($_POST['username']);
    
    //----------------------------------------------------------------------------
    //                 méthode 2 
    //----------------------------------------------------------------------------
   $donnees = req_mail($bdd,$username);
   $user = $donnees[0];
   $compte = $donnees[1];

    if ($compte != 0) {
        if (password_verify($pwd, $user['mdp_client'])) {
            $_SESSION['id_client'] = $user['identifiant_client'];

            if (isset($_GET['ins']) && $_GET['ins'] != NULL)  {
                ?>
                <script>
                    // force le rechargement de la page
                    window.location.assign("index.php?page=6&ins=1");
                </script>
                <?php
            }
            else {
            ?>
            <script>
                // force le rechargement de la page
                window.location.assign("index.php?page=6");
            </script>
            <?php
            }
            // teste si un panier a été créer. Si oui update l'id_client 
            update_panier_si_existe($bdd,$user);
        }
        else {
            $texte_page_courante = '<p style="color: red;">Identifiant ou mot de passe incorrecte</p>';
        }
    }
    else {
        $texte_page_courante = '<p style="color: red;">Utilisateur inconnu</p>';
    }

} 
else {
    // action pas de connection
}


?>