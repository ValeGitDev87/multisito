document.addEventListener("DOMContentLoaded", function () {
    let registerForm = document.getElementById("registerForm");

    if (registerForm) { // Controlla se il form esiste nella pagina
        registerForm.addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("/register", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message);
                    setTimeout(() => window.location.href = "/login", 2000);
                } else {
                    toastr.error(data.message);
                }
            })
            .catch(error => toastr.error("Errore di connessione al server."));
        });
    }
});
