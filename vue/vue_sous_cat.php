<?php
include('controler/traitement_sous_cat.php');
?>

<div class="container-fluid">
    <div class="row">
       
        <!-- fils d’Ariane -->
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
        <!-- en tete -->
        <div class="col-lg-12 position-relative  text-center my-lg-5" style=" <?php echo $titre_couleur ?>">
            <h1 class=" my-lg-5"><?php  echo $titre; ?></h1>
            <p class=" my-lg-3 py-lg-3 d-none d-md-block">
                <?php echo $texte_categorie; ?>
            </p>
        </div>
        <!-- liste des sous catégories -->
        <div class="col-lg-12 mt-5">
            <div class="row mb-5 justify-content-center">

                <?php  
                echo $cards_sous_cat;
                
                ?>

            </div>
        </div>
        
    </section>
</div>

