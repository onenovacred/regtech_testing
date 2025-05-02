@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css"/>
    <style type="text/css">
         .bootstrap-select.btn-group .dropdown-menu li a {
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .dropdown-menu>.active>a,
        .dropdown-menu>.active>a:hover,
        .dropdown-menu>.active>a:focus {
            color: #fff;
            text-decoration: none;
            background-color: #428bca;
            outline: 0;
        }

        .dropdown-menu>li>a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .multiselect,
        .bs-select-all,
        .bs-deselect-all {
            border: 1px solid #ced4da !important;
        }

    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Auto Complete API</h3>
                </div>
                <div class="card-body">
                    @if (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div>
                       
                    @endif
                    @if (isset($auto_complate['statusCode']) &&  $auto_complate['statusCode']==103)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div> 
                    @endif
                    @if (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==403)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div> 
                    @endif
                    @if (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==404)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div> 
                    @endif
                    @if (isset($autostatusCode) && $autostatusCode== 500)
                    <div class="alert alert-danger" role="alert">
                           Internal server error Please contact techsupport@docboyz.in for more details.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.autocomplete') }}" >
                                {{ csrf_field() }}
                                 <div class="form-group">
                                    <label for="name">Text</label>
                                    <input type="text" class="form-control" id="text" name="text"
                                      placeholder="Enter a text" required />
                                      <label for="name">Max Result</label>
                                      <input type="number" class="form-control" id="max_result" name="max_result"
                                      placeholder="Enter a max result" required min='1'/>
                                      <select  name="address_show" id="address_show" class="form-control selectpicker multiselect mt-1" data-live-search="true"
                                      data-actions-box="true">
                                      </select>
                                      <span class="text-danger" id="error_message"></span>
                                  </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Auto Complete  Details</h3>
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
                                              </tr>
                                            </thead>
                                            <tbody>
                                             @if(!empty($auto_complate['data']))
                                                @foreach ($auto_complate['data'] as $key => $item)
                                                <tr>
                                                    <td>{{$item['sn']}}</td>
                                                    <td>{{$item['address']}}</td>
                                                </tr>  
                                                @endforeach
                                               @else
                                                <tr>
                                                    <td colspan="2" class="text-center">No Address</td>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            $('#max_result,#text').keyup(function() {
            $('#error_message').text(" ");
            var max_result = $('#max_result').val().trim();
            var text = $('#text').val().trim();
          if (max_result !== '' &&  text !== '') {
            $.ajax({
                url:'{{url("kyc/autopopulate")}}',
                type: 'GET',
                data:{
                    "max_result":max_result,
                    "text":text
                },
                dataType: 'json',
                success: function(data) {
                   $('#address_show').empty();
                  if(data.data != undefined && data.data.status_code == 200){
                    data.data.data.forEach(function(item, index) {
                        $('#address_show').append('<option value="'+item.address+'">'+item.address+'</option>');
                     });
                     $('#address_show').selectpicker('refresh');
                   }
                  else if(data.data[0] != undefined && data.data[0].statusCode ==404){
                    $('#error_message').text(data.data[0].message);
                    $('#address_show').selectpicker('refresh');
                  }
                  else if(data.data != undefined && data.data.status_code ==102){
                   
                    $('#error_message').text(data.data.message);
                    $('#address_show').selectpicker('refresh');
                  }
                  else if(data.data.statusCode ==103){
                   
                    $('#error_message').text(data.data.message);
                    $('#address_show').selectpicker('refresh');
                  }
                  else if(data.data != undefined && data.data ==500 ){
                  
                    $('#error_message').text(data.message);
                    $('#address_show').selectpicker('refresh');
                  }
                  else{
                    $('#error_message').text("NOT Found");
                    $('#address_show').selectpicker('refresh');
                  }
                  
                }, error: function(xhr, status, error) {
                   console.log(xhr.responseText); 
               }
            });
          }
         });
         })
    </script>
@stop
