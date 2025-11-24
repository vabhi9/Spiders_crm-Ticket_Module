<div class="loginForm">
    <h1>Login</h1>
    <form action="./server/authentication/login.php" method="POST">
        <input type="text" name="username"  placeholder="Username">
        <input type="password" name="password"  placeholder="Password">
        <h4 id="registerBtn">Register?</h4>
        <button type="submit" class="loginButton">Login</button>
    </form>
        <script>
        // const loginForm = document.querySelector(".loginForm");
        // const registerForm = document.querySelector(".registerForm");
        
        const registerBtn = document.querySelector("#registerBtn");

        registerBtn.addEventListener("click", () => {
            loginForm.style.display = "none";
            registerForm.style.display = "block";
        });
    </script>
</div>