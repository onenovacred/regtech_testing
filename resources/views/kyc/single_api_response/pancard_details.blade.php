@if (!empty($pancardnew_details) && isset($pancardnew_details['pancard']['data']) && $pancardnew_details['status_code']==200)
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PAN CARD Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p><strong>Client Id:</strong>null</p>
                <p><strong>Transaction Id: </strong>{{$pancardnew_details['pancard']['data']["transactionId"] }}</p>
                <p><strong>Pan Number: </strong>{{$pancardnew_details['pancard']['data']['panNumber'] }}</p>
                <p><strong>Masked Aadhar: </strong>{{$pancardnew_details['pancard']['data']['maskedAadhar'] }}</p>
                <p><strong>LastFourDigitAadhar: </strong>{{$pancardnew_details['pancard']['data']['lastFourDigitAadhar'] }}</p>
                <p><strong>TypeOfHolder:</strong> {{$pancardnew_details['pancard']['data']['typeOfHolder'] }}</p>
                <p><strong>Full Name: </strong>{{$pancardnew_details['pancard']['data'][ "name"] }}</p>
                <p><strong>FirstName: </strong>{{$pancardnew_details['pancard']['data']['firstName'] }}</p>
                <p><strong>MiddleName: </strong>{{$pancardnew_details['pancard']['data']['middleName'] }}</p>
                <p><strong>LastName: </strong>{{$pancardnew_details['pancard']['data']['lastName'] }}</p>
                <p><strong>Gender:</strong>{{$pancardnew_details['pancard']['data']['gender'] }}</p>
                <p><strong>Date Of Birthday: </strong>{{$pancardnew_details['pancard']['data']['dob'] }}</p>
                <p><strong>Address: </strong>{{$pancardnew_details['pancard']['data']['address'] }}</p>
                <p><strong>City: </strong>{{$pancardnew_details['pancard']['data']['city'] }}</p>
                <p><strong>State: </strong>{{$pancardnew_details['pancard']['data']['state'] }}</p>
                <p><strong>Country: </strong>{{$pancardnew_details['pancard']['data']['country'] }}</p>
                <p><strong>Pincode: </strong>{{$pancardnew_details['pancard']['data']['pincode'] }}</p>
                <p><strong>Mobile Number: </strong>{{$pancardnew_details['pancard']['data']['mobile_no'] }}</p>
                <p><strong>Email: </strong>{{$pancardnew_details['pancard']['data']['email'] }}</p>
                <p><strong>IsValid: </strong>{{$pancardnew_details['pancard']['data']['isValid'] }}</p>
                <p><strong>AadhaarSeedingStatus: </strong>{{$pancardnew_details['pancard']['data']['aadhaarSeedingStatus'] }}</p>
                <p><strong>ServiceCode: </strong>{{$pancardnew_details['pancard']['data']['serviceCode'] }}</p>
                <p><strong>Status Code: </strong>{{$pancardnew_details['status_code'] }}</p>
                <p><strong>Success: </strong>{{$pancardnew_details['success'] }}</p>
                <p><strong>Message Code: </strong>{{$pancardnew_details['message_code'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif
<!--Pancard Details end-->