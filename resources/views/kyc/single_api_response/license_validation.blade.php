@if (
    !empty($license_validation[0]['license_validation']) &&
        isset($license_validation[0]['statusCode']) &&
        ($license_validation[0]['statusCode'] = 200))
      <div class="row">
        <div class="col-md-6 offset-md-3">   
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">License Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <p>License Number:
                            {{ $license_validation[0]['license_validation']['data']['license_number'] }}
                        </p>
                        <p>Name: {{ $license_validation[0]['license_validation']['data']['name'] }}</p>
                        <p>Father / Husband Name:
                            {{ $license_validation[0]['license_validation']['data']['father_or_husband_name'] }}
                        </p>
                        <p>DOB: {{ $license_validation[0]['license_validation']['data']['dob'] }}</p>
                        <p>Permanent Address:
                            {{ $license_validation[0]['license_validation']['data']['permanent_address'] }}
                        </p>
                        <p>Permanent ZIP:
                            {{ $license_validation[0]['license_validation']['data']['permanent_zip'] }}
                        </p>
                        <p>State:
                            {{ $license_validation[0]['license_validation']['data']['state'] }}
                        </p>
                        <p>District:
                            {{ $license_validation[0]['license_validation']['data']['district'] }}
                        </p>
                        <p>Image: <br><img
                                src="{{ $license_validation[0]['license_validation']['data']['profile_image'] }}"
                                alt="Profile"></p>
                        {{-- <p>License Verification: {{ $license_validation[0]['statusCode'] }}</p> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
      </div>
@endif