<?php
include('controler/traitement_plan.php');
?>
<div class="container">
    <div class="row">
        <h1 class="text-center col-12">Plan du site</h1>
        <div class="col-10 offset-2 my-5 ">
        <ul>
            <li> 
                <h2>Accueil</h2> 
                <ul>
                    <li>
                        <h3>Tous nos produits</h3>
                        <ul>
                            <?php
                               echo  $liste_cat;
                            ?>
                        </ul>
                    </li>
                    <li><a href="index.php?page=9">Services</a></li>
                    <li><a href="index.php?page=6">Mon compte</a></li>
                    <li><a href="index.php?page=4">Contact</a></li>
                </ul>
            </li>
            <li>
                <h2>Services</h2>
                <ul>
                    <li><a href="index.php?page=13">Ateliers</a></li>
                    <li><a href="index.php?page=9#1pro">Offre pro</a></li>
                    <li><a href="index.php?page=9#4mes">Confection sur mesure</a></li>
                    <li><a href="index.php?page=8">Tutoriels</a></li>
                    <li><a href="index.php?page=9#2fid">Programme de fidélité</a></li>
                    <li><a href="index.php?page=9#3cad">Carte cadeau</a></li>
                </ul>
            </li>
            <li>
                <h2>A propos</h2>
                <ul>
                    <li><a href="index.php?page=7">A propos de nous</a></li>
                    <li><a href="index.php?page=11">Nos magasins</a></li>
                    <li><a href="index.php?page=5#1vente">Conditions générales de vente</a></li>
                    <li><a href="index.php?page=5#2perso">Politique de protection des données personnelles</a></li>
                    <li><a href="index.php?page=5#3legal">Mentions légales</a></li>
                    <li><a href="index.php?page=5#4cooki">Confidentialité et cookies</a></li>
                </ul>
            </li>
            <li>
                <h2>Mon compte</h2>
                <ul>
                    <li><a href="index.php?page=62">Mon panier</a></li>
                    <li><a href="index.php?page=2&fav=1">Mes favoris</a></li>
                    <li><a href="index.php?page=6"></a>Mes commendes</li>
                    <li><a href="index.php?page=6">Mon compte</a></li>
                    <li><a href="index.php?page=12">FAQ</a></li>
                </ul>
            </li>
        </ul>
        </div>
    </div>
</div>