@if(!empty($passportUploadUploadUpload) && $statusCodeUploadPassport == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Passport Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <strong><p>OCR READING OF  : {{$passportUploadUpload['data']['passport_num'] }}</p></strong>
                <strong><p>Status Code : {{200}}</p></strong>
                <p>Passport Number: {{$passportUploadUpload['data']['passport_num'] }}</p>
                <p>DOB: {{$passportUploadUpload['data']['dob'] }}</p>
                <p>Father Name: {{$passportUploadUpload['data']['father'] }}</p>
                <p>Full Name: {{$passportUploadUpload['data']['given_name'] }}</p>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div>
            

                <p>client_id: {{$passportUploadUpload['data']['client_id'] }}</p>
                <p>country_code: {{$passportUploadUpload['data']['country_code'] }}</p>
                <p>dob: {{$passportUploadUpload['data']['dob'] }}</p>
                <p>doe: {{ $passportUploadUpload['data']['doe'] }}</p>
                <p>doi: {{ $passportUploadUpload['data']['doi'] }}</p>
                <p>gender: {{ $passportUploadUpload['data']['gender'] }}</p>
                <p>given_name: {{ $passportUploadUpload['data']['given_name'] }}</p>
                <p>nationality: {{ $passportUploadUpload['data']['nationality'] }}</p>
                <p>passport_num: {{ $passportUploadUpload['data']['passport_num'] }}</p>
                <p>place_of_birth: {{ $passportUploadUpload['data']['place_of_birth'] }}</p>
                <p>place_of_issue: {{ $passportUploadUpload['data']['place_of_issue'] }}</p>
                <p>surname: {{ $passportUploadUpload['data']['surname'] }}</p>
                <p>mrz_line_1: {{ $passportUploadUpload['data']['mrz_line_1'] }}</p>
                <p>mrz_line_2: {{ $passportUploadUpload['data']['mrz_line_2'] }}</p>
                <p>type_of_passport: {{ $passportUploadUpload['data']['type_of_passport'] }}</p>
                <p>address: {{ $passportUploadUpload['data']['address'] }}</p>
                <p>father: {{ $passportUploadUpload['data']['father'] }}</p>
                <p>mother: {{ $passportUploadUpload['data']['mother'] }}</p>
                <p>file_num: {{ $passportUploadUpload['data']['file_num'] }}</p>
                <p>old_doi: {{ $passportUploadUpload['data']['old_doi'] }}</p>
                <p>old_passport_num: {{ $passportUploadUpload['data']['old_passport_num'] }}</p>
                <p>old_place_of_issue: {{ $passportUploadUpload['data']['old_place_of_issue'] }}</p>
                <p>pin: {{ $passportUploadUpload['data']['pin'] }}</p>
                <p>spouse: {{ $passportUploadUpload['data']['spouse'] }}</p>
                <p>passport_validity: {{ $passportUploadUpload['data']['passport_validity'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
@endif