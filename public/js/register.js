document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registerForm");

    if (!registerForm) return;

    registerForm.addEventListener("submit", function (event) {
        event.preventDefault();

        let pwd = document.getElementById("pwd").value;
        let pwd2 = document.getElementById("pwdConfirm").value;

        if(pwd !== pwd2){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Le password non corrispondono.'
            })
            return;
        }
        const formData = new FormData(this);

        fetch(`${baseUrl}/register`, {
            method: "POST",
            body: formData,
            credentials: "same-origin" // 👈 fondamentale per usare le sessioni
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Ottimo!',
                    text: data.message
                })
                setTimeout(() => {
                    window.location.href = `${baseUrl}/login`;
                }, 2000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message
                })
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message
            })
        });
    });
});


