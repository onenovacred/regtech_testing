$(document).ready(function() {
    $('.selectpicker').selectpicker();
    $('#span_no').hide();
   $('#id_type').change(function() {
        var data = $(this).val();
       $('#span_no').hide();
       for (var i = 0; i <= data.length; i++) {
     if (data[i] == 'T') {
      $('#span_no').show();
      }
   }
 });
$.ajax({
Type: 'GET',
url:equifaxScoreIdTypesUrl,
datatype: 'json',
success: function(data) {
  $('#id_type').empty();
  jQuery.noConflict();
  jQuery('#id_type').selectpicker('refresh');
  for (var i = 0; i < data.length; i++) {
      $('#id_type').append("<option value='" + data[i]['value'] + "'>" + data[i][
          'name'
      ] + "</option>");
  }
  jQuery('#id_type').selectpicker('refresh');
},
error: function(error) {

}
});

});