<?php 

    include('controler/traitement_accueil.php');
?>
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<!--                                                   slider principal                                                            -->
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<section id="carouselAccueil" class="carousel carousel-dark slide text-end" data-bs-ride="carousel">
    <div class="carousel-indicators ">
        <?php
            echo $carousel_indicators;
        ?>
        
    </div>
    <div class="carousel-inner ">
        <?php
            echo $carousel_inner;
        ?>
        
    </div>
    <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#carouselAccueil" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true">
            <img src="public/assets/img/site/fleche-gauche-dans-un-cercle.png" alt="" class="img-fluid w-100 control_img">
        </span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#carouselAccueil" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true">
            <img src="public/assets/img/site/fleche-gauche-dans-un-cercle.png" alt="" class="img-fluid w-100 control_img">

        </span>
        <span class="visually-hidden">Next</span>
    </button>
    
</section>

<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<!--                                          cards catégories                                                                     -->
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<div class="container">
    
    <section class="row mt-5 justify-content-center">
        <?php  
            echo $cards_categories;
        
        ?>
        
    </section>
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <!--                                                         nouveautés                                                            -->
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <section class="row">
        <div class="col-lg-12 mt-5 d-flex justify-content-between">
            <h1 class="d-inline">
                Nouveautés 
            </h1>
            <a href="index.php?page=2&promo=2" class="btn btn-primary align-self-center text-nowrap">Voir plus</a>
        </div>
        <div class="row flex-lg-nowrap align-items-stretch">
            <?php
                echo $cards_nouveaux;
            ?>
            
        </div>
    </section>
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <!--                                                promo saisonnières                                                             -->
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <section class="row bg-primary justify-content-center">
        <div class=" col-10 my-5 promo p-5 position-relative">
            <div class="promo_texte position-relative p-3">
                <?php
                    echo $texte_jumbotron;
                ?>
                <div class="text-center ">
                        <a href="index.php?page=2&promo=1" class="btn btn-primary position-relative top-100">Découvrir</a>
                </div>
            </div>
            <div class=" promo_img position-absolute top-0 start-0 d-flex justify-content-evenly align-items-center flex-column flex-lg-row w-100 h-100">
                <?php
                    echo $image_jumbotron;
                ?>
            </div>
        </div>
        <!-- tissus pour la promo saisonnière -->
        <div class="row flex-lg-nowrap align-items-stretch">
            <?php
                echo $cards_promo;
            ?>
            
        </div>
    </section>
    <!-- <section class="row"> -->
        <!-- <div class="col-lg-12 mt-5 d-flex justify-content-between">
            <h1 class="d-inline">
                Aperçu  
            </h1>
            <a href="index.php?page=2&promo=1" class="btn btn-primary align-self-center text-nowrap">Voir plus</a>
        </div> -->
    <!-- </section> -->
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <!--                                              offre atelier couture                                                            -->
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <section class="row">
        <div class="offset-1 col-10 atelier my-5 p-5 position-relative ">
            <div class="row">
                <div class="atelier_text col-12">
                    <h1 class="text-center">Ateliers de couture et de confection </h1>
                    <p>
                        Plongez dans le monde captivant de la couture et de la confection avec nos ateliers ÉtoffeCréation. Que vous soyez novice ou que vous ayez déjà des compétences en couture, nos ateliers sont conçus pour vous guider à travers l'univers varié des tissus et des techniques, tout en stimulant votre créativité.
                    </p>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 atelier_text">
                            <h2 class="text-center">Maîtrisez les Techniques de Confection</h2>
                            <p>
                                De la coupe minutieuse aux points de couture sophistiqués, nos experts en couture vous guideront à travers les techniques fondamentales et avancées de la confection. Apprenez à coudre des ourlets parfaits, à créer des plis élégants et à insérer des fermetures éclair en toute confiance. Qu'il s'agisse de vêtements, d'accessoires ou de pièces décoratives, nous vous aiderons à donner vie à vos idées avec précision et flair.
                            </p>
                        </div>
                        <div class="col-md-6 d-flex align-items-centers justify-content-center p-lg-3  p-md-4 atelier_text">
                            <img src="public/assets/img/site/cours.jpg" alt="" class="img-fluid atelier_img position-relative">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-centers justify-content-center p-lg-3 p-md-4 atelier_text">
                            <img src="public/assets/img/site/cart.jpg" alt="" class="img-fluid atelier_img position-relative">
                        </div>
                        <div class="col-md-6 atelier_text">
                            <h2 class="text-center">Créez Vos Propres Chef-d'œuvre</h2>
                            <p>
                                Nos ateliers ne se contentent pas de vous enseigner des compétences, ils vous encouragent à donner libre cours à votre créativité. Guidé par nos experts en couture expérimentés, vous aurez l'opportunité de concevoir et de créer vos propres pièces uniques. Que vous rêviez de robes élégantes, de sacs à main tendance ou d'éléments de décoration personnalisés, nous vous fournirons les compétences et l'inspiration nécessaires pour réaliser vos projets les plus ambitieux.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <p class="atelier_text col-12 mb-lg-0">Inscrivez-vous dès aujourd'hui et laissez vos idées prendre forme entre vos mains expertes. Ensemble, explorons les possibilités infinies des tissus et créons des pièces qui racontent votre histoire unique à travers le fil et l'aiguille.</p>
                        <div class="text-center atelier_text col-12 mb-lg-3">
                            <a href="index.php?page=13" class="btn btn-primary position-relative top-50">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="position-absolute col-12 promo_img top-0 start-0 ">
                    <div class="d-lg-flex justify-content-evenly align-items-center d-none">
                        <img src="public/assets/img/site/tissu-jacquard.jpg" alt="" class="img-fluid ">
                        <img src="public/assets/img/site/tissu-jacquard.jpg" alt="" class="img-fluid ">
                        <img src="public/assets/img/site/tissu-jacquard.jpg" alt="" class="img-fluid ">
                    </div>
                    <div class="d-lg-flex justify-content-evenly align-items-center d-none ">
                        <img src="public/assets/img/site/tissu-jacquard.jpg" alt="" class="img-fluid ">
                        <img src="public/assets/img/site/tissu-jacquard.jpg" alt="" class="img-fluid ">
                        <img src="public/assets/img/site/tissu-jacquard.jpg" alt="" class="img-fluid ">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <!--                                                   portfolio                                                                   -->
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <section class="row portfolio_img mb-lg-5 align-items-stretch">
        <h1 class="col-12 text-center my-lg-5 my-md-3">Les tutos Tissus en ligne </h1>
        <div class="col-lg-4 col-md-6 mb-md-3 mb-lg-0 ">
            <div class="row ">
                <div class="col-lg-12 mb-md-3 position-relative ">
                    <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio1">Decouvrir</a>
                    <h3 class="text-center position-absolute top-0 start-0 m-5 p-3 "><?php echo $portfolio[0]['titre_tutoriel'] ?></h3>
                    <!-- <h3 class="text-center position-absolute top-0 start-0 m-5 p-3 ">Sac à main</h3> -->
                    <img src="public/assets/img/site/<?php echo $portfolio[0]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                    <!-- <img src="public/assets/img/site/2023-08-08_15-00-07_UTC_6.jpg" alt="" class="img-fluid w-100 h-100"> -->
                </div>
                <div class="col-lg-12 position-relative">
                    <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio2">Decouvrir</a>
                    <h3 class="text-center position-absolute top-0 end-0 m-5 p-3 "><?php echo $portfolio[1]['titre_tutoriel'] ?></h3>
                    <!-- <h3 class="text-center position-absolute top-0 end-0 m-5 p-3 ">Coussin décoratif</h3> -->
                    <img src="public/assets/img/site/<?php echo $portfolio[1]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
                    <!-- <img src="public/assets/img/site/310702_2.jpg" alt="" class="img-fluid "> -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 position-relative mb-md-3 mb-lg-0 ">
            <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio3">Decouvrir</a>
            <h3 class="text-center position-absolute top-0 end-0 m-5 p-3 "><?php echo $portfolio[2]['titre_tutoriel'] ?></h3>
            <!-- <h3 class="text-center position-absolute top-0 end-0 m-5 p-3 ">Robe d'été</h3> -->
            <img src="public/assets/img/site/<?php echo $portfolio[2]['nom_img_site'] ?>" alt="" class="img-fluid h-100">
            <!-- <img src="public/assets/img/site/1692265258-style-colore.jpg" alt="" class="img-fluid "> -->
        </div>
        <div class="col-lg-4 pb-lg-0 align-self-center ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-md-3 ">
                        <div class="col-md-6 position-relative">
                            <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio4" >Decouvrir</a>
                            <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 "><?php echo $portfolio[3]['titre_tutoriel'] ?></h3>
                            <!-- <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 ">Cartable enfant</h3> -->
                            <img src="public/assets/img/site/<?php echo $portfolio[3]['nom_img_site'] ?>" alt="" class="img-fluid ">
                            <!-- <img src="public/assets/img/site/cart.jpg" alt="" class="img-fluid "> -->
                        </div>
                        <div class="col-md-6 position-relative">
                            <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio5">Decouvrir</a>
                            <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 "><?php echo $portfolio[4]['titre_tutoriel'] ?></h3>
                            <!-- <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 ">Écharpes</h3> -->
                            <img src="public/assets/img/site/<?php echo $portfolio[4]['nom_img_site'] ?>" alt="" class="img-fluid ">
                            <!-- <img src="public/assets/img/site/cart2.jpg" alt="" class="img-fluid "> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-md-3 position-relative">
                    <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio6">Decouvrir</a>
                    <h3 class="text-center position-absolute top-0 start-0 m-5 p-3 "><?php echo $portfolio[5]['titre_tutoriel'] ?></h3>
                    <!-- <h3 class="text-center position-absolute top-0 start-0 m-5 p-3 ">Robe portefeuille</h3> -->
                    <img src="public/assets/img/site/<?php echo $portfolio[5]['nom_img_site'] ?>" alt="" class="img-fluid w-100">
                    <!-- <img src="public/assets/img/site/1692269656-esprit.jpg" alt="" class="img-fluid "> -->
                </div>
                <div class="col-lg-12 mb-md-3 mb-lg-0">
                    <div class="row ">
                            <div class="col-md-6 position-relative">
                                <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio7">Decouvrir</a>
                                <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 "><?php echo $portfolio[6]['titre_tutoriel'] ?></h3>
                                <!-- <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 ">Veste matelassé</h3> -->
                                <img src="public/assets/img/site/<?php echo $portfolio[6]['nom_img_site'] ?>" alt="" class="img-fluid ">
                                <!-- <img src="public/assets/img/site/matelasse_2_2.jpg" alt="" class="img-fluid "> -->
                            </div>
                            <div class="col-md-6 position-relative">
                                <a href="index.php?page=8&tuto=" class="btn btn-primary position-absolute bottom-0 end-0 m-5 btn-porfolio8">Decouvrir</a>
                                <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 "><?php echo $portfolio[7]['titre_tutoriel'] ?></h3>
                                <!-- <h3 class="text-center position-absolute top-0 start-0 m-3 p-3 ">Chemise en soie</h3> -->
                                <img src="public/assets/img/site/<?php echo $portfolio[7]['nom_img_site'] ?>" alt="" class="img-fluid ">
                                <!-- <img src="public/assets/img/site/nouvelle_co_2.jpg" alt="" class="img-fluid "> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <!--                                              reassurance                                                                      -->
    <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    <section class="row justify-content-center mb-5 bandeau_promo py-3 mx-0">
        <a href="index.php?page=14" class="col-lg-2 text-center col-8 col-md-4 my-2 my-lg-0">
            <div class="d-flex justify-content-center align-items-center flex-column card-reassurance p-5">
                <img src="public/assets/img/icones/box.png" class="img-fluid rounded-top icones" alt="">
                <h4 class="text-center">Livraison gratuite</h4>
                <p >En retrait magasin</p>
            </div>
        </a>

        <a href="index.php?page=12" class="col-lg-2 text-center col-8 col-md-4 my-2 my-lg-0">
            <div class="d-flex justify-content-center align-items-center flex-column card-reassurance p-5">
                <img src="public/assets/img/icones/credit-cards.png" class="img-fluid rounded-top icones" alt="">
                <h4 class="text-center">Payement</h4>
                <p >100% sécurisé</p>
            </div>
        </a>

        <a href="index.php?page=14" class="col-lg-2 text-center col-8 col-md-4 my-2 my-lg-0">
            <div class="d-flex justify-content-center align-items-center flex-column card-reassurance p-5">
                <img src="public/assets/img/icones/camion.png" class="img-fluid rounded-top icones" alt="">
                <h4 class="text-center">Livraison offerte </h4>
                <p >Pour toutes commandes supérieure à 50 € </p>
            </div>
        </a>

        <a href="index.php?page=12" class="col-lg-2 text-center col-8 col-md-4 my-2 my-lg-0">
            <div class="d-flex justify-content-center align-items-center flex-column card-reassurance p-5">
                <img src="public/assets/img/icones/service-client.png" class="img-fluid rounded-top icones" alt="">
                <h4 class="text-center">Des conseillers</h4>
                <p >à votre service</p>
            </div>
        </a>

        <!-- <a href="index.php?page=" class="col-lg-2 text-center col-8 col-md-4 my-2 my-lg-0">
            <div class="d-flex justify-content-center align-items-center flex-column card-reassurance p-5">
                <img src="public/assets/img/icones/5-stars.png" class="img-fluid rounded-top icones" alt="">
                <h4 class="text-center">Ils nous recommandent</h4>
                <p >Lire les avis clients</p>
            </div>
        </a> -->
    </section>
</div>


<script src="public/assets/js/add_favoris.js"></script>