
@if(isset($voteruplode['data']['ocr_fields'][0]['epic_number']['value']) && isset($statusCodevoterUpload) && $statusCodevoterUpload == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Voter ID CARD Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>Voter ID Number: {{ $voteruplode['data']['ocr_fields'][0]['epic_number']['value'] }}</p>
                @php
                $dob = explode('-',$voteruplode['data']['ocr_fields'][0]['dob']['value']);
                @endphp
                <p>DOB: {{ $dob[0] }}-XX-XX</p>
                <p>Age: {{ $voteruplode['data']['ocr_fields'][0]['age']['value'] }}</p>
                <p>Gender: {{ $voteruplode['data']['ocr_fields'][0]['gender']['value'] }}</p>
                <p>Father Name: {{ $voteruplode['data']['ocr_fields'][0]['care_of']['value'] }}</p>
                <p>Full Name: {{ $voteruplode['data']['ocr_fields'][0]['full_name']['value'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(isset($voter_detailed_info_upload) &&$voter_detailed_info !=null && isset($is_valid) && $is_valid == 1)
<div class = "card card-success">
    <div class = "card-header">
        <h3 class = "card-title">Voter Detailed Information</h3>
    </div>
    <div class = "card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                  <p>Verification Sucessfull  </p>
                <p>Client ID: {{$voter_detailed_info_upload['data']['client_id'] }}</p>
                <p>Gender: @if($voter_detailed_info_upload['data']['gender'] == 'M') Male @elseif($voter_detailed_info_upload['data']['gender'] == 'F') Female @else {{$voter_detailed_info_upload['data']['gender']}} @endif</p>
                <p>State: {{ $voter_detailed_info_upload['data']['state'] }}</p>
                <p>Name: {{$voter_detailed_info_upload['data']['name']}}</p>
                <p>Relation Name: {{$voter_detailed_info_upload['data']['relation_name']}}</p>
                <p>Relation Type: {{ $voter_detailed_info_upload['data']['relation_type'] }}</p>
                <p>House No.: {{ $voter_detailed_info_upload['data']['house_no'] }}</p>
                <p>DOB: {{ $voter_detailed_info_upload['data']['dob'] }}</p>
                <p>Age: {{ $voter_detailed_info_upload['data']['age'] }}</p>
                <p>Area: {{ $voter_detailed_info_upload['data']['area'] }}</p>
                <p>District: {{ $voter_detailed_info_upload['data']['district'] }}</p>
                <p>Multiple: {{$voter_detailed_info_upload['data']['multiple']}}</p>
                <p>Last Update: {{$voter_detailed_info_upload['data']['last_update']}}</p>
                <p>Assembly Constituency: {{ $voter_detailed_info_upload['data']['assembly_constituency'] }}</p>
                <p>Assembly Constituency Number: {{ $voter_detailed_info_upload['data']['assembly_constituency_number'] }}</p>
                <p>Polling Station: {{ $voter_detailed_info_upload['data']['polling_station'] }}</p>
                <p>Part Number: {{ $voter_detailed_info_upload['data']['part_number'] }}</p>
                <p>Part Name: {{ $voter_detailed_info_upload['data']['part_name'] }}</p>
                <p>Parliamentary Constituency: {{ $voter_detailed_info_upload['data']['parliamentary_constituency'] }}</p>
              </div>
            </div>
        </div>
    </div>
    @endif