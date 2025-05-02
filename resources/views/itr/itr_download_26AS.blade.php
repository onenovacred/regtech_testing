@extends('adminlte::page')

@section('title', 'ITR Download 26AS')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ITR Download 26AS</h3>
            </div>
                <div class="card-body">
                    @if($statusCode == '404')
                        <div class = "alert alert-danger" role = "alert">
                            <p>Internal Server Error, please try again.</p>
                        </div>
                    @endif
                    <form role="form" method="post" action="{{route('itr.itr_download_26AS')}}">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Client ID</label>
                            <input type="text" class="form-control" 
                                id="client_id" name="client_id" value="{{old('client_id')}}" 
                                placeholder="Enter Client ID" required>
                            </div>
                            <button type="submit" class="btn btn-success">Get Details</button>
                    </form>
                </div>
            </div>
        </div>

        @if(!empty($itr_download_26AS) && $itr_download_26AS['status_code'] == 200)
        <div class="col-md-6 offset-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">ITR Client Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <p><strong>Client ID:</strong> {{ $itr_download_26AS['data']['client_id'] }}</p>
                                <p><strong>Pan no:</strong> {{ $itr_download_26AS['data']['pan_no'] }}</p>
                                
                                <p><strong>TDS Details:</strong></p> 
                                @foreach($itr_download_26AS['data']['tds'] as $tdskey => $tdsvalue)
                                    <p>TDS ID: {{ $tdsvalue['tds_id'] }}</p>
                                    <p>Assessment Year: {{ $tdsvalue['assessment_year'] }}</p>                             
                                @endforeach

                                <p><strong>Status Code:</strong> {{
                                $itr_download_26AS['status_code']}}</p>
                                <p><strong>Status:</strong> {{
                                $itr_download_26AS['success']}}</p>
                                <p><strong>Message:</strong> {{
                                $itr_download_26AS['message']}}</p>
                                <p><strong>Message Code:</strong> {{
                                $itr_download_26AS['message_code']}}</p>
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