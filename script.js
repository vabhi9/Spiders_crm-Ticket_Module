const registerBtn = document.querySelector("#registerBtn");
const registerForm = document.querySelector(".registerForm");

const loginBtn = document.querySelector("#signin")
const loginForm = document.querySelector(".loginForm");


registerBtn.addEventListener("click", () => {
  loginForm.style.display = "none";
  registerForm.style.display = "block";
});

loginBtn.addEventListener("click", ()=>{
    loginForm.style.display = "block"
    registerForm.style.display = "none"
})


// As like in react we create separate components in separate files and folder and then Render them Conditionally, If I've two separate php files, and i wanna Keep them as
