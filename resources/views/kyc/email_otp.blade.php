@extends('adminlte::page')

@section('title', 'Email OTP Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- STATUS MESSAGE --}}
        @if(isset($message))
            <div class="alert {{ $statusCode == 200 ? 'alert-success' : 'alert-danger' }}">
                {{ $message }}
            </div>
        @endif

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Email Verification</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('kyc.email_otp') }}">
                    @csrf

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="example@email.com"
                               value="{{ old('email', $email ?? '') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        Send OTP
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="otpModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary">
                <h5 class="modal-title">Verify OTP</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('kyc.verify_email_otp') }}">
                @csrf

                <div class="modal-body">

                    <input type="hidden" name="email" value="{{ $email ?? '' }}">

                    <div class="form-group">
                        <label>Enter OTP</label>
                        <input type="text"
                               name="otp"
                               class="form-control"
                               maxlength="6"
                               placeholder="6-digit OTP"
                               required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Verify OTP
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@stop

@section('js')
<script>

    @if(isset($showOtp) && $showOtp)
        $(document).ready(function () {
            $('#otpModal').modal('show');
        });
    @endif
</script>
@stop
