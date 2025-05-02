@if (!empty($udyamaadhar) && isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Udhyog Aadhaar Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong>Full Name:</strong> {{ $udyamaadhar['response']['result']['uamNumber'] }}</p>
                    <p><strong>Name of Enterprise:
                        </strong>{{ $udyamaadhar['response']['result']['nameofEnterprise'] }}</p>
                    <p><strong>Major Activity:
                        </strong>{{ $udyamaadhar['response']['result']['majorActivity'] }}</p>
                    <p><strong>Social Category:
                        </strong>{{ $udyamaadhar['response']['result']['socialCategory'] }}</p>
                    <p><strong>Enterprise Type:
                        </strong>{{ $udyamaadhar['response']['result']['enterpriseType'] }}</p>
                    <p><strong>Date of Commencement:
                        </strong>{{ $udyamaadhar['response']['result']['dateofCommencement'] }}</p>
                    <p><strong>Dic Name: </strong>{{ $udyamaadhar['response']['result']['dicName'] }}</p>
                    <p><strong>State: </strong>{{ $udyamaadhar['response']['result']['state'] }}</p>
                    <p><strong>AppliedDate: </strong>{{ $udyamaadhar['response']['result']['appliedDate'] }}
                    </p>
                    <p><strong>Modified Date:
                        </strong>{{ $udyamaadhar['response']['result']['modifiedDate'] }}</p>
                    <p><strong>ValidTill Date:
                        </strong>{{ $udyamaadhar['response']['result']['validTillDate'] }}</p>
                    <p><strong>Nic2Digit: </strong>{{ $udyamaadhar['response']['result']['nic2Digit'] }}</p>
                    <p><strong>nic4Digit: </strong>{{ $udyamaadhar['response']['result']['nic4Digit'] }}</p>
                    <p><strong>nic5DigitCode:
                        </strong>{{ $udyamaadhar['response']['result']['nic5DigitCode'] }}</p>
                    <p><strong>Status: </strong>{{ $udyamaadhar['response']['result']['status'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif