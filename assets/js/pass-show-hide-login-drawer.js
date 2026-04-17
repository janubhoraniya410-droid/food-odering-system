const pswrdField = document.querySelector("#ld_password"),
toggleBtn4 = document.querySelector("#ld_pwd-e");


toggleBtn4.onclick = ()=>{
    if(pswrdField.type == "password"){
        pswrdField.type = "text";
        toggleBtn4.classList.add("active")
    }
   else{
    pswrdField.type = "password";
    toggleBtn4.classList.remove("active");
   }
  }
