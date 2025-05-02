  /*Jharkhand*/
        // jharkhand Distract
        $('#jhar_district').change(function() {
            let jharkhand_district = $(this).val();
            // Fatch Circle
            if (jharkhand_district) {
             $.ajax({
                 url:'/jhar/distracts/' + jharkhand_district,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                    $('#jhar_circle').empty().append('<option value="">Select Circle</option>');
                     $.each(data, function(key, value) {
                         $('#jhar_circle').append('<option value="'+value.Circle+'">'+value.Circle+'</option>');
                     });
 
                     jQuery('#jhar_circle').selectpicker('refresh');
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#jhar_circle').empty();
           }
         });
        // jharkhand Circle
         $('#jhar_circle').change(function() {
            let jharkhand_circle = $(this).val();
              // Fatch Halka
            if (jharkhand_circle) {
             $.ajax({
                 url:'/jhar/circles/'+ jharkhand_circle,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#jhar_halka').empty().append('<option value="">Select Halka</option>');
                     $.each(data, function(key, value) {
                         $('#jhar_halka').append('<option value="'+value.Halka+'">'+value.Halka+'</option>');
                     });
                     jQuery('#jhar_halka').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#jhar_halka').empty();
           }
         });
         //Jaharkhand Halka
         $('#jhar_halka').change(function() {
            let jharkhand_halka = $(this).val();
              // Fatch Halka
            if (jharkhand_halka) {
             $.ajax({
                 url:'/jhar/halkas/'+ jharkhand_halka,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#jhar_mauza').empty().append('<option value="">Select Mauza</option>');
                     $.each(data, function(key, value) {
                         $('#jhar_mauza').append('<option value="'+value.Mauza+'">'+value.Mauza+'</option>');
                     });
                     jQuery('#jhar_mauza').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#jhar_mauza').empty();
           }
         });
 
          //Jaharkhand SheetNumber
          $('#jhar_mauza').change(function() {
            let jharkhand_mauza = $(this).val();
              // Fatch Halka
            if (jharkhand_mauza) {
             $.ajax({
                 url:'/jhar/mauza/'+ jharkhand_mauza,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#jhar_sheetno').empty().append('<option value="">Select SheetNumber</option>');
                     $.each(data, function(key, value) {
                         $('#jhar_sheetno').append('<option value="'+value.Sheet+'">'+value.Sheet+'</option>');
                     });
                     jQuery('#jhar_sheetno').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#jhar_sheetno').empty();
           }
         });
         /*GOA Distract*/
         $('#goa_district').change(function() {
            let goa_district = $(this).val();
              // Fatch Taluka
            if (goa_district) {
             $.ajax({
                 url:'/goa/distracts/'+ goa_district,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#goa_taluka').empty().append('<option value="">Select Taluka</option>');
                     $.each(data, function(key, value) {
                         $('#goa_taluka').append('<option value="'+value.Taluka+'">'+value.Taluka+'</option>');
                     });
                     jQuery('#goa_taluka').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#goa_taluka').empty();
           }
         });
           /*Goa Taluka*/
         $('#goa_taluka').change(function() {
            let goa_taluka = $(this).val();
              // Fatch Sheet Number
            if (goa_taluka) {
             $.ajax({
                 url:'/goa/taluka/'+ goa_taluka,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#goa_village').empty().append('<option value="">Select SheetNumber</option>');
                     $.each(data, function(key, value) {
                         $('#goa_village').append('<option value="'+value.Village+'">'+value.Village+'</option>');
                     });
                     jQuery('#goa_village').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#goa_village').empty();
           }
         });
         /*Goa Sheet Number*/
         $('#goa_village').change(function() {
            let goa_village = $(this).val();
              // Fatch Village
            if (goa_village) {
             $.ajax({
                 url:'/goa/village/'+ goa_village,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#goa_sheet_number').empty().append('<option value="">Select Sheet</option>');
                     $.each(data, function(key, value) {
                         $('#goa_sheet_number').append('<option value="'+value.Sheet+'">'+value.Sheet+'</option>');
                     });
                     jQuery('#goa_sheet_number').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#goa_village').empty();
           }
         });
         /*Lakshdaweep*/
           /*Lakshdaweep District*/
          $('#laksh_district').change(function() {
            let laksh_district = $(this).val();
              // Fatch Taluka
            if (laksh_district) {
             $.ajax({
                 url:'/lakshadweep/distract/'+ laksh_district,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#laksh_taluk').empty().append('<option value="">Select Taluka</option>');
                     $.each(data, function(key, value) {
                         $('#laksh_taluk').append('<option value="'+value.Taluk+'">'+value.Taluk+'</option>');
                     });
                     jQuery('#laksh_taluk').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#laksh_taluk').empty();
           }
         });
          /*Lakshdaweep taluk*/
           $('#laksh_taluk').change(function() {
            let laksh_taluka = $(this).val();
              // Fatch Taluka
            if (laksh_taluka) {
             $.ajax({
                 url:'/lakshadweep/taluka/'+ laksh_taluka,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#laksh_village').empty().append('<option value="">Select Village</option>');
                     $.each(data, function(key, value) {
                         $('#laksh_village').append('<option value="'+value.Village+'">'+value.Village+'</option>');
                     });
                     jQuery('#laksh_village').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#laksh_village').empty();
           }
         });
 
           /*Lakshdaweep village*/
           $('#laksh_village').change(function() {
            let laksh_village = $(this).val();
              // Fatch village
            if (laksh_village) {
             $.ajax({
                 url:'/lakshadweep/village/'+ laksh_village,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#laksh_survey').empty().append('<option value="">Select Survey</option>');
                     $.each(data, function(key, value) {
                         $('#laksh_survey').append('<option value="'+value.Survey+'">'+value.Survey+'</option>');
                     });
                     jQuery('#laksh_survey').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#laksh_survey').empty();
           }
         });
         /*Chattisgarh */
         /*Chattisgarh Distract*/
         $('#chha_distract').change(function() {
            let chha_distract = $(this).val();
              // Fatch Tehsil
            if (chha_distract) {
             $.ajax({
                 url:'/chhatisgarh/distract',
                 type: 'POST',
                 headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                 dataType: 'json',
                 data:{'distract':chha_distract},
                 success: function(data) {
                   if(data){
                     $('#chha_tehsil').empty().append('<option value="">Select Tehsil</option>');
                     $.each(data, function(key, value) {
                         $('#chha_tehsil').append('<option value="'+value.Tehsil+'">'+value.Tehsil+'</option>');
                     });
                     jQuery('#chha_tehsil').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#chha_tehsil').empty();
           }
         });
 
          /*Chattisgarh Tehsil*/
          $('#chha_tehsil').change(function() {
            let chha_tehsil = $(this).val();
              // Fatch Tehsil
            if (chha_tehsil) {
             $.ajax({
                 url:'/chhatisgarh/tehsil/'+ chha_tehsil,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#chha_ri_circle').empty().append('<option value="">Select Ri Circle</option>');
                     $.each(data, function(key, value) {
                         $('#chha_ri_circle').append('<option value="'+value.Ri+'">'+value.Ri+'</option>');
                     });
                     jQuery('#chha_ri_circle').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#chha_ri_circle').empty();
           }
         });
 
           /*Chattisgarh Ri*/
           $('#chha_ri_circle').change(function() {
            let chha_village = $(this).val();
              // Fatch Village
            if (chha_village) {
             $.ajax({
                 url:'/chhatisgarh/ri_circle/'+ chha_village,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#chha_village').empty().append('<option value="">Select Village</option>');
                     $.each(data, function(key, value) {
                         $('#chha_village').append('<option value="'+value.Village+'">'+value.Village+'</option>');
                     });
                     jQuery('#chha_village').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#chha_village').empty();
           }
         });
           /*Rajshthan*/
            /*Rajshthan Distract*/
         $('#ra_district').change(function() {
            let ra_district = $(this).val();
              // Fatch Tehsil
            if (ra_district) {
             $.ajax({
                 url:'/rajasthan/distract',
                 type: 'POST',
                 headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                 dataType: 'json',
                 data:{'distract':ra_district},
                 success: function(data) {
                   if(data){
                     $('#ra_tehsil').empty().append('<option value="">Select Tehsil</option>');
                     $.each(data, function(key, value) {
                         $('#ra_tehsil').append('<option value="'+value.Tehsil+'">'+value.Tehsil+'</option>');
                     });
                     jQuery('#ra_tehsil').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ra_tehsil').empty();
           }
         });
 
         //Rajshthan Tehsil
         $('#ra_tehsil').change(function() {
            let ra_tehsil = $(this).val();
              // Fatch Tehsil
            if (ra_tehsil) {
             $.ajax({
                 url:'/rajasthan/tehsil/' + ra_tehsil,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ra_ri_circle').empty().append('<option value="">Select Ri</option>');
                     $.each(data, function(key, value) {
                         $('#ra_ri_circle').append('<option value="'+value.Ri+'">'+value.Ri+'</option>');
                     });
                     jQuery('#ra_ri_circle').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ra_ri_circle').empty();
           }
         });
 
           //Rajshthan Ri
           $('#ra_ri_circle').change(function() {
            let ra_ri_circle = $(this).val();
              // Fatch Tehsil
            if (ra_ri_circle) {
             $.ajax({
                 url:'/rajasthan/ri_circle/' + ra_ri_circle,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ra_ri_halkas').empty().append('<option value="">Select Halka</option>');
                     $.each(data, function(key, value) {
                         $('#ra_ri_halkas').append('<option value="'+value.Halkas+'">'+value.Halkas+'</option>');
                     });
                     jQuery('#ra_ri_halkas').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ra_ri_circle').empty();
           }
         });
          //Rajshthan Halkas
           $('#ra_ri_halkas').change(function() {
            let ra_ri_halkas = $(this).val();
              // Fatch Tehsil
            if (ra_ri_halkas) {
             $.ajax({
                 url:'/rajasthan/ri_halkas/' + ra_ri_halkas,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ra_village').empty().append('<option value="">Select Village</option>');
                     $.each(data, function(key, value) {
                         $('#ra_village').append('<option value="'+value.Village+'">'+value.Village+'</option>');
                     });
                     jQuery('#ra_village').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ra_village').empty();
           }
         });
 
          //Rajshthan SheetNumber
          $('#ra_village').change(function() {
            let ra_village = $(this).val();
              // Fatch Tehsil
            if (ra_village) {
             $.ajax({
                 url:'/rajasthan/ri_village/' + ra_village,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ra_sheet_number').empty().append('<option value="">Select SheetNumber</option>');
                
                     $.each(data, function(key, value) {
                         $('#ra_sheet_number').append('<option value="'+value.SheetNo+'">'+value.SheetNo+'</option>');
                     });
                     jQuery('#ra_sheet_number').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ra_sheet_number').empty();
           }
         });
         /*Odish Distract*/ 
         $('#odi_district').change(function() {
            let odi_distract = $(this).val();
              // Fatch Tehsil
            if (odi_distract) {
             $.ajax({
                 url:'/odisha/distract/',
                 type: 'POST',
                 headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                 data:{'distract':odi_distract},
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#odi_tehsil').empty().append('<option value="">Select Tehsil</option>');
                
                     $.each(data, function(key, value) {
                         $('#odi_tehsil').append('<option value="'+value.Tehsil+'">'+value.Tehsil+'</option>');
                     });
                     jQuery('#odi_tehsil').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#odi_tehsil').empty();
           }
         });
         // Odisha Tehsil
         $('#odi_tehsil').change(function() {
            let odi_tehsil = $(this).val();
              // Fatch Tehsil
            if (odi_tehsil) {
             $.ajax({
                 url:'/odisha/tehsil/' + odi_tehsil,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#odi_ri_circle').empty().append('<option value="">Select Ri Circle</option>');
                     $.each(data, function(key, value) {
                         $('#odi_ri_circle').append('<option value="'+value.Ri+'">'+value.Ri+'</option>');
                     });
                     jQuery('#odi_ri_circle').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#odi_ri_circle').empty();
           }
         });
        // Odisha Tehsil
          $('#odi_ri_circle').change(function() {
            let odi_ri_circle = $(this).val();
              // Fatch Tehsil
            if (odi_ri_circle) {
             $.ajax({
                 url:'/odisha/ri_circle/' + odi_ri_circle,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#odi_village').empty().append('<option value="">Select Village</option>');
                     $.each(data, function(key, value) {
                         $('#odi_village').append('<option value="'+value.Village+'">'+value.Village+'</option>');
                     });
                     jQuery('#odi_village').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#odi_village').empty();
           }
         });
         //odisha village
         $('#odi_village').change(function() {
            let odi_village = $(this).val();
              // Fatch Tehsil
            if (odi_village) {
             $.ajax({
                 url:'/odisha/village/' + odi_village,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#odi_sheetnumber').empty().append('<option value="">Select SheetNumber</option>');
                     $.each(data, function(key, value) {
                         $('#odi_sheetnumber').append('<option value="'+value.Sheetno+'">'+value.Sheetno+'</option>');
                     });
                     jQuery('#odi_sheetnumber').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#odi_sheetnumber').empty();
           }
         });
          /*Kerala*/
          //kerala district
          $('#ker_district').change(function() {
            let ker_district = $(this).val();
              // Fatch Tehsil
            if (ker_district) {
             $.ajax({
                 url:'/kerala/distract',
                 type: 'POST',
                 headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                 data:{
                     'district':ker_district
                 },
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ker_taluk').empty().append('<option value="">Select Taluka</option>');
                     $.each(data, function(key, value) {
                         $('#ker_taluk').append('<option value="'+value.Taluk+'">'+value.Taluk+'</option>');
                     });
                     jQuery('#ker_taluk').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ker_taluk').empty();
           }
         });
          //kerala Taluk
         $('#ker_taluk').change(function() {
            let ker_taluk = $(this).val();
              // Fatch Tehsil
            if (ker_taluk) {
             $.ajax({
                 url:'/kerala/taluk/' + ker_taluk,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ker_village').empty().append('<option value="">Select Village</option>');
                     $.each(data, function(key, value) {
                         $('#ker_village').append('<option value="'+value.Village+'">'+value.Village+'</option>');
                     });
                     jQuery('#ker_village').selectpicker('refresh');
                   }
                   
                 }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ker_village').empty();
           }
         });
          //kerala village
         $('#ker_village').change(function() {
            let ker_village = $(this).val();
              // Fatch Tehsil
            if (ker_village) {
             $.ajax({
                 url:'/kerala/village/' + ker_village,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ker_blockno').empty().append('<option value="">Select Blockno</option>');
                     $.each(data, function(key, value) {
                         $('#ker_blockno').append('<option value="'+value.Blockno+'">'+value.Blockno+'</option>');
                     });
                     jQuery('#ker_blockno').selectpicker('refresh');
                   }
                  }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ker_blockno').empty();
           }
         });
 
         //kerala blockNo
         $('#ker_blockno').change(function() {
            let ker_blockno = $(this).val();
              // Fatch blockNo
            if (ker_blockno) {
             $.ajax({
                 url:'/kerala/blockno/' + ker_blockno,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ker_survey_number').empty().append('<option value="">Select Survey Number</option>');
                     $.each(data, function(key, value) {
                         $('#ker_survey_number').append('<option value="'+value.Surveyno+'">'+value.Surveyno+'</option>');
                     });
                     jQuery('#ker_survey_number').selectpicker('refresh');
                   }
                  }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ker_survey_number').empty();
           }
         });
 
         //kerala Survey No
         $('#ker_survey_number').change(function() {
            let ker_survey_number = $(this).val();
              //  blockNo
            if (ker_survey_number) {
             $.ajax({
                 url:'/kerala/surveynumber/' + ker_survey_number,
                 type: 'GET',
                 dataType: 'json',
                 success: function(data) {
                   if(data){
                     $('#ker_subdivno').empty().append('<option value="">Select SubDivNumber</option>');
                     $.each(data, function(key, value) {
                         $('#ker_subdivno').append('<option value="'+value.Subdivno+'">'+value.Subdivno+'</option>');
                     });
                     jQuery('#ker_subdivno').selectpicker('refresh');
                   }
                  }, error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log any error messages
                }
             });
          } else {
             $('#ker_subdivno').empty();
           }
         });