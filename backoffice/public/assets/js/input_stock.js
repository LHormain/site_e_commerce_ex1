//------------------------------------------------------------------------
//             pour changer le stock dans le tableau gestion
//------------------------------------------------------------------------

function chargementStock(id_produit, stock) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_input_stock.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        
    }
    
    // récupère la value de l'input 
    let selection = document.getElementById(stock).value;
    data = ('stock_produit='+ selection +'&id_produit='+ id_produit);
    xmlhttp.send(data);
}

let AllStock = document.querySelectorAll('.input_dispo');
AllStock.forEach(stock => {
    let id = stock.id.replace('stock', '');
    let aff = stock.id;
    stock.addEventListener('change', function() {
        chargementStock(id,aff);
    });
});