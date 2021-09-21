<?php
  $firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING));
  $lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_STRING));
  $checked = $_POST['checked'];
  $role = $_POST['role'];
  $id = $_POST['id'];
  $error='';
  if(strlen($firstName) <= 3)
    $error = 'Wrong name';
  else if(strlen($lastName) <= 3)
    $error = 'Wrong last name';
  else if($role == '0')
    $error = 'No role selected';
    include_once("../class/crud.php");
    $crud = new Crud();
if($id == null){
  $result = $crud->execute("INSERT INTO connect(firstName, lastName, checked, role) VALUES('$firstName','$lastName','$checked','$role')");
  $id3 = $crud->execute("SELECT LAST_INSERT_ID()");
}else if($id>0){
  $result = $crud->execute("UPDATE connect SET firstName='$firstName', lastName='$lastName', checked='$checked', role='$role' WHERE id = $id");
}
if($id3 == null){
  $id3 = $id;
}

     $data = array(
       'status'=> $result,
       'id'=>$id3,
       'error' => array(
         'code' => http_response_code(),
         'msg'=>$error
       ),
    );
    if($error == ''){
      $data['error'] = 'none';
    }
if($data['id']!=0){

}
      echo json_encode($data);
      exit();
?>
