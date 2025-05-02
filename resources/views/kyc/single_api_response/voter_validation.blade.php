@if (!empty($voter_validation[0]['voter_validation']) &&
                        isset($voter_validation[0]['voter_validation']['code']) &&
                        $voter_validation[0]['voter_validation']['code'] == 200)
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
                                        <p>Voter ID / Epic Number:
                                            {{ $voter_validation[0]['voter_validation']['response']['epic_no'] }}</p>
                                        <p>Name: {{ $voter_validation[0]['voter_validation']['response']['holder_name'] }}
                                        </p>
                                        <p>Age: {{ $voter_validation[0]['voter_validation']['response']['age'] }}</p>
                                        <p>Gender: @if ($voter_validation[0]['voter_validation']['response']['gender'] == 'M')
                                                Male
                                            @elseif($voter_validation[0]['voter_validation']['response']['gender'] == 'F')
                                                Female
                                            @else
                                                {{ $voter_validation[0]['voter_validation']['response']['gender'] }}
                                            @endif
                                        </p>
                                        <p>DOB: {{ $voter_validation[0]['voter_validation']['response']['dob'] }}</p>
                                        <p>District: {{ $voter_validation[0]['voter_validation']['response']['district'] }}
                                        </p>
                                        <p>Area: {{ $voter_validation[0]['voter_validation']['response']['area'] }}</p>
                                        <p>Relation Type:
                                            {{ $voter_validation[0]['voter_validation']['response']['relation_type'] }}</p>
                                        <p>Relation Name:
                                            {{ $voter_validation[0]['voter_validation']['response']['relation'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                @endif