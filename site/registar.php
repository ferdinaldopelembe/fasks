

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>fasks</title>
  <style>
    :root {
      --primary: #2445a2ff;
      --border-radius: 4px;
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      background-color: #eee;
      height: 100dvh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .right{
      width: 30vw;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0px 5px 15px #6a6969ff;
      min-width: 350px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px 24px;
    }
    .field {
      border-radius: var(--border-radius);
      border: 1px #dadae4ff solid;
      width: 100%;
      margin: 8px;
      outline: none;
      margin: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 4px;
    }

    .field input {
      background-color: transparent;
      outline: none;
      border: none;
      padding: 10px 8px;
      flex: 1;
      border-radius: var(--border-radius);
    }
    .field i {
      color: gray;
      font-size: 12pt;
    }

    .field:focus-within {
      background-color: #d9dff0ff;
      margin: 7px;
      border: 2px #7474b3ff solid;
    }
    input[type="submit"] {
      margin-bottom: 6px;
      padding: 12px 8px;
      border: none;
      width: 100%;
      border-radius: var(--border-radius);
      font-weight: 400;
      color: #fff;
      font-size: 11pt;
      background: linear-gradient(330deg, #2b2358ff, #2445a2ff);
    }
    input[type="submit"], button {
      cursor: pointer;
    }
     .right h2 {
      font-size: 2rem;
    }
   
    .right h2 {
      color: #133cabff;
      text-transform: uppercase;
      padding-bottom: 10px;
    }
    .message {
      padding: 12px 8px;
      text-align: center;
      width: 100%;
      color : #cd4e4eff;
      background-color: #d490903e;
      border-radius: var(--border-radius);
      border: 1px solid #cd4e4eff;
    }
  </style>
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
  
<?php

require_once '../includes/functions.php';


$message;

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];
  
  if ($confirm_password != $password) {
    $message = 'As senhas não correspondem!';
  } else {
    $message = registerUser($username, $password);
  }

  if ($message == '') {
    header('Location: index.php');
  }

}

?>

  <form class="right" method="POST" action="#">
      <h2>Registar</h2>
      <?php
      if (isset($message)) {
        echo '<span class=\'message\'>' . $message . '</span>'; 
      }
      ?>
      <div class="username-input field">
        <i class="fa-solid fa-user"></i>
        <input type="text" placeholder="nome de usuario" name="username" required>
      </div>
      <div class="password-input field">
        <i class="fa-solid fa-lock"></i>
        <input type="password" placeholder="criar senha" name="password" required>
      </div>
      <div style="margin-bottom: 12px;" class="password-input field">
        <i class="fa-solid fa-lock"></i>
        <input  type="password" placeholder="criar senha" name="confirm-password" required>
      </div>
      <input type="submit" value="SIGN UP">
      <p style="color: #6a6a6aff">já possui uma conta? <a style="text-decoration: none; color: var(--primary);" href="login.php">entrar</a></p>
  </form>
</body>
</html>