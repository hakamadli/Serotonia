<?php
session_start();
require "pdo.php";
if(isset($_POST['Start'])){
  header('Location: register_project.php');
  return;
}
if(isset($_POST['Login'])){
  header('Location: login_admin.php');
  return;
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style = "height: 100%;">
  <head>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">
    <style>
    h1{
        text-align:center;
        color: white;
        text-shadow: 3px 3px gray;
				font-family: 'Titillium Web', sans-serif;
      }
    table.center {
      margin-left: auto;
      margin-right: auto;
    }
    input[type=submit]{
      box-shadow: 2px 2px 5px grey;
      border: none;
      background-color: brown;
      color: white;
      font-weight: bold;
      width: 200px;
      height: 30px;
      border-radius: 5px;
      cursor: pointer;
    }
    body{
      font-family: 'Quicksand', sans-serif;
      font-weight: 300;
    }
    </style>
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>
  <body style = "background-image: url('https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm218batch3-ning-05.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=6bb5381f3b078fab24ee49febf3e5d86');
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;">
    <h1>Hello! Welcome to Serotonia </h1>
     <img src="psycho.png" alt="pscyhology" width="400" height="400">
    <form method="post" >
      <table class = "center">
        <tr>
          <td> <input type="submit" name= "Login" value="Admin? Login here"></td>
          <td> <input type="submit" name = "Start" value="Start the questionnaire!"> </td>
        </tr>
      </table>
    </form>
  </body>
</html>
