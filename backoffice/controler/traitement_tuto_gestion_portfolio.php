<?php
// récupération des tutoriels pour les selects
$selects = '';
$portfolio = req_portfolio($bdd);

for ($i=1; $i < 9; $i++) {
    $id = 'identifiant'.$i;
    $donnees = req_All_tuto($bdd);

    $tuto_select = req_tuto_portfolio($bdd,$i);
    
    $options = '';
    foreach ($donnees as $ligne) {
        if ($ligne['id_tutoriel'] == $tuto_select['id_tutoriel']) {
            $options .= '<option value="'.$ligne['id_tutoriel'].'" selected>'.$ligne['titre_tutoriel'].'</option>';
        }
        else {
            $options .= '<option value="'.$ligne['id_tutoriel'].'">'.$ligne['titre_tutoriel'].'</option>';
        }
    
    }

    $selects .= '
    <div class="mb-3">
            <label for="'.$id.'" class="form-label">Tutoriel '.$i.'</label>
            <select class="form-select form-select-lg" name="'.$id.'" id="'.$id.'">
                <option selected>Choisir une option</option>
                '.$options.'
            </select>
        </div>
    ';

}
?>