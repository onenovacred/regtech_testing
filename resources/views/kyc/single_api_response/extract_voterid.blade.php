
@if (isset($extract_voterid['status_code']) && $extract_voterid['status_code']==200)
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
                        @if (!empty($extract_voterid['voterid']['detected_text']))
                            {{ $extract_voterid['voterid']['detected_text'] }}
                        @else
                            null
                        @endif
                    </p>
                    <p><strong>Name:&nbsp;&nbsp;</strong>
                        @if (!empty($extract_voterid['voterid']['extracted_info']['name']))
                            {{ $extract_voterid['voterid']['extracted_info']['name'] }}
                        @else
                        null
                        @endif
                    </p>
                    <p><strong>Voter Id:&nbsp;&nbsp;</strong>
                        @if (!empty($extract_voterid['voterid']['extracted_info']['voter_id']))
                            {{ $extract_voterid['voterid']['extracted_info']['voter_id'] }}
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