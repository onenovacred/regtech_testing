<!--pancard start-->
@if (!empty($pan_cards['status_code']) && $pan_cards['status_code'] == 200)
<div class="row">
   <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PAN Details</h3>
    </div>
    <div class="card-body">
       <div class="col-md-12">
                <div>
                    @if (!empty($pan_cards['pancard']['data']['client_id']))
                    <p><strong>ClientId:</strong>
                        {{$pan_cards['pancard']['data']['client_id']}}
                    </p>
                   @endif
                    @if (!empty($pan_cards['pancard']['data']['transactionId']))
                        <p><strong>TransactionId:</strong>
                            {{$pan_cards['pancard']['data']['transactionId']}}
                        </p>
                    @endif
                    @if (!empty($pan_cards['pancard']['data']['maskedAadhar']))
                   <p><strong>MaskedAadhar:</strong>
                       {{$pan_cards['pancard']['data']['maskedAadhar']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['lastFourDigitAadhar']))
                   <p><strong>LastFourDigitAadhar:</strong>
                       {{$pan_cards['pancard']['data']['lastFourDigitAadhar']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['typeOfHolder']))
                   <p><strong>TypeOfHolder:</strong>
                       {{$pan_cards['pancard']['data']['typeOfHolder']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['name']))
                   <p><strong>FullName:</strong>
                       {{$pan_cards['pancard']['data']['name']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['firstName']))
                   <p><strong>FirstName:</strong>
                       {{$pan_cards['pancard']['data']['firstName']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['middleName']))
                   <p><strong>MiddleName:</strong>
                       {{$pan_cards['pancard']['data']['middleName']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['lastName']))
                   <p><strong>LastName:</strong>
                       {{$pan_cards['pancard']['data']['lastName']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['gender']))
                   <p><strong>Gender:</strong>
                       {{$pan_cards['pancard']['data']['gender']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['dob']))
                   <p><strong>DOB:</strong>
                       {{$pan_cards['pancard']['data']['dob']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['address']))
                   <p><strong>Address:</strong>
                       {{$pan_cards['pancard']['data']['address']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['city']))
                   <p><strong>City:</strong>
                       {{$pan_cards['pancard']['data']['city']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['state']))
                   <p><strong>State:</strong>
                       {{$pan_cards['pancard']['data']['state']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['country']))
                   <p><strong>Country:</strong>
                       {{$pan_cards['pancard']['data']['country']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['pincode']))
                   <p><strong>Pincode:</strong>
                       {{$pan_cards['pancard']['data']['pincode']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['mobile_no']))
                   <p><strong>Mobile_no:</strong>
                       {{$pan_cards['pancard']['data']['mobile_no']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['email']))
                   <p><strong>Email:</strong>
                       {{$pan_cards['pancard']['data']['email']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['isValid']))
                   <p><strong>IsValid:</strong>
                       {{$pan_cards['pancard']['data']['isValid']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['aadhaarSeedingStatus']))
                   <p><strong>AadhaarSeedingStatus:</strong>
                       {{$pan_cards['pancard']['data']['aadhaarSeedingStatus']}}
                   </p>
                   @endif
                   @if (!empty($pan_cards['pancard']['data']['serviceCode']))
                   <p><strong>ServiceCode:</strong>
                       {{$pan_cards['pancard']['data']['serviceCode']}}
                   </p>
                   @endif
                </div>
       </div>
    </div>
</div>
   </div>
</div>
@endif