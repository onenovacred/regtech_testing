@if (!empty($lincensedocr['status_code']) && $lincensedocr['status_code'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Lincense Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                 <p><strong>Lincese Description:
                    </strong>
                    @if(isset($lincensedocr['driving_license']['raw_ocr_texts']))
                    @foreach($lincensedocr['driving_license']['raw_ocr_texts'] as $row_text) {{$row_text }} @endforeach
                   @else 
                    "null"
                    @endif          
                </p>
                <p><strong>Valid Till:
                    </strong>{{ isset($lincensedocr['driving_license']['expiry_date']) ? $lincensedocr['driving_license']['expiry_date'] : 'null' }}
                </p>
                <p><strong>birth date:
                    </strong>{{ isset($lincensedocr['driving_license']['birth_date']) ? $lincensedocr['driving_license']['birth_date'] : 'null' }}
                </p>
                <p><strong>dl_no:
                </strong>{{ isset($lincensedocr['driving_license']['dl_no']) ? $lincensedocr['driving_license']['dl_no'] : 'null' }}
                 </p>
                 <p><strong>name:
                </strong>{{ isset($lincensedocr['driving_license']['name']) ? $lincensedocr['driving_license']['name'] : 'null' }}
                 </p>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endif