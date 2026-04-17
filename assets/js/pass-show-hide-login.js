const pswrdFieldn = document.querySelector("#l_password"),
toggleBtn3 = document.querySelector("#l_pwd-e");


toggleBtn3.onclick = ()=>{
    if(pswrdFieldn.type == "password"){
        pswrdFieldn.type = "text";
        toggleBtn3.classList.add("active")
    }
   else{
    pswrdFieldn.type = "password";
    toggleBtn3.classList.remove("active");
   }
  }

