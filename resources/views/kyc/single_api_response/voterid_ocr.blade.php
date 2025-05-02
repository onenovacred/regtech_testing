@if (isset($voterid['status_code']) && $voterid['status_code']==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Voter Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong>Voter Description:&nbsp;&nbsp;</strong>
                        @if(isset($voterid['voterid']['raw_ocr_texts']))
                        @foreach($voterid['voterid']['raw_ocr_texts'] as $row_text) {{$row_text }} @endforeach
                       @else 
                        "null"
                        @endif       

                    </p>
                    <p><strong>Name:&nbsp;&nbsp;</strong>
                        @if (!empty($voterid['voterid']['name']))
                            {{ $voterid['voterid']['name'] }}
                        @else
                        null
                        @endif
                    </p>
                    <p><strong>Voter Id:&nbsp;&nbsp;</strong>
                        @if (!empty($voterid['voterid']['voter_id_number']))
                            {{ $voterid['voterid']['voter_id_number'] }}
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
</div>
@endif