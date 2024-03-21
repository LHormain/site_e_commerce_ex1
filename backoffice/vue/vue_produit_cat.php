<?php
include('controler/traitement_produit_cat.php');

?>

<div class="col-10 p-5 text-start">
    <div class="row">
        <form action="index.php?page=3&c=2" method="post"  class="col-8 offset-2 text-start" >
            <div class="row">
            <h3>Choisir une catégorie</h3>
            <!-- category -->
            <div class="mb-3 col-6 ">
                <!-- <label for="id_cat" class="form-label">Catégorie</label> -->
                <select class="form-select form-select-lg" name="id_cat" id="id_cat" > 
                    <option selected>Choisir une option</option>
                    <?php 
                        
                        echo $select_cat;
                    ?>
                </select>
            </div>
        </div>
        <input type="submit" value="Choisir" class="btn btn-primary col-3 mb-3 ms-auto align-self-end">
    </form>
</div>
</div>