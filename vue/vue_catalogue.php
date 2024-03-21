<?php  

include('controler/traitement_catalogue.php'); 
?>
<div class="container-fluid">
    <div class="row">
        <!-- --------------------------------------------------------------------- -->
        <!--                               filtres                                 -->
        <!-- --------------------------------------------------------------------- -->
        
        <div class="col-lg-1 my-2">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Filtres</button>
        
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Affinez Votre Recherche</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="#" method="post" class="row">
                        <div class="my-3">
                            <h5>Couleur</h5>
                            <div class="row">
                                <?php 

                                echo $select_couleurs;
                                ?>
                            </div>
                        </div>
                        <div class="my-3">
                            <h5>Usage</h5>
                            <select name="usage" id="">
                                <option disabled selected>Choisir une option</option>
                                <?php 
                                    echo $select_usages;
                                ?>
                            </select>
                        </div>
                        <!-- <div class="my-3" >
                            <h5>Poids</h5>
                            <div class="row">
                                <div class="col-4">
                                    <input type="checkbox" name="poids[]" id="sleger" value="trés léger"><label for="sleger">Très léger</label>
                                </div>
                                <div class="col-4">
                                    <input type="checkbox" name="poids[]" id="leger" value="léger"><label for="leger">Léger</label>
                                </div>
                                <div class="col-4">
                                    <input type="checkbox" name="poids[]" id="moyen" value="moyen"><label for="moyen">Moyen</label>
                                </div>
                                <div class="col-4">
                                    <input type="checkbox" name="poids[]" id="lourd" value="lourd"><label for="lourd">Lourd</label>
                                </div>
                                <div class="col-4">
                                    <input type="checkbox" name="poids[]" id="xlourd" value="trés lourd"><label for="xlourd">Très lourd</label>
                                </div>
                            </div>
                        </div> -->
                        <div class="my-3">
                            <h5>Prix (en €)</h5>
                            <div class="row">
                                <input type="text" name="" id="valeur_min"class=" m-1 col-2">
                                <span class="multi-range col"> 
                                    <!-- valeur max depend de la catégorie -->
                                    <input type="range" id="upper" name="budget_max" class=" max" min="0" max="45" step="1" value="20">
                                    <input type="range" id="lower" name="budget_min" class=" min" min="0" max="45" step="1" value="2">
                                </span>
                                <input type="text" name="" id="valeur_max"class=" m-1 col-2">
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="row justify-content-end">
                                <input type="submit" value="Recherche" class="btn btn-primary col-3 me-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- --------------------------------------------------------------------- -->
        <!--                             fils d’Ariane                             -->
        <!-- --------------------------------------------------------------------- -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="col-lg-8 offset-lg-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=1">Accueil</a></li>
                <?php echo $ariane; ?>
            </ol>
        </nav>

    </div>
</div>
<div class="container">
    <section class="row">
        <!-- --------------------------------------------------------------------- -->
        <!--                                en tete                                -->
        <!-- --------------------------------------------------------------------- -->
        <div class="col-lg-12 position-relative  text-center my-lg-5" style=" <?php echo $titre_couleur ?>">
            <h1 class=" my-lg-5"><?php  echo $titre; ?></h1>
            <p class=" my-lg-3 py-lg-3 d-none d-md-block">
                <?php echo $texte_sous_categorie ?>
            </p>
        </div>
        <!-- --------------------------------------------------------------------- -->
        <!--                             produits                                  -->
        <!-- --------------------------------------------------------------------- -->
        <div class="col-lg-12 mt-mb-5 p-5">
            <div class="row">
                <?php
                    echo $catalogue;
                ?>
            </div>
        </div>
        <!-- pagination -->
        <nav aria-label="Page navigation " class="d-flex justify-content-center my-5">
            <ul class="pagination ">
                <?php
                    echo $pagination;
                ?>
            </ul>
        </nav>
    </section>
</div>

<script src="public/assets/js/double_range_control.js"></script>
<script src="public/assets/js/add_favoris.js"></script>