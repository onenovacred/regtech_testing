@extends('adminlte::page')

@section('title', 'Consumer Product')

@section('content_header')

<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
  <link rel="stylesheet" href="{{ URL::asset('public/assets/css/bd-wizard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
    <style> 
        .content-wrapper
        {
          padding:20px;
        }
        /* #editcustomerhd
        {
          overflow:visible !important;
        } */
      #clear {
          position: absolute;
    top: 0;
    border-radius: 5px;
    right: 6px;
    z-index: 2;
    border: none;
    top: 2px;
    height: 29px;
    cursor: pointer;
    /* color: white; */
    /* background-color: #1e90ff; */
    transform: translateX(2px);
    margin: 12px;
    }
    #clearhd
    {
      position: unset;
    top: 0;
    border-radius: 5px;
    right: 6px;
    /* z-index: 2;
    border: none;
    top: 2px;
    height: 29px;
    cursor: pointer;
    color: white;
    background-color: #1e90ff;
    transform: translateX(2px); */
    margin: 1px;
    }
     
    /* #clear {
        position: absolute;
        top: 0;
        border-radius: 5px;
        right: 0px;
        z-index: 2;
        border: none;
        top: 2px;
        height: 30px;
        cursor: pointer;
        color: white;
        background-color: #1e90ff;
        transform: translateX(2px);
    } */
    </style>
@stop
@section('content')

  <main class="my-5">
    <div class="container">
    <form method="post"  enctype="multipart/form-data" id="formSubmitted" action="{{route('consumerproduct')}}">
      @csrf
      <div id="wizard">
      
        @if(isset($message))
        <div class="alert alert-warning alert-dismissible fade show">
          <strong>{{$message}}</strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        @endif
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div>
             <div id="editcustomer"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body"> 
            <div class="bd-wizard-step-title" id="customerdetails">Customer Details</div>
              <div class="bd-wizard-step-subtitle">Step 1</div>
             
              <!-- <a><i class="fa fa-edit" style="font-size:24px;color:red"></i></a>   -->
           </div>
          </div>
          <div class="form-group media"  >
            <input type="text" name="consumerheading" id="consumerheading"   class="form-control" style="display:none" autofocus/>
            <div id="clearhd" class='addcustomerhd'><i class="fa fa-plus"  id="show" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
         </h3>
         
        <section>
        
          <div class="content-wrapper">
            <h4 class="section-heading">Enter your Customer details </h4>
            <div class="row">
              <input type="hidden" name="consumerhd" id="consumerhd" value="Customer Details"/>
              <div class="form-group col-md-6 col-12" id="hidefullname">
                
                <label for="fullname" class="sr-only">Full Name</label>
                <input type="text" name="fullname" placeholder="Enter full name" class="form-control" id="fullname" /> 
                <a id="clear" class="rmfullname"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>   
        
              </div>
              <div class="form-group col-md-6 col-12" id="hidefirstname">
                
                <label for="firstname" class="sr-only">First Name</label>
                <input type="text" name="firstname" placeholder="Enter first name" class="form-control" id="firstname" /> 
                <a id="clear" class="rmfirstname"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
        
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 col-12" id="hidelastname">
                <label for="lastname" class="sr-only">Last Name</label>
                <input type="text" name="lastname" placeholder="Enter last name" class="form-control" id="lastname" /> 
                <a id="clear" class="rmlastname"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>  
              </div>
              <div class="form-group col-md-6" id="hidedb">
                <label for="dob" class="sr-only">Date Of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of birth" >
                <a id="clear" class="rmdb"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
              </div>
              </div>
            <div class="row">
              <div class="form-group col-md-6" id="hidemno">
                <label for="mobileno" class="sr-only">Phone Number</label>
                <input type="number" name="mobileno" placeholder="mobile no" class="form-control" id="mobileno"/>
                <a id="clear" class="rmmno"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
              </div>
              <div class="form-group col-md-6" id="hideemail">
                <label for="emailaddress" class="sr-only">Email Address</label>
                <input type="email" name="emailaddress" placeholder="email" class="form-control" id="emailaddress" /> 
                <a id="clear" class="rmemail"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
              </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12 col-12" id="hideaddress"> 
                <label for="address" class="sr-only">Address</label>
                <input type="text" name="address" placeholder="address" class="form-control" id="address" />
                <a id="clear" class="rmaddress"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-12"> 
                  <select class="custom-select custom-select-lg mb-3" id="sltfields" name="sltfields">
                  <option value="0" selected>Select the field</option> 
                  <option value="city">city</option> 
                  <option value="state">State</option>
                  <option value="addressline1">Address Line 1</option>
                  <option value="addressline2">Address Line 2</option>
                  <option value="addressline3">Adrress Line 3</option>
                  <option value="gender">gender</option>
                  <option value="image">image</option>
                  <option value="audiovideo">Audio/Video</option>    
                  </select>
                </div>
                <div class="form-group col-6">
                  <input type="button" name="adddynamicfileds" class="btn btn-primary btn-sm" value="Add Fields" id="adddynamicfileds"/> 
                </div>
            </div>
            <div class="row" id="displayaddressline1" style="display:none">
                <div class="form-group col-md-12 col-12">
                  <label for="addressline1" class="sr-only">Address Line1</label>
                    <input type="text" name="addressline1" id="addressline1" class="form-control" placeholder="addressline 1">
                    <a id="clear" class="rmaddressline1"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
                </div>
            </div>
            <div class="row" id="displayaddressline2" style="display:none">
                <div class="form-group col-12">
                  <label for="addressline2" class="sr-only">Address Line 2</label>
                  <input type="text" name="addressline2" id="addressline2" class="form-control" placeholder="addressline 2">
                  <a id="clear" class="rmaddressline2"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
                </div>
            </div>
            <div class="row" id="displayaddressline3" style="display:none">
                <div class="form-group col-12">
                <label for="addressline3" class="sr-only">Address Line 3</label>
                  <input type="text" name="addressline3" id="addressline3" class="form-control" placeholder="addressline 3">
                  <a id="clear" class="rmaddressline3"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6" id="displaycity" style="display:none">
                  <label for="city" class="sr-only">City</label>
                  <input type="text" name="city" id="city" class="form-control" placeholder="city">
                  <a id="clear" class="rmcity"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
                </div>
                <div class="form-group col-6" id="displaystate" style="display:none">
                <label for="city" class="sr-only">State</label>
                  <input type="text" name="state" id="state" class="form-control" placeholder="state">
                  <a id="clear" class="rmstate"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
                </div>
            </div>
            <div class="row">
              <div class="form-group col-6" id="displaygender" style="display:none">
                <h6>Select Gender </h6>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rdogender" id="rdomale" value="0">
                <label class="form-check-label" for="rdomale">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rdogender" id="rdofemale" value="1">
                <label class="form-check-label" for="rdofemale">Female</label>
              </div>
              <a id="clear" class="rmgender"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
              </div>
              <div class="form-group col-6" id="displayimageupload" style="display:none">
              <label for="uploadimage">Upload Image</label>
                <!-- <label for="uploadeddocument" class="sr-only" ></label> -->
                <input type="file" class="form-control-file" name="uploadimage" id="uploadimage" placeholder="Upload Image">
                <a id="clear" class="rmimageupload"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
              </div>
            </div>
            <div class="row">
                <div class="form-group col-12" style="display:none" id="displayaudiovideo">
                <label for="uploadimage">Upload Audio/Video</label>
                <!-- <label for="uploadeddocument" class="sr-only" ></label> -->
                <input type="file" class="form-control-file" name="uploadaudiovideo" id="uploadaudiovideo" placeholder="Upload Image" accept="image/*">
                <a id="clear" class="rmaudiovideo"><i class="fa fa-remove" style="font-size:24px;color:red"></i></a>
                </div>
            </div>
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
            <div id="editbusiness"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="businessdetails">Business Information</div>
              <div class="bd-wizard-step-subtitle">Step 2</div>
            </div>
          </div>
          <div class="form-group media">
            <input type="text" name="businessheading" id="businessheading"   class="form-control" style="display:none" autofocus/>
            <div id="clearhd" class='addbusinesshd'><i class="fa fa-plus"  id="showbusinesshd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
            <h4 class="section-heading">Enter your Business Information </h4>
            <div class="row">
            <input type="hidden" name="businesshd" id="businesshd" value="Business Information" />
                <div class="col-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="businesschecked">
                    <label class="form-check-label" for="businesschecked">
                        Add Business Details
                    </label>
                </div> 
            </div> 
            </div>
            <div id="addbusiness" style="display: none"> 
            <div class="row">
            <input type="hidden" name="urlbusinesstype" id="urlbusinesstype" value="{{route('businesstype')}}">
            <input type="hidden" name="urlbusinesskyc" id="urlbusinesskyc" value="{{route('businesskyc')}}">
                <div class="col-md-6">
                <select class="custom-select custom-select-lg mb-3" id="businesstypeid" name="businesstypeid">
                <option value="0" selected>Select Business Type</option> 
                @foreach($businesstype as $data)
                    <option value="{{$data->id}}">{{$data->businesstype}}</option>      
                @endforeach
                </select>
                </div>
                <div class="col-md-6">
                <input type="button" name="addbusinesstype" class="btn btn-primary btn-sm" value="Add Business type" id="addbusinesstype"/> 
                </div>
            </div>
            <div class="row" id="displaybusinesstype" style="display: none">           
              <div class="form-group col-md-6">
                <label for="businesstype" class="sr-only">Business Type</label>
                <input type="text" name="businesstype" placeholder="Add Business Type" id="businesstype" class="form-control"/>
                <a id="clear" class="addbusinesstypes"><i class="fa fa-plus" style="font-size:24px;color:red"></i></a>  
              </div>
              <!-- <div class="form-group col-md-6">
              <input type="button" name="addbusinesstype" class="btn btn-primary btn-sm" value="Add" id="add"/> 
              </div> -->
            
            </div>
            <div class="row">
            <div class="form-group col-md-6">
                <label for="businessname" class="sr-only">Business Name</label>
                <input type="text" class="form-control" name="businessname" placeholder="Business Name"  id="businessname"/>
              </div>
              <div class="form-group col-6">
                <label for="employeeNumber" class="sr-only">Address</label>
                <input type="text" name="businessaddress"  id="businessaddress" class="form-control" placeholder="Address">
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <select class="custom-select custom-select-lg mb-3" id="businesskycid" name="businesskycid">
                  <option value="0" selected>Select Business KYC</option>
                   @foreach($businesskyc as $data)
                      <option value="{{$data->id}}">{{$data->businesskyc}}</option>
                    @endforeach
                </select>
                  </div>
                  <div class="col-md-6">
                    <input type="button" name="addbusinesskyc" class="btn btn-primary btn-sm" value="Add Business KYC" id="addbusinesskyc" /> 
                </div>
            </div>
            <div class="row" style="padding-bottom: 10px;display:none"  id="displaybusinesskyc">
                <div class="col-md-6">
                <label for="businesskyc" class="sr-only">Business KYC</label>
                <input type="text" name="businesskyc"  id="businesskyc" class="form-control" placeholder="Business KYC">   
                <a id="clear" class="addbusinesskycs"><i class="fa fa-plus" style="font-size:24px;color:red"></i></a>  
                </div>
                <!-- <div class="form-group col-md-6">
              <input type="button" name="addbusinesstype" class="btn btn-primary btn-sm" value="Add" id="add"/> 
              </div> -->
            </div>
            <div class="row" >
                <div class="form-group col-12">
                <label for="uploadeddocument">Upload Kyc Document</label>
                <!-- <label for="uploadeddocument" class="sr-only" ></label> -->
                <input type="file" class="form-control-file" name="uploadeddocument" id="uploadeddocument" placeholder="upload KYC dociument">
                </div>
            </div>
        
            </div>
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-nix"></i></div>
            <div id="editotherdetails"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="otherdetails">Other details</div>
              <div class="bd-wizard-step-subtitle">Step 3</div>
            </div>
          </div>
          <div class="form-group media">
            <input type="text" name="requireddetailsheading" id="requireddetailsheading"   class="form-control" style="display:none" autofocus/>
            <div id="addotherdetailshd" class='addotherdetailshd'><i class="fa fa-plus"  id="showotherdetailshd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
          <input type="hidden" name="pancarddetailsmodal" id="pancarddetailsmodal" />
          <input type="hidden" name="aadhaardetailsmodal" id="aadhaardetailsmodal" />
          <input type="hidden" name="urldocumentname" id="urldocumentname" value="{{route('documentname')}}">
            <h4 class="section-heading">Enter your requirement details </h4>
            <div class="row">
            <input type="hidden" name="urlpancardval" id="urlpancardval" value="{{route('consumerpancard')}}">
            <input type="hidden" name="urlaadhaarval" id="urlaadhaarval" value="{{route('consumeraadhaar')}}">
            <input type="hidden" name="requireddetailshd" id="requireddetailshd" value="Other details" />
              <div class="form-group col-6">
              <select class="custom-select custom-select-lg mb-3" id="uploadeddocumentname" name="uploadeddocumentname">
                    <option selected value="0">Choose the document to upload</option>
                    @foreach($documentname as $document)
                      <option value="{{$document->id}}">{{$document->documentname}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
              <input type="button" name="adddocupload" class="btn btn-primary btn-sm" value="Add uploaded document" id="adddocupload" /> 
            </div>
            </div>
            <div class="row" id="displaydocupload" style="display:none">
              <div class="col-6">
              <label for="businesstype" class="sr-only">Document Name</label>
                <input type="text" name="documentname" placeholder="Add Document Name" id="documentname" class="form-control"/>
                <a id="clear" class="adddocname"><i class="fa fa-plus" style="font-size:24px;color:red"></i></a>  
              </div>
            </div>
            <div class="row" >
                <div class="col-12" style="padding-bottom: 10px">
                <label for="uploadfile" >Upload selected document</label>
                <input type="file" class="form-control-file" name="uploadfile" id="uploadfile">
                </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="panvalidation" class="sr-only">Pan Number</label>
                <input type="text" name="pannumber" id="pannumber" class="form-control" placeholder="pan number">
              </div>
              <div class="form-group col-md-6">
                <label for="aadharvalidation" class="sr-only">Aadhar Number</label>
                <input type="text" name="aadhaarnumber" id="aadhaarnumber" class="form-control" placeholder="Aadhar number">
              </div>
            </div>
          </div>        
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
            <div id="editrules"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="rulesdetails">Rules Defined</div>
              <div class="bd-wizard-step-subtitle">Step 4</div>
            </div>
          </div>
          <div class="form-group media" >
            <input type="text" name="rulesdefinedheading" id="rulesdefinedheading"   class="form-control" style="display:none" autofocus/>
            <div  class='addruleshd'><i class="fa fa-plus"  id="showruleshd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
            <h4 class="section-heading">Setting the rules</h4>
            <div class="row">
            <input type="hidden" name="rulesdefinedhd" id="rulesdefinedhd" value="rules defined"/>
            <div class="col-12">
                <!-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="loanchecked">
                    <label class="form-check-label" for="loanchecked">
                        Add Loan sactonied data
                    </label>
                </div>  -->
            </div> 
            </div>
            <table class="table table-bordered" id="dynamicAddRemove">
              <tr>
                <th>crif/equifax score</th>
                <th>Loan Allowed</th>
                <th>Actions</th>
              </tr>
              <tr>
                <td>
                  <input type="number" name="score[0][score]" id="score" class="form-control" placeholder="Score">
                </td>
                <td>
                <input type="number" name="loanamount[0][loanamount]" id="loanamount" class="form-control" placeholder="loan amount to be approved">
                </td>
                <td>
                  <!-- <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button> -->
                  <a id="addscore"><i class="fa fa-plus"   style="font-size:24px"></i></a>
                </td>
              </tr>
            </table>
            <!-- <div class="row">
              <div class="form-group col-md-6">
                <label for="score" class="sr-only">crif/equifax Score</label>
                <input type="text" name="score" id="score" class="form-control" placeholder="Score">
              </div>
              <div class="form-group col-md-6">
                <label for="loanallowed" class="sr-only">Loan Allowed</label>
                <input type="text" name="loanallowed" id="loanallowed" class="form-control" placeholder="loan amount to be approved">
              </div>
            </div> -->
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
            <div id="editterms"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="termsdetails">Terms and conditions</div>
              <div class="bd-wizard-step-subtitle">Step 5</div>
            </div>
          </div>
          <div class="form-group media" >
            <input type="text" name="termsconditionheading" id="termsconditionheading"   class="form-control" style="display:none" autofocus/>
            <div  class='addtermshd'><i class="fa fa-plus"  id="showtermshd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
        <div class="alert alert-warning alert-dismissible fade show" style="display:none" id="displaymsg">
          <strong id="messageid"></strong>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
          <div class="content-wrapper">
            <h4 class="section-heading">Terms and conditions</h4>
            <div class="row">
            <input type="hidden" name="termsconditionhd" id="termsconditionhd" value="Terms and conditions"/>
              <div class="form-group col-12">
              <label for="score" class="sr-only">Terms and conditions</label>
                <input type="text" name="termscondition" id="termscondition" class="form-control" placeholder="terms and conditions">
              <!-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="termscondition">
                    <label class="form-check-label" for="termscondition">
                      Crif/Equifax terms and conditions
                    </label>
                </div> -->
              </div> 
            </div>
            <div class="row">
              <input type="hidden" name="equifaxurl" id="equifaxurl" value="{{route('consumer.equifaxurl')}}" />
              <input type="hidden" name="esigninitializedurl" id="esigninitializedurl" value="{{route('esigninitialized')}}">
              <div class="form-group col-12">
              <select class="custom-select custom-select-lg mb-3" id="selectapi" name="selectapi">
                    <option selected value="0">Choose API</option>
                    <option value="crif">CRIF APi</option>
                    <option value="equifax">Equifax Api</option>
                </select>
              </div>
            </div>
            <div class="row">
            <div class="form-group col-md-6">
                <label for="score" class="sr-only">crif/equifax Score</label>
                <input type="text" name="crifapiscore" id="crifapiscore" class="form-control" placeholder="Score" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="loan" class="sr-only">Loan</label>
                <input type="text" name="loansactioned" id="loansactioned" class="form-control" placeholder="Loan sactioned">
              </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                <input type="button" name="esign" class="btn btn-primary btn-sm" value="Esign" id="esign"/> 
                </div>
            </div>
            <div class="row" style="display:none" id="esigninitialized">
              <div class="form-group col-12 col-md-12">
                  <div id="client_id"></div>
                  <div id="group_id"></div>
                  <p id="esignurl">url:</p>
              </div>
            </div>
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
            <div id="editcong"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="congdetails">Congratulations</div>
              <div class="bd-wizard-step-subtitle">Step 6</div>
            </div>
          </div>
          <div class="form-group media" >
            <input type="text" name="congratulationsheading" id="congratulationsheading"   class="form-control" style="display:none" autofocus/>
            <div  class='addconghd'><i class="fa fa-plus"  id="showconghd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
            <h4 class="section-heading"></h4>
            <div class="row">
            <input type="hidden" name="congratulationshd" id="congratulationshd" value="Congratulations"/>
            <div class="form-group col-md-12">
            <label for="congmsg" class="sr-only">Congratulations Message</label>
            <input type="text" name="congmsg" id="congmsg" class="form-control" placeholder="Congratulations Message">
              <!-- <h4>Your Amount has been aprroved </h4> -->
            </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
              <label for="uploadcongfile" >Upload selected document</label>
                <input type="file" class="form-control-file" name="uploadcongfile" id="uploadcongfile">
              </div>
            </div>
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-account-check-outline"></i></div>
            <div id="editagreement"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="agreementdetails">Agreement </div>
              <div class="bd-wizard-step-subtitle">Step 7</div>
            </div>
          </div>
          <div class="form-group media" >
            <input type="text" name="agreementheading" id="agreementheading"   class="form-control" style="display:none" autofocus/>
            <div  class='addagreementhd'><i class="fa fa-plus"  id="showagreementhd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
          <h4 class="section-heading mb-5">Agreement Policy</h4>
          <div class="row">
          <input type="hidden" name="agreementhd" id="agreementhd" value="Agreement"/>
              <div class="form-group col-12">
              <!-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="agreement" checked>
                    <label class="form-check-label" for="agreement">
                    Agreement Policy for loan and tap
                    </label>
                </div> 
              </div> -->
              <label for="agreementupload" >Upload Agreement policy document</label>
              <input type="file" class="form-control-file" name="agreementupload" id="agreementupload" accept="application/pdf,application/doc">
            </div>
          </div>
          <div class="row">
              <div class="form-group col-12">
              <label for="agreemnet" class="sr-only">Agreement</label>
                <input type="text" name="agreemnet" id="agreemnet" class="form-control" placeholder="Agreement">
            </div>
          </div>
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
            <div id="editautodebit"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="autodebitdetails">Auto Debit</div>
              <div class="bd-wizard-step-subtitle">Step 8</div>
            </div>
          </div>
          <div class="form-group media" >
            <input type="text" name="bankdetailsheading" id="bankdetailsheading"   class="form-control" style="display:none" autofocus/>
            <div  class='addautodebithd'><i class="fa fa-plus"  id="showautodebithd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
            <h4 class="section-heading mb-5">Bank Details</h4>
            <div class="row">
            <input type="hidden" name="bankdetailshd" id="bankdetailshd" value="Auto Debit" />
              <div class="form-group col-md-6">
                <label for="score" class="sr-only">Bank Name</label>
                <input type="text" name="bankname" id="bankname" class="form-control" placeholder="Bank Name">
              </div>
              <div class="form-group col-md-6">
                <label for="accountnumber" class="sr-only">Account Number</label>
                <input type="text" name="accountnumber" id="accountnumber" class="form-control" placeholder="Account Number">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
              <select class="custom-select custom-select-lg mb-3" id="accounttype" name="accounttype">
                    <option selected value="0">Choose account type</option>
                    <option value="saving">Saving Account</option>
                    <option value="current">Current Account</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="ifsccode" class="sr-only">IFSC Code</label>
                <input type="text" name="ifsccode" id="ifsccode" class="form-control" placeholder="IFSC code">
              </div>
            </div>
          </div>  
        </section>
        <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
            <div id="editlink"><i class="fa fa-edit" style="font-size:24px;color:red"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title" id="linkdetails">Generating the link</div>
              <div class="bd-wizard-step-subtitle">Step 9</div>
            </div>
          </div>
          <div class="form-group media" >
            <input type="text" name="linkheading" id="linkheading"   class="form-control" style="display:none" autofocus/>
            <div  class='addlinkhd'><i class="fa fa-plus"  id="showlinkhd" style="font-size:24px;color:red;display:none;"></i></div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
            <h4 class="section-heading mb-5">Adding the link</h4>
            <div class="row">
            <input type="hidden" name="linkhd" id="linkhd" value="Adding the link" />
              <div class="form-group col-12">
                <label for="score" class="sr-only">Link Name</label>
                <input type="text" name="linkname" id="linkname" class="form-control" placeholder="link Name">
              </div>
            </div>
          </div>  
        </section>
            <!-- Modal HTML -->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div id="displaydetailsofpancard">
                  </div>
                  <div id="displaydetailsofaadhaar">
                  </div>
                  <div id="displaydetailsofequifax">
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                </div>
            </div>
        </div>
    </div>
      </div>
    </form>
    </div>
  </main>
  

@stop


@section('custom_js')
<script type="text/javascript" src="{{ URL::asset('public/js/consumer_product.js') }}"></script>
  <!-- <script type="text/javascript" language="javascript">
      var jq = jQuery.noConflict();
  </script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
  <script src="{{ URL::asset('public/assets/js/jquery.steps.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/bd-wizard.js') }}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    
  
@stop
