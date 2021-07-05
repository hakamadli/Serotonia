<?php
session_start();
require "pdo.php";
$age = isset($_POST['age']) ? $_POST['age'] : '';
if(isset($_POST['Cancel'])){
  header('Location: index.php');
  return;
}
if(isset($_POST['age']) && is_numeric($_POST['age'])){
  if(isset($_POST['gender'])){
     $stmt = $pdo->query("SELECT COUNT(*) AS personid FROM persons_data");
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     $_SESSION['id'] = $row['personid'] + 1;
     $_SESSION['age'] = $_POST['age'];
     $_SESSION['gender'] = $_POST['gender'];
     $age = $_POST['age'];
     $sql = "INSERT INTO persons_data (person_id, age, gender) VALUES (:personid, :age, :gender)";
     $stmt = $pdo->prepare($sql);
     $stmt->execute(array(
       ':personid' => $_SESSION['id'],
       ':age' => $_POST['age'],
       ':gender' => $_POST['gender']
     ));
     header('Location: Qsection1.php');
  }
  else{
    $invalid_message = "Please select a gender";
  }
}
else if (isset($_POST['age']) && !is_numeric($_POST['age'])){
  $invalid_message = "Please enter a number for age";
}
else{
  $invalid_message = "Please enter all details";
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr" style = "height: 100%;">
  <head>
      <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">
    <style media="screen">
    body{
      font-family: 'Quicksand', sans-serif;
      font-weight: 300;
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
    </style>
    <meta charset="utf-8">
    <title>Start Questionnaire</title>
  </head>
  <body style = "background-image: url('https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm218batch3-ning-05.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=6bb5381f3b078fab24ee49febf3e5d86');
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;">
    <h1>Enter Personal Details : </h1>
    <img src="psi.png" alt="pscyhology" width="250" height="200">
    <h2><?php echo $invalid_message ?></h2>
    <form method="post" >
      <table class = "center">
        <tr>
          <td>Age :</td>
          <td> <input type="text" name="age" value="<?php echo htmlentities($age)?>"> </td>
        </tr>
          <td>Gender :</td>
          <td>
            <input type="radio" id="male" name="gender" value="male">
            <label for="Insource">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="Co-source">Female</label>
          </td>
        </tr>
      </table>
      <br>
      <table class = "center">
        <tr>
          <td> <input type="submit" name= "Cancel" value="Cancel"></td>
          <td> <input type="submit" name = "Register" value="Register"> </td>
        </tr>
      </table>
    </form>
  </body>
</html>
