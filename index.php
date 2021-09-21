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
</head>

<body>
<script src="https://kit.fontawesome.com/078f8e260d.js" crossorigin="anonymous"></script>
<hr>
<div class='container'>
	<div id='info'></div>
  <div class="row">
    <div class="col-1">
      <button type='button' class="btn btn-success addEditUser" data-bs-toggle='modal' data-bs-target='#addEditModal'>
        ADD
      </button>
    </div>
    <div class="col-2">
      <form>
      <select class="form-select select" aria-label="Default select example">
      <option value="0">Please select</option>
      <option value="1">Set active</option>
      <option value="2">Set not active</option>
      <option value="3">Delete</option>
      </select>

      </form>

   </div>
    <div class="col-1">

      <div class="col-2"><button type='button'class="btn btn-success ok" >
        OK
      </button></div>
    </div>
</div>

<div id="value"></div>
<table class='table user-list'>
<thead>
<tr>
<th><input class='form-check-input check_all' type='checkbox' value='' id='check_all'>
<th><a id='dd3'>First Name</a></th>
<th><span>Last Name</span></th>
<th><span>Status</span></th>
<th><span>Role</span></th>
<th class='text-center'><span>Option</span></th>
</tr>
</thead>
<?php
require_once 'class/crud.php';
$crud = new Crud();
$query = "SELECT * FROM connect ORDER BY id";
$result = $crud->getData($query);
foreach ($result as $key => $row) {
    if($row['checked'] == 'on'){
    $chk = "<input class='cls' type='hidden' value='on'><i class='fas fa-check-circle text-success'></i></input>";
  }else if($row['checked'] == 'off'){
        $chk = "<input class='cls' type='hidden' value='off'><i class='fas fa-check-circle text-secondary'></i></input>";
    }
    if($row['role'] == 'admin'){
      $role = 'admin';
    }else{
      $role = 'user';
    }
    ?>
    <tbody>
    <tr data-idrow = '<?php echo $row['id']; ?>'>
     <td style='width:30px'><input class='form-check-input check'  type='checkbox' value='<?php echo $row['id']; ?>'></td>
     <td class='fname'><?php echo $row['firstName'] ?></td>
     <td class='lname'><?php echo $row['lastName'] ?></td>
     <td class='checked_user'><?php echo $chk ?></td>
     <td class='role_user'><?php echo $role ?></td>
     <td>
     <ul class='list-unstyled mb-0 d-flex justify-content-center'>
     <li class='ms-2'>

       <button data-id="<?php echo $row['id'] ?>"type='button' data-bs-target='#addEditModal' data-bs-toggle='modal' class='btn addEditUser' data-toggle='tooltip' title='' data-original-title='Edit'>
         <i class='fas fa-pencil-alt'></i>
       </button>
     </li>
     <li class='ms-2'>
     <button data-trash='<?php echo $row['id'] ?>' id='delete' type='button' class='btn delete text-danger'data-toggle='tooltip' title='' data-original-title='Delete' >
     <i class='far fa-trash-alt'></i>
     </button>
     </li>
     </ul>
   </td>
 </tr>
  <?php } ?>
</tbody>

</table>
<div class="row">
  <div class="col-1">
    <button type='button' class="btn btn-success addEditUser" data-bs-toggle='modal' data-bs-target='#addEditModal'>
      ADD
    </button>
  </div>
  <div class="col-2">
    <form>
    <select class="form-select select" aria-label="Default select example">
    <option value="0">Please select</option>
    <option value="1">Set active</option>
    <option value="2">Set not active</option>
    <option value="3">Delete</option>
    </select>

    </form>

   </div>
  <div class="col-1">

    <div class="col-2"><button type='button'class="btn btn-success ok" >
      OK
    </button></div>
  </div>
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php require 'blocks/addEdit.php' ?>
<?php require 'blocks/modalDelete.php'; ?>
<script>
console.log($('[data-idrow="612"]'));
$(document).on('click','#check_all',function(){
if($("#check_all").is(":checked")) {
    $('.check').prop('checked', true);
}else{
    $('.check').prop('checked', false);
}
});
$(document).on('click','.ok',function(){

    arr = [];
    console.log(arr);
      let string = ''
      $('.check:checkbox:checked').each(function(){
         arr.push($(this).val());
         string = arr.toString();

       });
  let arrCheckedUsers = string;
  if($('.select:first').val() == '0' && $('.select:last').val() == '0' || arrCheckedUsers==''){
    $('#PromiseConfirm').modal('toggle');
    $('.titl-modal').text('');
    $('.body-modal').text('Select an action or users');
    $('#d23').remove();
  }
  if($('.select:first').val() == '1' || $('.select:first').val() == '2' || $('.select:last').val() == '1' || $('.select:last').val() == '2'){
    let valueSelect = 0;
    if($('.select:first').val() == '1' || $('.select:last').val() == '1'){
       valueSelect = 'on';
    }else if($('.select:first').val() == '2' || $('.select:last').val() == '2'){
       valueSelect = 'off';
    }

    $.ajax({
      url: 'ajax/update.php',
      type: 'POST',
      cache: false,
      data: {'id': arrCheckedUsers, 'valueSelect':valueSelect},
      dataType: 'html',
      beforeSend: function(){
        console.log(valueSelect);
        for(let i=0;i<arr.length;i++){
          if(valueSelect == 'off'){
            $(`[data-idrow='${arr[i]}']`).find('.checked_user').html("<input class='cls' type='hidden' value='off'><i class='fas fa-check-circle text-secondary'></i></input>");
          }else if(valueSelect == 'on'){
            $(`[data-idrow='${arr[i]}']`).find('.checked_user').html("<input class='cls' type='hidden' value='on'><i class='fas fa-check-circle text-success'></i></input>");
          }
        }
      }
    })
  }else if($('.select:first').val() == '3' || $('.select:last').val() == '3'){
    if(arrCheckedUsers != ''){
      $('#PromiseConfirm').modal('toggle');
      $('.titl-modal').text('Delete');
      $('.body-modal').text('Are you sure want to delete this user?');
      $('.d23').click(function(){
        if(arrCheckedUsers != 0){
          $.ajax({
            url: 'ajax/delete.php',
            type: 'POST',
            cache: false,
            data: {'id': arrCheckedUsers},
            dataType: 'html',
            beforeSend: function(){
              let mas = arrCheckedUsers.split(',');
              for(let i=0;i<mas.length;i++){
                $(`[data-idrow='${mas[i]}']`).remove();
                $('#close1').click();
              }
            },
            success: function(data){
              arrCheckedUsers = 0;
            }
          })
        }

      })
    }


  }
});

$(document).on('click','.check',function(){
  $('#check_all').prop('checked', false);
})
</script>
<?php require 'blocks/table1.php' ?>
</body>
</html>
