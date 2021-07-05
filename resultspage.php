<?php
session_start();
require "pdo.php";
if(isset($_POST['return'])){
  session_unset();
  header('Location: register_project.php');
}
$personID = $_SESSION['id'];
$stmt = $pdo->query("SELECT answer_id FROM persons_ans");
$data = array();
$data1 = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
  $data[] = $row['answer_id'];
}
$stmt2 = $pdo->query("SELECT rating FROM answers INNER JOIN persons_ans ON answers.answer_id = persons_ans.answer_id WHERE persons_ans.person_id = $personID");
while ( $row = $stmt2->fetch(PDO::FETCH_ASSOC) ) {
  $data1[] = $row['rating'];
}

$stmt3 = $pdo->query("SELECT question FROM questions");
while ( $row = $stmt3->fetch(PDO::FETCH_ASSOC) ) {
  $data3[] = $row['question'];
}
$stmt4 = $pdo->query("SELECT answer FROM answers INNER JOIN persons_ans ON answers.answer_id = persons_ans.answer_id WHERE persons_ans.person_id = $personID");
while ( $row = $stmt4->fetch(PDO::FETCH_ASSOC) ) {
  $data4[] = $row['answer'];
}
$_SESSION['result'] = array();
$_SESSION['result'] [] = array(
                                  "Question1" => $data3[0],
                                  "answer1" => $data4[0],
                                  "rating1" => $data1[0],
                                  "Question2" => $data3[1],
                                  "answer2" => $data4[1],
                                  "rating2" => $data1[1],
                                  "Question3" => $data3[2],
                                  "answer3" => $data4[2],
                                  "rating3" => $data1[2],
                                  "Question4" => $data3[3],
                                  "answer4" => $data4[3],
                                  "rating4" => $data1[3],
                                  "Question5" => $data3[4],
                                  "answer5" => $data4[4],
                                  "rating5" => $data1[4],
                                  "Question6" => $data3[5],
                                  "answer6" => $data4[5],
                                  "rating6" => $data1[5],
                                  "Question7" => $data3[6],
                                  "answer7" => $data4[6],
                                  "rating7" => $data1[6],
                                  "Question8" => $data3[7],
                                  "answer8" => $data4[7],
                                  "rating8" => $data1[7],
                                  "Question9" => $data3[8],
                                  "answer9" => $data4[8],
                                  "rating9" => $data1[8],
                                );
$_SESSION['totalRating'] = array_sum($data1);
$totalRatingValue = $_SESSION['totalRating'];
$stmt5 = $pdo->query("SELECT * FROM depressions WHERE $totalRatingValue BETWEEN min AND max");
while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)) {
  $_SESSION['finalResult'] = $row['depression_level'];
  $_SESSION['DepressionID'] = $row['depression_id'];
}
$depressionID = $_SESSION['DepressionID'];
$sql = "UPDATE persons_data SET depression_id = $depressionID WHERE person_id = $personID";
$stmt = $pdo->prepare($sql);
$stmt->execute(array());
 ?>
<!DOCTYPE html>
<html style = "font-family: 'Titillium Web', sans-serif;">
   <head>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">
      <title>Muhammad Zikri Bin Mohd Shafie 204237</title>
      <script type = "text/javascript" src = "jquery.min.js">
      </script>
      <style>
      h1{
          text-align:center;
          color: white;
          text-shadow: 3px 3px gray;
  				font-family: 'Titillium Web', sans-serif;
        }
      table {
        border-collapse: collapse;
        width: 100%;
      }
      th, td {
        text-align: left;
        padding: 8px;
      }
      .center {
        margin: auto;
        width: 50%;
        padding: 10px;
      }
      .row {
        display: flex;
        border-radius: 25px; /* equal height of the children */
      }

      .col {
        flex: 1;
        border-radius: 25px; /* additionally, equal width */
        padding: 1em;
        border: solid;
      }
      .button{
        background:url('https://media.istockphoto.com/vectors/paper-texture-background-vector-id1199971584?k=6&m=1199971584&s=612x612&w=0&h=A-Jj4ia-XHzdj8iwAliGkwsNknboBVnryjW2SglhGZU=');
        border: none;
        color: black;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
      }
      tr:nth-child(even){background-color: #f2f2f2}
      tr:nth-child(odd){background:url('https://lh5.googleusercontent.com/proxy/Joxb8ytEDfHvf9QNLGTOCEGy8LLov_QBsekzr0u9Ejgntb277hkF_hYDgF-cU9w-SkjAo6aoTb3RaND8Zv8_F3dR_akuGcFGH7Z-TeqwNclXU28i-w8XO5npoLKZNmjf2whb96pHtu31PkcAU9iU79FtY4Pb=s0-d')}
      th {
        background:url('https://png.pngtree.com/thumb_back/fw800/background/20210504/pngtree-art-of-vintage-paper-aesthetic-image_701486.jpg');
        color: white;
      }
      </style>
   </head>
   <body style="text-align:center;background-image: url('https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm218batch3-ning-05.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=6bb5381f3b078fab24ee49febf3e5d86');">
     <h1>Your Mental Health Results</h1>
     <div id = "resultslist">
       <table class="center" style = "width:100%">
         <tr>
           <th>Questions</th>
           <th>Answer</th>
           <th>Rating</th>
         </tr>
       </table>
     </div>
       <script type = "text/javascript" src = "jquery.min.js">
       </script>
       <script type = "text/javascript">
        function updateResults(){
          window.console && console.log('Requesting JSON');
          $.getJSON('resultslist.php', function(rowz){
            window.console && console.log('JSON Received');
            window.console && console.log(rowz);
            for(var i = 0; i<rowz.length; i++){
              entry = rowz[i];
              $('#resultslist tr:last').after(
                "<tr>"+
                  "<td>"+entry['Question1']+"</td>"+
                  "<td>"+entry['answer1']+"</td>"+
                  "<td>"+entry['rating1']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question2']+"</td>"+
                  "<td>"+entry['answer2']+"</td>"+
                  "<td>"+entry['rating2']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question3']+"</td>"+
                  "<td>"+entry['answer3']+"</td>"+
                  "<td>"+entry['rating3']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question4']+"</td>"+
                  "<td>"+entry['answer4']+"</td>"+
                  "<td>"+entry['rating4']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question5']+"</td>"+
                  "<td>"+entry['answer5']+"</td>"+
                  "<td>"+entry['rating5']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question6']+"</td>"+
                  "<td>"+entry['answer6']+"</td>"+
                  "<td>"+entry['rating6']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question7']+"</td>"+
                  "<td>"+entry['answer7']+"</td>"+
                  "<td>"+entry['rating7']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question8']+"</td>"+
                  "<td>"+entry['answer8']+"</td>"+
                  "<td>"+entry['rating8']+"</td>"+
                "</tr>"+
                "<tr>"+
                  "<td>"+entry['Question9']+"</td>"+
                  "<td>"+entry['answer9']+"</td>"+
                  "<td>"+entry['rating9']+"</td>"+
                "</tr>"
              );
            }
          })
        }
        $(document).ready(function() {
          $.ajaxSetup({ cache: false });
          updateResults();
        });
        </script>
        <br>
        <br>
        <div>
        <table>
          <tr>
            <th>Total Rating</th>
            <th>Desperation Severity</th>
          </tr>
          <tr>
            <td><?php echo $_SESSION['totalRating'] ?></td>
            <td><?php echo $_SESSION['finalResult'] ?></td>
          </tr>
        </table>
      </div>
      <p>Do note that this questionnaire is just an early screening<br> If you experience any severe depression systems, do contact the following hotlines</p>
      <div class="row">
        <br>
        <div class = "col" style="background:url('https://static.vecteezy.com/system/resources/previews/002/442/476/non_2x/white-grey-paper-texture-background-kraft-paper-for-aesthetic-creative-design-free-photo.jpg'); width:450px;display:inline-block">
          <h4>BEFRIENDERS</h4>
                    <p><b>Hotline numbers: </b></p>
                    <p>KL: 03-7956 8145 (24 hours)</p>
                    <p>Ipoh: 05-547 7933 (4pm to 11pm)</p>
                    <p>Penang: 04-281 5161 (3pm to midnight)</p>
                    <p><b>E-Mail: </b>sam@befrienders.org.my</p>
                    <p><b>Website: </b>https://www.befrienders.org.my/</p>
                    <p> </p>
                    <p>Befrienders is a not-for-profit organisation providing emotional support 24 hours a day, 7 days a week, to people who are lonely, in distress, in despair, and having suicidal thoughts - without charge.<br />
                    </p>
        </div>
        <div class = "col" style="background:url('https://static.vecteezy.com/system/resources/previews/002/442/476/non_2x/white-grey-paper-texture-background-kraft-paper-for-aesthetic-creative-design-free-photo.jpg'); width:450px;display:inline-block">
          <h4>Malaysian Mental Health Association (MMHA)</h4>
                    <p><b>Contact Number: </b></p>
                    <p>03-2780 6803</p>
                    <p><b>E-Mail: </b>admin@mmha.org.my</p>
                    <p><b>Website: </b>https://mmha.org.my/</p>
                    <p> </p>
                    <p>Malaysian Mental Health Association provides support via their phone line on any mental health issues. MMHA also has qualified mental health professionals ie. clinical psychologist, and counselors providing psychological support services. Financial subsidies are readily available to ensure that necessary therapy and support is given to anyone who needs it.<br />
                    </p>
        </div>
        <br><br>
        <div class = "col" style="background:url('https://static.vecteezy.com/system/resources/previews/002/442/476/non_2x/white-grey-paper-texture-background-kraft-paper-for-aesthetic-creative-design-free-photo.jpg'); width:450px;display:inline-block">
          <h4>SOLS Health</h4>
                    <p><b>Contact Number: </b></p>
                    <p>6018-664-0247</p>
                    <p><b>E-Mail: </b>solshealth@sols247.org</p>
                    <p><b>Website: </b>https://www.sols247.org/solshealth</p>
                    <p> </p>
                    <p>SOLS Health is a behavioural health centre that connects clients to accessible individual, family and community mental health and nutritional services with an emphasis on combating the stigma of mental health in Malaysia.
                      Clients with a monthly household income below a certain threshold will qualify for subsidized rates. <br />
                    </p>
        </div>
        <div class = "col" style="background:url('https://static.vecteezy.com/system/resources/previews/002/442/476/non_2x/white-grey-paper-texture-background-kraft-paper-for-aesthetic-creative-design-free-photo.jpg'); width:450px;display:inline-block">
          <h4>MIASA</h4>
                    <p><b>Contact Number: </b></p>
                    <p>03-7732 2414</p>
                    <p>6013-878-1322</p>
                    <p>6019-236-2423</p>
                    <p><b>E-Mail: </b>miasa.malaysia@gmail.com</p>
                    <p><b>Website: </b>http://miasa.org.my/</p>
                    <p> </p>
                    <p>MIASA offers various programs for patients and carers including:
                      Support Group
                      Therapeutic Assessment
                      Circle Time & Support Programmes
                      Islamic spiritual therapy<br/>
                    </p>
        </div>

      </div>
      <br><br>
      <form method="post" >
            <input class = "button" type="submit" name= "return" value="Do Another Test">
      </form>
   </body>
</html>
