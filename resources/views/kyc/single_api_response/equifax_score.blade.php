<!--Equifax Score Api Start-->
@if (isset($score_api_success_message))
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Score Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                  @php
                     $messageDatascore = json_decode($score_api_success_message, true);
                  @endphp
                <div>
                    <p><b>Full Name</b> : {{ $messageDatascore['full_name'] }}</p>
                    <p><b>PAN no</b> : {{ $messageDatascore['pan_no'] }}</p>
                    <p><b>Score value</b> : {{ $messageDatascore['score_value'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif
