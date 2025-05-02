@if (!empty($lincense_extract['status_code']) && $lincense_extract['status_code'] == 200)
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
                        @if(isset($lincense_extract['driving_license']['detected_text']))
                         {{$lincense_extract['driving_license']['detected_text']}} 
                        
                        @endif          
                    </p>
                    <p><strong>Valid Till:
                        </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['Valid Till']) ? $lincense_extract['driving_license']['extracted_info']['Valid Till'] : 'null' }}
                    </p>
                    <p><strong>birth date:
                        </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['birth_date']) ? $lincense_extract['driving_license']['extracted_info']['birth_date'] : 'null' }}
                    </p>
                    <p><strong>dl_no:
                    </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['dl_no']) ? $lincense_extract['driving_license']['extracted_info']['dl_no'] : 'null' }}
                     </p>
                     <p><strong>name:
                    </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['name']) ? $lincense_extract['driving_license']['extracted_info']['name'] : 'null' }}
                     </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif