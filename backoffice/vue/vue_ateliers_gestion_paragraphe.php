<?php
include('controler/traitement_ateliers_gestion_paragraphe.php')
?>
<h3>Gestion des paragraphes de l'atelier : <?php echo $donnees['nom_atelier']; ?></h3>
<div class="my-3 text-start">
    <a class="btn btn-primary" href="index.php?page=12&c=5&id=<?php echo $id_atelier; ?>" role="button">Ajouter un nouveau paragraphe</a>
</div>
<div class="table-responsive">
    <table class="table table-striped
    table-hover	
    table-bordered
    align-middle">
        <thead class="table-primary">
            <!-- <caption>Table Name</caption> -->
            <tr>
                <th>Titre</th>
                <th>Texte</th>
                <th>Ordre d'affichage</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                    echo $table;
                ?>
            </tbody>
            <tfoot>
                
            </tfoot>
    </table>
</div>
<script src="public/assets/js/input_position_paragraphe.js"></script>