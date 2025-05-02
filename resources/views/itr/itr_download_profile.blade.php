@extends('adminlte::page')

@section('title', 'ITR')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ITR Profile</h3>
            </div>
            <div class="card-body">
                @if($statusCode == '404')
                        <div class = "alert alert-danger" role = "alert">
                            <p>Internal Server Error, please try again.</p>
                        </div>
                @endif
                    
                <form role="form" method="post" action="{{route('itr.itr_download_profile')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Client ID</label>
                        <input type="text" class="form-control" 
                        id="client_id" name="client_id" value="{{old('client_id')}}" 
                        placeholder="Ex: itr_glvFpjIAxwsdscTEHYy" required>
                    </div>
                    <button type="submit" class="btn btn-success">GET Details</button>
                </form>
            </div>
            </div>
        </div>

        @if(!empty($itr_download_profile) && $itr_download_profile['status_code'] == 200)
        <div class="col-md-6 offset-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">ITR Profile Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h3>Profile Details</h3>
                                <h4>PAN Details:-</h4>
                                <p><strong>PAN No:</strong> {{ $itr_download_profile['data']['profile_details']['pan']['pan'] }}</p>
                                <p><strong>PAN Holder Name:</strong> {{ $itr_download_profile['data']['profile_details']['pan']['name'] }}</p>
                                <p><strong>DOB:</strong> {{ $itr_download_profile['data']['profile_details']['pan']['dob'] }}</p>
                                <p><strong>Gender:</strong> {{ $itr_download_profile['data']['profile_details']['pan']['gender'] }}</p>
                                <p><strong>Category:</strong> {{ $itr_download_profile['data']['profile_details']['pan']['category'] }}</p>
                                <p><strong>Address:</strong> {{ $itr_download_profile['data']['profile_details']['pan']['address'] }}</p>
                                <p><strong>Indian Citizen (Yes/No):</strong> {{ $itr_download_profile['data']['profile_details']['pan']['indian_citizen'] }}</p>
                                <p><strong>Status:</strong> {{ $itr_download_profile['data']['profile_details']['pan']['status'] }}</p>
                                

                                <h4>Jurisdiction Details:-</h4>
                                <p><strong>Area Code: </strong> {{ $itr_download_profile['data']['profile_details']['jurisdiction']['area_code'] }}</p>
                                <p><strong>AO Type: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['jurisdiction']['ao_type'] }}</p>
                                <p><strong>Range Code: </strong> {{ $itr_download_profile['data']['profile_details']['jurisdiction']['range_code'] }}</p>
                                <p><strong>AO Number: </strong> {{ $itr_download_profile['data']['profile_details']['jurisdiction']['ao_number'] }}</p>
                                <p><strong>Jurisdiction: </strong> {{ $itr_download_profile['data']['profile_details']['jurisdiction']['jurisdiction'] }}</p>
                                <p><strong>Building Name: </strong> {{ $itr_download_profile['data']['profile_details']['jurisdiction']['building_name'] }}</p>
                                <p><strong>Email ID: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['jurisdiction']['email_id'] }}</p>
                                
                                <h4>Address Details:-</h4>
                                <p><strong>Country: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['country'] }}</p>
                                <p><strong>Door Number: </strong> {{ $itr_download_profile['data']['profile_details']['address']['door_number'] }}</p>
                                <p><strong>Street: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['street'] }}</p>
                                <p><strong>Pin Code: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['pin_code'] }}</p>
                                <p><strong>Zip Code: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['zip_code'] }}</p>
                                <p><strong>Locality: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['locality'] }}</p>
                                <p><strong>Post Office: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['post_office'] }}</p>
                                <p><strong>City: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['city'] }}</p>
                                <p><strong>State: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['address']['state'] }}</p>

                                <h4>Contact Details:-</h4>
                                <p><strong>Resident: </strong> {{
                                $itr_download_profile['data']['profile_details']['contact']['resident'] }}</p>
                                <p><strong>Non-Resident: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['non_resident'] }}</p>
                                <p><strong>Primary Mobile: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['primary_mobile'] }}</p>
                                <p><strong>Primary Mobile Belongs to: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['primary_mobile_belongs_to'] }}</p>
                                <p><strong>Primary Email: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['primary_email'] }}</p>
                                <p><strong>Primary Email Belongs to: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['primary_email_belongs_to'] }}</p>
                                <p><strong>Secondary Mobile: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['secondary_mobile'] }}</p>
                                <p><strong>Secondary Mobile belongs to: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['secondary_mobile_belongs_to'] }}</p>
                                <p><strong>Secondary Email: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['secondary_email'] }}</p>
                                <p><strong>Secondary Email belongs to: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['contact']['secondary_email_belongs_to'] }}</p>

                                <h4>Aadhaar Details:-</h4>
                                <p><strong>Aadhaar Number: </strong> {{
                                $itr_download_profile['data']['profile_details']['aadhaar']['aadhaar_number'] }}</p>
                                <p><strong>Aadhaar Status: </strong> {{ 
                                $itr_download_profile['data']['profile_details']['aadhaar']['aadhaar_status'] }}</p>
                                

                                <p><strong>Status Code: </strong>{{
                                $itr_download_profile['status_code']}}</p>
                                <p><strong>Status: </strong>{{
                                $itr_download_profile['success']}}</p>
                                <p><strong>Message: </strong>{{
                                $itr_download_profile['message']}}</p>
                                <p><strong>Message Code: </strong>{{
                                $itr_download_profile['message_code']}}</p>
    

                            </div>
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