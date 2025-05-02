@extends('adminlte::page')

@section('title', 'Voter ID Verification')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Voter ID Verification</h3>
                <a href = "{{ route('kyc.voter_api') }}" role = "button" 
                class = "btn btn-light float-right">Voter ID APIs</a>
            </div>
            <div class="card-body">
                @if(isset($voter_validation[0]['statusCode']) && $voter_validation[0]['statusCode'] == '400')
                    <div class="alert alert-danger" role="alert">
                        Voter ID is Invalid 
                  </div>
                @endif
                @if(isset($voter_validation[0]['statusCode']) && ($voter_validation[0]['statusCode'] == '404'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($voter_validation[0]['statusCode']) && $voter_validation[0]['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.voter_validation')}}">
                            {{csrf_field()}}
                               @if(isset($voterIdRequest[1]) && $voterIdRequest[1]=='voter_number')
                               <div class="form-group">
                                <label for="name">Voter ID Number</label>
                                  <input type="text" class="form-control" 
                                  id="voter_number" name="voter_number" value="{{old('voter_number')}}" 
                                  placeholder="Ex: NLN1234567" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                                @else
                                <div class="form-group">
                                    <label for="name">Voter ID Number</label>
                                <input type="text" class="form-control" 
                                    id="voter_number" name="voter_number" value="{{old('voter_number')}}" 
                                    placeholder="Ex: NLN1234567" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                               @endif
                               
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
        @if(!empty($voter_validation[0]['voter_validation']) && isset($voter_validation[0]['voter_validation']['code']) && $voter_validation[0]['voter_validation']['code'] == 200)
         <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Voter Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                      <p>Voter ID / Epic Number: {{ $voter_validation[0]['voter_validation']['response']['epic_no'] }}</p>
                        <p>Name: {{ $voter_validation[0]['voter_validation']['response']['holder_name'] }}</p>
                        <p>Age: {{ $voter_validation[0]['voter_validation']['response']['age'] }}</p>
                        <p>Gender: @if($voter_validation[0]['voter_validation']['response']['gender'] == 'M') Male @elseif($voter_validation[0]['voter_validation']['response']['gender'] == 'F') Female @else {{$voter_validation[0]['voter_validation']['response']['gender']}} @endif</p>
                        <p>DOB: {{ $voter_validation[0]['voter_validation']['response']['dob'] }}</p>
                        <p>District: {{ $voter_validation[0]['voter_validation']['response']['district'] }}</p>
                        <p>Area: {{ $voter_validation[0]['voter_validation']['response']['area'] }}</p>
                        <p>Relation Type: {{ $voter_validation[0]['voter_validation']['response']['relation_type'] }}</p>
                        <p>Relation Name: {{ $voter_validation[0]['voter_validation']['response']['relation'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
     
        @if(!empty($voter_validation_response['voter_validation']['response']))
      
         <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Voter Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        @if(!empty($voter_validation_response['voter_validation']['response']['epic_no']))
                           <p>Voter ID / Epic Number: {{$voter_validation_response['voter_validation']['response']['epic_no'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['holder_name']))
                           <p>Name: {{ $voter_validation_response['voter_validation']['response']['holder_name'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['age']))
                           <p>Age: {{$voter_validation_response['voter_validation']['response']['age'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['gender']))
                           <p>Gender: @if($voter_validation_response['voter_validation']['response']['gender'] == 'M') Male @elseif($voter_validation_response['voter_validation']['response']['gender'] == 'F') Female @else {{$voter_validation_response['voter_validation']['response']['gender']}} @endif</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['dob']))
                           <p>DOB: {{ $voter_validation_response['voter_validation']['response']['dob'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['district']))
                          <p>District: {{ $voter_validation_response['voter_validation']['response']['district'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['area']))
                           <p>Area: {{$voter_validation_response['voter_validation']['response']['area'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['relation_type']))
                          <p>Relation Type: {{$voter_validation_response['voter_validation']['response']['relation_type'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['relation']))
                           <p>Relation Name: {{ $voter_validation_response['voter_validation']['response']['relation'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['assembly_constituency']))
                          <p>Assembly Constituency : {{$voter_validation_response['voter_validation']['response']['assembly_constituency'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['parliamentary_constituency']))
                          <p>Parliamentry Constituency: {{ $voter_validation_response['voter_validation']['response']['parliamentary_constituency'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['polling_station']))
                          <p>Polling Station: {{ $voter_validation_response['voter_validation']['response']['polling_station'] }}</p>
                        @endif
                        @if(!empty( $voter_validation_response['voter_validation']['response']['part_number']))
                          <p>Part Number: {{ $voter_validation_response['voter_validation']['response']['part_number'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['part_name']))
                          <p>Part Name: {{ $voter_validation_response['voter_validation']['response']['part_name'] }}</p>
                        @endif
                        @if(!empty($voter_validation_response['voter_validation']['response']['id']))
                        <p>Id: {{ $voter_validation_response['voter_validation']['response']['id'] }}</p>
                        @endif
                     </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@stop


@section('custom_js')
@stop