@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">GET Coordinate API</h3>
                </div>
                <div class="card-body">
                    @if (isset($get_coordinate['status_code']) && $get_coordinate['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div>
                       
                  @endif
                    @if (isset($get_coordinate['statusCode']) &&  $get_coordinate['statusCode']==103)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div> 
                    @endif
                    @if (isset($get_coordinate[0]['statusCode']) && $get_coordinate[0]['statusCode']==403)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div> 
                    @endif
                    @if (isset($getcostatusCode) && $getcostatusCode== 500)
                    <div class="alert alert-danger" role="alert">
                           Internal server error Please contact techsupport@docboyz.in for more details.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.getcoordinate') }}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                      placeholder="Enter a address" required />
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($get_coordinate['status_code']) && $get_coordinate['status_code']==200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Coordinate  Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th scope="col" class="text-center">Sr No</th>
                                                <th scope="col" class="text-center">Address</th>
                                                <th scope="col" class="text-center">Longitude</th>
                                                <th scope="col" class="text-center">Latitude</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                             @if(!empty($get_coordinate['data']))
                                                @foreach ($get_coordinate['data'] as $key => $item)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$item['label']}}</td>
                                                    @foreach ($item['point'] as $key1=>$coordinate )
                                                        <td>{{$coordinate}}</td>
                                                    @endforeach
                                                </tr>  
                                                @endforeach
                                               @else
                                                <tr>
                                                    <td colspan="2" class="text-center">No Coordinate</td>
                                                </tr>
                                              @endif
                                            </tbody>
                                        </table>
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
