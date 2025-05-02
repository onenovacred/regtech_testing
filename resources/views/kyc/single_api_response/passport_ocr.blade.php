@if (!empty($passport['status_code']) && $passport['status_code'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Passport Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong> Date Of Birth: </strong>
                        {{ isset($passport['passport_verification']['mrz_info']['date_of_birth_yymmdd']) ? Carbon\Carbon::createFromFormat('ymd', $passport['passport_verification']['mrz_info']['date_of_birth_yymmdd'])->toDateString() : 'null' }}
                    </p>
                    <p><strong>Expiration Date: </strong>
                        {{ isset($passport['passport_verification']['mrz_info']['expiration_date_yymmdd']) ? Carbon\Carbon::createFromFormat('ymd', $passport['passport_verification']['mrz_info']['expiration_date_yymmdd'])->toDateString() : 'null' }}
                    </p>
                    <p><strong>Gender:
                        </strong>{{ isset($passport['passport_verification']['mrz_info']['gender']) ? $passport['passport_verification']['mrz_info']['gender'] : 'null' }}
                    </p>
                    <p><strong>Mrz Type:
                        </strong>{{ isset($passport['passport_verification']['mrz_info']['mrz_type']) ? $passport['passport_verification']['mrz_info']['mrz_type'] : 'null' }}
                    </p>
                    <p><strong>Nationality:
                        </strong>{{ isset($passport['passport_verification']['mrz_info']['nationality']) ? $passport['passport_verification']['mrz_info']['nationality'] : 'null' }}
                    </p>
                    <p><strong>Number:
                        </strong>{{ isset($passport['passport_verification']['mrz_info']['number']) ? $passport['passport_verification']['mrz_info']['number'] : 'null' }}
                    </p>
                    <p><strong>Valid Document:
                        </strong>{{ isset($passport['passport_verification']['valid_document']) ? 'True' : 'False' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endif