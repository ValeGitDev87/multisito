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
                Swal.fire({
                    icon: 'success',
                    title: 'OK',
                    text: data.message
                })

                setTimeout(() => {
                    window.location.href = `${baseUrl}/`;
                }, 1500);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ops..',
                    text: data.message
                })
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Ops..',
                text: error.message
            })
        });
    });
});


