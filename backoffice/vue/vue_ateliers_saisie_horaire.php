<?php
include('controler/traitement_ateliers_saisie_horaire.php');
?>
<h3 class="mt-3"><?php echo $titre; ?> date pour l'atelier : <?php echo $nom_atelier; ?></h3>
<p><?php echo $texte_page_courante; ?></p>
<div class="my-5 text-start offset-2 col">
    <a class="btn btn-primary" href="index.php?page=12&c=41&id=<?php echo $id_atelier; ?>" role="button">Retour à la gestion des horaires</a>
</div>
<div class="row">
    <form action="#" method="post" class="col-8 offset-2 text-start">
        <!-- date -->
        <div class="mb-3 ">
            <label for="date_atelier" class="form-label">Date de l'atelier</label>
            <input type="datetime-local" class="form-control" name="date_atelier" id="date_atelier" aria-describedby="helpId2" placeholder="" value="<?php echo $date_atelier; ?>" <?php if (!(isset($_GET['id']) && $_GET['id'] != NULL)) {echo 'required';} ?>>
            <small id="helpId2" class="form-text text-muted">Choisissez une date</small>
        </div>
        <!-- enregistrer -->
        <input type="submit" value="Enregistrer" class="btn btn-primary col-3 ms-auto">

    </form>
</div>