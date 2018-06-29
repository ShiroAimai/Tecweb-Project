window.onload = function () {
    var Password = document.getElementById("pass");
    var ConfirmPassword = document.getElementById("confirmPass");
    Password.onchange = x;
    ConfirmPassword.onkeyup = x;
    function x() {
        ConfirmPassword.setCustomValidity("");
        if (Password.value != ConfirmPassword.value) {
            ConfirmPassword.setCustomValidity("Le password non coincidono");
        }
    }
}