@if(!empty($face_match) && isset($face_match[0]['statusCode']) && $face_match[0]['statusCode'] == 200)

@php
    $cardClasses = ['card'];

    if ((float)$face_match[0]['face_match']['response']['confidence'] <= 60) {
        $cardClasses[] = ' card-danger';
    }else if ((float)$face_match[0]['face_match']['response']['confidence'] > 60 && (float)$face_match[0]['face_match']['response']['confidence'] <= 80){
        $cardClasses[] = ' card-warning';
    }else{
        $cardClasses[] = ' card-success';
    }
@endphp

<div class="{{ implode(' ', $cardClasses) }}">
    <div class="row">
        <div class="col-md-6 offset-md-3">
    <div class="card-header">
        <h3 class="card-title">Face Match Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p><strong>Confidence: </strong>{{ $face_match[0]['face_match']['response']['confidence'] }}%</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif