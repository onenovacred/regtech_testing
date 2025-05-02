$(document).ready(function() {
       
    $("#submitFormcrif").click(function(e) {
        e.preventDefault();
        if($("#crifmno").val()=="")
        {
            alert('Please enter Phone Number');
        }
        else
        {
            var temp2 = new Object;
            temp2._token =creditToken;
            temp2.phone = $("#crifmno").val();

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
                        $("#myModalcrif").modal("show");
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

 

    $("#btnVerifycrif").click(function(e) {
        e.preventDefault();
        $("#verified").val("0");
            var temp = new Object;
            temp._token = creditToken;
            temp.otp_code1 = $("#otp_code1").val();
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
                        $("#myModalcrif").modal("hide");
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