<?php

if (isset($_GET['cas']) && $_GET['cas'] != NULL) {
    $cas = intval($_GET['cas']);

    if ($cas == 1) {
        // inscription
        echo '
        <div class="row">
            <div class="offset-lg-2 col-lg-8 text-center my-5">
                <h2>Votre compte a été correctement créé.</h2>
                <h1 class="my-5">Bienvenue sur Étoffe en ligne</h1>
                <div class="mt-3">
                    <a class="btn btn-primary m-5" href="index.php?page=6" role="button" >Vers votre page client</a>
                    <a class="btn btn-primary m-5" href="index.php?page=1" role="button">Retour vers l\'accueil</a>
                </div>
            </div>
        </div>
        ';
    }
    elseif ($cas == 2) {
        // inscription atelier
        echo '
        <div class="container my-5 text-center">
            <div class="row">
                <h1>Inscription à un atelier</h1>
                <h2 class="my-5">Votre inscription a été réalisé avec sucé.<br> Rendez-vous bientôt. Nous vous attendons avec impatience.</h2>
                <div class="mt-3">
                    <a class="btn btn-primary m-5" href="index.php?page=6" role="button" >Vers votre page client</a>
                    <a class="btn btn-primary m-5" href="index.php?page=1" role="button">Retour vers l\'accueil</a>
                </div>
            </div>
        </div>
        ';
    }
    elseif ($cas == 3) {
        // contact
        echo '
        <div class="container h-100">
            <div class="row my-5">
                <h1 class=" text-center my-5">Contactez-Nous</h1>
                <div class="offset-1 col-10 text-center">
                    <h2>Votre message a été envoyé avec succès. Notre équipe traitera votre demande dans les plus brefs délais. <br> Merci de nous avoir contactés.</h2>
                    <a href="index.php?page=1" class="btn btn-primary m-5">Retourner à l\'accueil</a>
                </div>
            </div>
        </div>
        ';
    }
    elseif ($cas == 4) {
        //mdp oublier
        echo '
        <div class="row text-center">
            <h1 class="mt-5">Mot de passe oublié</h1>
            <div class=" my-5">
                <h2>Un liens pour réinitialiser votre mot de passe vient d\'être envoyé sur votre boite mail. Il sera valide 30 minutes.</h2>
                <a href="index.php?page=1" class="btn btn-primary m-5">Retourner à l\'accueil</a>
            </div>
        </div>
        ';
    }
    elseif ($cas == 5) {
        // réinitialise mdp
        echo '
        <div class="row text-center">
            <h1 class="mt-5">Réinitialisation du mot de passe</h1>
            <div class=" my-5">
                <h2>Votre mot de passe à été réinitialisé. Vous pouvez maintenant vous connecter.</h2>
                <a href="index.php?page=1" class="btn btn-primary m-5">Retourner à l\'accueil</a>
                <a href="index.php?page=6" class="btn btn-primary m-5">Connexion</a>
            </div>
            
        </div>
        ';
    }
    elseif ($cas == 6) {
        // inscription
        echo '
        <div class="row">
            <div class="offset-lg-2 col-lg-8 text-center my-5">
                <h1>Vos données ont été correctement modifiées</h1>
                <div class="mt-3">
                    <a class="btn btn-primary m-5" href="index.php?page=6" role="button" >Vers votre page client</a>
                    <a class="btn btn-primary m-5" href="index.php?page=1" role="button">Retour vers l\'accueil</a>
                </div>
            </div>
        </div>
        ';
    }
}

?>