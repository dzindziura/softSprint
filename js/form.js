$(document).on('click','#edit',function(){
      var ed_id = 0;
      if(typeof(edit_id) == 'number'){
        ed_id = $(this).data('id');
      }
      $.ajax(function(){
        url: 'blocks/value.php',
        type: 'POST',
        cache: false,
        data: {'id': ed_id},
        dataType: 'html',
        success: function(data){
          console.log(ed_id);
      }
    });
  });
