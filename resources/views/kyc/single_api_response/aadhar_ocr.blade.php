@if (!empty($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Aadhar Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                 <p><strong>Aadhar Description:
                    </strong>
                     @if(isset($aadharcardocr['aadharcard']['raw_ocr_texts']))
                     @foreach($aadharcardocr['aadharcard']['raw_ocr_texts'] as $row_text) {{$row_text }} @endforeach
                                        
                     @else 
                     "null"
                @endif          
               </p>
                <p><strong>Date of Bith:
                    </strong>{{ isset($aadharcardocr['aadharcard']['date_of_birth']) ? $aadharcardocr['aadharcard']['date_of_birth'] : 'null' }}
                </p>
                <p><strong>Aadhar Number:
                    </strong>{{ isset($aadharcardocr['aadharcard']['aadhar_number']) ? $aadharcardocr['aadharcard']['aadhar_number'] : 'null' }}
                </p>
                <p><strong>Name:
                </strong>{{ isset($aadharcardocr['aadharcard']['name']) ? $aadharcardocr['aadharcard']['name'] : 'null' }}
                 </p>
                 <p><strong>Gender:
                </strong>{{ isset($aadharcardocr['aadharcard']['gender']) ? $aadharcardocr['aadharcard']['gender'] : 'null' }}
                 </p>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endif