@if (!empty($bhunakasha['data']) && $bhunakasha['status_code'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Bhumi Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong>Giscode:</strong>
                        {{ isset($bhunakasha['data']['Giscode']) ? $bhunakasha['data']['Giscode'] : 'null' }}
                    </p>
                    <p><strong>Plotno:</strong>
                        {{ isset($bhunakasha['data']['Plotno']) ? $bhunakasha['data']['Plotno'] : 'null' }}
                    </p>
                    @if (isset($bhunakasha['data']['Plotinfo']['Area_details']) ||
                            isset($bhunakasha['data']['Plotinfo']['Owner_details']) ||
                            isset($bhunakasha['data']['Plotinfo']['Remark']))
                        <p class="text-center"><strong>Plot Description</strong></p>
                        <p><strong>Area Details:</strong>
                            {{ isset($bhunakasha['data']['Plotinfo']['Area_details']) ? $bhunakasha['data']['Plotinfo']['Area_details'] : 'null' }}
                        </p>
                        <p><strong>Owner Details:</strong>
                            {{ isset($bhunakasha['data']['Plotinfo']['Owner_details']) ? $bhunakasha['data']['Plotinfo']['Owner_details'] : 'null' }}
                        </p>
                        <p><strong>Remark:</strong>
                            {{ isset($bhunakasha['data']['Plotinfo']['Remark']) ? $bhunakasha['data']['Plotinfo']['Remark'] : 'null' }}
                        </p>
                    @else
                        <p><strong>Plot Description:</strong>
                            {{ isset($bhunakasha['data']['Plotinfo']) ? $bhunakasha['data']['Plotinfo'] : 'null' }}
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif