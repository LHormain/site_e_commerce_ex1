<?php
include('controler/traitement_tuto_details.php');
?>

<div class="container">
    <div class="row">
        <section class="position-relative">
            <h1 class="text-center my-5"><?php echo $donnees['titre_tutoriel']; ?></h1>
            <div class="position-absolute atelier_form d-none d-lg-block start-0 top-50" style="height: 15vw; width: 15vw; <?php couleurAleatoire(); ?>"></div>
            <!-- video d'instruction lien vers youtube -->
            <div class="text-center ">
                <?php echo $video; ?>
            </div>
            <h2 class="my-5">Matériel Nécessaire :</h2>
            <!-- liste du materiel -->
            <div class="">
                <ol>
                    <?php echo $liste_materiaux; ?>
                </ol>

            </div>
            <p class="my-5">
                <?php echo $donnees['texte_tutoriel']; ?>
            </p>
        </section>
    </div>
</div>
