<?php

  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Update Questions</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Question</label>
                          <input type="text" class="form-control" id="question" placeholder="Enter New Question">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateQuestion()" value="Update"></input>
                      </div>
                    </form>
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
            url: "./api/question/read_single.php?question_id=<?php echo $_GET['question_id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#question').val(data['question']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateQuestion(){
        $.ajax(
        {
            type: "POST",
            url: './api/question/update.php',
            dataType: 'json',
            data: {
                question_id: <?php echo $_GET['question_id']; ?>,
                question: $("#question").val(),
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Question!");
                    window.location.href = '/Serotonia/admin_dashboard.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
