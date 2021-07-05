<?php
session_start();
require "pdo.php";
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
if(isset($_POST['save'])){
  for($i = 1;$i<=9;$i++){
    if (!isset($_POST[$i])) {
      $_POST['invalid'] = true;
      break;
    }
  }
  if(isset($_POST['invalid'])){
    $_SESSION['message'] = "Please answer all questions";
    header('Location: Qsection1.php');
  }
  else{
    $count = $_SESSION['questionsCount'];
  for($i = 0;$i<$count;$i++){
    $m = $i+1;
    $sql = "INSERT INTO persons_ans (person_id, answer_id) VALUES (:personid, :answer_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':personid' => $_SESSION['id'],
      ':answer_id' => $_POST[$m]
    ));
    header('Location: resultspage.php');
  }
}
}
 ?>

<html lang="en" dir="ltr">
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
    .button{
      background-image:url('https://lh5.googleusercontent.com/proxy/Joxb8ytEDfHvf9QNLGTOCEGy8LLov_QBsekzr0u9Ejgntb277hkF_hYDgF-cU9w-SkjAo6aoTb3RaND8Zv8_F3dR_akuGcFGH7Z-TeqwNclXU28i-w8XO5npoLKZNmjf2whb96pHtu31PkcAU9iU79FtY4Pb=s0-d');
      border: none;
      color: black;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      box-shadow: 2px 2px 5px grey;
    }
    body{
      font-family: 'Quicksand', sans-serif;
      font-weight: 500;
    }
    .container1{
        display: grid;
        background-color: white;
        width: 600px;
        border-radius: 5px;
        margin: auto;
        padding-left: 1em;
      }
    </style>
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>
  <body style = "max-width: 500px;margin: auto;background:url('https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm218batch3-ning-05.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=6bb5381f3b078fab24ee49febf3e5d86');background-size: cover;">
    <h1>Answer all questions</h1>
    <img src="clinical.png" alt="pscyhology" width="300" height="300">
    <h3 style = "color:red"><?php echo $message ?></h3>
    <form method = "post">
      <div class="container1">
        <?php
        require "pdo.php";
        $questions = [];
        $questionsCounter = 0;
        $answersCounter = 0;
        $stmt = $pdo->query("SELECT * FROM questions");
        while ( $question = $stmt->fetch(PDO::FETCH_ASSOC) ) {
          $questions[$questionsCounter] = $question['question'];
          $stmt1 = $pdo->query("SELECT * FROM answers where question_id = $questionsCounter+1");
          while ( $answer = $stmt1->fetch(PDO::FETCH_ASSOC) ) {
            $answers[$questionsCounter][$answersCounter] = $answer["answer"];
            $answersID[$questionsCounter][$answersCounter] = $answer["answer_id"];
            $answersRating[$questionsCounter][$answersCounter] = $answer["rating"];
            ++$answersCounter;
          }
          $answersCounter = 0;
          ++$questionsCounter;
        }
        $_SESSION['questionsCount'] = count($answers);
          for($i = 0; $i < count($answers);$i++){
            echo "<br><p> $questions[$i]</p>";
            for($j = 0; $j < count($answers[$i]); $j++){
          $value = $answers[$i][$j];
          $answerID = $answersID[$i][$j];
          $rating = $answersRating[$i][$j];
          $k = $i+1;
          echo "<p><input type=\"radio\" name=\"$k\" value=\"$answerID\">";
          echo "<label for=\"$value\">$value</label></p>";

        }
          }
         ?>
      </div>
     <br>
     <input class = "button" type="submit" name="save" value="Get Your Diagnosis" style = "margin:auto;display:block;">
   </form>
  </body>
</html>
