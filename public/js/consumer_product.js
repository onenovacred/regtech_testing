$(document).ready(function(){
    var countpancard=0;
    var countaadhaarnumber=0;
    var i = 0; 
    // const phoneInputField = document.querySelector("#mobileno");
    // const phoneInput = window.intlTelInput(phoneInputField, {
    //     preferredCountries: ["in", "co", "us", "de"],
    //   utilsScript:
    //     "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    // });
    $("#addbusinesstype").click(function () {
          $("#displaybusinesstype").show();
    });
    $("#addbusinesskyc").click(function () {
        $("#displaybusinesskyc").show();
    });
    $("#businesschecked").click(function () {
        if ($(this).is(":checked")) {
            $("#addbusiness").show();
        } else {
            $("#addbusiness").hide();
        }
    });
//   $('#loanchecked').click(function(){
//         $('#loansection').show();
//   });

//   $(find(".actions a[href$='#finish']")).click(   // If you wish to do something clicking anchor
//     function(){
//        alert("Hello");
//     });
    $("a#choose").click(function(event){
        var status_id = $(this).attr("href");
     
        var url = $('#equifaxurl').val();
        //  alert(status_id);
        if(status_id == "#finish")
        {
            // var api = $('#selectapi').val();
            // alert(api);
            // if($("#firstname").val()!="" && $("#lastname").val()!="" &&
            // $("#mobileno").val()!="" && $("#aadhaarnumber").val()!="" &&
            // api!="Choose API")
            // {
            //     var formdata = {
            //         fname : $("#firstname").val(),
            //         lname : $("#lastname").val(),
            //         phone_number:$("#mobileno").val(),
            //         id_value:$("#aadhaarnumber").val()
            //     };
            //     $.ajax({
            //         type: 'get',
            //         url: url,
            //         data: formdata,
            //         datatype:'json',
            //         success: function(data)
            //         {
            //             console.log(data);
            //         },
            //         error: function (error) {
            //           console.log(error);
            //         }
            //     });
            // }
            // else
            // {
            //     $('#displaymsg').css({'display':'block'});
            //     var message = "Please filled all the details properly firstname,lastname,mobile no and aadhaar number";
            //     $('#messageid').append(message);
            // }
            
            $("#formSubmitted").submit();
        }
        if(status_id =='#next')
        {
        }
    });
    $("li#tab1").click(function(){
         var pannumber=$('#pannumber').val();
         var aadhaarnumber=$('#aadhaarnumber').val();
         
         if(pannumber=="")
         {
            $('#displaydetailsofpancard').empty();
         } /* end of if for pannumber */
         if(aadhaarnumber=="")
         {
            $('#displaydetailsofaadhaar').empty();
         } /* end of if for aadhaar number */
            if(pannumber!="")
            {
                countpancard=countpancard+1;
                var url = $('#urlpancardval').val();
                    var formdata = {
                    pan_number : pannumber
                };
                var pancarddetails =  $("#pancarddetailsmodal").val();
                if(!pancarddetails)
                {
                            pancarddetails=$("#pancarddetailsmodal").val(pannumber);
                }
                // alert("these is pancard details"+pancarddetails);
                // alert("These is pancard number"+pannumber);
                // alert(count);
                if(countpancard==1 || pancarddetails!=pannumber)
                {
                $.ajax({
                    type: 'get',
                    url: url,
                    data: formdata,
                    datatype:'json',
                    success: function(data)
                    {
                        
                        // alert(pancarddetails);
                        // alert(pancarddetails.val());
                        //  alert("these is the data for the success"+pancarddetails);
                        pancarddetails=$("#pancarddetailsmodal").val(pannumber);
                            $("#myModal").modal('show');
                        // $("#displaydetailsofpancard").css({'display':'block'});
                            if(data[0]['statusCode']==200)
                            {
                                $('#displaydetailsofpancard').empty();
                                $("#displaydetailsofpancard").append('<h2>Pan Card Details</h2><p>Full Name:'+data[0]['pancard']['data']['full_name'] +'</p><p>PAN no:'+data[0]['pancard']['data']['pan_number'] +'</p><p>PAN Verification:'+data[0]['pancard']['message_code']+'</p>');
                            }
                        
                    },
                    error: function (error) {
                        pancarddetails=$("#pancarddetailsmodal").val(pannumber);
                        $("#myModal").modal('show');
                         $('#displaydetailsofpancard').empty();
                        $("#displaydetailsofpancard").append("<h2>Pan Card Number</h2>Pan Card number is not proper");
                      console.log(error);
                    }
                });
                }
            } /* end of if for pannumber */
            if(aadhaarnumber!="")
            {
                countaadhaarnumber=countaadhaarnumber+1;
                var url = $('#urlaadhaarval').val();
                var formdata = {
                    aadhaar_number : aadhaarnumber
                };
                var aadhaardetails = $("#aadhaardetailsmodal").val();
                if(!aadhaardetails)
                {
                    aadhaardetails = $("#aadhaardetailsmodal").val(aadhaarnumber);
                }
                if(countaadhaarnumber==1 || aadhaardetails!=aadhaarnumber)
                {
                    $.ajax({
                        type: 'get',
                        url: url,
                        data: formdata,
                        datatype:'json',
                        success: function(data)
                        {
                            console.log(data);
                            aadhaardetails = $("#aadhaardetailsmodal").val(aadhaarnumber);
                            $("#myModal").modal('show');
                            if(data[0]['statusCode']==200)
                            {
                               $('#displaydetailsofaadhaar').empty();
                               $("#displaydetailsofaadhaar").append('<h2>Aadhaar Details</h2><p>Aadhaar Number:'+data[0]['aadhaar_validation']['data']['aadhaar_number'] +'</p><p>Age Range:'+data[0]['aadhaar_validation']['data']['age_range'] +'</p><p>Mobile:*******'+ data[0]['aadhaar_validation']['data']['last_digits']+'</p><p>State:'+ data[0]['aadhaar_validation']['data']['state'] +'</p><p>Aadhaar Verification:'+data[0]['aadhaar_validation']['message_code']+'</p>');
                            }
                        },
                        error: function (error) {
                            aadhaardetails = $("#aadhaardetailsmodal").val(aadhaarnumber);
                            $("#myModal").modal('show');
                            $('#displaydetailsofaadhaar').empty();
                            $("#displaydetailsofaadhaar").append("<h2>Addhar card Details</h2>Aadhaar Card number is not proper");
                        console.log(error);
                        }
                    });
                }
                // var pancarddetails =  $("#pancarddetailsmodal").val();
            } /* end of if for addhar number */
     
           
    });
    $( "li#tab1").removeClass(function() {
        var status = $( this ).prev().attr( "class" );
        if(status=="disabled")
        {
            $("li").removeClass("disabled");
        }
    });
    $(".rmfullname").click(function(){
        $("#hidefullname").hide(); 
        $('#fullname').val('');
    });
    $(".rmfirstname").click(function(){
        $("#hidefirstname").hide(); 
        $('#firstname').val('');
    });
    $(".rmlastname").click(function(){
        $("#hidelastname").hide(); 
        $('#lastname').val('');
    });
    $(".rmdb").click(function(){
        $("#hidedb").hide(); 
        $('#dob').val('');
    });
    $(".rmmno").click(function(){
        $("#hidemno").hide(); 
        $('#mobileno').val('');
    });
    $(".rmemail").click(function(){
        $("#hideemail").hide(); 
        $('#emailaddress').val('');
    });
    $(".rmaddress").click(function(){
        $("#hideaddress").hide(); 
        $('#address').val('');
    });
    $('#editcustomer').click(function(e){
        $('#consumerheading').css({'display':'block'});
        setTimeout(function(){
            $('#consumerheading').focus();
        },500);
        $('#show').css({'display':'block'});
        //$("#editcustomerhd input[type=text]").focus();
        // $('input[name=editcustomerhd]').focus();
        // $("#editcustomerhd").filter(':visible').focus();
        // $('input[name=editcustomerhd]').focus().filter(':visible').css({ 'border': '2px solid #862d59'});
       // $('#editcustomerhd').focus();
       // e.preventDefault();
    });
    $('#consumerheading').on("focus", function (event) {
        setTimeout(function(){
            $('#consumerheading').focus();
        });
        // var keycode = (event.keyCode ? event.keyCode : event.which);
        // if (keycode == '9') { // Keycode for TAB
            // $("#editcustomerhd").focus();
            event.preventDefault();
        
    });
    $('.addcustomerhd').click(function(){
        var editcustomerhd = $('#consumerheading').val();
        if(editcustomerhd=="")
        {
            var customeheading = 'Customer Details';
            $('#consumerhd').val(customeheading);
            $('#customerdetails').html(customeheading);
        }
        else
        {
            $('#consumerhd').val(editcustomerhd);
            // $('#consumerheading').val('');
            $('#customerdetails').html(editcustomerhd);
        }
       
        $('#consumerheading').css({'display':'none'});
        $('#show').css({'display':'none'});
    });
    $('#editbusiness').click(function(){
        $('#businessheading').css({'display':'block'});
        $('#showbusinesshd').css({'display':'block'});
        setTimeout(function(){
            $('#businessheading').focus();
        },500);
    });
    $('#businessheading').on("focus", function (event) {
        setTimeout(function(){
            $('#businessheading').focus();
        });
            event.preventDefault();
        
    });
    $('.addbusinesshd').click(function(){
        var editcustomerhd = $('#businessheading').val();
        if(editcustomerhd=="")
        {
            var customeheading = 'Business Information';
            $('#businesshd').val(customeheading);
            $('#businessdetails').html(customeheading);
        }
        else
        {
            $('#businesshd').val(editcustomerhd);
            // $('#businessheading').val('');
            $('#businessdetails').html(editcustomerhd);
        }   
        $('#businessheading').css({'display':'none'});
        $('#showbusinesshd').css({'display':'none'});
    });
    $('#editotherdetails').click(function(){
        $('#requireddetailsheading').css({'display':'block'});
        $('#showotherdetailshd').css({'display':'block'});
        setTimeout(function(){
            $('#requireddetailsheading').focus();
        },500);
    });
    $('#requireddetailsheading').on("focus", function (event) {
        setTimeout(function(){
            $('#requireddetailsheading').focus();
        });
            event.preventDefault();
        
    });
    $('.addotherdetailshd').click(function(){
        var editcustomerhd = $('#requireddetailsheading').val();
        if(editcustomerhd=="")
        {
            var customeheading = 'Other Details';
            $('#requireddetailshd').val(customeheading);
            $('#otherdetails').html(customeheading);
        }
        else
        {
            $('#requireddetailshd').val(editcustomerhd);
            // $('#requireddetailsheading').val('');
            $('#otherdetails').html(editcustomerhd);
        }
        $('#requireddetailsheading').css({'display':'none'});
        $('#showotherdetailshd').css({'display':'none'});
    });
    $(document).on('click', '#addscore', function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="number" name="score[' + i +
        '][score]" placeholder="Score" class="form-control" /></td><td><input type="number" name="loanamount[' + i +'][loanamount]" id="loanamount" class="form-control" placeholder="loan amount to be approved"></td><td>  <a id="addscore"><i class="fa fa-plus"   style="font-size:24px"></i></a><a class="remove-input-field" ><i class="fa fa-remove" style="font-size:24px;color:red"></i></a></td></tr>'
        );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
    $('#editrules').click(function(){
        $('#rulesdefinedheading').css({'display':'block'});
        $('#showruleshd').css({'display':'block'});
        setTimeout(function(){
            $('#rulesdefinedheading').focus();
        },500);   
    });
    $('#rulesdefinedheading').on("focus", function (event) {
        setTimeout(function(){
            $('#rulesdefinedheading').focus();
        });
            event.preventDefault();
        
    });
    $('.addruleshd').click(function(){
        var editcustomerhd = $('#rulesdefinedheading').val();
        if(editcustomerhd == "")
        {
            var customeheading = 'Rules Defined';
            $('#rulesdefinedhd').val(customeheading);
            $('#rulesdetails').html(customeheading);
        }
        else
        {
            $('#rulesdefinedhd').val(editcustomerhd);
            // $('#rulesdefinedheading').val('');
            $('#rulesdetails').html(editcustomerhd);
        }
     
        $('#rulesdefinedheading').css({'display':'none'});
        $('#showruleshd').css({'display':'none'});
    });
    $('#editterms').click(function(){
        $('#termsconditionheading').css({'display':'block'});
        $('#showtermshd').css({'display':'block'});
        setTimeout(function(){
            $('#termsconditionheading').focus();
        },500);   
    });
    $('#termsconditionheading').on("focus", function (event) {
        setTimeout(function(){
            $('#termsconditionheading').focus();
        });
            event.preventDefault();
        
    });
    $('.addtermshd').click(function(){
        var editcustomerhd = $('#termsconditionheading').val();
        if(editcustomerhd == "")
        {
            var customeheading = 'Terms and conditions';
            $('#termsconditionhd').val(customeheading);
            $('#termsdetails').html(customeheading);
        }
        else
        {
            $('#termsconditionhd').val(editcustomerhd);
            // $('#termsconditionheading').val('');
            $('#termsdetails').html(editcustomerhd);
        }
        $('#termsconditionheading').css({'display':'none'});
        $('#showtermshd').css({'display':'none'});
    });
    $('#congratulationsheading').on("focus", function (event) {
        setTimeout(function(){
            $('#congratulationsheading').focus();
        });
            event.preventDefault();
        
    });
    $('#editcong').click(function(){
        $('#congratulationsheading').css({'display':'block'});
        $('#showconghd').css({'display':'block'});
        setTimeout(function(){
            $('#congratulationsheading').focus();
        },500);   
    });
    $('.addconghd').click(function(){
        var editcustomerhd = $('#congratulationsheading').val();
        if(editcustomerhd=="")
        {
            var customeheading = 'Congratulations';
            $('#congratulationshd').val(customeheading);
            $('#congdetails').html(customeheading);
        }
        else
        {
            $('#congratulationshd').val(editcustomerhd);
            // $('#congratulationsheading').val('');
            $('#congdetails').html(editcustomerhd);
        }
      
        $('#congratulationsheading').css({'display':'none'});
        $('#showconghd').css({'display':'none'});
    });
    $('#editagreement').click(function(){
        $('#agreementheading').css({'display':'block'});
        $('#showagreementhd').css({'display':'block'});
        setTimeout(function(){
            $('#agreementheading').focus();
        },500);   
    });
    $('#agreementheading').on("focus", function (event) {
        setTimeout(function(){
            $('#agreementheading').focus();
        });
            event.preventDefault();
        
    });
    $('.addagreementhd').click(function(){
        var editcustomerhd = $('#agreementheading').val();
        if(editcustomerhd=="")
        {
            var customeheading = 'Agreement';
            $('#agreementhd').val(customeheading);
            $('#agreementdetails').html(customeheading);
        }
        else
        {
            // $('#agreementheading').val('');
            $('#agreementhd').val(editcustomerhd);
            $('#agreementdetails').html(editcustomerhd);
        }
     
        $('#agreementheading').css({'display':'none'});
        $('#showagreementhd').css({'display':'none'});
    });
    $('#editautodebit').click(function(){
        $('#bankdetailsheading').css({'display':'block'});
        $('#showautodebithd').css({'display':'block'});
        setTimeout(function(){
            $('#bankdetailsheading').focus();
        },500);
    });
    $('#bankdetailsheading').on("focus", function (event) {
        setTimeout(function(){
            $('#bankdetailsheading').focus();
        });
            event.preventDefault();
        
    });
    $('.addautodebithd').click(function(){
        var editcustomerhd = $('#bankdetailsheading').val();
        if(editcustomerhd=="")
        {
            var customeheading = 'Auto Debit';
            $('#bankdetailshd').val(customeheading);
            $('#autodebitdetails').html(customeheading);
        }
        else
        {
            $('#bankdetailshd').val(editcustomerhd);
            // $('#bankdetailsheading').val('');
            $('#autodebitdetails').html(editcustomerhd);
        }
        $('#bankdetailsheading').css({'display':'none'});
        $('#showautodebithd').css({'display':'none'});
    });
    $('#editlink').click(function(){
        $('#linkheading').css({'display':'block'});
        $('#showlinkhd').css({'display':'block'});
        setTimeout(function(){
            $('#linkheading').focus();
        },500);    
    });
    $('#linkheading').on("focus", function (event) {
        setTimeout(function(){
            $('#linkheading').focus();
        });
            event.preventDefault();
        
    });
    $('.addlinkhd').click(function(){
        var editcustomerhd = $('#linkheading').val();
        if(editcustomerhd=="")
        {
            var customeheading = 'Adding the link';
            $('#linkhd').val(customeheading);
            $('#linkdetails').html(customeheading);
        }
        else
        {
            $('#linkhd').val(editcustomerhd);
            // $('#linkheading').val('');
            $('#linkdetails').html(editcustomerhd);
        }
       
        $('#linkheading').css({'display':'none'});
        $('#showlinkhd').css({'display':'none'});
    });
    $('.addbusinesstypes').click(function(){
        var urls = $('#urlbusinesstype').val();
        
        var businesstype = $('#businesstype').val();
        $.ajax({
            type: 'get',
            url: urls,
            data: { businesstype: $('#businesstype').val() },
            datatype:'json',
            success: function(data)
            {
                var items="";
                items +="<option value = '" + data + " '>" + businesstype + " </option>";
                // alert(JSON.stringify(data));
                // alert(data['businesstype']);
                $("#businesstypeid").append(items);
                $('#businesstype').val('');
                $('#displaybusinesstype').css({'display':'none'});
            },
            error: function (error) {
              //alert(error);
              console.log(error);
            }
        });
    });
    $('.addbusinesskycs').click(function(){
        var urls = $('#urlbusinesskyc').val();
        
        var businesskyc = $('#businesskyc').val();
        $.ajax({
            type: 'get',
            url: urls,
            data: { businesskyc: $('#businesskyc').val() },
            datatype:'json',
            success: function(data)
            {
                // alert(data);
                var items="";
                items +="<option value = '" + data + " '>" + businesskyc + " </option>";
                // alert(JSON.stringify(data));
                // alert(data['businesstype']);
                $("#businesskycid").append(items);
                $('#businesskyc').val('');
                $('#displaybusinesskyc').css({'display':'none'});
            },
            error: function (error) {
              //alert(error);
              console.log(error);
            }
        });
    });
    $('#adddocupload').click(function(){
        $("#displaydocupload").show();
    });
    $('.adddocname').click(function(){
        var urls = $('#urldocumentname').val();
        
        var document = $('#documentname').val();
        // alert("hello");
        $.ajax({
            type: 'get',
            url: urls,
            data: { documentname: $('#documentname').val() },
            datatype:'json',
            success: function(data)
            {
                console.log(data);
               // alert(data);
               var items="";
               items +="<option value = '" + data + " '>" + document + " </option>";
               // alert(JSON.stringify(data));
               // alert(data['businesstype']);
               $("#uploadeddocumentname").append(items);
               $('#documentname').val('');
               $('#displaydocupload').css({'display':'none'});
            },
            error: function (error) {
              //alert(error);
              console.log(error);
            }
        });
    });
    $('#sltfields').change(function(){
       
    });
    $('#adddynamicfileds').click(function(){
        var sltfields = $('#sltfields').val();
        if(sltfields=="city")
        {
            $('#displaycity').css({'display':'block'});
            $('.rmcity').css({'display':'block'});
        }
        if(sltfields=="state")
        {
            $('#displaystate').css({'display':'block'});
            $('.rmstate').css({'display':'block'});
        }
        if(sltfields=="addressline1")
        {
            $("#displayaddressline1").css({'display':'block'});
            $('.rmaddressline1').css({'display':'block'});
        }
        if(sltfields=="addressline2")
        {
            $('#displayaddressline2').css({'display':'block'});
            $('.rmaddressline2').css({'display':'block'});
        }
        if(sltfields=="addressline3")
        {
            $('#displayaddressline3').css({'display':'block'});
            $('.rmaddressline3').css({'display':'block'});
        }
        if(sltfields=="gender")
        {
            $('#displaygender').css({'display':'block'});
            $('.rmgender').css({'display':'block'});
        }
        if(sltfields=="image")
        {
            $('#displayimageupload').css({'display':'block'});
            $('.rmimageupload').css({'display':'block'});
            var images = $('#uploadimage').attr('src');
            // alert(images); 
        }
        if(sltfields=="audiovideo")
        {
            $('#displayaudiovideo').css({'display':'block'});
            $('.rmaudiovideo').css({'display':'block'});
        }
    });
    $(".rmaddressline2").click(function(){
        $('#displayaddressline2').css({'display':'none'});
        $('#addressline2').val('');
    });
    $(".rmaudiovideo").click(function(){
        $('#displayaudiovideo').css({'display':'none'});
        $('#uploadaudiovideo').val("");
    });
    $(".rmimageupload").click(function(){
        $("#uploadimage").val("");
        $('#displayimageupload').css({'display':'none'});
        
        // $('#uploadimage').attr('src','');
        // $('#uploadimage').attr('src',''); 
        // $('#uploadimage').remove();;
        // $("#uploadimage").prop("src","")
    });
    $(".rmgender").click(function(){
        $('#displaygender').css({'display':'none'});
        $("#rdofemale").prop("checked", false);
        $("#rdomale").prop("checked",false);
    });
    $(".rmcity").click(function(){
        $("#displaycity").hide(); 
        $('#city').val('');
    });
    $(".rmstate").click(function(){
        $("#displaystate").hide();
        $('#state').val('');
    });
    $(".rmaddressline1").click(function(){
        $("#displayaddressline1").css({'display':'none'});
        $("#addressline1").val('');
    });
    $(".rmaddressline3").click(function(){
        $('#displayaddressline3').css({'display':'none'});
        $('#addressline3').val('');
    });
    $('#selectapi').click(function(){
        var api = $('#selectapi').val();
        var id_values;
        if($("#firstname").val()!="" && $("#lastname").val()!="" &&
        $("#mobileno").val()!="" && ($("#aadhaarnumber").val()!="" || $("#pannumber").val()!="") 
        && api=="equifax")
        {
            var url = $('#equifaxurl').val();
            if($("#aadhaarnumber").val()=="")
            {
                id_values = $("#pannumber").val();
            }
            if($("#pannumber").val()=="")
            {
                id_values = $("#aadhaarnumber").val();
            }
            if($("#pannumber").val()!="" && $("#aadhaarnumber").val()!="")
            {
                id_values = $("#pannumber").val();
            }
            var formdata = {
                fname : $("#firstname").val(),
                lname : $("#lastname").val(),
                phone_number:$("#mobileno").val(),
                id_value:id_values
            };
            $.ajax({
                type: 'get',
                url: url,
                data: formdata,
                datatype:'json',
                success: function(data)
                {
                    console.log(data);
                    $("#myModal").modal('show');
                    $('#displaydetailsofequifax').empty();
                    if(data['Equifax Report']['InquiryResponseHeader']['SuccessCode'] == 1)
                    {
                        $("#displaydetailsofequifax").append('<h2>Equifax Details</h2><p>Consumer Details Not Found in Bereau</p>');
                    }
                   
                },
                error: function (error) {
                    console.log(error);
                    $("#myModal").modal('show');
                    $('#displaydetailsofequifax').empty();
                   $("#displaydetailsofequifax").append("<h2>Equifax</h2><p>Some details is missing</p>");
                }
            });
        } /* end of if for equifax */
        if(api=="equifax")
        {
         if($("#firstname").val()=="" || $("#lastname").val()=="" ||
            $("#mobileno").val()=="" || ($("#aadhaarnumber").val()=="" && $("#pannumber").val()==""))
            {
                   $('#displaymsg').css({'display':'block'});
                   var message = "Please filled all the details properly firstname,lastname,mobile no and aadhaar number";
                   $('#messageid').append(message);
            }
        }
    });
    $('#esign').click(function(){
        
        var url = $('#esigninitializedurl').val();
        var formdata = {
            full_name : $("#fullname").val(),
            mobile_number : $("#mobileno").val(),
            user_email:$("#emailaddress").val(),
        };
        $.ajax({
            type: 'get',
            url: url,
            data: formdata,
            datatype:'json',
            success: function(data)
            {
                console.log(data);
                if(data['status_code'] == 200)
                {
                    $('#esigninitialized').css({'display':'block'});
                    $('#client_id').append("<div>Client id :'"+data['data']['client_id']+"'</div>");
                    $('#group_id').append("<div>Group Id:'"+data['data']['group_id']+"'</div>");
                    $('#esignurl').append('<a href=' + data['data']['url']  +'> '+  data['data']['url'] +'</a>');
                }
            },
            error: function (error) {
                console.log(error);      
            }
        });
    });
});