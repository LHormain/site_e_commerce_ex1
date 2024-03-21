//---------------------------------------------------------------
//                   Ajax sur panier
//---------------------------------------------------------------

function chargementQuantite(id_panier, id_produit) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_input_quantite.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        
        const myobj = JSON.parse(this.responseText);

    }
    
    // récupère directement la value de l'input en passant son id en paramètre
    let produit = document.getElementById(id_produit);
    let selection = produit.value;
    data = ('quantite_produit='+ selection +'&id_panier='+ id_panier);
    xmlhttp.send(data);
 
}
//-------------------------------------------------------------
//               gestion des btn plus et moins
//-------------------------------------------------------------

function quantitePlus(id_produit) {
    let produit = document.getElementById(id_produit);
    let max = parseInt(produit.getAttribute('max'));
    let value = produit.value;
    if (value < max) {
        produit.stepUp();
        let newValue = produit.value;
        produit.setAttribute('value', newValue);
    }
}
function quantiteMoins(id_produit) {
    let produit = document.getElementById(id_produit);
    let min = parseInt(produit.getAttribute('min'));
    let value = produit.value;
    
    if (value > min) {
        produit.stepDown();
        let newValue = produit.value;
        produit.setAttribute('value', newValue);
    }
}

// ----------------------------------------------------------
//                        addEventListener
// ----------------------------------------------------------
let allQuantite = document.querySelectorAll('.input_quantite');
allQuantite.forEach(quantite => {
    let id = quantite.id;
    let id_produit = id.replace('produit', '');
    quantite.addEventListener('input', function() {
        chargementQuantite(id_produit, id);
        window.location.assign("index.php?page=62");
    });
});

let allBtnMoins = document.querySelectorAll('.moins');
allBtnMoins.forEach(btnMoins => {
    let id = btnMoins.id;
    let id_produit = id.replace('m', 'produit');
    let id_c = id.replace('m', '');
    btnMoins.addEventListener('click', function() {
        quantiteMoins(id_produit);
        chargementQuantite(id_c, id_produit);
        window.location.assign("index.php?page=62");
    });
});
let allBtnPlus = document.querySelectorAll('.plus');
allBtnPlus.forEach(btnPlus => {
    let id = btnPlus.id;
    let id_produit = id.replace('p', 'produit');
    let id_c = id.replace('p', '');
    btnPlus.addEventListener('click', function() {
        quantitePlus(id_produit);
        chargementQuantite(id_c, id_produit);
        window.location.assign("index.php?page=62");
    });
});