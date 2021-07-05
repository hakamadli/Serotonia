<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/question.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$question = new Question($db);

// set ID property of doctor to be edited
$question->question_id = isset($_GET['question_id']) ? $_GET['question_id'] : die();

// read the details of doctor to be edited
$stmt = $question->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $question_arr=array(
        "question_id" => $row['question_id'],
        "question" => $row['question'],
    );
}
// make it json format
print_r(json_encode($question_arr));
?>
