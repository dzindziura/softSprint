<?php
include_once("../class/crud.php");
$crud = new Crud();
  $id = $_POST['id'];
  $valueSelect = $_POST['valueSelect'];
  $res = explode(',', $id);
  $k = sizeof($res);
  for($i=0;$i<$k;$i++){
    $result = $crud->execute("UPDATE connect SET checked='$valueSelect' WHERE id = $res[$i]");
  }

  $data = array(
    'error' => array(
      'code' => http_response_code(),
      'mess' => 'select a user',
    ),
    'status'=>$result,
 );
 if($res != ''){
   $data['error'] = null;
 }
 echo json_encode($data);
