$(document).ready(function() {
    jQuery('.selectpicker').selectpicker();
    $('#aadhar_noc').hide();
    $('#pan_noc').hide();
    $('#driving_licencec').hide();
    $('#voter_idc').hide();
    $('#passportc').hide();
    $('#crid_type').change(function(){
        var data = $(this).val();
        $('#aadhar_noc').hide();
        $('#pan_noc').hide();
        $('#driving_licencec').hide();
        $('#voter_idc').hide();
        $('#passportc').hide();
        
        for(var i=0;i<data.length;i++){
            
            if(data[i] == "M") {
                $('#aadhar_noc').show();
            }
            if(data[i] == "T"){
                $('#pan_noc').show();
            }
            if(data[i] == "DL"){
                $('#driving_licence').show();
            }
            if(data[i] == "V"){
                $('#voter_idc').show();
            }
            if(data[i] == "P"){
                $('#passportc').show();
            }
        }
    });

        var formdata1 = ""; 
        $.ajax({
            type: 'get',
            url:idtypes,
            data: formdata1,
            datatype:'json',
            success: function(data)
            {
                $('#crid_type').empty(); 
                jQuery.noConflict();
                jQuery('#crid_type').selectpicker('refresh');
                for(var i=0;i<data.length;i++)
                {
                    // alert(data[i]);
                    $('#crid_type').append("<option value='"+data[i]['value']+"'>"+data[i]['name']+"</option>");
                }
                jQuery('#crid_type').selectpicker('refresh');
            },
            error: function (error) {
                // console.log(error);
            }
        }); 

        $("#crsubmitForm").click(function(e) {
            e.preventDefault();
            if($("#crphone_number").val()=="")
            {
                alert('Please enter Phone Number');
            }
            else
            {
                var temp2 = new Object; 
                temp2._token =creditToken;
                temp2.phone = $("#crphone_number").val();

                var myJSON = JSON.stringify(temp2);

                $.ajax({
                    url: sendotpEcredit,
                    type: "post",
                    data: myJSON,
                    contentType: "application/json",
                    processData: false,
                    success: function(response) {
                        if(response.hasOwnProperty('success'))
                        {
                            $("#myModal").modal("show");
                        }
                        else if(response.hasOwnProperty('duplicate'))
                        {
                            alert(response.duplicate);
                        } 
                        else
                        {
                            alert("OTP send failed. Please try later.");
                            return false;
                        }
                    }
                });
            }
        });
        $("#btnVerify").click(function(e) {
            e.preventDefault();
            $("#verified").val("0");
                var temp = new Object;
                temp._token =creditToken;
                temp.otp_code = $("#otp_code").val();

                var myJSON = JSON.stringify(temp);

                $.ajax({
                    url:EcreditVerifyOtp,
                    type: "post",
                    data: myJSON,
                    contentType: "application/json",
                    processData: false,
                    success: function(response) {
                        if(response.hasOwnProperty('success'))
                        {
                            $("#myModal").modal("hide");
                            $("#verified").val("1");
                            $("#formSubmitted").submit();
                        }
                        else
                        {
                            alert("OTP is not match");
                            return false;
                        }
                    }
                });
        });
    });