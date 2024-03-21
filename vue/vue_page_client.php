<?php 
    include('controler/traitement_page_client.php');
    // $points = 500; 
?>


<div class="container-fluid">
    <div class="row">
        <nav class="col-lg-3 col-md-6">
            <!-- navigation -->
            <ul class="nav_client py-5">
                <li class="mb-5"><a href="index.php?page=6"><img src="public/assets/img/icones/user.png" alt="" class="img-fluid icones m-2">Mon compte</a></li>
                <li><a href="index.php?page=6#cc_info"><img src="public/assets/img/icones/client.png" alt="" class="img-fluid icones m-2">Mes informations personnelles</a></li>
                <li><a href="index.php?page=2&fav=1"><img src="public/assets/img/icones/coeur.png" alt="" class="img-fluid icones m-2">Mes favoris</a></li>
                <li><a href="index.php?page=6#cc_adresses"><img src="public/assets/img/icones/maison.png" alt="" class="img-fluid icones m-2">Mes Adresses</a></li>
                <li><a href="index.php?page=6#cc_payement"><img src="public/assets/img/icones/credit-cards.png" alt="" class="img-fluid icones m-2">Mon mode de payement</a></li>
                <li><a href="index.php?page=6#cc_commandes"><img src="public/assets/img/icones/box.png" alt="" class="img-fluid icones m-2">Mes commandes</a></li>
                <li><a href="index.php?page=6#cc_atelier"><img src="public/assets/img/icones/fils.png" alt="" class="img-fluid icones m-2">Mes inscriptions aux ateliers</a></li>
                <!-- <li><a href="index.php?page=6#cc_fidele"><img src="public/assets/img/icones/5-stars.png" alt="" class="img-fluid icones m-2">Mon programme de fidélité</a></li> -->
                <li class="mt-5"><a href="index.php?page=60&dis=1"><img src="public/assets/img/icones/deco.png" alt="" class="img-fluid icones m-2">déconnexion</a></li>
            </ul>
        </nav>
        <section class=" col-lg-9 col-md-6 text-center text-md-start">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="">Bienvenus <?php echo $donnees['prenom_client'].' '.$donnees['nom_client']; ?></h1>
                    <p>Depuis votre compte client, vous pouvez avoir un aperçu de vos récentes activités et mettre à jour les informations de votre compte.</p>
                </div>
                <!-- encart contact -->
                <aside class="offset-1 offet-lg-0 col-10 col-lg-3 text-center">
                    <h2 class="my-5">Une question ? </h2>
                    <a href="index.php?page=4" class="btn btn-primary">Contactez nous</a>
                    <p class=" my-3">
                        Vous pouvez aussi consulter notre <a href="index.php?page=12">FAQ</a> <br>ou nous appeler au 01 23 45 67 89.
                    </p>
                </aside>
                <!-- infos du compte -->
                <div class="col-12 mt-5">
                    <div class="row">
                        <h3 id="cc_info">Information du compte</h3>
                        <div class="col-lg-4 mb-3">
                            Nom : <?php echo $donnees['nom_client']; ?>
                        </div>
                        <div class="col-lg-8 mb-3">
                            Prénom : <?php echo $donnees['prenom_client']; ?>
                        </div>
                        <div class="col-lg-12 mb-3">
                            Téléphone : <?php echo $donnees['tel_client']; ?>
                        </div>
                        <div class="col-lg-4 mb-3">
                             Mail : <?php echo $donnees['mail_client']; ?>
                            </div>
                        <div class="col-lg-8 mb-3">
                            <a href="index.php?page=61&c=<?php echo $donnees['id_client'] ?>&ad=1" class="btn btn-primary">Modifier mes informations personnelles</a>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <a href="index.php?page=600" class="btn btn-primary">Modifier le mot de passe</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <section class="offset-md-1 col-md-10 offset-lg-3 col-lg-9 text-center text-md-start">
            <div class="row">
                <!-- --------- -->
                <h3 id="cc_adresses">Mes adresses</h3>
                <div class="col-md-3 col-lg-3 mb-3">
                    Adresse de livraison :
                </div>
                <div class="col-md-9 col-lg-9 mb-3 text-end">
                    <a href="index.php?page=61&c=<?php echo $donnees['id_client'] ?>&ad=0" class="btn btn-primary">Ajouter une adresse de livraison</a>
                </div>
                <?php
                    echo $adresse_livraison;
                ?>
                <div class="col-md-12 col-lg-12 mb-3">
                    Adresse de facturation :
                </div>
                <?php
                    echo $adresse_facturation;
                ?>
                <!-- --------- -->
                <h3 id="cc_payement">Mon mode de payement</h3>
                <div class="col-md-6 col-lg-4 mb-5">
                    carte bleu : XXXXXXXXXX54 
                </div>
                <div class="col-md-6 col-lg-4 mb-5">
                    <a href="" class="btn btn-primary">Modifier</a>
                </div>
                <!-- --------- -->
                
            </div>
        </section>
        <section class="offset-lg-3 col-lg-9">
            <h3 id="cc_commandes">Mes panniers et commandes</h3>
            <div class="table-responsive col-lg-10">
                <table class=" mb-5 table table-hover table-borderless text-center caption-top">
                    <thead>
                        <caption>Mes paniers</caption>
                        <tr>
                            <th>N° de pannier</th>
                            <th>Date</th>
                            <th>Nombre de produits</th>
                            <th>Montant sans livraison en €</th>
                            <th>Modifier</th>
                            <th>Fusionner avec le panier actuel</th>
                            <th>Passer commande</th>
                            <th>Annuler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo $table;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive col-lg-10">
                <table class="mb-5 table table-hover table-borderless text-center caption-top">
                    <thead class="">
                        <caption>Mes commandes</caption>
                        <tr>
                            <th>N° de commande</th>
                            <th>Date</th>
                            <th>Nombre de produit</th>
                            <th>Montant TTC en €</th>
                            <th>Récapitulatif</th>
                            <th>Paiement</th>
                            <th>Livraison</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                                echo $table3;
                            ?>
                        </tbody>
                </table>
            </div>
            
            
            <!-- --------- -->
            <h3 id="cc_atelier">Mes inscriptions aux ateliers</h3>
            <div class="table-responsive col-lg-10">
                <table class=" mb-5 table table-hover table-borderless text-center ">
                    <thead>
                        <tr>
                            <th>Atelier</th>
                            <th>Date</th>
                            <th>Nombre de place réservé</th>
                            <th>Montant TTC en €</th>
                            <th>Annuler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo $table2;
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- --------- -->
            <!-- <h3 id="cc_fidele">Programme de fidélité</h3>
            <div class="col-6 mb-5">
                Nombre de points cumulé : <?php echo $points; ?>
            </div> -->

        </section>
    </div>
</div>
<script src="public/assets/js/annulation_atelier.js"></script>