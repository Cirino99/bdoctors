require('./bootstrap');

const form_register = document.getElementById("form-register");
if (form_register) {
    form_register.onsubmit = function () { return myFunction() };
}

function myFunction() {
    const name = document.getElementById('name').value;
    const lastname = document.getElementById('lastname').value;
    const address = document.getElementById('address').value;
    const city = document.getElementById('city').value;
    const postal_code = document.getElementById('postal_code').value;
    const mySpecializations = document.getElementById('mySpecialization');
    const specializations = mySpecializations.querySelectorAll('input');
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const password_confirm = document.getElementById('password-confirm').value;
    let mySpecialization;
    specializations.forEach(specialization => {
        if (specialization.checked) {
            mySpecialization = true;
        }
    });
    if (name != "" & lastname != "" & address != "" & city != "" & postal_code != "" & mySpecialization & email != "" & password != "" & password_confirm != "") {
        if (password.length < 8) {
            alert('password troppo corta');
            return false;
        }
        if (password != password_confirm) {
            alert('le due password non coincidono');
            return false;
        }
        if (!email.includes('@') || !email.includes('.')) {
            alert('email non corretta');
            return false;
        }
    } else {
        alert('compila tutti i campi');
        return false;
    }
    return true;
}