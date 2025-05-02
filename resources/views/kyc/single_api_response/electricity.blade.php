@if(!empty($electricity))
@if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == 200 && $electricity['electricity']['response']['isValid'] == 'Yes')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Electricity Bill Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <div>
                <p><strong>Customer ID:</strong> {{ $electricity['electricity']['response']['customer_id'] }}</p>
                <p><strong>Customer Name:</strong> {{ $electricity['electricity']['response']['customer_name'] }}</p>
                <p><strong>Operator:</strong> {{ $electricity['electricity']['response']['operator_name'] }} - {{ $electricity['electricity']['response']['operator_code'] }}</p>
                <p><strong>Due Amount:</strong> {{ $electricity['electricity']['response']['due_amount'] }}</p>
                <p><strong>Due Date:</strong> {{ $electricity['electricity']['response']['due_date'] }}</p>
            </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif