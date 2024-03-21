// -----------------------------------------------------------------------------------
//                                       double input range
// -----------------------------------------------------------------------------------
// Pour que la valeur min ne soit pas supérieure à la max
// source avant modification : https://codepen.io/ChrisSargent/pen/meMMye
// remplace oninput par addEventListener avec l'event input
// et ajout de champs input pour min et max lier au range

let valeur_min = document.querySelector('#valeur_min');
let valeur_max = document.querySelector('#valeur_max');
let lowerSlider = document.querySelector('#lower');
let upperSlider = document.querySelector('#upper');

lowerVal = parseInt(lowerSlider.value);
upperVal = parseInt(upperSlider.value);
valeur_max.value = upperVal;
valeur_min.value = lowerVal;

// control de la valeur max pour le range
upperSlider.addEventListener('input', function(){
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);
    
    if (upperVal < lowerVal + 4) {
        lowerSlider.value = upperVal - 4;
        
        if (lowerVal == lowerSlider.min) {
            upperSlider.value = 4;
        }
    }
    valeur_max.value = upperVal;
    valeur_min.value = lowerVal;
});
    
// control de la valeur min pour le range
lowerSlider.addEventListener('input', function(){
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);
    
    if (lowerVal > upperVal - 4) {
        upperSlider.value = lowerVal + 4;
        
        if (upperVal == upperSlider.max) {
            lowerSlider.value = parseInt(upperSlider.max) - 4;
        }
        
    }
    valeur_max.value = upperVal;
    valeur_min.value = lowerVal;
});

// control des champs inputs
valeur_max.addEventListener('input', function() {
    upperSlider.value = valeur_max.value;
});
valeur_min.addEventListener('input', function() {
    lowerSlider.value = valeur_min.value;
})