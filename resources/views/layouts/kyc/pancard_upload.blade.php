@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Upload</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.pancard_api') }}">Pan Card APIs</a>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        PAN is Invalid 
                  </div>
                @endif
                @if($statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.pancard.upload')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                <input type="file" class="form-control" name="file"  required>
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pancard) && $pancard[0]['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>PAN Number: {{ $pancard[0]['pancard']['pan_number'] }}</p>
                        <p>DOB: {{ $pancard[0]['pancard']['pan_dob'] }}</p>
                        <p>Father Name: {{ $pancard[0]['pancard']['pan_fname'] }}</p>
                        <p>Full Name: {{ $pancard[0]['pancard']['pan_name'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($pancard2!=null && $pan_verified==1)
            <div class = "card card-success">
                <div class = "card-header">
                    <h3 class = "card-title">PAN CARD Detailed Information</h3>
                </div>
                <div class = "card-body">
                    <div class="row">
                        <div class="col-md-12">
                          <div>
                            <p>Pan Verified: {{ ($pan_verified==1)? 'Verified' : 'Failed' }}</p>
                            <p>Full Name: {{ $pancard2[0]['pancard']['fullname'] }}</p>
                            <p>PAN no: {{ $pancard2[0]['pancard']['pancard'] }}</p>
                            <p>PAN Verification: {{ $pancard2[0]['statusCode'] }}</p>
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