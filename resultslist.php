<?php
  session_start();
  sleep(5);
  header('Content-Type: application/json; charset=utf-8');
  if(!isset($_SESSION['result'])){
    $_SESSION['result'] = array();
  }
  echo(json_encode($_SESSION['result']));
 ?>
