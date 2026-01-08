@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ckyc Search V2</h3>
                    <a role="button" class="btn btn-light float-right" 
                    href="{{ route('kyc.ckysearch_advance_api') }}">ckycAdvance APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($statusCode) && $statusCode == 102)
                        <div class="alert alert-danger" role="alert">
                           Please enter valid information.
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == 103)
                        <div class="alert alert-danger" role="alert">
                            You are not registered to use this service.
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="card-body">
                            <form id="sendOtpForm">
                                @csrf
                                <div class="form-group">
                                    <label for="pan_number">PAN Number</label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10" name="pan_number" id="pan_number" placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10" name="mobile" id="mobile" placeholder="Ex: 9876543210" required>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Test button to manually open modal -->
            <!-- <button id="openTestModal" class="btn btn-primary mt-3 btn-block">Open OTP Modal Test</button> -->
        </div>

        @if (!empty($searchkyc) && $searchkyc['response']['status'] == 'VALID' && $statusCode == 200)
        @endif
    </div>

    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="verifyOtpForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Enter OTP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="request_id" id="request_id">
                        <input type="hidden" name="ckyc_response_request_id" id="ckyc_response_request_id">
                        <div class="form-group">
                            <label for="otp">OTP</label>
                            <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter OTP" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Verify OTP</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
$(document).ready(function() {

    // Test button to open modal manually
    $('#openTestModal').on('click', function() {
        console.log('Test button clicked - showing modal');
        $('#otpModal').modal('show');
    });

    $('#sendOtpForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('kyc.ckycsearchproduction') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                console.log('Response result_code:', response.result_code);
                if (response.result_code === 103 || response.result_code === 200) {
                    $('#request_id').val(response.request_id);
                    $('#ckyc_response_request_id').val(response.ckyc_response_request_id);

                    console.log('Showing OTP modal');
                    $('#otpModal').modal('show');

                    // Debug: check if modal has show class
                    setTimeout(() => {
                        console.log('Modal classes after show:', $('#otpModal').attr('class'));
                    }, 500);
                } else {
                    alert(response.error || 'Failed to send OTP.');
                }
            },
            error: function(xhr) {
                alert("Error sending OTP.");
                console.log(xhr);
            }
        });
    });

    $('#verifyOtpForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('kyc.verifyOtp') }}",
            method: "POST",
            data: $(this).serialize(),
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response, status, xhr) {
                const blob = new Blob([response], { type: 'application/pdf' });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "ckyc_verified_details.pdf";
                link.click();
                $('#otpModal').modal('hide');
            },
            error: function(xhr) {
                alert("OTP verification failed.");
                console.log(xhr);
            }
        });
    });
});
</script>
@stop
