<?php
include_once("classes/delete.php");
 ?>
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
    require_once '../mysql_connect.php';

  $sql="SELECT * FROM connect ORDER BY id DESC";
  $query = $pdo->query($sql);
  while($row = $query->fetch(PDO::FETCH_OBJ)){
    if($row->checked == '1'){
    $chk = "<i class='fas fa-check-circle text-success'></i>";
  }else if($row->checked == ''){
        $chk = "<i class='fas fa-check-circle text-secondary'></i>";
    }
    if($row->role == 1){
      $role = 'admin';
    }else{
      $role = 'user';
    }
    ?>
    <tbody>
    <tr>
     <td style='width:30px'><input class='form-check-input'  type='checkbox' value='' id='check'>
     <td><?php echo $row->firstName ?></td>
     <td><?php echo $row->lastName ?></td>
     <td><?php echo $chk ?></td>
     <td><?php echo $role ?></td>
     <th>
     <ul class='list-unstyled mb-0 d-flex justify-content-center'>
     <li class='ms-2'>

       <button data-id='<?php echo $row->id ?>' type='button'data-bs-target='#exampleModal' data-bs-toggle='modal' id='edit' class='btn' class='text-danger' data-toggle='tooltip' title='' data-original-title='Edit'>
         <i class='fas fa-pencil-alt'></i>
       </button>
     </li>
     <li class='ms-2'>
     <button data-trash='<?php echo $row->id ?>' id='delete' type='button' class='btn delete text-danger'data-toggle='tooltip' title='' data-original-title='Delete'>
     <i class='far fa-trash-alt'></i>
     </button>
     </li>
     </ul>
     </th>
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
