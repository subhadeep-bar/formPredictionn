function validateRegister() {
    let phone = document.getElementById("phone").value;
    let password = document.getElementById("password").value;
    let error = document.getElementById("error");

    let phonePattern = /^[0-9]{10}$/;

    if (!phonePattern.test(phone)) {
        error.innerText = "Enter valid 10-digit phone number";
        return false;
    }

    if (password.length < 6) {
        error.innerText = "Password must be at least 6 characters";
        return false;
    }

    return true;
}

function validateLogin() {
    let email = document.getElementById("loginEmail").value;
    let password = document.getElementById("loginPassword").value;
    let error = document.getElementById("error");

    if (email === "" || password === "") {
        error.innerText = "All fields required!";
        return false;
    }

    return true;
}