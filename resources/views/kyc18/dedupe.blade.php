@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Depue</h3>
                    <a class="float-right btn btn-secondary" href="{{route('kyc.dedupe_api')}}">
                        Dedupe Api
                   </a>
                </div>
                <div class="card-body">
                  @if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 102)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div>
                       
                  @endif
                    @if (isset($dedupe_details['statusCode']) &&  $dedupe_details['statusCode']==103)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div> 
                    @endif
                    @if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==500)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div> 
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.dedupe') }}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Bucket Name</label>
                                    <input type="text" class="form-control" id="bucket_name" name="bucket_name"
                                      placeholder="Enter a bucket name" required />
                                      <label for="name">Prefix</label>
                                    <input type="text" class="form-control" id="prefix" name="prefix"
                                      placeholder="Enter a prefix" required />
                                      <label for="name">Aws Access Key Id</label>
                                    <input type="text" class="form-control" id="aws_access_key_id" name="aws_access_key_id"
                                      placeholder="Enter a aws_access_key_id" required />
                                      <label for="name">Aws Secret Access Key</label>
                                    <input type="text" class="form-control" id="aws_secret_access_key" name="aws_secret_access_key"
                                      placeholder="Enter a aws access key id" required />
                                      <label for="name">Region Name</label>
                                    <input type="text" class="form-control" id="region_name" name="region_name"
                                      placeholder="Enter a region name" required />
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] ==200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Dedupe Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                     <p><strong>Delete Files:&nbsp;&nbsp;</strong>
                                        @if(isset($dedupe_details['data']['deleted_files']))
                                          @foreach($dedupe_details['data']['deleted_files'] as $files) 
                                           <p>{{$files}}</p>
                                           @endforeach
                                         @else 
                                          "null"
                                         @endif         
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
