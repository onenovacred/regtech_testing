@if(!empty($bypancard_details) &&  isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] == 200)
<div class="row">
 <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PAN CARD Details</h3>
    </div>
    <div class="card-body">
            <div>
                <p><strong>GSTIN Number:&nbsp;&nbsp;</strong>
                    @if (!empty($bypancard_details['data']['GSTIN']))
                        {{ $bypancard_details['data']['GSTIN'] }}
                    @else
                        null
                    @endif
                </p>
                <p><strong>GSTIN Status:&nbsp;&nbsp;</strong>
                    @if (!empty($bypancard_details['data']['GSTIN_STATUS']))
                        {{ $bypancard_details['data']['GSTIN_STATUS'] }}
                    @else
                        null
                    @endif
                </p> 
                <p><strong>STATE:&nbsp;&nbsp;</strong>
                    @if (!empty($bypancard_details['data']['STATE']))
                        {{ $bypancard_details['data']['STATE'] }}
                    @else
                        null
                    @endif
                </p> 
            </div>
       </div>
    </div>
</div>
</div>
</div>
@endif