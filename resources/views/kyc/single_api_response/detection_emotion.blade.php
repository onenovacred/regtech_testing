@if(!empty($detection_emotion_details['statusCode']) && $detection_emotion_details['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Emotion Details.</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p>
                     <strong>Emoation Description:</strong>
                     @if(isset($detection_emotion_details['response']['emotions'][0]))
                           {{$detection_emotion_details['response']['emotions'][0]}}
                        @else
                          ""
                     @endif
                </p>
               
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif