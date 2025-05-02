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
      right: -46%;
      width:46%;
      height: 100%;
      background-color: #fff;
      transition: right 0.3s ease-in-out;
      z-index: 1050;
      overflow-x: hidden;
  }
 
  
  .drawer.open {
      right: 0;
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
  .form-container{
      padding:15px !important;
     
  }
  #add_payment_process{
      margin-left:20px;
  }
  #add_button{
      margin-left:20px;
  }
  .heading_admin{
     font-size:23px !important;
     color:#505050 !important;
     font-weight:600 !important;

  }
  .credit_debit{
      font-size:14px !important;
  }
  .reasone_transaction{
      font-size: 14px !important;
  }
  .add_amount{
       margin-left:8px !important;
  }

</style>
<div class="drawer" id="drawer-2">
    <a type="button" class="close-button" id="closeDrawerButtonAdmin">&times;</a>
    <div class="drawer-content">
        <div class="form-container border border-dark rounded p-2">
        <div class="row">
            <form id="payment-form" method="post">
                <div class="row">
                @if(Auth::user()->id==1)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Select Userrrrrrr</label>
                            @php
                            $users = DB::table('users')->where('type', 'role_prepaid')->get();
                            @endphp
                            <select class="form-control" id="user" name="user" class="credit_debit" required>
                                <option disabled selected>Select Prepaid User</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} : {{$user->email}} : Rs {{$user->wallet_amount}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="credit_debit">Credit / Debit</label>
                            <select class="form-control" id="transaction_type" name="transaction_type" required>
                                <option disabled selected>credit / debit</option>
                                <option value="credit">credit</option>
                                <option value="debit">debit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group add_amount">
                        <label for="reason">Wallet Blance To Credit/ Debit. For Ex : [ 15000 ]</label>
                        <input type="text" class="form-control" id="amount" name="amount"
                            placeholder="Enter wallet amount.">
                            <div id="amount-validation-error" style="color: red;"></div>
                     </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex justify-content-center" style="margin-left:140px;">
                            <span class="lacs_thousand" id="twenty_thousand" style="margin-right:30px;">+20,000</span>
                            <span class="lacs_thousand" id="fifty_thousand" style="margin-right:30px;">+50,000</span>
                            <span class="lacs_thousand" id="lacs" style="margin-right:30px;">+1,00,000</span>
                        </div>
                        <br/>
                        <div class="d-flex add_amount">
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
                    </div>
                    <br />
                    <div class="col-md-10">
                           <div class="d-flex justify-content-center">
                             <button type="submit" id="add_payment_process" class="btn btn-success">Add</button>
                           </div>
                    </div>
                </div>
                </form>
          </div>
    </div>
      <br/>
    <div class="form-container border border-dark rounded p-2">
          <h4 class="text-center">Admin Add Wallet Blance</h4>
        <form id="admin_payment_form" method="post">
        <div class="row">
         @if(Auth::user()->id == 1)
         <div class="col-md-6">
            <div class="form-group">
                <label for="name">Select User</label>
                <select class="form-control" id="user" name="user" required>
                    <option disabled selected>Select Prepaid User</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}} : {{$user->email}} : Rs {{$user->wallet_amount}}</option>
                    @endforeach
                </select>
            </div>
        </div>
         @endif
         <div class="col-md-6">
            <div class="form-group">
                <label for="name">Credit / Debit</label>
                <select class="form-control" id="transaction_type" name="transaction_type" required>
                    <option disabled selected>credit / debit</option>
                    <option value="credit">credit</option>
                    <option value="debit">debit</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group add_amount">
                <label for="reason">Wallet Blance To Credit/ Debit. For Ex : [ 15000 ]</label>
                <input type="text" class="form-control" id="aamount" name="amount"
                    placeholder="Enter wallet amount.">
                    <div id="aamount-validation-error" style="color: red;"></div>
             </div>
         </div>
        <div class="col-md-10">
            <div class="d-flex justify-content-center">
              <button type="submit" id="add_payment_process" class="btn btn-success">Add</button>
            </div>
        </div>
     </div>   
    </form>
    </div>
</div>
<script src='https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script> 
<script>
         const amountInput = document.getElementById('amount');
         const amountValidationError = document.getElementById('amount-validation-error');
          amountInput.addEventListener('input', () => {
           const amount = parseFloat(amountInput.value);
              if (isNaN(amount) || amount < 1000) {
                    amountValidationError.textContent = 'Amount must be at least 1000.';
                   amountInput.setCustomValidity('Amount must be at least 1000.');
             } else {
                  amountValidationError.textContent = '';
                   amountInput.setCustomValidity('');
             }
           });
           const paymentForm = document.getElementById('payment-form');
           paymentForm.addEventListener('submit', (e) => {
            if (amountInput.checkValidity() === false) {
               e.preventDefault();
             }
          });

            const adminamountInput = document.getElementById('aamount');
            const adminamountValidationError = document.getElementById('aamount-validation-error');
            adminamountInput.addEventListener('input', () => {
            const amount = parseFloat(adminamountInput.value);
              if (isNaN(amount) || amount < 1000) {
                adminamountValidationError.textContent = 'Amount must be at least 1000.';
                adminamountInput.setCustomValidity('Amount must be at least 1000.');
              } else {
                  adminamountValidationError.textContent = '';
                 adminamountInput.setCustomValidity('');
             }
           });
           const paymentAdminForm = document.getElementById('admin_payment_form');
             paymentAdminForm.addEventListener('submit', (e) => {
            if (adminamountInput.checkValidity() === false) {
                e.preventDefault();
               }
            });
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
 $('#payment-form').submit(function(e) {
     e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);
    $.ajax({
        url: '{{ route('billing.add_wallet') }}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        success: function(response) {
            
              if (response.payment_status_code == 200) {
                if(response.data.status==1){
                    var easebuzzCheckout = new EasebuzzCheckout(response.key,"prod")
                    var options = {
                        access_key: response.data.data, // access key received via Initiate Payment
                        onResponse: (response_data) => {
                            if (response_data.status === "success") {
                            let amount = $('#amount').val();
                            let txnid = response_data.txnid ? response_data.txnid : null;
                            let email = response_data.email ? response_data.email : null;
                            let successUrl = '{{ url("success_url") }}/' + amount + '/' + txnid+'/'+ email;
                            window.location.href = successUrl;
                        } else {
                            let name_on_card =  response_data.name_on_card ? response_data.name_on_card: null;
                            let error_Message = response_data.error_Message ? response_data.error_Message : null;
                            let failureUrl = '{{ url("failure_url") }}/' + name_on_card + '/' + error_Message;
                            window.location.href = failureUrl;
                           
                        }
                          console.log(response_data);
                        },
                        theme: '#123456' // color hex
                        }
                        easebuzzCheckout.initiatePayment(options);
                }
                else{
                    alert("Something is wrong.");
                }
               
             } 
            else if(response.status_code==200){
                 alert(response.success);
             }
             else if(response.status_code==401){
                alert(response.error);
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

$('#admin_payment_form').submit(function(e) {
     e.preventDefault(); // Prevent form submission
    var formData = $(this).serialize();
    console.log(formData);
    $.ajax({
        url: '{{ route('billing.add_walletadmin') }}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: formData,
        success: function(response) {
            if(response.status_code==200){
                 alert(response.success);
             }
             else if(response.status_code==401){
                alert(response.error);
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
