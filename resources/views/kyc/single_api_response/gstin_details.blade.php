@if(isset($gstin_details['statusCode']) && $gstin_details['statusCode']==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">GSTIN Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nature of Business Activities:</strong> @if(isset($gstin_details['data']['Nature of Business Activities'])){{ $gstin_details['data']['Nature of Business Activities'] }}@else '' @endif</p>
                <p><strong>Dealing in Goods and Services:</strong> @if(isset($gstin_details['data']['Dealing in Goods and Services'])){{ $gstin_details['data']['Dealing in Goods and Services']}}@else '' @endif</p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif