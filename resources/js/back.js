require('./bootstrap');

document.getElementById("form-register").onsubmit = function () { return myFunction() };

function myFunction() {
    password = document.getElementById('password').value;
    if (password.length < 8) {
        return false;
    }
    return true;
}