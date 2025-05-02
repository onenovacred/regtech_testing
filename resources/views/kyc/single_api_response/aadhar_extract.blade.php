@if (!empty($aadharcard_extract['status_code']) && $aadharcard_extract['status_code'] == 200)
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
                         @if(isset($aadharcard_extract['aadharcard']['detected_text']))
                            {{$aadharcard_extract['aadharcard']['detected_text']}}
                          @else 
                         "null"
                    @endif          
                   </p>
                    <p><strong>Date of Bith:
                        </strong>{{ isset($aadharcard_extract['aadharcard']['date_of_birth']) ? $aadharcard_extract['aadharcard']['date_of_birth'] : 'null' }}
                    </p>
                    <p><strong>Aadhar Number:
                        </strong>{{ isset($aadharcard_extract['aadharcard']['aadhar_number']) ? $aadharcard_extract['aadharcard']['aadhar_number'] : 'null' }}
                    </p>
                    <p><strong>Name:
                    </strong>{{ isset($aadharcard_extract['aadharcard']['name']) ? $aadharcard_extract['aadharcard']['name'] : 'null' }}
                     </p>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endif