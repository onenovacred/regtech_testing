@if (isset($pancard['status_code']) && $pancard['status_code']==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PAN CARD Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-">
                <div>
                    <p><strong>Pan Description:&nbsp;&nbsp;</strong>
                        @if(isset($pancard['pancard']['raw_ocr_texts']))
                         @foreach($pancard['pancard']['raw_ocr_texts'] as $row_text) {{$row_text }} @endforeach
                                            
                         @else 
                         "null"
                       @endif         
                    </p>
                    <p><strong>Name:&nbsp;&nbsp;</strong>
                        @if (!empty($pancard["pancard"]['name']))
                            {{ $pancard["pancard"]['name'] }}
                        @else
                        null
                        @endif
                    </p>
                    <p><strong>Date Of Birth:&nbsp;&nbsp;</strong>
                        @if (!empty($pancard["pancard"]['date_of_birth']))
                            {{ $pancard["pancard"]['date_of_birth'] }}
                        @else
                        null
                        @endif
                    </p>
                    <p><strong>Pan number :&nbsp;&nbsp;</strong>
                        @if (!empty($pancard["pancard"]['pan_number']))
                            {{ $pancard["pancard"]['pan_number'] }}
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