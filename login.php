<!--- http://www.ondeweb.in/ajax-login-form-with-jquery-and-php/ -->
<h1>User Login</h1>
<div class="err" id="add_err"></div>
<fieldset>
    <form action="login.php" method="post">
        <ul>
            <li> <label for="name">Email </label>
                <input type="text" size="30"  name="email" id="email"  /></li>
            <li> <label for="name">Password</label>
                <input type="password" size="30"  name="password" id="password"  /></li>
            <li> <label></label>
                <input type="submit"  id="login2" name="login" value="Login" class="loginbutton" ></li>
        </ul>
    </form>
</fieldset>
</div>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
