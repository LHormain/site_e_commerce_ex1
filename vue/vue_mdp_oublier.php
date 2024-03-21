<?php
include('controler/traitement_mdp_oublier.php');
?>

<div class="row ">
    <h2 class="text-center">Mot de passe oublié</h2>

    <?php 
    if (!(isset($_POST['mail']) && $_POST['mail'] != NULL)) {

    ?>
    <form action="" method="post" class="my-5 text-center offset-4 col-4">
        <div class="mb-3 text-start">
            <label for="mail" class="form-label">Entrez votre adresse e-mail</label>
            <input type="email"
            class="form-control" name="mail" id="mail" aria-describedby="helpId" placeholder="">
            <small id="helpId" class="form-text text-muted">Entrez une adresse e-mail valide</small>
        </div>
        <input type="submit" value="Envoyer" class="btn btn-primary">
    </form>
    <?php
    }
    else {
        // echo $message;
        ?>
        <script>window.location.assign("index.php?page=602&cas=4");</script>
        <?php
    }
    ?>
</div>
