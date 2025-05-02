@if(isset($facematch_details1['status_code']) && $facematch_details1['status_code'] == 200)

@php
    $cardClasses = ['card'];
    if ((float)$facematch_details1['rec_face']['match'] <= 60) {
        $cardClasses[] = ' card-danger';
    }else if ((float)$facematch_details1['rec_face']['match'] > 60 && (float)$$facematch_details1['rec_face']['match'] <= 80){
        $cardClasses[] = ' card-warning';
    }else{
        $cardClasses[] = ' card-success';
    }
@endphp
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="{{ implode(' ', $cardClasses) }}">
    <div class="card-header">
        <h3 class="card-title">Face Match Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p><strong>Confidence: </strong>{{ $facematch_details1['rec_face']['match'] }}%</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif