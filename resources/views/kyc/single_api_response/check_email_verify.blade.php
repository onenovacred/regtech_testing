@if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 200)
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Verified Address Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong>Identity:&nbsp;&nbsp;</strong>
                        @if (!empty($check_verify_email_status['data']['identity']))
                            {{ $check_verify_email_status['data']['identity'] }}
                        @else
                            null
                        @endif
                    </p>
                    <p><strong>Verification Status:&nbsp;&nbsp;</strong>
                        @if (!empty($check_verify_email_status['data']['verification_status']))
                            {{ $check_verify_email_status['data']['verification_status'] }}
                        @else
                            null
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif
<!--Check Email Verify End-->