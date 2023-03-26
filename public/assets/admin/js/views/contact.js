$(document).ready(function(e) {
  $("[name='data[purpose]']").on('change', function(){
    $('#appType select').val('');
    if($(this).val() == 2) {
      $('#appType').removeClass('noDisplay');
    }else{
      $('#appType').addClass('noDisplay');
    }
  })
})
