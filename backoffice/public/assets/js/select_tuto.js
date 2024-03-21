//------------------------------------------------------------------
//     génère les sous cat en fonction de la cat sélectionnée
//------------------------------------------------------------------

function chargementSelect(id_portfolio) {
    
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_select_tuto.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        window.location.assign(window.location.href);
        // const myobj = JSON.parse(this.responseText);
        // let resultat = document.getElementById('id_sous_cat'); //le select à remplacer
        
        // resultat.innerHTML = '<option selected>Choisir une option</option>';
        // for (let data in myobj) {
        //         resultat.innerHTML += `<option value=" ${myobj[data].id_sous_cat}">${myobj[data].nom_sous_categorie}</option>`;
            
        // }
    }
    
    let liste = document.getElementById('identifiant'+id_portfolio);
    let selection = liste.options[liste.selectedIndex].value;
    data = ('id_portfolio='+ id_portfolio +'&id_tutoriel=' +selection);
    // xmlhttp.send(JSON.stringify(data)); // il envoi tout
    xmlhttp.send(data);
    // xmlhttp.send('id='+ selection);

}
let allTuto = document.querySelectorAll('.form-select');
allTuto.forEach(tutoriel => {
    let id = tutoriel.id.replace('identifiant', '');
    tutoriel.addEventListener('change', function() {
        chargementSelect(id);
    });
});