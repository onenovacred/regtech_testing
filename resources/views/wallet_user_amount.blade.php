
<style>
    .lacs_thousand {
      background-color: #2c2b2b40;
      padding: 8px;
      border-radius: 50px;
      padding-left: 10px;
      padding-right: 10px;
  }

  .drawer {
      position: fixed;
      top: 0;
      right: -40%;
      /* Initially off-screen */
      width: 40%;
      /* Set the width to 75% */
      height: 100%;
      background-color: #fff;
      transition: right 0.3s ease-in-out;
      z-index: 1050;
      overflow-x: hidden;
  }
 
  
  .drawer.open {
      right: 0;
      /* Slide in from the right when open */
  }

  .drawer .drawer-content {
      padding: 20px;
  }

  .drawer-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #fff;
  }

  .close-button {
      cursor: pointer;
      font-size: 40px;
      margin-left: 24px;
      font-weight: 600;
      color: #000;
  }
</style>
<div class="drawer" id="drawer-1">
    <a type="button" class="close-button" id="closeDrawerButton">&times;</a>
    <div class="drawer-content">
        <div class="form-container border border-dark rounded p-2">
        <div class="row">
            <div class="col-md-12 offset-md-2">
                    <div class="">
                        <div class="text-center mt-1 mb-1">
                            <span>Current Wallet Balance :
                                ({{ Auth::user()->wallet_amount}})
                                <i class="fa fa-inr"></i>
                            </span>
                        </div>
                     </div>
                     <br/>
                      <form id="addWalletAmount" method="post">
                            @csrf
                                <div class="col-8">
                                    <input type="hidden" name="name" value="{{Auth::user()->name}}" />
                                    <input type="hidden" name="email" value="{{Auth::user()->email}}" />
                                    <div class="form-group">
                                        <label for="reason">Add Amount In Wallettttt</label>
                                        <input type="text" class="form-control" id="amount" name="amount"
                                            placeholder="Enter wallet amount.">
                                            <div>
                                               <span style="color:red;" id="wallet_payment_error_message"></span>
                                            </div>
                                     </div>
                                </div>
                                <div class="d-flex" style="margin-left:50px;">
                                    <span class="lacs_thousand" id="twenty_thousand" style="margin-right:30px;">+20,000</span>
                                    <span class="lacs_thousand" id="fifty_thousand" style="margin-right:30px;">+50,000</span>
                                    <span class="lacs_thousand" id="lacs" style="margin-right:30px;">+1,00,000</span>
                                </div>
                                <br />
                                <div class="d-flex">
                                    <div class="form-group">
                                        <p>
                                            <span>
                                                <strong>TAX (GST-18)</strong>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span id="gstAmount"></span>
                                            </span>
                                        </p>
                                        <p>
                                            <span>
                                                <strong>Net Amount Payble</strong>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;
                                                <span id="enteramount"></span>
                                            </span>
                                        </p>
                                        <p>
                                            <span>
                                                <strong>Total Amount</strong>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;
                                                <span id="total_amount"></span>
                                                <input type='hidden' name="total_amounts" id="total_amounts" />
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div style="margin-left:150px;">
                                    <button type="submit" id="ebz-checkout-btn" class="btn btn-success">Procced to Pay</button>
                                </div>
                        </form>
            
            </div>
        </div>
        <div id="loading1">

        </div>
    </div>
</div>
</div>
<script src='https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script> 
<script>
    $(document).ready(function() {
            $("#amount").on("input", function() {
                var enteredAmount = parseFloat($(this).val());
                if (!isNaN(enteredAmount) && enteredAmount >= 1000) {
                    var gst = enteredAmount * 0.18;
                    var totalAmount = enteredAmount + gst;
                    $("#gstAmount").text(gst.toFixed(2));
                    $("#total_amount").text(totalAmount);
                    $("#total_amounts").val(totalAmount);
                    $("#enteramount").text($("#amount").val());
                } else {
                    $("#total_amount").text("");
                    $("#gstAmount").text("");
                    $("#enteramount").text("");
                }
            });
            $("#twenty_thousand").click(function() {
                var amount = 20000;
                calculateGST(amount);
            })
            $("#fifty_thousand").click(function() {
                var amount = 50000;
                calculateGST(amount);
            })
            $("#lacs").click(function() {
                var amount = 100000;
                calculateGST(amount);
            })
            function calculateGST(amount) {
                if (!isNaN(amount) && amount >= 1000) {
                    $('#amount').val(amount);
                    var gst = amount * 0.18;
                    var totalAmount = amount + gst;
                    $("#gstAmount").text(gst.toFixed(2));
                    $("#total_amount").text(totalAmount);
                    $("#total_amounts").val(totalAmount);
                    $("#enteramount").text(amount);
                } else {
                    $("#total_amount").text("");
                    $("#gstAmount").text("");
                    $("#enteramount").text("");
                }
            }
        });
 $(document).ready(function() {

$('#addWalletAmount').submit(function(e) {
     e.preventDefault(); 
    var formData = $(this).serialize();
    console.log('addamount: ',formData);
    $.ajax({
        url: '{{ route('billing.addwalletuseramount') }}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        success: function(response) {
        console.log(response);
            if (response.data.status == 1) {
                var easebuzzCheckout = new EasebuzzCheckout("7PQJ3ZJPRQ","prod")
                    var options = {
                        access_key: response.data.data, 
                        onResponse: (response_data) => {
                            if (response_data.status === "success") {
                            let amount = $('#amount').val();
                            let txnid = response_data.txnid ? response_data.txnid : null;
                            let email = response_data.email ? response_data.email : null;
                            let successUrl = '{{ url("success_url") }}/' + amount + '/' + txnid+'/'+email;
                             window.location.href = successUrl;
                          } else {
                            let name_on_card =  response_data.name_on_card ? response_data.name_on_card: null;
                            let error_Message = response_data.error_Message ? response_data.error_Message : null;
                            let failureUrl = '{{ url("failure_url") }}/' + name_on_card + '/' + error_Message;
                            window.location.href = failureUrl;
                          }
                        },
                        theme: '#123456' // color hex
                        }
                        easebuzzCheckout.initiatePayment(options);
             } else {
             //   document.getElementById('loading1').innerText=JSON.stringify(json_response);
                   
            }

       },
        error: function(xhr, status, error) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                if (errors.amount) {
                    $('#wallet_payment_error_message').text(errors.amount);
                }
            } else {
                console.log(error);
            }
        }
    });
});
});
 
  
</script>
