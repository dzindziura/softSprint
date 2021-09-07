<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                  <input class='form-check-input' name='checked' type='checkbox'  id='checked' value='1'>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $('#errorBlock').hide();
    $(document).on('click','#edit',function(){
    let edit_id = $(this).data('id');
      if(edit_id){
        let eds = $(this).parents('tr').find('.fname');
        $('.firstName').val($(eds).text())
        let eds1 = $(this).parents('tr').find('.lname');
        $('.lastName').val($(eds1).text())
        let eds2 = $(this).parents('tr').find('.role_user');
      }else{
        $('.firstName').val('');
        $('.lastName').val('');
        $('.role').val(0);
      }
  $('#add_user').click(function(){
    var firstName = $('.firstName').val();
    var lastName = $('.lastName').val();
    var checked = $('#checked').val();
    var role = $('#role').val();
    var checked = [];
    $('#checked').each(function(){
        if(this.checked) {
            checked.push($(this).val());
        }else if($(this).hasClass('text')){
            checked.push($(this).val());
        }
    });
    checked = checked.toString();
    $.ajax({
      url: 'ajax/addEdit.php',
      type: 'POST',
      cache: false,
      data: {'firstName': firstName, 'lastName': lastName, 'checked': checked, 'role': role, 'id': edit_id},
      dataType: 'html',
      success: function(data){
        if(data == 'Готово'){
          $('#errorBlock').hide();
          $('#add_user').text("Готово");
          $('#close').click();
          showUser();
          edit_id = 0;
          console.log(edit_id)
        }else{
          $('#errorBlock').show();
          $('#errorBlock').text(data);
        }
      },

    });

  });

  });

</script>
