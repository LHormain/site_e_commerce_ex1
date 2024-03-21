// -------------------------------------------------------------------------------------
//            Validation du formulaire de contact coté utilisateur
// -------------------------------------------------------------------------------------

let nom = document.getElementById('nom_contact');
let mail = document.getElementById('mail_contact');
let condition = document.getElementById('condition');
let conditionLabel = document.getElementById('condition_label');
let codeTest = document.getElementById('captcha');
let envoyer = document.querySelector('input[type=submit]');

let validationNom = false;
let validationMail = false;
let validationCondition = false;
let validationCaptcha = false;
let validation = false;

// -----------------------------------------------------
// fonctions
// -----------------------------------------------------
// identification du résultat captcha
function captchaTest(codeTest) {
    if (codeTest.value === chaineNumberCode) {
        validationCaptcha = true;
        codeTest.style.backgroundColor = "transparent";
    }
    else {
        validationCaptcha = false;
        codeTest.style.backgroundColor = "var(--rosepoudre)";
    }
    return validationCaptcha;
}
// mail
function validateEmail(email) {
    let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    return res.test(email);
}

function mailTest(mail) {
    if (validateEmail(mail.value)) {
        validationMail = true;
        mail.style.backgroundColor = "transparent";
    }
    else {
        mail.placeholder = mail.value + " adresse non valide";
        mail.value = '';
        mail.style.backgroundColor = "var(--rosepoudre)";
        validationMail = false;
    }
    return validationMail;
}
// test longueur input nom
function lengthcheck(elementTester, minimum) {
    if (elementTester.value.length < minimum) {
        elementTester.value = '';
        elementTester.placeholder = minimum + ' caractères minimum';
        elementTester.style.backgroundColor = "var(--rosepoudre)";
        validation = false;
    }
    else {
        validation = true;
        elementTester.style.backgroundColor = "transparent";
    }
    return validation;
}
// test checkbox condition
function boxcheck(elementTester) {
    if (elementTester.checked) {
        validationCondition = true;
        conditionLabel.style.backgroundColor = "transparent";
    }
    else {
        validationCondition = false;
        conditionLabel.style.backgroundColor = "var(--rosepoudre)";
    }
    return validationCondition;
}

// -----------------------------------------------------
// addEventListeners
// -----------------------------------------------------
nom.addEventListener('blur', function() {
    lengthcheck(nom, 2);
    validationNom = validation;
});

mail.addEventListener('blur', function() {
    mailTest(mail);
});

codeTest.addEventListener('input', function() {
    captchaTest(codeTest);
});

document.addEventListener('click', function() {
    lengthcheck(nom, 2);
    validationNom = validation;
    mailTest(mail);
    captchaTest(codeTest);
    boxcheck(condition);
    
    if (validationCaptcha === true 
        && validationNom === true 
        && validationMail === true
        && validationCondition === true) {
        envoyer.disabled = false;

    }
    else {
        envoyer.disabled = true;
    }
});