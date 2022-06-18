<html>

<head>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign in</title>
  <link rel="stylesheet" href="admin/style.css">
</head>

<body>
  <div class="main">
    <p class="sign" align="center">Sign in</p>
    <?php 
      session_start();
      if($_SESSION['status'] == 'gagal login'){
        echo "username dan password salah";
      }
    ?>
    <form class="form1" action="admin/login.php" method="POST">
      <input class="un " type="text" name="username" align="center" placeholder="Username" required>
      <input class="pass" type="password" name="password" align="center" placeholder="Password" required>
      <button name="submit" class="submit">Sign in</button>
      <p class="forgot" align="center"><a href="#">Forgot Password?</p>
    </form>


  </div>

</body>

</html>