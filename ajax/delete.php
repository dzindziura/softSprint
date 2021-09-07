<?php

    include_once("../class/crud.php");
    $crud = new Crud();
    $id = $_POST['id'];
    $result = $crud->delete($id);
