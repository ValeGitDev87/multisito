document.addEventListener("DOMContentLoaded", function(){
    
    const forgotpedForm = document.getElementById("forgotPasswordForm");

    if(!forgotpedForm) return;

    forgotpedForm.addEventListener("submit", function(e){

        e.preventDefault();

        const formData = new FormData(this);

        fetch(`${baseUrl}/forgot-password`, {
            method: "POST",
            body: formData,
            credentials: "same-origin"
        }).then(res => res.json()).then(data=>{

            if(data.success){
                Swal.fire({
                    icon:"success",
                    "title":"OK",
                    "text":data.message
                })
            }else{
                Swal.fire({
                    icon:"error",
                    title:"Ops.",
                    text:data.message
                })
            }
        })
        .catch(error=>{
            Swal.fire({
                icon:"error",
                title:"Attenzione!",
                text:error.message
            })
        })
    })
})