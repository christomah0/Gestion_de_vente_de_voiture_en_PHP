const iconBtn = document.querySelector("#icon-btn");
const form = document.querySelector("form");
const errorLogin = document.querySelector("#error-login");
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");
const groupInputIcon = document.querySelector("#group-input-icon");

// change couleur bordure d'input password
passwordInput.addEventListener("focus", function() {
    groupInputIcon.classList.replace("bg-gray-200", "bg-white");
    groupInputIcon.classList.add("border-blue-400");
});

passwordInput.addEventListener("blur", function() {
    groupInputIcon.classList.replace("bg-white", "bg-gray-200");
    groupInputIcon.classList.remove("border-blue-400");
});

// change le type d'input en texte s'il est en password
iconBtn.addEventListener("click", function() {
    if (iconBtn.classList.contains("slashed-eye")) {
        passwordInput.setAttribute("type", "text");
        iconBtn.classList.remove("slashed-eye");
        document.querySelector("i").classList.remove("bi-eye-slash-fill");
        document.querySelector("i").classList.add("bi-eye-fill");
    } else {
        passwordInput.setAttribute("type", "password");
        iconBtn.classList.add("slashed-eye");
        document.querySelector("i").classList.remove("bi-eye-fill");
        document.querySelector("i").classList.add("bi-eye-slash-fill");
    }
});

// envoie des donnée au server
form.addEventListener("submit", async function(e) {
    // e.preventDefault();
    console.log("submited");
});