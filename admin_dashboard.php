<?php
//require_once "pdo.php";
//session_start();

$content = '<div class="row">
              <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Questions List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="questions" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Question ID</th>
                      <th>Question</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>';
include('./master.php');
?>
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "./api/question/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var i in data){
                response += "<tr>"+
                "<td>"+data[i].question_id+"</td>"+
                "<td>"+data[i].question+"</td>"+
                "<td><a href='update.php?question_id="+data[i].question_id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[i].question_id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#questions"));
        }
    });
  });

  function Remove(question_id){
    var result = confirm("Are you sure you want to Delete the Record?");
    if (result == true) {
        $.ajax(
        {
            type: "POST",
            url: './api/question/delete.php',
            dataType: 'json',
            data: {
                question_id: question_id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed Question!");
                    window.location.href = '/Serotonia/admin_dashboard.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>
<!--
echo('<table>'."\n");
$questionstmt = $pdo->query("SELECT question_id, question FROM questions");
$answerstmt = $pdo->query("SELECT answer_id, answer FROM answers, questions WHERE answers.question_id = questions.question_id");
while ( $qrow = $questionstmt->fetch(PDO::FETCH_ASSOC) ) {
  echo ('<tr><td rowspan ="5">');
  echo(htmlentities($qrow['question_id']));
  echo('</td><td rowspan="5">');
  echo(htmlentities($qrow['question']));
  echo('</td>');
  while ( $arow = $answerstmt->fetch(PDO::FETCH_ASSOC) ) {
    echo("<tr><td>");
    echo(htmlentities($arow['answer']));
    echo("</td></tr>");
  }
  echo('<td rowspan="5">');
  echo('<a href="edit.php?question_id='.$qrow['question_id'].'">Edit</a> / ');
  echo('<a href="delete.php?question_id='.$qrow['question_id'].'">Delete</a>');
  echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add a new question and answers</a> -->
