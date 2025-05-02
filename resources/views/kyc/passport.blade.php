@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Passport Create Client</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Create Passport Client</label>
                        </div>
                        <button id="btnGetClientId" type="button" class="btn btn-success">Create</button>
                    </div>
                </div>
                <br>
                <div class="row">
                <div class="col-md-12">
                <div id="divClientId">
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Passport Upload</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <!-- <form role="form" method="post" action="{{route('kyc.passport_upload')}}" enctype="multipart/form-data"> -->
                                <div class="form-group">
                                    <label for="name">Client ID</label>
                                <input type="text" class="form-control" id="client_id" name="client_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Passport File</label>
                                <input type="file" class="form-control" id="file" name="file"  required>
                                </div>
                                <button id="btnPassportUpload" type="button" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('custom_js')
<script type="text/javascript">
    $(document).ready(function() {
        var hit_limits_exceeded=0;

        $("#btnGetClientId").click(function() {
            var getClientId = new Object;
            getClientId._token = "{{csrf_token()}}";

            var myJSON = JSON.stringify(getClientId);

            var routeURL = "";
            routeURL = "{{ URL('/kyc/passport_create_client_ajax') }}";
            
            $.ajax({
                url: routeURL,
                type: "post",
                data: myJSON,
                dataType: "json",
                contentType: "application/json",
                processData: false,
                success: function(response) {
                    hit_limits_exceeded = response[0].hit_limits_exceeded;
                    if(response[0].hit_limits_exceeded==0)
                    {
                        var text = '<p>Passport Client ID:<input readonly type="text" class="form-control" value="'+response[0].passport.data.client_id+'" /></p>';
                        $("#divClientId").empty().append(text);
                    }
                    else
                    {
                        var text = '<p>Hit Limit Exceeded</p>';
                        $("#divClientId").empty().append(text);
                    }
                }
            });
            return false;
        });

        $("#btnPassportUpload").click(function() {
            var fd = new FormData();

            var file_data = $('#file')[0].files;
            // alert(file_data);
            var client_id = $('#client_id').val();
            var token = "{{csrf_token()}}";
            // var other_data = $('form').serialize(); //page_id=&category_id=15&method=upload&required%5Bcategory_id%5D=Category+ID

            fd.append("file", file_data);
            fd.append("client_id", client_id);
            fd.append("_token", token);

            var routeURL = "";
            routeURL = "{{ URL('/kyc/passport_upload_ajax') }}";
            
            $.ajax({
                url: routeURL,
                type: "post",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response[0].passport.data.given_name);
                    // hit_limits_exceeded = response[0].hit_limits_exceeded;
                    // if(response[0].hit_limits_exceeded==0)
                    // {
                    //     var text = '<p>Passport Client ID:<input readonly type="text" class="form-control" value="'+response[0].passport.data.client_id+'" /></p>';
                    //     $("#divClientId").empty().append(text);
                    // }
                    // else
                    // {
                    //     var text = '<p>Hit Limit Exceeded</p>';
                    //     $("#divClientId").empty().append(text);
                    // }
                }
            });
            return false;
        });
    });
</script>
@stop