                    @if (isset($extract_voterid['status_code']) && $extract_voterid['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file only upload VoterId image.
                        </div>
                    @endif
                    @if (isset($extract_voterid['status_code']) && $extract_voterid['status_code'] ==404)
                        <div class="alert alert-danger" role="alert">
                            No Image file provided.
                        </div> 
                    @endif
                    @if (isset($extract_voterid['status_code']) && $extract_voterid['status_code']== 500)
                    <div class="alert alert-danger" role="alert">
                           Internal server error Please contact techsupport@docboyz.in for more details.
                    </div>
                    @endif
                    @if (isset($extract_voterid['statusCode']) && $extract_voterid['statusCode']== 103)
                    <div class="alert alert-danger" role="alert">
                           You are not registered to use this service. Please update your plan.
                    </div>
                    @endif