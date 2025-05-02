@extends('adminlte::page')

@section('title', 'Passport')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Passport </h3>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        Passport 
                  </div>
                @endif
                @if($statusCode == '401' || $statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.pull_kra')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Passport Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="pan_number" name="pan_number" value="{{old('pan_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <form action="/action_page.php">
                                    <label for="img">Select Passport image:</label>
                                    <input type="file" id="img" name="img" accept="image/*"> <br><br>
                                   
                                  </form> <br>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pull_kra) && $pull_kra['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Passport Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Pan No: {{ $pull_kra['data']['pan_number'] }}</p>
                        <p>KRA Authority: {{ $pull_kra['data']['kra_authority'] }}</p>
                        <p>KRA Status: {{ $pull_kra['data']['document_link'] }}</p>
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