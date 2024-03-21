<?php
include('controler/traitement_tuto_saisie_materiaux.php');
?>

<h3 class="mt-3">Matériaux pour le tutoriel <?php echo $tutoriel['titre_tutoriel']; ?></h3>
<div class="row">
    <div class="col-4">
        <form action="#" method="post" class="mt-5 pt-5">
            <div class="mb-3">
              <label for="intitule_materiel" class="form-label">Intitulé du matériel</label>
              <input type="text"
                class="form-control" name="intitule_materiel" id="intitule_materiel" aria-describedby="helpId" placeholder="" value="<?php echo $intitule_materiel; ?>">
              <small id="helpId" class="form-text text-muted">Nom du matériel</small>
            </div>
            <div class="mb-3">
              <label for="description_materiel" class="form-label">Description</label>
              <textarea class="form-control" name="description_materiel" id="description_materiel" rows="3"><?php echo $description_materiel; ?></textarea>
            </div>
            <input type="submit" value="<?php echo $btn_submit; ?>" class="btn btn-primary">
        </form>
    </div>
    <div class="col-8">
        <div class="table-responsive mt-5">
            <table class="table table-striped
            table-hover	
            table-bordered
            table-primary
            align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Intitulé</th>
                        <th>Description</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php echo $table; ?>
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
            </table>
        </div>
        
    </div>

</div>