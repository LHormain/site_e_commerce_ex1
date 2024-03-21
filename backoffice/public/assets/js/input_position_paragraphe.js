//------------------------------------------------------------
//      pour changer l'ordre des images pour l'affichage
//------------------------------------------------------------

function chargementPosition(id_descriptif, position) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_input_position_paragraphe.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        
        window.location.assign(window.location.href);

        // const myobj = JSON.parse(this.responseText);
        // let resultat = document.getElementById(id_descriptif); // récupère le td contenant l'input
        // for (let data in myobj) {
        //     resultat.innerHTML = `<input type="text" id="position${id_descriptif}" value=" ${myobj[data].position_descriptif}" class="input_dispo" oninput="chargementPosition(${id_image}, ${position})">`;
        // }
    }
    
    // récupère directement la value de l'input en passant son id en paramètre
    let selection = document.getElementById(position).value;
    data = ('position_descriptif='+ selection +'&id_descriptif='+ id_descriptif);
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