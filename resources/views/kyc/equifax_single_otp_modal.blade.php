<!--ECREDIT--->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">OTP has been Sent</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="input-group input-group--style-1">
                            <input type="number" class="form-control" name="otp_code" placeholder="Enter OTP" id="otp_code" required minlength="4" maxlength="4" />
                            <span class="input-group-addon">
                                <i class="text-md la la-lock"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <span id="timer"></span>
            <span id="otp_check" style="display:none">OTP not received ? <a class="btn btn-primary" href="#" id="resent">Resend</a></span>
            <span><button type="button" class="btn btn-success" id="btnVerify">Verify</button></span>
        </div>
    </div>
    </div>
</div>
<!--CRIF-->
<div class="modal fade" id="myModalcrif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">OTP has been Sent</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="input-group input-group--style-1">
                            <input type="number" class="form-control" name="otp_code1" placeholder="Enter OTP" id="otp_code1" required minlength="4" maxlength="4" />
                            <span class="input-group-addon">
                                <i class="text-md la la-lock"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <span id="timer"></span>
            <span id="otp_check" style="display:none">OTP not received ? <a class="btn btn-primary" href="#" id="resent">Resend</a></span>
            <span><button type="button" class="btn btn-success" id="btnVerifycrif">Verify</button></span>
        </div>
    </div>
    </div>
</div>
</div>
</div>