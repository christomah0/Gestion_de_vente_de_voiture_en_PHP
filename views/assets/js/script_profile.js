const deleteModal = document.getElementById("del-modal");
const closeDeleteModal = document.getElementById("close-del-modal");
const deleteUsernameText = document.getElementById("del-id-text");
const deleteUsername = document.getElementById("del-id");
const deleteForm = document.getElementById("del-form");
const cancelDeleteBtn = document.getElementById("cancel-del-btn");
const deleteLinksUsername = document.querySelectorAll("[data-username]");
const addModal = document.getElementById("a-modal");
const adminForm = document.getElementById("admin-form");
const inputs = document.querySelectorAll(".modal-input");
const addBtn = document.getElementById("a-btn");

// montre et cache la fenêtre modal
function showAndHideModal() {
    deleteModal.classList.toggle("hidden");
    deleteModal.classList.toggle("flex");
}

function showAndHideAddModal() {
    addModal.classList.toggle("hidden");
    addModal.classList.toggle("block");
}

function hideAddModalAfterInputVerification() {
    let isValid = false;
    inputs.forEach(input => {
        if (input.value != "") {
            isValid = true;
        } else {
            isValid = false;
        }
    });
    if (isValid) {
        showAndHideAddModal();
    }
}

// envoie formulaire de confirmation de suppression d'utilisateur
deleteForm.addEventListener("submit", (e) => {
    // e.preventDefault();
    showAndHideModal();
});

// recupère élément cliqué et affiche fenêtre modal contenant l'élément
deleteLinksUsername.forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault();
        const i = link.getAttribute("data-username");
        showAndHideModal();
        deleteUsernameText.innerText = "Voulez-vous vraiment supprimer l'administrateur \"" + i + "\" ?";
        deleteUsername.value = i;
    });
});

// ferme la fenêtre modal
closeDeleteModal.addEventListener("click", () => {
    showAndHideModal();
});

// annule la suppression de la fenêtre modal
cancelDeleteBtn.addEventListener("click", () => {
    showAndHideModal();
});

// formulaire admin
adminForm.addEventListener("submit", (e) => {
    // e.preventDefault();
    if (document.getElementById("a-admin-password").value === document.getElementById("a-admin-retype-password").value) {
        hideAddModalAfterInputVerification();
    }
});

// déclenche l'ouverture de la fenêtre modal d'ajout
addBtn.addEventListener("click", () => {
    showAndHideAddModal();
});

document.getElementById("close-a-modal").addEventListener("click", () => {
    showAndHideAddModal();
});

document.getElementById("cancel-a-btn").addEventListener("click", () => {
    showAndHideAddModal();
});