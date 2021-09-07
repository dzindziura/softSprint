<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>table user list - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<link rel="stylesheet" href="css/main.css">
<script src="js/select.js" charset="utf-8"></script>
</head>

<body>
<script src="https://kit.fontawesome.com/078f8e260d.js" crossorigin="anonymous"></script>
<hr>
<div class='container'>
	<div id='info'></div>
  <div class="row">
    <div class="col-1">
      <button type='button' id='edit' class="btn btn-success" data-bs-toggle='modal' data-bs-target='#exampleModal'>
        ADD
      </button>
    </div>
    <div class="col-2"> <?php require 'blocks/select.php'; ?> </div>
    <div class="col-1">

      <div class="col-2"><button type='button'class="btn btn-success ok" >
        OK
      </button></div>
    </div>
</div>

<div id="value"></div>
<div class="txtblock" id="txtHint"></div>

<div class="row">
  <div class="col-1">
    <button type='button' id='edit' class="btn btn-success" data-bs-toggle='modal' data-bs-target='#exampleModal'>
      ADD
    </button>
  </div>
  <div class="col-2"> <?php require 'blocks/select.php'; ?> </div>
  <div class="col-1">

    <div class="col-2"><button type='button'class="btn btn-success ok" >
      OK
    </button></div>
  </div>
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php require 'blocks/delete.php' ?>
<?php require 'blocks/addEdit.php' ?>
<?php require 'blocks/modalDelete.php'; ?>
<script>
function showUser(str = 5) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","blocks/table1.php?str="+str,true);
    xmlhttp.send();
  }
showUser();
$(document).on('click','#check_all',function(event){
  if(this.checked) {
      $('.check').each(function() {
          this.checked = true;
      });
  }else{
      $('.check').each(function() {
          this.checked = false;
      });
  }
});
$(document).on('click','.ok',function(){
  $('input:checkbox:checked').each(function(){
    arr = $(this).val();

    if($('.select').val() == '1' || $('.select').val() == '2'){
      let valueSelect = 0;
      if($('.select').val() == '1'){
         valueSelect = 1;
      }else if($('.select').val() == '2'){
         valueSelect = '';
      }
      $.ajax({
        url: 'ajax/update.php',
        type: 'POST',
        cache: false,
        data: {'id': arr, 'valueSelect':valueSelect},
        dataType: 'html',
        success: function(data){
          showUser();
        }

      })
    }else if($('.select').val() == '3'){
      $.ajax({
        url: 'ajax/delete.php',
        type: 'POST',
        cache: false,
        data: {'id': arr},
        dataType: 'html',
        success: function(data){
          showUser();

        }
  })
    }


});
});
</script>
<script src='js/script.js' charset='utf-8'></script>
</body>
</html>
