<?php
    include_once("../class/crud.php");
    $crud = new Crud();
    $id = $_POST['id'];
    if(gettype($id) == string){
      $res = explode(',', $id);
      $k = sizeof($res);
      for($i=0;$i<$k;$i++){
      $result = $crud->delete($res[$i]);
    }
  }else{
    $result = $crud->delete($id);
  }

  if($result == null){
    $result = true;
  }
  $data = array(
    'error' => array(
      'code' => http_response_code(),
    ),
    'status'=>$result,
 );
 if($data['status'] == true){
   $data['error'] = null;
 }
 echo json_encode($data);
