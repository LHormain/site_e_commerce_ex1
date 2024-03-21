<?php
include('controler/traitement_tuto_gestion.php');
?>

<h3 class="mt-3">Gestion des tutoriels</h3>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>Titre</th>
                <th>Illustration</th>
                <th>liens vers la vidéo</th>
                <th>liste du matériel</th>
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
<script>
    iframe = document.querySelectorAll('iframe');
    iframe.forEach(element => {
        element.width = 250;
        element.height = 150;
    });
</script>