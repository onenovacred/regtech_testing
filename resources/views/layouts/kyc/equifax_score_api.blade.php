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

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Score API</h3>
                </div>
                <div class="card-body">
                    @if (isset($statusCode) && $statusCode == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == 102)
                        <div class="alert alert-danger" role="alert">
                            Consumer not found in bureau.
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == 422)
                        <div class="alert alert-danger" role="alert">
                            Verification Failed. Please enter correct PAN Number.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('other.equifax_score') }}"
                                id="formSubmitted">
                                {{ csrf_field() }}
                                @if (
                                    (isset($scoreRequest[1]) && $scoreRequest[1] == 'FirstName') ||
                                        (isset($scoreRequest[2]) && $scoreRequest[2] == 'LastName') ||
                                        (isset($scoreRequest[3]) && $scoreRequest[3] == 'DOB') ||
                                        (isset($scoreRequest[4]) && $scoreRequest[4] == 'MobileNumber') ||
                                        (isset($scoreRequest[5]) && $scoreRequest[5] == 'PanNumber'))
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="fname"
                                            placeholder="Enter First Name" value="" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="lname"
                                            placeholder="Enter Last Name" value="" required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                            placeholder="Enter phone number" value="" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="DOB"
                                            value="" placeholder="YYYY-MM-DD" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i> Check
                                                All
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pan_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="PanNumber" id="pan_num"
                                            placeholder="Enter pan card number" value="" required>
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                @elseif(isset($scoreRequest[1]) && $scoreRequest[1] == 'FirstName' && empty($scoreRequest[2]))
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="fname"
                                            placeholder="Enter First Name" value="" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="lname"
                                            placeholder="Enter Last Name" value="" required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                            placeholder="Enter phone number" value="" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="DOB"
                                            value="" placeholder="YYYY-MM-DD" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i> Check
                                                All
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pan_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="PanNumber" id="pan_num"
                                            placeholder="Enter pan card number" value="" required>
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                @elseif(isset($scoreRequest[1]) && $scoreRequest[1] == 'LastName' && empty($scoreRequest[2]))
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="fname"
                                            placeholder="Enter First Name" value="" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="lname"
                                            placeholder="Enter Last Name" value="" required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                            placeholder="Enter phone number" value="" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="DOB"
                                            value="" placeholder="YYYY-MM-DD" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i> Check
                                                All
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pan_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="PanNumber" id="pan_num"
                                            placeholder="Enter pan card number" value="" required>
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                @elseif(isset($scoreRequest[1]) && $scoreRequest[1] == 'DOB' && empty($scoreRequest[2]))
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="fname"
                                            placeholder="Enter First Name" value="" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="lname"
                                            placeholder="Enter Last Name" value="" required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                            placeholder="Enter phone number" value="" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="DOB"
                                            value="" placeholder="YYYY-MM-DD" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i> Check
                                                All
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pan_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="PanNumber" id="pan_num"
                                            placeholder="Enter pan card number" value="" required>
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                @elseif(isset($scoreRequest[1]) && $scoreRequest[1] == 'MobileNumber' && empty($scoreRequest[2]))
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="fname"
                                            placeholder="Enter First Name" value="" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="lname"
                                            placeholder="Enter Last Name" value="" required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                            placeholder="Enter phone number" value="" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="DOB"
                                            value="" placeholder="YYYY-MM-DD" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i> Check
                                                All
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pan_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="PanNumber" id="pan_num"
                                            placeholder="Enter pan card number" value="" required>
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                @elseif(isset($scoreRequest[1]) && $scoreRequest[1] == 'PanNumber' && empty($scoreRequest[2]))
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="fname"
                                            placeholder="Enter First Name" value="" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="lname"
                                            placeholder="Enter Last Name" value="" required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                            placeholder="Enter phone number" value="" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="DOB"
                                            value="" placeholder="YYYY-MM-DD" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i> Check
                                                All
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pan_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="PanNumber" id="pan_num"
                                            placeholder="Enter pan card number" value="" required>
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="fname"
                                            placeholder="Enter First Name" value="" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="lname"
                                            placeholder="Enter Last Name" value="" required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber" id="phone_number"
                                            placeholder="Enter phone number" value="" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="DOB"
                                            value="" placeholder="YYYY-MM-DD" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i> Check
                                                All
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="pan_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="PanNumber" id="pan_num"
                                            placeholder="Enter pan card number" value="" required>
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- The rest of your view content -->
            @if (isset($equifax_score) && $equifax_score['statusCode'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Score Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><b>Full Name</b> : {{ $first_name . ' ' . $last_name }}</p>
                                    <p><b>PAN no</b> : {{ $pan_no }}</p>
                                    <p><b>Score value</b> : {{ $equifax_score['ScoreValue '] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- The rest of your view content -->
            @if (isset($equifax_score_response) && isset($statusCode) && $statusCode == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Score Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (!empty($equifax_score_response['full_name']))
                                        <p><b>Full Name</b> : {{ $equifax_score_response['full_name'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($equifax_score_response['pan_no']))
                                        <p><b>PAN NO</b> : {{ $equifax_score_response['pan_no'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($equifax_score_response['success']))
                                        <p><b>Success</b> : {{ $equifax_score_response['success'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($equifax_score_response['ScoreValue']))
                                        <p><b>Score Value</b> : {{ $equifax_score_response['ScoreValue'] }}</p>
                                    @else
                                    @endif
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
