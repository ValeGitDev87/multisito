document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registerForm");

    if (!registerForm) return;

    registerForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch(`${baseUrl}/register`, {
            method: "POST",
            body: formData,
            credentials: "same-origin" // 👈 fondamentale per usare le sessioni
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (typeof toastr !== "undefined") {
                    toastr.success(data.message);
                } else {
                    console.log(data.message);
                }

                setTimeout(() => {
                    window.location.href = `${baseUrl}/login`;
                }, 2000);
            } else {
                if (typeof toastr !== "undefined") {
                    toastr.error(data.message || "Errore di validazione.");
                } else {
                    console.error(data.message || "Errore di validazione.");
                }
            }
        })
        .catch(error => {
            if (typeof toastr !== "undefined") {
                toastr.error("Errore di connessione al server.");
            } else {
                console.error("Errore di connessione al server.", error);
            }
        });
    });
});
console.log(baseUrl)
