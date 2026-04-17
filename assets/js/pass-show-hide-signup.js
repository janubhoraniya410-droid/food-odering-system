const pswrdFieldf = document.querySelector("#password1"),
c_pswdFieldf = document.querySelector("#cpassword"),
toggleBtn1 = document.querySelector("#pwd-e"),
toggleBtn2 = document.querySelector("#c_pwd-e");


toggleBtn1.onclick = ()=>{
    if(pswrdFieldf.type == "password"){
        pswrdFieldf.type = "text";
        toggleBtn1.classList.add("active")
    }
   else{
    pswrdFieldf.type = "password";
    toggleBtn1.classList.remove("active");
   }
  }

toggleBtn2.onclick = ()=>{
    if(c_pswdFieldf.type == "password"){
        c_pswdFieldf.type = "text";
        toggleBtn2.classList.add("active")
    }
   else{
    c_pswdFieldf.type = "password";
    toggleBtn2.classList.remove("active");
   }
  }

