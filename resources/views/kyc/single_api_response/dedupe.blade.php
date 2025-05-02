@if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] ==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Dedupe Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                     <p><strong>Delete Files:&nbsp;&nbsp;</strong>
                        @if(isset($dedupe_details['data']['deleted_files']))
                          @foreach($dedupe_details['data']['deleted_files'] as $files) 
                           <p>{{$files}}</p>
                           @endforeach
                         @else 
                          "null"
                         @endif         
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
 </div>
</div>
@endif
<!--Dedupe End-->