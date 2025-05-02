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