<?php
//session_start();
require "pdo.php";

if(isset($_POST['Return'])){
  header('Location: admin_dashboard.php');
  return;
}

$stmtG1 = $pdo->query("SELECT gender, count(*) as number FROM persons_data WHERE depression_id = 1 GROUP BY Gender");
$stmtG2 = $pdo->query("SELECT gender, count(*) as number FROM persons_data WHERE depression_id = 2 GROUP BY Gender");
$stmtG3 = $pdo->query("SELECT gender, count(*) as number FROM persons_data WHERE depression_id = 3 GROUP BY Gender");
$stmtG4 = $pdo->query("SELECT gender, count(*) as number FROM persons_data WHERE depression_id = 4 GROUP BY Gender");
$stmtG5 = $pdo->query("SELECT gender, count(*) as number FROM persons_data WHERE depression_id = 5 GROUP BY Gender");

$stmtA1 = $pdo->query("SELECT SUM(CASE WHEN age < 16 THEN 1 ELSE 0 END) AS 'Under_16',
                        SUM(CASE WHEN age BETWEEN 17 AND 30 THEN 1 ELSE 0 END) AS '17-30',
                        SUM(CASE WHEN age BETWEEN 31 AND 45 THEN 1 ELSE 0 END) AS '31-45',
                        SUM(CASE WHEN age > 45 THEN 1 ELSE 0 END) AS 'Above_45'
FROM persons_data WHERE depression_id = 1");
$stmtA2 = $pdo->query("SELECT SUM(CASE WHEN age < 16 THEN 1 ELSE 0 END) AS 'Under_16',
                        SUM(CASE WHEN age BETWEEN 17 AND 30 THEN 1 ELSE 0 END) AS '17-30',
                        SUM(CASE WHEN age BETWEEN 31 AND 45 THEN 1 ELSE 0 END) AS '31-45',
                        SUM(CASE WHEN age > 45 THEN 1 ELSE 0 END) AS 'Above_45'
FROM persons_data WHERE depression_id = 2");
$stmtA3 = $pdo->query("SELECT SUM(CASE WHEN age < 16 THEN 1 ELSE 0 END) AS 'Under_16',
                        SUM(CASE WHEN age BETWEEN 17 AND 30 THEN 1 ELSE 0 END) AS '17-30',
                        SUM(CASE WHEN age BETWEEN 31 AND 45 THEN 1 ELSE 0 END) AS '31-45',
                        SUM(CASE WHEN age > 45 THEN 1 ELSE 0 END) AS 'Above_45'
FROM persons_data WHERE depression_id = 3");
$stmtA4 = $pdo->query("SELECT SUM(CASE WHEN age < 16 THEN 1 ELSE 0 END) AS 'Under_16',
                        SUM(CASE WHEN age BETWEEN 17 AND 30 THEN 1 ELSE 0 END) AS '17-30',
                        SUM(CASE WHEN age BETWEEN 31 AND 45 THEN 1 ELSE 0 END) AS '31-45',
                        SUM(CASE WHEN age > 45 THEN 1 ELSE 0 END) AS 'Above_45'
FROM persons_data WHERE depression_id = 4");
$stmtA5 = $pdo->query("SELECT SUM(CASE WHEN age < 16 THEN 1 ELSE 0 END) AS 'Under_16',
                        SUM(CASE WHEN age BETWEEN 17 AND 30 THEN 1 ELSE 0 END) AS '17-30',
                        SUM(CASE WHEN age BETWEEN 31 AND 45 THEN 1 ELSE 0 END) AS '31-45',
                        SUM(CASE WHEN age > 45 THEN 1 ELSE 0 END) AS 'Above_45'
FROM persons_data WHERE depression_id = 5");
?>
<!DOCTYPE html>
<html>
     <head>
       <style media="screen">
       .container2{
        display: grid;
         place-items: center;
      }
       </style>
          <title>Statistical Data</title>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart()
          {
               var dataG1 = google.visualization.arrayToDataTable([
                         ['Gender', 'Number'],
                         <?php
                         while($row = $stmtG1->fetch(PDO::FETCH_ASSOC))
                         {
                              echo "['".$row["gender"]."', ".$row["number"]."],";
                         }
                         ?>
                    ]);
               var optionsG1 = {
                     title: 'Percentage of Male and Female that are Normal',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartG1 = new google.visualization.PieChart(document.getElementById('piechartG1'));
               chartG1.draw(dataG1, optionsG1);
               var dataG2 = google.visualization.arrayToDataTable([
                         ['Gender', 'Number'],
                         <?php
                         while($row = $stmtG2->fetch(PDO::FETCH_ASSOC))
                         {
                              echo "['".$row["gender"]."', ".$row["number"]."],";
                         }
                         ?>
                    ]);
               var optionsG2 = {
                     title: 'Percentage of Male and Female that have Mild Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartG2 = new google.visualization.PieChart(document.getElementById('piechartG2'));
               chartG2.draw(dataG2, optionsG2);
               var dataG3 = google.visualization.arrayToDataTable([
                         ['Gender', 'Number'],
                         <?php
                         while($row = $stmtG3->fetch(PDO::FETCH_ASSOC))
                         {
                              echo "['".$row["gender"]."', ".$row["number"]."],";
                         }
                         ?>
                    ]);
               var optionsG3 = {
                     title: 'Percentage of Male and Female that have Moderate Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartG3 = new google.visualization.PieChart(document.getElementById('piechartG3'));
               chartG3.draw(dataG3, optionsG3);
               var dataG4 = google.visualization.arrayToDataTable([
                         ['Gender', 'Number'],
                         <?php
                         while($row = $stmtG4->fetch(PDO::FETCH_ASSOC))
                         {
                              echo "['".$row["gender"]."', ".$row["number"]."],";
                         }
                         ?>
                    ]);
               var optionsG4 = {
                     title: 'Percentage of Male and that have Moderately Severe Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartG4 = new google.visualization.PieChart(document.getElementById('piechartG4'));
               chartG4.draw(dataG4, optionsG4);
               var dataG5 = google.visualization.arrayToDataTable([
                         ['Gender', 'Number'],
                         <?php
                         while($row = $stmtG5->fetch(PDO::FETCH_ASSOC))
                         {
                              echo "['".$row["gender"]."', ".$row["number"]."],";
                         }
                         ?>
                    ]);
               var optionsG5 = {
                     title: 'Percentage of Male and Female that have Severe Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartG5 = new google.visualization.PieChart(document.getElementById('piechartG5'));
               chartG5.draw(dataG5, optionsG5);
               var dataA1 = google.visualization.arrayToDataTable([
                         ['Age', 'Group'],
                         <?php
                         while($row = $stmtA1->fetch(PDO::FETCH_ASSOC))
                         {
                           $u16 = "Under 16";
                           $b17_30 = "17-30";
                           $b31_45 = "31-45";
                           $a45 = "Above 45";
                              echo "['".$u16."', ".$row["Under_16"]."], ['".$b17_30."', ".$row["17-30"]."], ['".$b31_45."', ".$row["31-45"]."], ['".$a45."', ".$row["Above_45"]."],";
                         }
                         ?>
                    ]);
               var optionsA1 = {
                     title: 'Percentage of Age Group that are Normal',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartA1 = new google.visualization.PieChart(document.getElementById('piechartA1'));
               chartA1.draw(dataA1, optionsA1);
               var dataA2 = google.visualization.arrayToDataTable([
                         ['Age', 'Group'],
                         <?php
                         while($row = $stmtA2->fetch(PDO::FETCH_ASSOC))
                         {
                           $u16 = "Under 16";
                           $b17_30 = "17-30";
                           $b31_45 = "31-45";
                           $a45 = "Above 45";
                              echo "['".$u16."', ".$row["Under_16"]."], ['".$b17_30."', ".$row["17-30"]."], ['".$b31_45."', ".$row["31-45"]."], ['".$a45."', ".$row["Above_45"]."],";
                         }
                         ?>
                    ]);
               var optionsA2 = {
                     title: 'Percentage of Age Group that have Mild Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartA2 = new google.visualization.PieChart(document.getElementById('piechartA2'));
               chartA2.draw(dataA2, optionsA2);
               var dataA3 = google.visualization.arrayToDataTable([
                         ['Age', 'Group'],
                         <?php
                         while($row = $stmtA3->fetch(PDO::FETCH_ASSOC))
                         {
                           $u16 = "Under 16";
                           $b17_30 = "17-30";
                           $b31_45 = "31-45";
                           $a45 = "Above 45";
                              echo "['".$u16."', ".$row["Under_16"]."], ['".$b17_30."', ".$row["17-30"]."], ['".$b31_45."', ".$row["31-45"]."], ['".$a45."', ".$row["Above_45"]."],";
                         }
                         ?>
                    ]);
               var optionsA3 = {
                     title: 'Percentage of Age Group that have Moderate Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartA3 = new google.visualization.PieChart(document.getElementById('piechartA3'));
               chartA3.draw(dataA3, optionsA3);
               var dataA4 = google.visualization.arrayToDataTable([
                         ['Age', 'Group'],
                         <?php
                         while($row = $stmtA4->fetch(PDO::FETCH_ASSOC))
                         {
                           $u16 = "Under 16";
                           $b17_30 = "17-30";
                           $b31_45 = "31-45";
                           $a45 = "Above 45";
                              echo "['".$u16."', ".$row["Under_16"]."], ['".$b17_30."', ".$row["17-30"]."], ['".$b31_45."', ".$row["31-45"]."], ['".$a45."', ".$row["Above_45"]."],";
                         }
                         ?>
                    ]);
               var optionsA4 = {
                     title: 'Percentage of Age Group that have Moderately Severe Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartA4 = new google.visualization.PieChart(document.getElementById('piechartA4'));
               chartA4.draw(dataA4, optionsA4);
               var dataA5 = google.visualization.arrayToDataTable([
                         ['Age', 'Group'],
                         <?php
                         while($row = $stmtA5->fetch(PDO::FETCH_ASSOC))
                         {
                           $u16 = "Under 16";
                           $b17_30 = "17-30";
                           $b31_45 = "31-45";
                           $a45 = "Above 45";
                              echo "['".$u16."', ".$row["Under_16"]."], ['".$b17_30."', ".$row["17-30"]."], ['".$b31_45."', ".$row["31-45"]."], ['".$a45."', ".$row["Above_45"]."],";
                         }
                         ?>
                    ]);
               var optionsA5 = {
                     title: 'Percentage of Age Group that have Severe Depression',
                     //is3D:true,
                     pieHole: 0.4
                    };
               var chartA5 = new google.visualization.PieChart(document.getElementById('piechartA5'));
               chartA5.draw(dataA5, optionsA5);
          }
          </script>
     </head>
     <body>
          <br /><br />
          <div>
               <h3 align="center">Statistical Data by Age and Gender</h3>
               <br />
               <div id="piechartG1" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartG2" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartG3" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartG4" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartG5" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <br>
               <div id="piechartA1" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartA2" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartA3" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartA4" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
               <div id="piechartA5" style="width: 900px; height: 500px;display:inline-block;border-radius: 25px;"></div>
          </div>
          <div class="container2">
            <form method="post" >
              <input type="submit" name= "Return" value="Return to dashboard">
            </form>
          </div>
     </body>
</html>
