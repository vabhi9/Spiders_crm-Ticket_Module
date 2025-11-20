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
        <button>Register</button>
    </form>
</div>