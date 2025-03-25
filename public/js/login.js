document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    if (!loginForm) return;

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch(`${baseUrl}/login`, {
            method: "POST",
            body: formData,
            credentials: "same-origin" // 🔐 mantiene cookie/sessione
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
                    window.location.href = `${baseUrl}/`;
                }, 1500);
            } else {
                if (typeof toastr !== "undefined") {
                    toastr.error(data.message || "Credenziali non valide.");
                } else {
                    console.error(data.message || "Errore nel login.");
                }
            }
        })
        .catch(error => {
            if (typeof toastr !== "undefined") {
                toastr.error("Errore di rete.");
            } else {
                console.error("Errore di rete.", error);
            }
        });
    });
});

