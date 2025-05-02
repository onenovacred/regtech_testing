@extends('adminlte::page')
@section('title', 'Equifax | Score')

@section('content_header')

@stop
<link href="https://codeseven.github.io/toastr/build/toastr.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
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

    .validation-message {
        color: red;
        font-weight: 500;
        font-size: 15px;
        margin-bottom: 5px;
    }
</style>
@section('content')
    @if (session('score_api_message'))
        @php
            $messageData = json_decode(session('score_api_message'), true);
        @endphp
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>StatusCode : {{ $messageData['statusCode'] }}</strong> &nbsp;&nbsp;<strong>Message :
                {{ $messageData['message'] }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Score API</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('equifax_score_submit') }}"
                                id="formSubmitted">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" name="FirstName" id="fname"
                                        placeholder="Enter First Name" value="" autofocus>
                                    @error('FirstName')
                                        <span class="text-danger validation-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" name="LastName" id="lname"
                                        placeholder="Enter Last Name" value="">
                                    @error('LastName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Phone Number</label>
                                    <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                        placeholder="Enter phone number" value="">
                                    @error('MobileNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="dob" name="DOB" value=""
                                        placeholder="YYYY-MM-DD">
                                    @error('DOB')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for=""><strong>Select ID Type</strong></label>
                                    </div>
                                    <select name="id_type[]" id="id_type" class="form-control selectpicker multiselect"
                                        data-live-search="true" data-actions-box="true" multiple>
                                        <option value="" selected>Select ID Type</option>
                                    </select>
                                </div>
                                <div class="row checkAllCheckBox" style="display: none">
                                    <div class="col-md-3">
                                        <label class="ui-check m-a-0">
                                            <input id="checkAllRadius" type="checkbox" class=""><i></i> Check All
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="pan_no">
                                    <label for="name">PAN Card Number</label>
                                    <input type="text" class="form-control" name="IdValue" id="pan_num"
                                        placeholder="Enter pan card number" value="">
                                    @error('IdValue')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" id="submitForm" class="btn btn-success offset-md-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The rest of your view content -->
            @if (session('score_api_success_message'))
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Score Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                  @php
                                     $messageData = json_decode(session('score_api_success_message'), true);
                                  @endphp
                                <div>
                                    <p><b>Full Name</b> : {{ $messageData['full_name'] }}</p>
                                    <p><b>PAN no</b> : {{ $messageData['pan_no'] }}</p>
                                    <p><b>Score value</b> : {{ $messageData['score_value'] }}</p>
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
        $(document).ready(function() {

            $('.selectpicker').selectpicker();
            $('#pan_no').hide();
            $('#id_type').change(function() {
                var data = $(this).val();
                $('#pan_no').hide();
                for (var i = 0; i <= data.length; i++) {
                    if (data[i] == 'T') {
                        $('#pan_no').show();
                    }
                }
            });
            $.ajax({
                Type: 'GET',
                url: '{!! route('other.equifax_score_idtypes') !!}',
                datatype: 'json',
                success: function(data) {
                    $('#id_type').empty();
                    jQuery.noConflict();
                    jQuery('#id_type').selectpicker('refresh');
                    for (var i = 0; i < data.length; i++) {
                        $('#id_type').append("<option value='" + data[i]['value'] + "'>" + data[i][
                            'name'
                        ] + "</option>");
                    }
                    jQuery('#id_type').selectpicker('refresh');
                },
                error: function(error) {

                }
            })

        });
    </script>
@stop
