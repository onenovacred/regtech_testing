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
                <h3 class="card-title">ITR Download</h3>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class = "alert alert-danger" role = "alert">
                        No ITR found for given PAN
                    </div>
                @endif
                @if($statusCode == '404')
                    <div class = "alert alert-danger" role = "alert">
                        Client Not Found.
                    </div>
                @endif
                
                <form role="form" method="post" action="{{route('itr.itr_download')}}">
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

        @if(!empty($itr_download) && $itr_download['status_code'] == 200)
        <div class="col-md-6 offset-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">ITR Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div>
                            <p>Client ID: {{ $itr_download['data']['client_id'] }}</p>
                            <p>PAN no: {{ $itr_download['data']['filed_itrs'][0]['pan_no'] }}</p>
                            <p>ITR ID: {{ $itr_download['data']['filed_itrs'][0]['itr_id'] }}</p>
                            <p>Filing Year: {{ $itr_download['data']['filed_itrs'][0]['filing_year'] }}</p>
                            <p>Acknowledgement No: {{ $itr_download['data']['filed_itrs'][0]['acknowledgement_no'] }}</p>
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