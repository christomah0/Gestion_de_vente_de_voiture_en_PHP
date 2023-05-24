const searchInput = document.querySelector("#search-input");
const delBtn = document.querySelector("#del-btn");
const searchForm = document.querySelector("#search-form");
const groupInputIcon = document.querySelector("#group-input-icon");
const mClientForm = document.querySelector("#m-client-form");
const aClientForm = document.querySelector("#a-client-form");
const closeModifyModalBtn = document.querySelector("#close-m-modal");
const closeAddModalBtn = document.querySelector("#close-a-modal");
const cancelAddModalBtn = document.querySelector("#cancel-a-btn");
const cancelModifyModalBtn = document.querySelector("#cancel-m-btn");
const modifyLinksClient = document.querySelectorAll("[mod-client-data-id]");
const addBtn = document.querySelector("#a-btn");

// change l'état du focus sur input
searchInput.addEventListener("focus", function() {
    groupInputIcon.classList.replace("bg-gray-200", "bg-white");
    groupInputIcon.classList.add("border-blue-400");
});

searchInput.addEventListener("blur", function() {
    groupInputIcon.classList.replace("bg-white", "bg-gray-200");
    groupInputIcon.classList.remove("border-blue-400");
});

// met la propriété display par défaut
function showDataMatchedInSearchInput(parent_item, str_to_compare, option) {
    if (option === 0) {
        Array.from(document.querySelectorAll(parent_item)).forEach(row => {
            const content = row.children.item(0).textContent.toLowerCase() + row.children.item(1).textContent.toLowerCase();

            if (content.indexOf(str_to_compare) != -1) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
    else if (option === 1) {
        Array.from(document.querySelectorAll(parent_item)).forEach(row => {
            row.style.display = "";
        });
    }
}

// vide la zone de recherche si la zone de recherche contient char(s)
searchInput.addEventListener("keyup", function(e) {
    const charObtained = e.target.value;
    const charObtainedToLowerCase = charObtained.toLowerCase();

    if (charObtained != "") {
        delBtn.classList.replace("hidden", "inline");

        delBtn.addEventListener("click", function() {
            e.target.value = "";
            delBtn.classList.replace("inline", "hidden");
            showDataMatchedInSearchInput(".data-client", charObtainedToLowerCase, 1);
        });
        showDataMatchedInSearchInput(".data-client", charObtainedToLowerCase, 0);
    } else {
        delBtn.classList.replace("inline", "hidden");        showDataMatchedInSearchInput(".data-client", charObtainedToLowerCase, 1);
    }
});

function showAndHideModal(id) {
    document.querySelector(id).classList.toggle("hidden");
    document.querySelector(id).classList.toggle("block");
}

function showAndHideModalWithFlex(id) {
    document.querySelector(id).classList.toggle("hidden");
    document.querySelector(id).classList.toggle("flex");
}

function hideModalAferSubmission(arg1, arg2) {
    let isValid = false;
    document.querySelectorAll(arg1).forEach(i => {
        if (i.value != "") {
            isValid = true;
        }
        else {
            isValid = false;
        }
    });
    if (isValid) {
        showAndHideModal(arg2);
    }
}

// envoie les données modifiées au server
mClientForm.addEventListener('submit', (e) => {
    // e.preventDefault();
    hideModalAferSubmission(".modal-input", "#m-modal");
});

aClientForm.addEventListener('submit', async (e) => {
    // e.preventDefault();
    hideModalAferSubmission(".modal-input", "#a-modal");
});

// ferme la fenêtre modal si on clique sur bouton fermeture
closeModifyModalBtn.addEventListener("click", () => {
    showAndHideModal("#m-modal");
});

closeAddModalBtn.addEventListener("click", () => {
    showAndHideModal("#a-modal");
});

// annule la modification en cours
cancelModifyModalBtn.addEventListener("click", () => {
    showAndHideModal("#m-modal");
});

cancelAddModalBtn.addEventListener("click", () => {
    showAndHideModal("#a-modal");
});

// recupère id cliqué et affiche la fenêtre modal
modifyLinksClient.forEach((link) => {
    link.addEventListener("click", (e) => {
        e.preventDefault();
        const id = link.getAttribute("mod-client-data-id");
        showAndHideModal("#m-modal");
        document.getElementById("m-client-id").value = id;
    });
});

// ouvre la fenêtre modal pour faire l'ajout
addBtn.addEventListener("click", () => {
    showAndHideModal("#a-modal");
});

// recupère id cliqué et affiche fenêtre modal contenant l'id
document.querySelectorAll("[del-client-data-id]").forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault();
        const id = link.getAttribute("del-client-data-id");
        showAndHideModalWithFlex("#del-modal");
        document.getElementById("del-id-text").innerText = "Voulez-vous vraiment supprimer " + id + '?';
        document.getElementById("del-id").value = id;
    });
});

// ferme la fenêtre modal de confirmation de suppression
document.getElementById("close-del-modal").addEventListener("click", () => {
    showAndHideModalWithFlex("#del-modal");
});

document.getElementById("cancel-del-btn").addEventListener("click", () => {
    showAndHideModalWithFlex("#del-modal");
});

document.getElementById("del-form").addEventListener("submit", e => {
    // e.preventDefault();
    showAndHideModalWithFlex("#del-modal");
});
