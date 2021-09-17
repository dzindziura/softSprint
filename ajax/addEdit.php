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

    $user = 'root';
    $password = 'root';
    $db = 'testing';
    $host = 'localhost';

    $dsn = 'mysql:host='.$host.';dbname='.$db;
    $pdo = new PDO($dsn, $user, $password);
if($id == null){
  $query = "INSERT INTO connect(firstName, lastName, checked, role) VALUES('$firstName','$lastName','$checked','$role')";
  $query_success = $pdo->query($query);
  $id3 = $pdo->lastInsertId();
}else if($id>0){
  $query = "UPDATE connect SET firstName='$firstName', lastName='$lastName', checked='$checked', role='$role' WHERE id = $id";
  $query_success = $pdo->prepare($query);
  $query_success->execute();
}
if($id3 == null){
  $id3 = $id;
}

     $data = array(
       'status'=>'true',
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
