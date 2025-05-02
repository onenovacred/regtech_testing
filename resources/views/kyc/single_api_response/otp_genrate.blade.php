@if (
    !empty($aadhaar_otp_genrate) &&
        isset($aadhaar_otp_genrate[0]['status_code']) &&
        $aadhaar_otp_genrate[0]['status_code'] == 200)
        <div class="row">
            <div class="col-md-6 offset-md-3">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Aadhaar OTP Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <p>client_id:
                            {{ $aadhaar_otp_genrate[0]['aadhaar_validation']['data']['client_id'] }}
                        </p>
                        <p>otp_sent:
                            {{ $aadhaar_otp_genrate[0]['aadhaar_validation']['data']['otp_sent'] }}</p>
                        <p>if_number:
                            {{ $aadhaar_otp_genrate[0]['aadhaar_validation']['data']['if_number'] }}
                        </p>
                        <p>valid_aadhaar:
                            {{ $aadhaar_otp_genrate[0]['aadhaar_validation']['data']['valid_aadhaar'] }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endif
