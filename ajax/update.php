<?php
include_once("../class/crud.php");
$crud = new Crud();
  $id = $_POST['id'];
  $valueSelect=$_POST['valueSelect'];
    $result = $crud->execute("UPDATE connect SET checked='$valueSelect' WHERE id = $id");
 ?>
