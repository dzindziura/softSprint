$(document).ready(function() {
  console.log('sdfsdf');
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
