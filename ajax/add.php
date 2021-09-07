<?php

include_once("../class/crud.php");
$crud = nev Crud();
$firstName = $crud->escape_string($_POST['firstName']);
$lastName = $crud->escape_string($_POST['lastName']);
