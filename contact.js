document.addEventListener("DOMContentLoaded", function(){
    const form= document.getElementById("contact_form");

    if(form){
        form.addEventListener("submit", (e)=>{
            const name = document.getElementById("name").Value;
            const email = document.getElementById("email").Value;
            const phone = document.getElementById("phone").Value;
            const message = document.getElementById("message").Value;

            if(!name || !email || !phone || !message){
                alert("Please fill in all fields.");
                e.preventDefault();
            }
        });
    }
});