document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("loginForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch("/login", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message);
                setTimeout(() => window.location.href = "/", 1500);
            } else {
                toastr.error(data.message);
            }
        })
        .catch(error => {
            toastr.error("Errore di rete.");
            console.error(error);
        });
    });
});
