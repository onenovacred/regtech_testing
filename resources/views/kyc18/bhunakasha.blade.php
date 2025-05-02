@extends('adminlte::page')

@section('title', 'RegtechAPI')

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
                <h3 class="card-title">Bhunakasha</h3>
                <a  role = "button" class = "btn btn-light float-right" 
                  href="{{ route('kyc.bhunakasha.api')}}">
                     Bhunakasha API
                </a>
            </div>
            <div class="card-body">
                @if(!empty($statusCode) &&  $statusCode== 202)
                  <div class="alert alert-danger" role="alert">
                       {{$error_message}}
                  </div>
                @endif
                @if(!empty($statusCode) &&  $statusCode== 103)
                <div class="alert alert-danger" role="alert">
                     {{$error_message}}
                 </div>
              @endif
                @if(!empty($statusCode) &&  $statusCode== 500)
                  <div class="alert alert-danger" role="alert">
                       {{$error_message}}
                   </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.bhunakasha')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for=""><strong>State Name</strong></label>
                                </div>
                                <select name="states" id="states_select_form"
                                    class="form-control selectpicker multiselect" data-live-search="true"
                                    data-actions-box="true">
                                    <option value="">Select State</option>
                                    <option value="bihar">Bihar</option>
                                    <option value="jharkhand">Jharkhand</option>
                                    <option value="up">Uttar Pradesh</option>
                                    <option value="chhattisgarh">Chhattisgarh</option>
                                    <option value="rajasthan">Rajasthan</option>
                                    <option value="lakshadweep">Lakshadweep</option>
                                    <option value="kerala">Kerala</option>
                                    <option value="goa">Goa</option>
                                    <option value="odisha">Odisha</option>
                                </select>
                            </div>
                            <div class="form-group" id="bihar_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="br_district" id="br_district" placeholder="Enter District" value="">
                                <label for="name">Subdiv</label>
                                <input type="text" class="form-control" name="br_subdiv" id="br_subdiv" placeholder="Enter Subdiv" value="">
                                <label for="name">Circle</label>
                                <input type="text" class="form-control" name="br_circle" id="br_circle" placeholder="Enter Circle" value="">
                                <label for="name">Mauza</label>
                                <input type="text" class="form-control" name="br_mauza" id="br_mauza" placeholder="Enter Mauza" value="">
                                <label for="name">SurveyType</label>
                                <input type="text" class="form-control" name="br_surveytype" id="br_surveytype" placeholder="Enter Survey Type" value="">
                                <label for="name">Mapinstance</label>
                                <input type="text" class="form-control" name="br_mapinstance" id="br_mapinstance" placeholder="Enter Mapinstance" value="">
                                <label for="name">Sheet Number</label>
                                <input type="text" class="form-control" name="br_sheet_number" id="br_sheet_number" placeholder="Enter Sheet Number" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="br_plot_number" id="br_plot_number" placeholder="Enter Plot Number" value="">
                            </div>
                            <div class="form-group" id="jharkhand_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="jhar_district" id="jhar_district" placeholder="Enter District" value="">
                                <label for="name">Circle</label>
                                <input type="text" class="form-control" name="jhar_circle" id="jhar_circle" placeholder="Enter Circle" value="">
                                <label for="name">Halka</label>
                                <input type="text" class="form-control" name="jhar_halka" id="jhar_halka" placeholder="Enter Halka" value="">
                                <label for="name">Mauza</label>
                                <input type="text" class="form-control" name="jhar_mauza" id="jhar_mauza" placeholder="Enter Mauza" value="">
                                <label for="name">Sheet Number</label>
                                <input type="text" class="form-control" name="jhar_sheetno" id="jhar_sheetno" placeholder="Enter Sheet Number" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="jhar_ploat_number" id="jhar_ploat_number" placeholder="Enter plot_number" value="">
                            </div>
                            <div class="form-group" id="uttar_pradesh_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="up_district" id="up_district" placeholder="Enter District" value="">
                                <label for="name">Tehsil</label>
                                <input type="text" class="form-control" name="up_tehsil" id="up_tehsil" placeholder="Enter Tehsil" value="">
                                <label for="name">Village</label>
                                <input type="text" class="form-control" name="up_village" id="up_village" placeholder="Enter Village" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="up_plot_number" id="up_plot_number" placeholder="Enter plot_number" value="">
                            </div>
                            <div class="form-group" id="chhattisgarh_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="chha_distract" id="chha_distract" placeholder="Enter District" value="">
                                <label for="name">Tehsil</label>
                                <input type="text" class="form-control" name="chha_tehsil" id="chha_tehsil" placeholder="Enter Tehsil" value="">
                                <label for="name">RI Circle</label>
                                <input type="text" class="form-control" name="chha_ri_circle" id="chha_ri_circle" placeholder="Enter RI Circle" value="">
                                <label for="name">Village</label>
                                <input type="text" class="form-control" name="chha_village" id="chha_village" placeholder="Enter Village" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="chha_plot_number" id="chha_plot_number" placeholder="Enter Plot Number" value="">
                            </div>
                            <div class="form-group" id="rajasthan_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="ra_district" id="ra_district" placeholder="Enter District" value="">
                                <label for="name">Tehsil</label>
                                <input type="text" class="form-control" name="ra_tehsil" id="ra_tehsil" placeholder="Enter Tehsil" value="">
                                <label for="name">RI Circle</label>
                                <input type="text" class="form-control" name="ra_ri_circle" id="ra_ri_circle" placeholder="Enter Ri Circle" value="">
                                <label for="name">Halkas</label>
                                <input type="text" class="form-control" name="ra_ri_halkas" id="ra_ri_halkas" placeholder="Enter Halkas" value="">
                                <label for="name">Sheetno</label>
                                <input type="text" class="form-control" name="ra_sheet_number" id="ra_sheet_number" placeholder="Enter SheetNumber" value="">
                                <label for="name">Village</label>
                                <input type="text" class="form-control" name="ra_village" id="ra_village" placeholder="Enter Village" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="ra_plot_number" id="ra_plot_number" placeholder="Enter plot number" value="">
                            </div>
                            <div class="form-group" id="lakshadweep_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="laksh_district" id="laksh_district" placeholder="Enter District" value="">
                                <label for="name">Taluk</label>
                                <input type="text" class="form-control" name="laksh_taluk" id="laksh_taluk" placeholder="Enter Taluk" value="">
                                <label for="name">Survey</label>
                                <input type="text" class="form-control" name="laksh_survey" id="laksh_survey" placeholder="Enter Survey" value="">
                                <label for="name">Village</label>
                                <input type="text" class="form-control" name="laksh_village" id="laksh_village" placeholder="Enter Village" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="laksh_plot_number" id="laksh_plot_number" placeholder="Enter plot_number" value="">
                            </div>
                            <div class="form-group" id="kerala_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="ker_district" id="ker_district" placeholder="Enter District" value="">
                                <label for="name">Taluk</label>
                                <input type="text" class="form-control" name="ker_taluk" id="ker_taluk" placeholder="Enter Taluk" value="">
                                <label for="name">Village</label>
                                <input type="text" class="form-control" name="ker_village" id="ker_village" placeholder="Enter Village" value="">
                                <label for="name">Block Number</label>
                                <input type="text" class="form-control" name="ker_blockno" id="ker_blockno" placeholder="Enter Block Number" value="">
                                <label for="name">Survey Number</label>
                                <input type="text" class="form-control" name="ker_survey_number" id="ker_survey_number" placeholder="Enter Survey Number" value="">
                                <label for="name">Sub Division Number</label>
                                <input type="text" class="form-control" name="ker_subdivno" id="ker_subdivno" placeholder="Enter Sub Division Number" value="">
                            </div>
                            <div class="form-group" id="goa_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="goa_district" id="goa_district" placeholder="Enter District" value="">
                                <label for="name">Taluka</label>
                                <input type="text" class="form-control" name="goa_taluka" id="goa_taluka" placeholder="Enter Taluka" value="">
                                <label for="name">Sheet Number</label>
                                <input type="text" class="form-control" name="goa_sheet_number" id="goa_sheet_number" placeholder="Enter Sheet Number" value="">
                                <label for="name">Village</label>
                                <input type="text" class="form-control" name="goa_village" id="goa_village" placeholder="Enter Village" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="goa_plot_number" id="goa_plot_number" placeholder="Enter plot_number" value="">
                            </div>
                            <div class="form-group" id="odisha_info" style="display:none;">
                                <label for="name">District</label>
                                <input type="text" class="form-control" name="odi_district" id="odi_district" placeholder="Enter District" value="">
                                <label for="name">Tehsil</label>
                                <input type="text" class="form-control" name="odi_tehsil" id="odi_tehsil" placeholder="Enter Tehsil" value="">
                                <label for="name">RI Circle</label>
                                <input type="text" class="form-control" name="odi_ri_circle" id="odi_ri_circle" placeholder="Enter RI Circle" value="">
                                <label for="name">Sheet Number</label>
                                <input type="text" class="form-control" name="odi_sheetnumber" id="odi_sheetnumber" placeholder="Enter Sheet Number" value="">
                                <label for="name">Village</label>
                                <input type="text" class="form-control" name="odi_village" id="odi_village" placeholder="Enter Village" value="">
                                <label for="name">Plot Number</label>
                                <input type="text" class="form-control" name="odi_plot_number" id="odi_plot_number" placeholder="Enter plot_number" value="">
                            </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="result_form">
        @if(!empty($bhunakasha['data']) && $bhunakasha['status_code']==200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Bhumi Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div> 
                            <p><strong>Giscode:</strong>
                                {{ isset($bhunakasha['data']['Giscode']) ? $bhunakasha['data']['Giscode'] : 'null' }}
                            </p>
                            <p><strong>Plotno:</strong>
                                {{ isset($bhunakasha['data']['Plotno']) ? $bhunakasha['data']['Plotno'] : 'null' }}
                            </p>
                            @if(isset($bhunakasha['data']['Plotinfo']['Area_details']) || isset($bhunakasha['data']['Plotinfo']['Owner_details']) || isset($bhunakasha['data']['Plotinfo']['Remark']))
                              <p class="text-center"><strong>Plot Description</strong></p>
                              <p><strong>Area Details:</strong>
                                {{ isset($bhunakasha['data']['Plotinfo']['Area_details']) ? $bhunakasha['data']['Plotinfo']['Area_details'] : 'null' }}
                              </p>      
                              <p><strong>Owner Details:</strong>
                                {{ isset($bhunakasha['data']['Plotinfo']['Owner_details']) ? $bhunakasha['data']['Plotinfo']['Owner_details'] : 'null' }}
                              </p>  
                              <p><strong>Remark:</strong>
                                {{ isset($bhunakasha['data']['Plotinfo']['Remark']) ? $bhunakasha['data']['Plotinfo']['Remark'] : 'null' }}
                              </p>  
                            @else
                               <p><strong>Plot Description:</strong>
                                {{ isset($bhunakasha['data']['Plotinfo']) ? $bhunakasha['data']['Plotinfo'] : 'null' }}
                               </p>
                            @endif
                           
                    </div>
                </div>
            </div>
        </div>
        @endif
        </div>
    </div>
</div>
@stop


@section('custom_js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
      $('.selectpicker').selectpicker();
      $(document).ready(function(e){
         $('#states_select_form').on('change',function(){
             let statesName = $(this).val();
             let biharForm = document.getElementById("bihar_info");
                 biharForm.style.display="none";
             let jharkhandForm = document.getElementById("jharkhand_info");
                 jharkhandForm.style.display = "none";
             let uttarPradeshForm = document.getElementById("uttar_pradesh_info");
                 uttarPradeshForm.style.display = "none";
             let chhattisgarhForm = document.getElementById("chhattisgarh_info");
                 chhattisgarhForm.style.display = "none";
             let rajasthanForm = document.getElementById("rajasthan_info");
                 rajasthanForm.style.display = "none";
             let lakshadweepForm = document.getElementById("lakshadweep_info");
                 lakshadweepForm.style.display = "none";
             let keralaForm = document.getElementById("kerala_info");
                 keralaForm.style.display = "none";
             let goaForm = document.getElementById("goa_info");
                 goaForm.style.display = "none";
             let odishaForm = document.getElementById("odisha_info");
                 odishaForm.style.display = "none";
            if(statesName=="bihar"){
                biharForm.style.display = "block";
                //bihar state filed set validation.
                $('#result_form').hide();
                $('#br_district').prop('required', true);
                $('#br_subdiv').prop('required', true);
                $('#br_circle').prop('required', true);
                $('#br_mauza').prop('required', true);
                $('#br_surveytype').prop('required', true);
                $('#br_mapinstance').prop('required', true);
                $('#br_sheet_number').prop('required', true);
                $('#br_plot_number').prop('required', true);
                  //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                   //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);

                   //chhattisgarh state filed remove validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);

                  //rajasthan state filed remove validation.
                $('#ra_district').prop('required', false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);

                  //kerala state filed remove validation.      
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_village').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required', false);
                $('#ker_subdivno').prop('required',false);
               //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required', false);
                   //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);

                   //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);
            }
            if(statesName=="jharkhand"){
               jharkhandForm.style.display = "block";
               $('#result_form').hide();
               //jharkhand state filed set validation.
                $('#jhar_district').prop('required', true);
                $('#jhar_circle').prop('required', true);
                $('#jhar_halka').prop('required', true);
                $('#jhar_mauza').prop('required', true);
                $('#jhar_ploat_number').prop('required', true);

                  //bihar  filed remove validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);

                 //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);

                   //chhattisgarh state filed remove validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);
                  //rajasthan state filed remove validation.
                $('#ra_district').prop('required', false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);

                     //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required', false);

                  //kerala state filed remove validation.
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_village').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required', false);
                $('#ker_subdivno').prop('required',false);

                   //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);
                   //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);
            }
            if(statesName=="up"){
                uttarPradeshForm.style.display = "block";
                   //up state filed set validation.
                $('#result_form').hide();
                $('#up_district').prop('required', true);
                $('#up_tehsil').prop('required', true);
                $('#up_village').prop('required', true);
                $('#up_plot_number').prop('required', true);
              
                     //bihar state filed remove validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);
                  //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                 //chhattisgarh state filed remove validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);

                  //rajasthan state filed remove validation.
                $('#ra_district').prop('required', false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);

                     //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required', false);
                  //kerala state filed remove validation.
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_village').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required', false);
                $('#ker_subdivno').prop('required',false);

                   //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);
                //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);

            }
            if(statesName=="chhattisgarh"){
                chhattisgarhForm.style.display = "block";
                  //chhattisgarh state filed set validation.
                $('#result_form').hide();
                $('#chha_distract').prop('required', true);
                $('#chha_tehsil').prop('required', true);
                $('#chha_ri_circle').prop('required', true);
                $('#chha_village').prop('required', true);
                $('#chha_plot_number').prop('required', true);

                  //bihar state filed set validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);

                  //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                   //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);
                  //rajasthan state filed remove validation.
                $('#ra_district').prop('required', false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);
                     //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required', false);

                  //kerala state filed remove validation.
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_village').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required', false);
                $('#ker_subdivno').prop('required',false);

                   //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);

                   //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);
            }
            if(statesName=="rajasthan"){
               rajasthanForm.style.display = "block";
                 $('#result_form').hide();
                //rajasthan state filed set validation.
                $('#ra_district').prop('required',true);
                $('#ra_tehsil').prop('required', true);
                $('#ra_ri_circle').prop('required', true);
                $('#ra_ri_halkas').prop('required', true);
                $('#ra_sheet_number').prop('required', true);
                $('#ra_village').prop('required', true);
                $('#ra_plot_number').prop('required', true);
                //chhattisgarh state filed set validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);

                  //bihar state filed set validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);

                  //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                   //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);

                  //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required', false);

                  //kerala state filed remove validation.
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_village').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required', false);
                $('#ker_subdivno').prop('required',false);
                   //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);

                   //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);
            }
            if(statesName=="lakshadweep"){
              lakshadweepForm.style.display = "block";
                $('#result_form').hide();
                //lakshadweep state filed set validation.
                $('#laksh_district').prop('required',true);
                $('#laksh_taluk').prop('required', true);
                $('#laksh_survey').prop('required', true);
                $('#laksh_village').prop('required', true);
                $('#laksh_plot_number').prop('required', true);
                //rajasthan state filed remove validation.
                $('#ra_district').prop('required',false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);
                //chhattisgarh state filed set validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);

                  //bihar state filed set validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);

                  //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                   //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);

                //kerala state filed remove validation.
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_village').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required', false);
                $('#ker_subdivno').prop('required',false);

                   //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);

                   //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);
            }
            if(statesName=="kerala"){
                keralaForm.style.display = "block";
                $('#result_form').hide();
                  //kerala state filed set validation.
                $('#ker_district').prop('required',true);
                $('#ker_taluk').prop('required', true);
                $('#ker_village').prop('required', true);
                $('#ker_blockno').prop('required', true);
                $('#ker_survey_number').prop('required', true);
                $('#ker_subdivno').prop('required',true);

                 //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required',false);
                //rajasthan state filed remove validation.
                $('#ra_district').prop('required',false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);
                //chhattisgarh state filed set validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);

                  //bihar state filed set validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);
                 //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);
                  //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);
                   //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);
            }
            if(statesName=="goa"){
                goaForm.style.display = "block";
                 
                $('#result_form').hide();
                //goa state filed set validation.
                $('#goa_district').prop('required',true);
                $('#goa_taluka').prop('required', true);
                $('#goa_sheet_number').prop('required', true);
                $('#goa_village').prop('required', true);
                $('#goa_plot_number').prop('required',true);
                    //kerala state filed set validation.
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required',false);
                $('#ker_subdivno').prop('required',false);
                $('#ker_village').prop('required', false);
                 //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required',false);
                //rajasthan state filed remove validation.
               $('#ra_district').prop('required',false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);
                //chhattisgarh state filed set validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);

                  //bihar state filed set validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);
                 //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);

                  //odisha state filed remove validation.
                $('#odi_district').prop('required',false);
                $('#odi_tehsil').prop('required', false);
                $('#odi_ri_circle').prop('required', false);
                $('#odi_sheetnumber').prop('required', false);
                $('#odi_village').prop('required',false);
                $('#odi_plot_number').prop('required',false);
            }
            if(statesName=="odisha"){
                odishaForm.style.display = "block";
                $('#result_form').hide();
                 //odisha state filed set validation.
                $('#odi_district').prop('required',true);
                $('#odi_tehsil').prop('required', true);
                $('#odi_ri_circle').prop('required', true);
                $('#odi_sheetnumber').prop('required', true);
                $('#odi_village').prop('required',true);
                $('#odi_plot_number').prop('required',true);
                //goa state filed remove validation.
                $('#goa_district').prop('required',false);
                $('#goa_taluka').prop('required', false);
                $('#goa_sheet_number').prop('required', false);
                $('#goa_village').prop('required', false);
                $('#goa_plot_number').prop('required',false);
                    //kerala state filed set validation.
                $('#ker_district').prop('required',false);
                $('#ker_taluk').prop('required', false);
                $('#ker_blockno').prop('required', false);
                $('#ker_survey_number').prop('required',false);
                $('#ker_subdivno').prop('required',false);
                $('#ker_village').prop('required', false);
                 //lakshadweep state filed remove validation.
                $('#laksh_district').prop('required',false);
                $('#laksh_taluk').prop('required', false);
                $('#laksh_survey').prop('required', false);
                $('#laksh_village').prop('required', false);
                $('#laksh_plot_number').prop('required',false);
                //rajasthan state filed remove validation.
                $('#ra_district').prop('required',false);
                $('#ra_tehsil').prop('required', false);
                $('#ra_ri_circle').prop('required', false);
                $('#ra_ri_halkas').prop('required', false);
                $('#ra_sheet_number').prop('required', false);
                $('#ra_village').prop('required', false);
                $('#ra_plot_number').prop('required', false);
                //chhattisgarh state filed set validation.
                $('#chha_distract').prop('required', false);
                $('#chha_tehsil').prop('required', false);
                $('#chha_ri_circle').prop('required', false);
                $('#chha_village').prop('required', false);
                $('#chha_plot_number').prop('required', false);

                  //bihar state filed set validation.
                $('#br_district').prop('required', false);
                $('#br_subdiv').prop('required', false);
                $('#br_circle').prop('required', false);
                $('#br_mauza').prop('required', false);
                $('#br_surveytype').prop('required', false);
                $('#br_mapinstance').prop('required', false);   
                $('#br_sheet_number').prop('required', false);
                $('#br_plot_number').prop('required', false);
                 //jharkhand state filed remove validation.
                $('#jhar_district').prop('required', false);
                $('#jhar_circle').prop('required', false);
                $('#jhar_halka').prop('required', false);
                $('#jhar_mauza').prop('required', false);
                $('#jhar_sheetno').prop('required', false);
                $('#jhar_ploat_number').prop('required', false);

                //up state filed remove validation.
                $('#up_district').prop('required', false);
                $('#up_tehsil').prop('required', false);
                $('#up_village').prop('required', false);
                $('#up_plot_number').prop('required', false);
            }
            else{
                //  $('#bihar_info,#jharkhand_info,#uttar_pradesh_info,#chhattisgarh_info,#rajasthan_info,#lakshadweep_info,#kerala_info,#goa_info,#odisha_info').css('display','none');
            }
         });
      });
    </script>

@stop