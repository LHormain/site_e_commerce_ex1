//------------------------------------------------------------
//      pour changer l'ordre des images pour l'affichage
//------------------------------------------------------------

function chargementPosition(id_image, position) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_input_position.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        
        // force à recharger la page pour voir les modif sur plusieurs images
        window.location.assign(window.location.href);
    }
    
    // récupère directement la value de l'input en passant son id en paramètre
    let selection = document.getElementById(position).value;
    data = ('position_image='+ selection +'&id_image='+ id_image);
    xmlhttp.send(data);
}

let AllStock = document.querySelectorAll('.input_dispo');
AllStock.forEach(stock => {
    let id = stock.id.replace('position', '');
    let aff = stock.id;
    stock.addEventListener('change', function() {
        chargementPosition(id,aff);
    });
});