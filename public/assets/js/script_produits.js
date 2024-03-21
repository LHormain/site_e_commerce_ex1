//--------------------------------------------------------------------------------------
//                 affichage du prix en fonction de la quantité
//--------------------------------------------------------------------------------------

let quantiteProduit = document.querySelector('#quantite_produit');
let prix = document.querySelector('#prix');
let prix_tot = document.querySelector('#prix_tot');

function changePrix(prix, value) {
    let prix_calcul = (parseFloat(prix.innerHTML)*value).toFixed(2);
    
    if (isNaN(prix_calcul) ) {
    prix_tot.innerHTML = 0;
    }
    else {
    prix_tot.innerHTML = prix_calcul;
    }
}
//--------------------------------------------------------------------------------------
//                       changement directement dans l'input 
//--------------------------------------------------------------------------------------
quantiteProduit.addEventListener('blur', function() {
    value = parseFloat(quantiteProduit.value);
    quantiteProduit.setAttribute('value', value ); 
    changePrix(prix, value);
});
//--------------------------------------------------------------------------------------
//               changement de la quantité avec les boutons
//--------------------------------------------------------------------------------------
let plus = document.getElementById('btn_plus');
let moins = document.getElementById('btn_moins');
let min = 1;
let max = quantiteProduit.getAttribute('max');
let step = parseFloat(quantiteProduit.getAttribute('step'));

plus.addEventListener('click', function() {
    let value = parseFloat(quantiteProduit.value);

    if (value < max) {
        quantiteProduit.stepUp();
        changePrix(prix, value + step);
    }
});
moins.addEventListener('click', function() {
    let value = parseFloat(quantiteProduit.value);
    if (value > 1) {
        quantiteProduit.stepDown();
        changePrix(prix, value - step);
    }
});

//--------------------------------------------------------------------------------------
//                            Ajax pour ajout au panier
//--------------------------------------------------------------------------------------
function addPanier(id, qte,prix,client,commande) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "controler/requete_add_panier.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() {
        const myobj = this.responseText;
        // alert (myobj);

    }
    data = ('id_produit=' + id + '&quantite_produit=' + qte + '&prix_unitaire=' + prix + '&identifiant_client=' + client + '&id_commande=' + commande);
    xmlhttp.send(data);
}

let id = document.getElementById('id_produit').value;
let client = document.getElementById('client').value;
let commande = document.getElementById('commande').value;
let qteAchat = parseFloat(quantiteProduit.value);
let panier = document.querySelector('.form_submit');

panier.addEventListener('click', function() {
    addPanier(id,qteAchat,prix.innerHTML,client, commande);
    window.location.assign(window.location.href)
});