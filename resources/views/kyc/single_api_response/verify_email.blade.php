@if (isset($verify_email['statusCode']) && $verify_email['statusCode'] ==200)
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
                    <p><strong>Email:&nbsp;&nbsp;</strong>
                        @if (!empty($verify_email['data']['email']))
                            {{ $verify_email['data']['email']}}
                        @else
                            null
                        @endif
                    </p>
                    <p><strong>HTTPStatusCode:&nbsp;&nbsp;</strong>
                        @if (!empty($verify_email['data']['HTTPStatusCode']))
                            {{ $verify_email['data']['HTTPStatusCode'] }}
                        @else
                            null
                        @endif
                    </p>
                    <p><strong>RequestId:&nbsp;&nbsp;</strong>
                        @if (!empty($verify_email['data']['RequestId']))
                            {{ $verify_email['data']['RequestId'] }}
                        @else
                            null
                        @endif
                    </p>
                    <p><strong>RetryAttempts:&nbsp;&nbsp;</strong>
                        @if (!empty($verify_email['data']['RetryAttempts']))
                        {{ $verify_email['data']['RetryAttempts'] }}
                        @else
                        null
                        @endif
                    </p>
                    <p><strong>Verification Initiated:&nbsp;&nbsp;</strong>
                        @if (!empty($verify_email['data']['verification_initiated']))
                        {{ $verify_email['data']['verification_initiated'] }}
                       @else
                        null
                       @endif
                    </p>
                    <p><strong>Verification Status:&nbsp;&nbsp;</strong>
                        @if (!empty($verify_email['data']['verification_status']))
                        {{ $verify_email['data']['verification_status'] }}
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