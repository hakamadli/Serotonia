<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Question</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Question</label>
                          <input type="text" class="form-control" id="question" placeholder="Enter Question">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddQuestion()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('./master.php');
?>
<script>
  function AddQuestion(){

        $.ajax(
        {
            type: "POST",
            url: './api/question/create.php',
            dataType: 'json',
            data: {
                question_id: $("#question_id").val(),
                question: $("#question").val(),
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Question!");
                    window.location.href = '/Serotonia';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
