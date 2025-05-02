@extends('adminlte::page')

@section('title', 'Fast Tag')

@section('content_header')
    <style>
        table{
            width:100%;
        }
    
        .data-title{
            background-color:grey;
            color:black;
            height:20px;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;	
        }
    
    </style>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">Fast Tag Information</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.rc_api') }}">Fast Tag APIs</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.rc_validation')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Vehicle Number</label>
                                <input type="text" class="form-control"
                                    id="rc_number" name="rc_number" value="{{old('rc_number')}}" 
                                    placeholder="Ex: MH12PQ1234" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop


@section('custom_js')
@stop