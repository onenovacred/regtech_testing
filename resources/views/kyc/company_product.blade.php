@extends('adminlte::page')

@section('title', 'Regtechapi - Company Product Details')

@section('content_header')
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

        table {
            width: 100%;
        }

        .data-title {
            /* background-color: #8B0000; */
            color: #8c8686;
            height: 20px;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;
        }

        .company-data {
            background-color: grey;
            color: black;
            height: 10px;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;
        }
        ul {
            list-style-type: none; /* Hide bullets */
        }
        .product_details{
            width:1000px; 
            height:220px; 
            text-align: center; 
            overflow-y: auto;
        }
    </style>

@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Company Product Details</h3>
                    <a role = "button" class = "btn btn-light float-right" 
                    href = "{{ route('kyc.company_product_api') }}">Company Product</a>
                </div>
                <div class="card-body">
                     @if (isset($companyProductDetails['status_code']) && $companyProductDetails['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid companyName or flrsLicenseNo
                        </div>
                    @endif
                    @if(isset($companyProductDetails['statusCode']) && $companyProductDetails['statusCode'] == 103)
                        <div class="alert alert-danger" role="alert">
                            You are not registered to use this service. Please update your plan.
                        </div>
                    @endif
                    @if(isset($companyProductDetails['status_code']) && $companyProductDetails['status_code'] == 500)
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.company_product') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for=""><strong>Select Company Details</strong></label>
                                    </div>
                                    <select name="company_details_id" id="company_details_id"
                                        class="form-control selectpicker multiselect" data-live-search="true"
                                        data-actions-box="true" multiple>
                                        <option value="company_name">Company Name</option>
                                        <option value="license_no">License No</option>
                                    </select>
                                </div>
                                <div class="form-group" id="company_name_id">
                                    <label for="name">CompanyName</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        value="" placeholder="Enter company number" required>
                                </div>
                                <div class="form-group" id="license_no_id">
                                    <label for="name">LicenseNo</label>
                                    <input type="text" class="form-control" id="license_no" name="license_no"
                                        value="" placeholder="Enter company name" required>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        @if (isset($companyProductDetails['status_code']) && $companyProductDetails['status_code'] == 200)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Company Details</h3>
                </div>
                <div class="card-body">
                    <div class = "row">
                      <table class="table table-bordered table-responsive" cellspacing="0">
                            <thead>
                                <tr class="data-title">
                                    <th scope = "col">Apptypedesc</th>
                                    <th scope = "col">Company Name</th>
                                    <th scope = "col">Display Refid</th>
                                    <th scope = "col">District</th>
                                    <th scope = "col">Fboid</th>
                                    <th scope = "col">Licenseactive Flag</th>
                                    <th scope = "col">LicenseCategoryId</th>
                                    <th scope = "col">LicenseCategoryName</th>
                                    <th scope = "col">Licenseno</th>
                                    <th scope = "col">PremiseAddress</th>
                                    <th scope = "col">PremisePincode</th>
                                    <th scope = "col">Refid</th>
                                    <th scope = "col">StateName</th>
                                    <th scope = "col">StatusDesc</th>
                                    <th scope = "col">TalukName</th>
                                    <th scope = "col">VillageName</th>
                                    <th scope = "col" class="text-center">Company Product Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($companyProductDetails['company_details'] as $company)
                                    <tr>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['apptypedesc'])? $company['companyDetails']['Information']['apptypedesc'] :'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['companyname'])?$company['companyDetails']['Information']['companyname']:'null' }}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['displayrefid'])? $company['companyDetails']['Information']['displayrefid']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['districtname'])? $company['companyDetails']['Information']['districtname']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['fboid'])?$company['companyDetails']['Information']['fboid']:'null' }}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['licenseactiveflag'])? $company['companyDetails']['Information']['licenseactiveflag']:'false' }}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['licensecategoryid'])? $company['companyDetails']['Information']['licensecategoryid']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['licensecategoryname'])? $company['companyDetails']['Information']['licensecategoryname']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['licenseno'])? $company['companyDetails']['Information']['licenseno']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['premiseaddress'])?$company['companyDetails']['Information']['premiseaddress']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['premisepincode'])? $company['companyDetails']['Information']['premisepincode']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['refid'])?$company['companyDetails']['Information']['refid']:'null' }}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['statename']) ? $company['companyDetails']['Information']['statename']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['statusdesc'])? $company['companyDetails']['Information']['statusdesc']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['talukname']) ? $company['companyDetails']['Information']['talukname']:'null'}}</td>
                                        <td scope = "col">{{ isset($company['companyDetails']['Information']['villagename']) ? $company['companyDetails']['Information']['villagename'] : 'null'}}</td>
                                        <td scope = "col">
                                            <div class = "row product_details">
                                                    <table class = "table text-center" cellspacing="0"  style="text-align: center;">
                                                        <thead class = "data-title">
                                                            <tr>
                                                                <th scope = "col">ActiveFlag</th>
                                                                <th scope = "col">CategoryName</th>
                                                                <th scope = "col">FpvsProductId</th>
                                                                <th scope = "col">IndexVal</th>
                                                                <th scope = "col">KindOfBusinessType</th>
                                                                <th scope = "col">ManufacturFlag</th>
                                                                <th scope = "col">ProductId</th>
                                                                <th scope = "col">ProductName</th>
                                                                <th scope = "col">ProductNamef</th>
                                                                <th scope = "col">RcProductId</th>
                                                                <th scope = "col">RefId</th>
                                                                <th scope = "col">SubCategoryId</th>
                                                                <th scope = "col">SubCategoryName</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table-style">
                                                            @foreach($company['companyDetails']['products'] as $product)
					                                    	<tr>
                                                                <td scope = "col">{{ isset($product['activeFlag']) ?$product['activeFlag'] : 'false'}}</td>
                                                                <td scope = "col">{{ isset($product['categoryName']) ?$product['categoryName'] :'null'}}</td>
                                                                <td scope = "col">{{ isset($product['fpvsProductId']) ?$product['fpvsProductId'] :'null' }}</td>
                                                                <td scope = "col">{{ isset($product['indexVal']) ?$product['indexVal'] :'null'}}</td>
                                                                <td scope = "col">{{ isset($product['kindOfBusinessType']) ?$product['kindOfBusinessType'] :'null'}}</td>
                                                                <td scope = "col">{{ isset($product['manufacturFlag']) ? $product['manufacturFlag'] :'false' }}</td>
                                                                <td scope = "col">{{ isset($product['productId'])?$product['productId'] :'null' }}</td>
                                                                <td scope = "col">{{ isset($product['productName'])?$product['productName'] : 'null'}}</td>
                                                                <td scope = "col">{{ isset($product['productNamef'])?$product['productNamef'] : 'null'}}</td>
                                                                <td scope = "col">{{ isset($product['rcProductId']) ?$product['rcProductId'] :'null'}}</td>
                                                                <td scope = "col">{{ isset($product['refId']) ?$product['refId'] :'null'}}</td>
                                                                <td scope = "col">{{ isset($product['subCategoryId'])? $product['subCategoryId']: 'null'}}</td>
                                                                <td scope = "col">{{ isset($product['subCategoryName']) ?$product['subCategoryName'] :'null'}}</td> 
					                                    	</tr>
					                                       @endforeach				
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
@section('custom_js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        $('.selectpicker').selectpicker();
        $(document).ready(function() {
            $("#company_name_id").hide();
            $("#license_no_id").hide();
            $('#company_details_id').change(function() {
                var company_details = $(this).val();
                if (company_details == "company_name") {
                    $("#company_name_id").show();
                    $("#license_no_id").hide();
                    $('#license_no').removeAttr('required');
                    $('#company_details_id').selectpicker('refresh');
                } else if (company_details == "license_no") {
                    $("#license_no_id").show();
                    $("#company_name_id").hide();
                    $('#company_name').removeAttr('required');
                    $('#company_details_id').selectpicker('refresh');
                } else if (company_details.includes("company_name") && company_details.includes("license_no")) {
                    $("#company_name_id").show();
                    $("#license_no_id").show();
                    $('#company_details_id').selectpicker('refresh');
                } else {
                    $("#company_name_id").hide();
                    $("#license_no_id").hide();
                    $('#company_details_id').selectpicker('refresh');
                }
            });
        });
    </script>
@stop
