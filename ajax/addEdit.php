<?php
  include_once("../class/crud.php");
  $crud = new Crud();

  $firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
  $lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));
  $checked = $_POST['checked'];
  $role = $_POST['role'];
  $id = $_POST['id'];
  $error='';
  $time = time();
  if(strlen($firstName) <= 3)
    $error = 'Enter your first name';
  else if(strlen($lastName) <= 3)
    $error = 'Enter your last name';


    if($error!=''){
      echo $error;
      exit();
    }
    if($id == null){
      $result = $crud->execute("INSERT INTO connect(firstName, lastName, checked, role, time) VALUES('$firstName','$lastName','$checked','$role','$time')");
      echo 'Готово';
      }
    if($id>=1){
      $result = $crud->execute("UPDATE connect SET firstName='$firstName', lastName='$lastName', checked='$checked', role='$role' WHERE id = $id");
      echo 'Готово';
    }
?>
