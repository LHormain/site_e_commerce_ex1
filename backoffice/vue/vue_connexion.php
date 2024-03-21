<?php
    if (isset($_POST['pwd'], $_POST['username']) && $_POST['pwd'] != NULL && $_POST['username']) {
        // action de connection
        include('controler/traitement_connexion.php');
    }
    else {
        // action pas de connection
?>
        <!-- <div class="row "> -->
            <h1 class="text-center pt-5">Connexion</h1>
            <form action="#" method="post" class="py-3 mb-5 text-center" autocomplete="off">
                <div class="mb-3">
                    <input type="text" name="username" placeholder="nom d'utilisateur">
                </div>
                <div class="mb-3">
                    <input type="password" name="pwd" placeholder="Mot de passe">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Connexion" class="btn btn-primary">
                </div>
            </form>
        <!-- </div> -->
<?php 
    }
?>