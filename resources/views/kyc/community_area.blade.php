@extends('adminlte::page')

@section('title', 'Regtechapi - Community Area Details')

@section('content_header')
<style>
		
    table{
        width:100%;
    }

    .data-title{
        background-color:#8B0000;
        color:#FFFFFF;
        height:20px;
        table-layout: fixed;
        -webkit-font-smoothing: antialiased;	
    }

    .company-data{
        background-color:grey;
        color:black;
        height:10px;
        table-layout: fixed;
        -webkit-font-smoothing: antialiased;
    }

</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Community Area</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.community_area_api') }}">Community Area</a>
            </div>
            <div class="card-body">
                @if(isset($community_details['statusCode']) && $community_details['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        Please enter valid details
                    </div>
                @endif
                @if(isset($community_details['statusCode']) && $community_details['statusCode']==202)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($community_details['statusCode']) && $community_details['statusCode'] == 500)
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                @if(isset($community_details['statusCode']) && $community_details['statusCode'] == 103)
                <div class="alert alert-danger" role="alert">
                    You are not registered to use this service. Please update your plan.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.community_area')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Longitude</label>
                                <input type="text" class="form-control" 
                                id="latitude" name="latitude" value="" 
                                placeholder="Enter Latitude" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Latitude</label>
                                <input type="text" class="form-control" 
                                id="longitude" name="longitude" value="" 
                                placeholder="Enter Longitude" required>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form><br>
                    </div>
                </div>
            </div>
        </div>
       @if(!empty($community_details['statusCode']) && $community_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Community Area Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Title:</strong>{{ isset($community_details['data']['page']) ? $community_details['data']['page'] : 'null' }}
                        </p>
                        <p><strong>Temple Count:</strong>{{ isset($community_details['data']['temple_count']) ?$community_details['data']['temple_count'] : 'null' }}
                        </p>
                        <p><strong>Church Count:</strong>{{ isset($community_details['data']['church_count']) ? $community_details['data']['church_count'] : 'null' }}
                        </p>
                        <p><strong>Mosque Count:</strong>{{ isset($community_details['data']['mosque_count']) ?$community_details['data']['mosque_count']: 'null' }}
                        </p>
                        <p><strong>Gurudwara Count:</strong>{{ isset($community_details['data']['gurudwara_count']) ?$community_details['data']['gurudwara_count']: 'null' }}
                        </p>
                        <p><strong>Timestamp:</strong>{{ isset($community_details['data']['Timestamp']) ? \Carbon\Carbon::createFromTimestamp($community_details['data']['Timestamp'])->format('Y-m-d') : 'null' }}
                        </p>
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