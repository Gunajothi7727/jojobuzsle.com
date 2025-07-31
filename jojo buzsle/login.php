
<?php

session_start();

$errors = [

'login' => $_SESSION['login_error'] ?? '',

'register' => $_SESSION['register_error'] ?? ''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError ($error) {
return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {

return $formName === $activeForm? 'active':'';

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: Arial, sans-serif;
          
        }

        .background {
            background-image: url("icon.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
.content {
      text-align: center;
      position: relative;
      z-index: 1;
      padding: 50px;
      color: white;         
    }
        .login-box {
            width: 350px;
            margin: 100px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
         
         
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-box input[type="submit"] {
            width: 100%;
            background-color: blue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-box input[type="submit"]:hover {
            background-color: blue;
        }

        .login-box p {
            text-align: center;
            margin-top: 15px;
        }

        

        .error-box {
            background-color: #fdecea;
            color: #b71c1c;
            border: 1px solid #f5c6cb;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <?php if (!empty($errors['register'])): ?>
        <div class="error-box">
            <?= showError($errors['register']) ?>
        </div>
    <?php endif; ?>

    
    <form action="logindata.php" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="signin.php">Register</a></p>
</div>

<div class="background"></div>

</body>
</html>
