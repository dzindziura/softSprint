<div class='modal fade' id='addEditModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title titl' id='exampleModalLabel'></h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <form action='' type='post'>
                <label for='firstName'>First Name</label>
                <input type='text' name='firstName' class='form-control mt-2 firstName'>
                <label for='lastName'>Last Name</label>
                <input type='text' name='lastName'  class='form-control mt-2 lastName'>

                <div class='form-check form-switch mt-2'>
                  <input class='form-check-input checked' name='checked' type='checkbox'>
                  <label class='form-check-label' for='flexSwitchCheckChecked'>Status</label>
                </div>
                <select class='form-select mt-2 role' name='role'>
                          <option value='0'>Role</option>
                          <option value='1'>Admin</option>
                          <option value='2'>User</option>
                        </select>
            </div>
            <div class='alert alert-danger mt-2' id='errorBlock'></div>
            <div class='modal-footer'>

              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' id='close'>Close</button>
              <button type='button' id='add_user' name='update' class='btn btn-primary' >Save</button>

            </div>
                </form>
          </div>
        </div>
      </div>
<script>

  $('#errorBlock').hide();
    $(document).on('click','.addEditUser',function(){

    let edit_id = $(this).data('id');
    if(edit_id){
      if($(`[data-idrow='${edit_id}']`).find('.cls').val() == 'on'){
        $('.checked').prop('checked', true);
      }else{
        $('.checked').prop('checked', false);
      }
      $('.titl').text('Edit user');
      $('.firstName').val($(`[data-idrow='${edit_id}']`).find('.fname').text());
      $('.lastName').val($(`[data-idrow='${edit_id}']`).find('.lname').text());
      if($(`[data-idrow='${edit_id}']`).find('.role_user').text() == 'admin'){
        $('.role').val(1);
      }else if($(`[data-idrow='${edit_id}']`).find('.role_user').text() == 'user'){
        $('.role').val(2);
      }
    }else{
      $('.titl').text('Add user');
      $('.firstName').val('');
      $('.lastName').val('');
      $('.role').val(0);
    }
  $('#add_user').click(function(){
    console.log(edit_id)
    let firstName = $('.firstName').val();
    let lastName = $('.lastName').val();
    let checked = $('.checked').val();
    let role = $('.role').val();
    if($(".checked:checked").val() == 'on'){
      checked = 'on';
      chk = "<input class='cls' type='hidden' value='on'><i class='fas fa-check-circle text-success'></i></input>";
    }else{
      checked = 'off';
      chk = "<input class='cls' type='hidden' value='off'><i class='fas fa-check-circle text-secondary'></i></input>";
    }
    if(role == '2'){
      role = 'user';
    }else if(role == '1'){
      role = 'admin';
    }
    if(firstName!='' && lastName!='' && role !='0'){
      if(edit_id !=0){
        $.ajax({
            url: 'ajax/addEdit.php',
            type: 'POST',
            cache: false,
            data: {'firstName': firstName, 'lastName': lastName, 'checked': checked, 'role': role, 'id': edit_id},
            dataType: 'html',
            success: function(data){
              $('#close').click();
              $('#errorBlock').hide();
              var data = $.parseJSON(data);
              let id25 = data.id;
              if(typeof(edit_id) == 'undefined' && firstName != '' && lastName != '' && role != '0'){
                $('table').append(`<tbody>
                <tr data-idrow = '${id25}'>
                 <td style='width:30px'><input class='form-check-input check'  type='checkbox' value='${id25}'></td>
                 <td class='fname'>${firstName}</td>
                 <td class='lname'>${lastName}</td>
                 <td class='checked_user'>${chk}</td>
                 <td class='role_user'>${role}</td>
                 <td>
                 <ul class='list-unstyled mb-0 d-flex justify-content-center'>
                 <li class='ms-2'>

                   <button data-id='${id25}' type='button' data-bs-target='#addEditModal' data-bs-toggle='modal' class='btn addEditUser' data-toggle='tooltip' title='' data-original-title='Edit'>
                     <i class='fas fa-pencil-alt'></i>
                   </button>
                 </li>
                 <li class='ms-2'>
                 <button data-trash='${id25}' id='delete' type='button' class='btn delete text-danger'data-toggle='tooltip' title='' data-original-title='Delete' >
                 <i class='far fa-trash-alt'></i>
                 </button>
                 </li>
                 </ul>
               </td>
             </tr>
                </tbody>`)
              }else{
            let fnameVal =  $('.firstName').val();
            $(`[data-idrow='${id25}']`).find('.fname').text(fnameVal);
            let lastNameVal =  $('.lastName').val();
            $(`[data-idrow='${id25}']`).find('.lname').text(lastNameVal);
            let roleVal =  $('.role').val();
            if(roleVal == 1){
              $(`[data-idrow='${id25}']`).find('.role_user').text('admin');
            }else if(roleVal == 2){
              $(`[data-idrow='${id25}']`).find('.role_user').text('user');
            }

            if(checked == 'off'){
              $(`[data-idrow='${id25}']`).find('.checked_user').html("<input class='cls' type='hidden' value='off'><i class='fas fa-check-circle text-secondary'></i></input>");
            }else if(checked == 'on'){
                $(`[data-idrow='${id25}']`).find('.checked_user').html("<input class='cls' type='hidden' value='on'><i class='fas fa-check-circle text-success'></i></input>");
            }
          }
          edit_id = 0;
            }

          });
      }

    }else{
      $('#errorBlock').show();
      if(firstName == ''){
        $('#errorBlock').text('Enter a name');
      }else if(lastName == ''){
        $('#errorBlock').text('Enter last name');
      }else if(role == 0){
        $('#errorBlock').text('Choose role');
      }
    }


  });
});
  $(document).on('click','#delete',function(){
    let id_trash = $(this).data('trash').toString();
    console.log(id_trash)
    $('#PromiseConfirm').modal('toggle');
    $('.titl-modal').text('Delete');
    $('.body-modal').text('Are you sure want to delete this user?');
    $('.d23').click(function(){
      if(id_trash!=0){
        let abr = $.ajax({
              url: 'ajax/delete.php',
              type: 'POST',
              cache: false,
              data: {'id': id_trash},
              dataType: 'html',
              beforeSend: function(){
                $(`[data-idrow='${id_trash}']`).remove();
                $('#close1').click();
              },
              success: function(data){
                id_trash = 0;
              }
            });
      }

    })
  })
</script>
