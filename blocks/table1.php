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
    $str = $_GET['str'];
    require_once '../mysql_connect.php';
    if($str == 1 || $str == 0){
        $sql="SELECT * FROM connect WHERE checked = $str";
    }else{
        $sql="SELECT * FROM connect ORDER BY id DESC";
    }
  $query = $pdo->query($sql);
  while($row = $query->fetch(PDO::FETCH_OBJ)){
    if($row->checked == '1'){
    $chk = "<i class='fas fa-check-circle text-success cls'></input></i>";
  }else if($row->checked == ''){
        $chk = "<i class='fas fa-check-circle text-secondary'></input></i>";
    }
    if($row->role == 1){
      $role = 'admin';
    }else{
      $role = 'user';
    }
    ?>
    <tbody>
    <tr class='tr' data-idrow = '<?php echo $row->id; ?>'>
     <td style='width:30px'><input class='form-check-input check'  type='checkbox'></td>
     <td class='fname'><?php echo $row->firstName ?></td>
     <td class='lname'><?php echo $row->lastName ?></td>
     <td class='checked_user'><?php echo $chk ?></td>
     <td class='role_user'><?php echo $role ?></td>
     <td>
     <ul class='list-unstyled mb-0 d-flex justify-content-center'>
     <li class='ms-2'>

       <button data-id='<?php echo $row->id ?>' type='button' data-bs-target='#exampleModal' data-bs-toggle='modal' id='edit' class='btn' class='text-danger' data-toggle='tooltip' title='' data-original-title='Edit'>
         <i class='fas fa-pencil-alt'></i>
       </button>
     </li>
     <li class='ms-2'>
     <button data-trash='<?php echo $row->id ?>' data-bs-toggle="modal" data-bs-target="#PromiseConfirm" id='delete' type='button' class='btn delete text-danger'data-toggle='tooltip' title='' data-original-title='Delete' >
     <i class='far fa-trash-alt'></i>
     </button>
     </li>
     </ul>
   </td>
 </tr>
  <?php } ?>
</tbody>

</table>

<script>
$(document).ready(function() {
$('#check_all').click(function(event) {
  if(this.checked) {
      $('input#check').each(function() {
          this.checked = true;
      });
  }else{
      $('input#check').each(function() {
          this.checked = false;
      });
  }
});
});

</script>