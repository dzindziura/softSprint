<script>

    $(document).on('click','.delete',function(){
      var id_trash = $(this).data('trash');
      $('#d23').click(function(){
        var abr = $.ajax({
              url: 'ajax/delete.php',
              type: 'POST',
              cache: false,
              data: {'id': id_trash},
              dataType: 'html',
              success: function(data){
                  showUser();
                  $('#close1').click();
              }
            });
      })
})

</script>
