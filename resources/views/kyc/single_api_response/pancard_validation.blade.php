@if(!empty($pancardVerification) &&  isset($pancardVerification['statusCode']) && $pancardVerification['statusCode'] == 200)
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PAN CARD Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                {{-- <p><strong>Client Id :</strong>{{isset($pancard['pancard']['data']['client_id'])?$pancard['pancard']['data']['client_id']:'null'}}</p> --}}
                <p><strong>Full Name:</strong> {{ isset($pancardVerification['pancard']['data']['full_name'])?$pancardVerification['pancard']['data']['full_name']:'null' }}</p>
                <p><strong>PAN no: </strong>{{ isset($pancardVerification['pancard']['data']['pan_number'])?$pancardVerification['pancard']['data']['pan_number']:'null'}}</p>
                <p><strong>Category: </strong>{{ isset($pancardVerification['pancard']['data']['category'])?$pancardVerification['pancard']['data']['category']:'null' }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif