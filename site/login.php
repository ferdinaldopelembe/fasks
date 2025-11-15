

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>fasks</title>
  <style>
    :root {
      --border-radius: 8px;
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
    .container {
      border-radius: var(--border-radius);
      min-height: 350px;
      background-color: #fff;
      box-shadow: 0px 10px 15px #2d2f41ff;
      /* padding: 12px; */
      /* gap: 24px; */
      display: flex;
      flex-direction: row;
      width: 700px;
    }
    .right, .left {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 16px 24px;
    }
    .right input, button{
      border-radius: var(--border-radius);
      border: 1px #6e6e9aff solid;
      width: 100%;
      margin: 8px;
      padding: 12px 8px;
      outline: none;
      margin: 8px;
    }

    

    input:focus-within {
      margin: 7px;
      border: 2px #7474b3ff solid;
    }
    input[type="submit"] {
      /* border-radius: 999px; */
      font-weight: 400;
      color: #fff;
      font-size: 11pt;
      background: linear-gradient(330deg, #2b2358ff, #2445a2ff);
    }
    input[type="submit"], button {
      cursor: pointer;
    }
    .left h2, .right h2 {
      font-size: 2rem;
    }
    .left {
      border-right: dashed 5px #ffffffff;
      text-align: center;
      border-radius: var(--border-radius) 0 0 var(--border-radius);
      color: #fff;
      background: linear-gradient(330deg, #2b2358ff, #2445a2ff);
    }
    .left button {
      width: 50%;
      font-size: 11pt;
      color: #fff;
      border-radius: var(--border-radius);
      background-color: transparent;
      border: 2px #fff solid;
    }
    .right, .left {
      width: 50%;
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
</head>
<body>
  
<?php

require_once '../includes/functions.php';


$message;

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (loginUser($username, $password)) {
    header('Location: index.php');
  } else {
    $message = 'invalid credentials, try again!';
  }
}

?>

  <div class="container">
    <div class="left">
      <h2>Hi, Welcome Back!</h2>
      <button>SIGN UP</button>
    </div>
    <form class="right" method="POST" action="#">
      <h2>Login</h2>
      <?php
      if (isset($message)) {
        echo '<span class=\'message\'>' . $message . '</span>'; 
      }
      ?>
      <input type="text" name="username" required>
      <input type="password" name="password" required>
      <input type="submit" value="SIGN IN">
    </form>
  </div>
</body>
</html>