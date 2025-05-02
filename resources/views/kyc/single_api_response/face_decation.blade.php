@if(!empty($facematch_details['statusCode']) && $facematch_details['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Image Details.</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center" style="font-weight:700;">Decated Image</h5>
                  <div class="text-center">
                     <img src="data:image/png;base64,{{isset($facematch_details["data"])?$facematch_details["data"] : ''}}" alt="image not found" width="350" height="300"/>
                  </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif