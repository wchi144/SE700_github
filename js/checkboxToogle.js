$('#selectAll_1').on('switch-change', function(){
    $val = $('#selectAll_1').bootstrapSwitch('status');
    $('.toggle-state-switch1').each(function( index ) {
      $(this).bootstrapSwitch('setState' , $val);
});
});

$('#selectAll_2').on('switch-change', function(){
    $val = $('#selectAll_2').bootstrapSwitch('status');
    $('.toggle-state-switch2').each(function( index ) {
      $(this).bootstrapSwitch('setState' , $val);
});
});