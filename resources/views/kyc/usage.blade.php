@extends('adminlte::page')

@section('title', 'Pull Kra')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Usage</h3>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        PAN or DOB is Invalid 
                  </div>
                @endif
                @if($statusCode == '401' || $statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.usage')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Email Number</label>
                                <input type="text" class="form-control" 
                                    
                                    id="recipient_email" name="recipient_email" value="{{old('recipient_email')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Start Date</label>
                                <input type="text" class="form-control"  
                                    id="start_date" name="start_date" value="{{old('start_date')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">End Date</label>
                                <input type="text" class="form-control"  
                                    id="end_date" name="end_date" value="{{old('end_date')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">type</label>
                                <select  class="form-control"  id="type" name="type"  required>
                                    <option value="pan" > PAN</option>
                                   
                                 </select>

                                </div>



                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pull_kra) && $pull_kra['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Usage Details</h3>
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