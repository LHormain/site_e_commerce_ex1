<?php
include('controler/traitement_ateliers_inscription.php');
?>
<div class="col-10 p-5 text-start">
    <div class="row">
        <form action="index.php?page=12&c=31" method="post"  class="col-10 offset-2 text-start" >
            <div class="row">
            <h3>Choisir un atelier</h3>
            <small id="helpId" class="form-text text-muted">Choisir une option</small>
            <!-- ateliers -->
            <div class="mb-3 ">
                <select class="form-select form-select-lg" name="id_atelier" id="id_atelier" > 
                    <?php 
                        
                        echo $select_atelier;
                    ?>
                </select>
            </div>
        </div>
        <input type="submit" value="Choisir" class="btn btn-primary col-3 mb-3 ms-auto align-self-end">
    </form>
</div>
</div>
