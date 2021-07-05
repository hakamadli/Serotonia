<?php
//session_start();
require_once "pdo.php";
$hashpassword = "";
if(isset($_POST['register'])){

    $_SESSION['oldName'] = $_POST['name'];
    $_SESSION['oldEmail'] = $_POST['email'];

  if(strlen($_POST['name']) < 1){
    $_SESSION['message'] = "Insert your name.";
    $_SESSION['successMessage'] = "test";
  }
  elseif(strlen($_POST['email']) < 1){
    $_SESSION['message'] = "Insert your email";
  }
  elseif (strlen($_POST['password']) < 1) {
    $_SESSION['message'] = "Input your password";
  }
  elseif (strlen($_POST['confirm-password']) < 1){
    $_SESSION['message'] = "Input confirm password";
  }
  elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = "Please enter a valid email";
  }
  elseif($_POST['password'] != $_POST['confirm-password']){
    $_SESSION['message'] = "Password not matched";
  }
  else {
    $sql = "SELECT email FROM admin WHERE email = :em";
    $stmt = $pdo -> prepare($sql);
    $stmt->execute(array(
      ':em' => $_POST['email']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row != 0){
      $_SESSION['message'] = "Email has been already registered.";
    }
    else {
      $hashpassword = hash('md5', $_POST['password']).'';
      $sql = "INSERT INTO admin (email, name, password) VALUES (:em, :name, :password)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':em' => $_POST['email'],
        ':name' => $_POST['name'],
        ':password' => $hashpassword
      ));

      $_SESSION['successMessage'] = 'Successfully registered!';
      header("Location: index.php");
      return;
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
        width: 400px;
        height: 190px;
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
    <title></title>
  </head>
  <body>
    <?php
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
    $oldName = isset($_SESSION['oldName']) ? $_SESSION['oldName'] : "";
    $oldEmail = isset($_SESSION['oldEmail']) ? $_SESSION['oldEmail'] : "";
    $successMessage = isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : "";
     ?>
    <h1>Register New Admin</h1>
    <div class="container2">
      <p style="color: red;"><?php echo $message;?></p>
    </div>
    <div class="container1">
      <form method="post">
        <table>
          <tr>
            <td>Name</td>
            <td>:</td>
            <td> <input type="text" name="name" value= "<?= htmlentities($oldName)?>"
              > </td>
          </tr>

          <tr>
            <td>Email</td>
            <td>:</td>
            <td> <input type="text" name="email" value="<?= htmlentities($oldEmail)?>"> </td>
          </tr>

          <tr>
            <td>Password</td>
            <td>:</td>
            <td> <input type="password" name="password" value=""> </td>
          </tr>

          <tr>
            <td>Confirm Password</td>
            <td>:</td>
            <td> <input type="password" name="confirm-password" value=""> </td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td> <input type="submit" name="register" value="Register"> </td>
          </tr>
        </table>
      </form>
    </div>
    <div class="container2">
      <p>Go to <a href="admin_dashboard.php"> dashboard.</a></p>
    </div>
  </body>
</html>
