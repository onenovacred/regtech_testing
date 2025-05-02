@if(!empty($pancarduploade) && $pancarduploade[0]['statusCode'] == 200)
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
                <p>PAN Number: {{ $pancarduploade[0]['pancard']['pan_number'] }}</p>
                <p>DOB: {{ $pancarduploade[0]['pancard']['pan_dob'] }}</p>
                <p>Father Name: {{ $pancarduploade[0]['pancard']['pan_fname'] }}</p>
                <p>Full Name: {{ $pancarduploade[0]['pancard']['pan_name'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif
@if(isset($pancardupload2) && $pancardupload2 !=null && $pan_verified==1)
<div class="row">
    <div class="col-md-6 offset-md-3">
    <div class = "card card-success">
        <div class = "card-header">
            <h3 class = "card-title">PAN CARD Detailed Information</h3>
        </div>
        <div class = "card-body">
            <div class="row">
                <div class="col-md-12">
                  <div>
                    <p>Pan Verified: {{ ($pan_verified==1)? 'Verified' : 'Failed' }}</p>
                    <p>Full Name: {{ $pancardupload2[0]['pancard']['fullname'] }}</p>
                    <p>PAN no: {{ $pancardupload2[0]['pancard']['pancard'] }}</p>
                    <p>PAN Verification: {{ $pancardupload2[0]['statusCode'] }}</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
        @endif