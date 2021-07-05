<?php
session_start();
require_once "pdo.php";

if(!empty($_POST['remember'])) {
	setcookie ('email',$_POST['email'],time()+ 3600);
	setcookie ('password',$_POST['password'],time()+ 3600);
  setcookie ('remember',$_POST['remember']);
}

if(isset($_POST['login'])){

	$check = hash('md5', $_POST['password']).'';
  $_SESSION['oldEmail'] = $_POST['email'];

  if (strlen($_POST['email']) < 1) {
    $_SESSION['message'] = "Please enter your email";
  }
  elseif (strlen($_POST['password']) < 1) {
    $_SESSION['message'] = "Please enter your password";
  }
  elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $_SESSION['message'] = "Please enter valid email";
  }
  else{
    $sql = "SELECT email FROM admin WHERE email = :em";
    $stmt = $pdo -> prepare($sql);
    $stmt->execute(array(
      ':em' => $_POST['email']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row != 0){
      if(implode("",$row) == $_POST['email']){
        $stmt = $pdo->query("SELECT password  FROM admin where password ='".$check."'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row != 0){
          if(implode("",$row) == $check){
            header("Location: admin_dashboard.php");
            return;
          }
        }
        else{
          $_SESSION['message'] = "Wrong password";
        }
      }
    }
    else {
      $_SESSION['message'] = "Wrong email";
    }
  }
}
else{
  session_unset();
}

 ?>
<html lang="en" dir="ltr">
  <head>
    <style>
		h1{
        text-align:center;
        color: white;
        text-shadow: 3px 3px gray;
				font-family: 'Titillium Web', sans-serif;
      }
		body{
			background-image: url('https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm218batch3-ning-05.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=6bb5381f3b078fab24ee49febf3e5d86');
			font-family: 'Quicksand', sans-serif;
      font-weight: 300;
			height: 100%;
		  background-position: center;
		  background-repeat: no-repeat;
		  background-size: cover;
		}
		.container1{
        display: grid;
        place-items: center;
        background-color: white;
        width: 350px;
        height: 130px;
        border-radius: 5px;
        margin: auto;
      }
			.container2{
				display: grid;
        place-items: center;
			}
			input[type=submit]{
        box-shadow: 2px 2px 5px grey;
        border: none;
        background-color: brown;
        color: white;
        font-weight: bold;
        width: 100px;
        height: 25px;
        border-radius: 5px;
      }
    </style>
		<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>
  <body>
    <?php
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
    $oldEmail = isset($_SESSION['oldEmail']) ? $_SESSION['oldEmail'] : "";
     ?>
    <h1>Admin Log In</h1>
		<div class="container2">
			<p style="color: red;"> <?php echo $message; ?> </p>
		</div>
		<div class="container1">
			<form method="post">
	      <table>

	        <tr>
	          <td>Email</td>
	          <td>:</td>
	          <td> <input type="text" name="email" value="<?php
	          if(isset($_COOKIE['email'])) { echo $_COOKIE['email'];}
	          echo $oldEmail ?>"> </td>
	        </tr>

	        <tr>
	          <td>Password</td>
	          <td>:</td>
	          <td> <input type="password" name="password" value="<?php
	          if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];}
	           ?>"> </td>
	        </tr>
	      </table>
	      <table>
	        <tr>
	          <td> <input type="checkbox" name="remember"> Remember me</td>
	          <td> <input class="" type="submit" name="login" value="Log In"> </td>
	        </tr>
	      </table>
	    </form>
		</div>
		<div class="container2">
					<p>Go to <a href="index.php">Main Page</a> </p>
		</div>
  </body>
</html>
