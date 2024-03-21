<?php
$mdp_taille_mini = 5;
$update = 0;

if (isset($_GET['c']) && $_GET['c'] != NULL) {
    // récupération des données pour préremplir le formulaire pour une update
    $id_client = htmlspecialchars($_GET['c']);

    $client = req_clients($bdd, $id_client);

    $message_page_courante = '<h1>Modifier vos informations</h1>';
    $username_client = $client['username_client'];
    $nom_client = $client['nom_client'];
    $prenom_client = $client['prenom_client'];
    $mail_client = $client['mail_client'];
    $tel_client = $client['tel_client'];
    $mdp_client = '';
    $mdp_check = '';

    if (isset($_GET['ad']) && $_GET['ad'] != NULL) {
        $test = htmlspecialchars($_GET['ad']);

        if ($test != 0) {
            $donnees = req_adresse($bdd,$test);
    
            $rue_client = $donnees['rue_client'];
            $code_p_client = $donnees['code_p_client'];
            $ville_client = $donnees['ville_client'];
            $pays_client = $donnees['pays_client'];
            $complement_adresse_client = $donnees['complement_adresse_client'];
        }
        else {
            $rue_client = '';
            $code_p_client = '';
            $ville_client = '';
            $pays_client = '';
            $complement_adresse_client = ''; 
        }
    }
}
else {

    $message_page_courante = '<h1>Formulaire d\'inscription</h1>';

    $username_client = '';
    $nom_client = '';
    $prenom_client = '';
    $mail_client = '';
    $mdp_client = '';
    $mdp_check = '';

    $rue_client = '';
    $code_p_client = '';
    $ville_client = '';
    $pays_client = '';
    $complement_adresse_client = '';
    $tel_client = '';
}

//---------------------------------------------------------------
//                 traitement de l'inscription
//---------------------------------------------------------------
if (isset($_POST['username_client'],
          $_POST['nom_client'],
          $_POST['prenom_client'],
          $_POST['mail_client'],
          $_POST['tel_client'],
          $_POST['mdp_client'],
          $_POST['mdp_check'],
          $_POST['rue_client'],
          $_POST['code_p_client'],
          $_POST['ville_client'],
          $_POST['pays_client'],
) 
&& $_POST['username_client'] != NULL 
&& $_POST['nom_client'] != NULL 
&& $_POST['prenom_client'] != NULL 
&& $_POST['mail_client'] != NULL 
&& $_POST['tel_client'] != NULL 
&& $_POST['mdp_client'] != NULL 
&& $_POST['mdp_check'] != NULL 
&& $_POST['rue_client'] != NULL 
&& $_POST['code_p_client'] != NULL 
&& $_POST['ville_client'] != NULL 
&& $_POST['pays_client'] != NULL 
) {
    $identifiant_client = time(); // ajouter un test pour voir si unique

    $username_client = htmlspecialchars($_POST['username_client']);
    $nom_client = htmlspecialchars($_POST['nom_client']);
    $prenom_client = htmlspecialchars($_POST['prenom_client']);
    $mail_client = htmlspecialchars($_POST['mail_client']);
    $tel_client = htmlspecialchars($_POST['tel_client']);
    $mdp_client = $_POST['mdp_client']; //
    $mdp_check = $_POST['mdp_check'];
    $rue_client = htmlspecialchars($_POST['rue_client']);
    $code_p_client = htmlspecialchars($_POST['code_p_client']);
    $ville_client = htmlspecialchars($_POST['ville_client']);
    $pays_client = htmlspecialchars($_POST['pays_client']);

    // complement d'adresse facultatif
    if (isset($_POST['complement_adresse_client']) && $_POST['complement_adresse_client'] != NULL) {
        $complement_adresse_client = htmlspecialchars($_POST['complement_adresse_client']);
    }
    else {
        $complement_adresse_client = '';
    }

    //-----------------------
    //        update
    //-----------------------
    if (isset($_GET['c']) && $_GET['c'] != NULL) {
        // test mdp
        if (password_verify($mdp_client, $client['mdp_client']) && $mdp_client == $mdp_check) {

            req_maj_client($bdd,$username_client,$nom_client,$prenom_client,$mail_client,$tel_client,$id_client,$test,$rue_client,$code_p_client,$ville_client,$pays_client,$complement_adresse_client);
    
            $message_page_courante = '<h1>Vos données ont été correctement modifiées</h1>';
            $update = 1;
        }
        else {
            $message_page_courante = '<h1>Mot de passe incorrecte</h1>';
        }
    }
    else {
        //-----------------------
        //        insert
        //-----------------------
        // tester si username_client est unique. peut faire la même chose avec adresse mail
        $test_username = req_mail($bdd,$mail_client);
    
        if (!isset($test_username[0]['mail_client'])) {
    
            // tester le mdp et le traiter si ok passe à la suite
            $mdp_hash = password_hash($mdp_client, PASSWORD_DEFAULT );
    
            if ($mdp_client == $mdp_check 
             && $mdp_client >= $mdp_taille_mini
             && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $mdp_client) 
             ) {
                $id_client = req_inscription_client($bdd,$identifiant_client,$username_client,$nom_client,$prenom_client,$mail_client,$tel_client,$mdp_hash,$rue_client,$code_p_client,$ville_client,$pays_client,$complement_adresse_client);
    
                $message_page_courante = '<h1>Votre compte a été correctement créé.<br> Bienvenue sur Étoffe en ligne</h1>';
                // connecté si viens de s'inscrire
                $_SESSION['id_client'] = $identifiant_client;
    
                // teste si un panier a été créer. Si oui update l'id_client 
                update_panier_si_existe($bdd,$id_client);
            }
            else {
                $message_page_courante = '<h1>Vous devez entrer deux fois le même mot de passe.</h1>';
            }
        }
        else {
            $message_page_courante = '<h1>Un compte pour cette adresse mail existe déjà. Veuillez en choisir une autre ou vous connecter.</h1>';
            // $message_page_courante = '<h1>Cet identifiant existe déjà. Veuillez en choisir un autre.</h1>';
        }
    }

}
?>