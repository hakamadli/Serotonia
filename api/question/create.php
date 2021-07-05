<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/question.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$question = new Question($db);

// set doctor property values
//$question->question_id = $_POST['question_id'];
$question->question = $_POST['question'];

// create the doctor
if($question->create()){
    $question_arr=array(
        "status" => true,
        "message" => "Successfully Added!",
        "question_id" => $question->question_id,
        "question" => $question->question,
    );
}
else{
    $question_arr=array(
        "status" => false,
        "message" => "Question already exists!"
    );
}
print_r(json_encode($question_arr));
?>
