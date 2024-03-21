
<?php
    include('controler/traitement_connexion_clients.php');

    // si utilisateur non connecté
    if (!isset($_SESSION['id_client'])) { 
?>

<div class="row ">
    <form action="#" method="post" class="py-3 mb-5 text-center col-lg-4 offset-lg-2" autocomplete="off">
        <h1 class=" pt-5">Connexion</h1>
        <?php echo $texte_page_courante; ?>
        <div class="mb-3 form-floating">
            <input type="text" name="username" placeholder="" id="floatingInput" class="form-control ">
            <label for="floatingInput">Adresse e-mail</label>
        </div>
        <div class="mb-3 form-floating">
            <input type="password" name="pwd" placeholder="" id="floatingPassword" class="form-control ">
            <label for="floatingPassword">Mot de passe</label>
            <small class="form-text text-muted"><a class="btn btn-link" href="index.php?page=600" role="button" >Mot de passe oublier?</a></small>
        </div>
        <div class="mb-3">
            <input type="submit" value="Connexion" class="btn btn-primary">
        </div>
    </form>
    <div class="text-center col-lg-4 py-3 mb-5">
        <h1 class=" pt-5">Pas encore client?</h1>
        <a class="btn btn-primary" href="index.php?page=61" role="button">Créer un compte</a>
    </div>
</div>

<?php 
    }
    // si utilisateur connecté
    else {
        if (isset($_GET['ins']) && $_GET['ins'] != NULL) {
            ?>
            <script>window.location.assign("index.php?page=13");</script>
            <?php
        }
        else {
            // include_once('vue/vue_page_client.php');
            ?>
            <script>window.location.assign("index.php?page=610");</script>
            <?php
        }
    }
?>