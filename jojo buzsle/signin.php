
<?php
session_start();

$errors = [
    'register' => $_SESSION['register_error'] ?? ''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

// Clear only specific session values (don't clear all)
unset($_SESSION['register_error']);
unset($_SESSION['active_form']);

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}
?>

<html>
    <head>
        <title>Sign In</title>
        <link rel="icon" href="icon.png">
    </head>
    
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

    
   .signup {
      width: 350px;
      margin: 100px auto;
      padding: 30px;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    .signup h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .signup input[type="text"],
    .signup input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .signup input[type="submit"] {
      width: 100%;
      background-color: blue;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .signup input[type="submit"]:hover {
      background-color: blue;
    }

    .signup p {
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

  <div class="signup">
    <h2>Signin</h2>
    <?php if (!empty($errors['register'])): ?>
        <div class="error-box">
            <?= showError($errors['register']) ?>
        </div>
    <?php endif; ?>

    <form action="signup.php
    " method="post">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter your username" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
      <label for="nickname">Nickname</label>
      <input type="text" id="nickname" name="nickname" placeholder="Enter your nickname" required>

      <input type="submit" value="Signup">
    </form>

  </div>
  <div class="background"></div>

</body>


</html>

            