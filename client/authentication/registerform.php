<div class="registerForm">
    <h1>Register</h1>
    <form action="./server/authentication/register.php" method = "POST">
        <input type="text" name="username"  placeholder="Username">
        <input type="password" name="password"  placeholder="Password">
        <input type="text" name="fullname"  placeholder="Full Name">
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <h4 id="signin">Already have an Accorunt?</h4>
        <button class='registerUserBtn'>Register</button>
    </form>
    <script>
        const loginForm = document.querySelector(".loginForm");
        const registerForm = document.querySelector(".registerForm");
        
        const loginBtn = document.querySelector("#signin");

        loginBtn.addEventListener("click", () => {
            loginForm.style.display = "block";
            registerForm.style.display = "none";
        });
    </script>
</div>