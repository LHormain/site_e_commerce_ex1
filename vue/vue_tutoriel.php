<?php
include('controler/traitement_tutoriel.php');
?>

<div class="container">
    <div class="row">
        <div class="">
            <h1 class="text-center my-5">Tutoriels Créatifs</h1>
            <p>
            Découvrez notre collection de tutoriels créatifs pour vous inspirer et vous guider dans vos projets de couture et de décoration. Que vous soyez débutant ou expérimenté, nos experts partagent leur savoir-faire pour vous aider à créer des pièces uniques et magnifiques.
            </p>
            <!-- liste des tutoriels -->
            <section class="row my-5">
                <?php echo $liste; ?>
                <!-- <div class="col-lg-3 p-2">
                    <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Tutoriel de Couture pour Débutants
                    </h2>
                    <p>
                    Apprenez les bases de la couture, des points essentiels aux techniques de couture à la main et à la machine.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Créer des Coussins Décoratifs
                    </h2>
                    <p>
                    Suivez notre guide pour confectionner des coussins élégants et personnalisés pour votre maison.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Robes d'Été DIY
                    </h2>
                    <p>
                    Créez votre garde-robe d'été avec nos tutoriels sur la confection de robes légères et estivales.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Customisation de Vêtements
                    </h2>
                    <p>
                    Donnez une nouvelle vie à vos vêtements en les personnalisant avec des broderies, des appliqués et plus encore.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Projets de Décoration de Noël 
                    </h2>
                    <p>
                    Préparez-vous pour les fêtes en réalisant des projets de décoration de Noël, y compris des ornements et des bas de Noël.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Accessoires Faits Main 
                    </h2>
                    <p>
                    Créez des accessoires uniques tels que des sacs, des chapeaux et des écharpes avec nos tutoriels.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Rideaux et Nappes Sur-Mesure
                    </h2>
                    <p>
                    Apprenez à mesurer, couper et coudre des rideaux et des nappes sur mesure pour votre maison.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Couture pour Enfants 
                    </h2>
                    <p>
                    Réalisez des vêtements et des accessoires adorables pour les plus jeunes avec nos tutoriels adaptés aux enfants.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Techniques de Broderie
                    </h2>
                    <p>
                    Explorez les techniques de broderie, y compris la broderie à la main et à la machine, pour ajouter des détails créatifs à vos projets.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div>
                <div class="col-lg-3 p-2">
                <iframe sandbox="allow-scripts allow-same-origin" width="250" height="125" src="https://www.youtube.com/embed/yUmat8fkhyU" title="Tuto : coudre un joli sac de voyage" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
                </div>
                <div class="col-lg-9 p-2 ">
                    <h2>
                    Confection de Masques Faits Main
                    </h2>
                    <p>
                    Apprenez à confectionner des masques en tissu avec nos tutoriels, parfaits pour rester en sécurité tout en ajoutant une touche de style.
                    </p>
                    <a href="index.php?page=15&id=1" class="btn btn-primary">Voir plus</a>
                </div> -->
                </section>
            <p>
            Ces tutoriels sont conçus pour vous aider à développer vos compétences en couture et en création, et à vous inspirer à réaliser des projets uniques. Suivez nos guides étape par étape pour donner vie à vos idées créatives.
            </p>
        </div>
    </div>
</div>