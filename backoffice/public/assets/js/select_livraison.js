//------------------------------------------------------------------
//     change l'état de livraisons
//------------------------------------------------------------------

function chargementSelect(id_commande) {
    
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_select_livraison.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        
        window.location.assign(window.location.href);
        const myobj = JSON.parse(this.responseText);
        // let resultat = document.getElementById(id_commande); //le select à remplacer
        
        // resultat.innerHTML = '';
        // for (let data in myobj) {
        //         resultat.innerHTML += `<option value=" ${myobj[data].id_livraison}">${myobj[data].nom_etat_livraison}</option>`;
            
        // }
    }
    
    let liste = document.getElementById(id_commande);
    let selection = liste.options[liste.selectedIndex].value;
    data = ('id_livraison='+ selection +'&id_commande='+ id_commande);
    xmlhttp.send(data);

}
let AllStock = document.querySelectorAll('.select_livrer');
AllStock.forEach(stock => {
    let id = stock.id;
    stock.addEventListener('change', function() {
        chargementSelect(id);
    });
});