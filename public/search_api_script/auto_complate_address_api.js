$(document).ready(function(){
    $('#autoaddress_max_result,#autoaddress_text').keyup(function() {
    $('#error_messagess').text(" ");
    let max_result = $('#autoaddress_max_result').val().trim();
    let text = $('#autoaddress_text').val().trim();
    if (max_result !== '' &&  text !== '') {
    $.ajax({
        url:autoComplateUrl,
        type: 'GET',
        data:{
            "max_result":max_result,
            "text":text
        },
        dataType: 'json',
        success: function(data) {
            $('#address_show').empty();
         if(data.data != undefined && data.data.status_code == 200){
            data.data.data.forEach(function(item, index) {
                $('#address_show').append('<option value="'+item.address+'">'+item.address+'</option>');
             });
             jQuery('#address_show').selectpicker('refresh');
           }
          else if(data.data[0] != undefined && data.data[0].statusCode ==404){
            $('#error_messagess').text(data.data[0].message);
            jQuery('#address_show').selectpicker('refresh');
          }
          else if(data.data != undefined && data.data.status_code ==102){
           
            $('#error_messagess').text(data.data.message);
            jQuery('#address_show').selectpicker('refresh');
          }
          else if(data.data.statusCode ==103){
           
            $('#error_messagess').text(data.data.message);
            jQuery('#address_show').selectpicker('refresh');
          }
          else if(data.data != undefined && data.data ==500 ){
          
            $('#error_messagess').text(data.message);
            jQuery('#address_show').selectpicker('refresh');
          }
          else{
            $('#error_messagess').text("NOT Found");
            jQuery('#address_show').selectpicker('refresh');
          }
          
        }, error: function(xhr, status, error) {
           console.log(xhr.responseText); 
       }
    });
  }
 });
 })