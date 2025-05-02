@if (isset($extract_pancard_text['status_code']) && $extract_pancard_text['status_code']==200)
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
                    <p><strong>Pan Description:&nbsp;&nbsp;</strong>
                        @if(isset($extract_pancard_text['pancard']['detected_text']))
                            {{$extract_pancard_text['pancard']['detected_text']}}
                       @endif         
                    </p>
                    <p><strong>Date Of Birth:&nbsp;&nbsp;</strong>
                        @if (!empty($extract_pancard_text["pancard"]['extracted_info']['date_of_birth']))
                            {{ $extract_pancard_text["pancard"]['extracted_info']['date_of_birth'] }}
                        @else
                        null
                        @endif
                    </p>
                    <p><strong>Pan number :&nbsp;&nbsp;</strong>
                        @if (!empty($extract_pancard_text["pancard"]['extracted_info']['pan_number']))
                            {{$extract_pancard_text["pancard"]['extracted_info']['pan_number'] }}
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