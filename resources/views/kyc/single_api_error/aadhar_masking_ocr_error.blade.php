   
                   <!---Aadhar Card Masking OCR Error Message-->
                   @if(isset($aadhaar_masking['status_code']) &&  $aadhaar_masking['status_code']== 102)
                   <div class="alert alert-danger" role="alert">
                       Invalid file type, must be an image.
                    </div>
                  @endif
                @if(isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code']== 404)
                  <div class="alert alert-danger" role="alert">
                     No image file provided.
                 </div>
                 @endif
                 @if(isset($aadhaar_masking['statusCode']) && $aadhaar_masking['statusCode']== 103)
                 <div class="alert alert-danger" role="alert">
                    {{$aadhaar_masking['message']}}
                </div>
                @endif
                 @if(isset($amstatusCode) && $amstatusCode == 500)
                   <div class="alert alert-danger" role="alert">
                      Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                   </div>
                  @endif