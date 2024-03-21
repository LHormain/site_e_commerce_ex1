<?php
if (isset( $_GET['page']) 
&& $_GET['page'] != NULL) {
    $page = $_GET['page'];
}
else {
    $page = 1;
}
if (isset($_GET['c']) 
&& $_GET['c'] != NULL) {
    $c = $_GET['c'];
}
else { 
    $c = 1;
}
?>
<nav class="col-2 bg-dark ">
    <?php
        if ($page == 1 || !isset($page)) {
            ?>
            <a  class="btn btn-info my-3" href="index.php?page=1" role="button">Accueil</a>
            <?php
        }
        else {
            ?>
            <a  class="btn btn-primary my-3" href="index.php?page=1" role="button">Accueil</a>
            <?php
        }
    ?>
    <div class="accordion accordion-flush" id="accordionNavBackOffice">
        <hr>
        <!-- ---------------------------------------------------------------------------------- -->
        <!--                                      Produits                                      -->
        <!-- ---------------------------------------------------------------------------------- -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <?php 
                    if (in_array($page, [3,31,32,33])) {
                        ?>
                        <button class="accordion-button bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                        <?php
                    }
                    else {
                        ?>
                        <button class="accordion-button bg-dark collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                        <?php
                    }
                ?>
                    Produits
                </button>
            </h2>
            <?php 
                if (in_array($page, [3,31,32,33])) {
                    ?>
                    <div id="flush-collapseOne" class="accordion-collapse bg-dark collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionNavBackOffice">
                    <?php
                }
                else {
                    ?>
                    <div id="flush-collapseOne" class="accordion-collapse bg-dark collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionNavBackOffice">
                    <?php
                }
            ?>
                <div class="accordion-body d-flex flex-column">
                    <?php
                        if ($page == 31) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=31" role="button">Catégories</a>
                            <?php
                            if ($c == 1) {
                                ?>
                                <a href="index.php?page=31&c=1" class="btn btn-outline-info my-1">Saisie</a>
                                <a href="index.php?page=31&c=2" class="btn btn-outline-primary my-1">Gestion</a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="index.php?page=31&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=31&c=2" class="btn btn-outline-info my-1">Gestion</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=31" role="button">Catégories</a>
                            <?php 
                        }

                    // <!-- --------- -->
                        if ($page == 32) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=32" role="button">Sous catégories</a>
                            <?php
                            if ($c == 1) {
                                ?>
                                <a href="index.php?page=32&c=1" class="btn btn-outline-info my-1">Saisie</a>
                                <a href="index.php?page=32&c=2" class="btn btn-outline-primary my-1">Gestion</a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="index.php?page=32&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=32&c=2" class="btn btn-outline-info my-1">Gestion</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=32" role="button">Sous catégories</a>
                            <?php
                        }
                        // <!-- --------- -->
                        if ($page == 3) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=3" role="button">Produits</a>
                            <?php
                            if ($c == 1) {
                                ?>
                                <a href="index.php?page=3&c=1" class="btn btn-outline-info my-1">Saisie</a>
                                <a href="index.php?page=3&c=3" class="btn btn-outline-primary my-1">Gestion</a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="index.php?page=3&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=3&c=3" class="btn btn-outline-info my-1">Gestion</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=3" role="button">Produits</a>
                            <?php
                        }
                    // <!-- --------- -->
                        if ($page == 33) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=33" role="button">Images produits</a>
                            <?php
                            if ($c == 1) {
                                ?>
                                <button href="index.php?page=33&c=1" class="btn btn-outline-info my-1" disabled>Saisie</button>
                                <a href="index.php?page=33&c=2" class="btn btn-outline-primary my-1">Gestion</a>
                                <?php
                            }
                            else {
                                ?>
                                <button href="index.php?page=33&c=1" class="btn btn-outline-primary my-1" disabled>Saisie</button>
                                <a href="index.php?page=33&c=2" class="btn btn-outline-info my-1">Gestion</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=33" role="button">Images produits</a>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
     <!-- ---------------------------------------------------------------------------------- -->
     <!--                                   Gestion du site                                  -->
     <!-- ---------------------------------------------------------------------------------- -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <?php 
                    if (in_array($page, [4,5,6,12])) {
                        ?>
                        <button class="accordion-button bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                        <?php
                    }
                    else {
                        ?>
                        <button class="accordion-button bg-dark collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                        <?php
                    }
                ?>
                    Gestion du site
                </button>
            </h2>
            <?php 
                    if (in_array($page, [4,5,6,12])) {
                        ?>
                        <div id="flush-collapseTwo" class="accordion-collapse bg-dark collapse show" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionNavBackOffice">
                        <?php
                    }
                    else {
                        ?>
                        <div id="flush-collapseTwo" class="accordion-collapse bg-dark collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionNavBackOffice">
                        <?php
                    }
                ?>
                <div class="accordion-body d-flex flex-column">
                    <?php 
                        if ($page == 4) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=4" role="button">Carousel accueil</a>
                            <?php
                            if ($c == 1) {
                                ?>
                                <a href="index.php?page=4&c=1" class="btn btn-outline-info my-1">Saisie</a>
                                <a href="index.php?page=4&c=2" class="btn btn-outline-primary my-1">Gestion</a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="index.php?page=4&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=4&c=2" class="btn btn-outline-info my-1">Gestion</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=4" role="button">Carousel accueil</a>
                            <?php
                        }
                    //<!-- --------- -->
                        if ($page == 5) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=5" role="button">Jumbotron accueil</a>
                            <?php
                            if ($c == 2) {
                                ?>
                                <a href="index.php?page=5&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=5&c=2" class="btn btn-outline-info my-1">Gestion</a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="index.php?page=5&c=1" class="btn btn-outline-info my-1">Saisie</a>
                                <a href="index.php?page=5&c=2" class="btn btn-outline-primary my-1">Gestion</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=5" role="button">Jumbotron accueil</a>
                            <?php
                        }
                    // <!-- --------- -->
                        if ($page == 6) {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=6" role="button">Tutoriels</a>
                            <?php
                            if ($c == 1) {
                                ?>
                                <a href="index.php?page=6&c=1" class="btn btn-outline-info my-1">Saisie</a>
                                <a href="index.php?page=6&c=2" class="btn btn-outline-primary my-1">Gestion</a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="index.php?page=6&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=6&c=2" class="btn btn-outline-info my-1">Gestion</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=6" role="button">Tutoriels</a>
                            <?php
                        }
                    // <!-- --------- -->
                        if ($page == 12) {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=12" role="button">Ateliers</a>
                            <?php
                            if ($c == 1) {
                                ?>
                                <a href="index.php?page=12&c=1" class="btn btn-outline-info my-1">Saisie</a>
                                <a href="index.php?page=12&c=2" class="btn btn-outline-primary my-1">Gestion des Ateliers</a>
                                <a href="index.php?page=12&c=3" class="btn btn-outline-primary my-1">Gestion des Inscriptions</a>
                                <?php
                            }
                            elseif ($c == 3) {
                                ?>
                                <a href="index.php?page=12&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=12&c=2" class="btn btn-outline-primary my-1">Gestion des Ateliers</a>
                                <a href="index.php?page=12&c=3" class="btn btn-outline-info my-1">Gestion des Inscriptions</a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="index.php?page=12&c=1" class="btn btn-outline-primary my-1">Saisie</a>
                                <a href="index.php?page=12&c=2" class="btn btn-outline-info my-1">Gestion des Ateliers</a>
                                <a href="index.php?page=12&c=3" class="btn btn-outline-primary my-1">Gestion des Inscriptions</a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=12" role="button">Ateliers</a>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    <!-- ---------------------------------------------------------------------------------- -->
    <!--                                     Administratif                                  -->
    <!-- ---------------------------------------------------------------------------------- -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <?php 
                    if (in_array($page, [7,8,9,10,11,91])) {
                        ?>
                        <button class="accordion-button bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
                        <?php
                    }
                    else {
                        ?>
                        <button class="accordion-button bg-dark collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
                        <?php
                    }
                ?>
                    Administratif
                </button>
            </h2>
            <?php 
                    if (in_array($page, [7,8,9,10,11,91])) {
                        ?>
                        <div id="flush-collapseThree" class="accordion-collapse bg-dark collapse show" aria-labelledby="flush-headingThree" data-bs-parent="#accordionNavBackOffice">
                        <?php
                    }
                    else {
                        ?>
                        <div id="flush-collapseThree" class="accordion-collapse bg-dark collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionNavBackOffice">
                        <?php
                    }
                ?>
                <div class="accordion-body d-flex flex-column">
                    <?php 
                        if ($page == 7) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=7" role="button">Clients</a>
                            <?php
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=7" role="button">Clients</a>
                            <?php
                        }
                    // <!-- --------- -->
                        if ($page == 8) {
                        ?>
                        <a  class="btn btn-info my-3" href="index.php?page=8" role="button">Messages</a>
                            <?php 
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=8" role="button">Messages</a>
                            <?php
                        }
                    // ---------------------
                        if ($page == 9) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=9" role="button">Paniers</a>
                            <?php
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=9" role="button">Paniers</a>
                            <?php
                        }
                    // ------------------
                        if ($page == 10) {
                            ?>
                            <a  class="btn btn-info my-3" href="index.php?page=10" role="button">Commandes</a>
                            <?php
                        }
                        else {
                            ?>
                            <a  class="btn btn-primary my-3" href="index.php?page=10" role="button">Commandes</a>
                            <?php
                        }
                    //----------------------
                        // if ($page == 11) {
                            ?>
                            <!-- <a  class="btn btn-info my-3" href="index.php?page=11" role="button">Factures</a> -->
                            <?php
                        // }
                        // else {
                            ?>
                            <!-- <a  class="btn btn-primary my-3" href="index.php?page=11" role="button">Factures</a> -->
                            <?php
                        // }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <a  class="btn btn-primary my-5" href="index.php?page=2&dis=1" role="button">Déconnexion</a>
</nav>