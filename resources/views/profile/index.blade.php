@extends('adminlte::page')

@section('title', 'User Profile')
<style>
    /* .faq-section .mb-0>a {
        display: block;
        position: relative;
    }

    .faq-section .mb-0>a:after {
        content: "\f067";
        font-family: "Font Awesome 5 Free";
        position: absolute;
        right: 0;
        font-weight: 600;
    }

    .faq-section .mb-0>a[aria-expanded="true"]:after {
        content: "\f068";
        font-family: "Font Awesome 5 Free";
        font-weight: 600;
    } */
</style>
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="tabbable-responsive">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="basic-profile" data-toggle="tab" href="#basicProfile"
                                role="tab" aria-controls="basic_profile" aria-selected="true">Basic
                                Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="bank-profile" data-toggle="tab" href="#bankProfile" role="tab"
                                aria-controls="bank_profile" aria-selected="false">Bank
                                Profile</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="business-profile" data-toggle="tab" href="#businessProfile"
                                role="tab" aria-controls="business_profile" aria-selected="true">Business
                                Profile</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="basicProfile" role="tabpanel" aria-labelledby="basic-profile">
                    @if (Auth::user()->id == 1)
                        <div class="card mt-5">
                            <div class="title p-3">
                                <h4 class="text-center text-muted">This is Admin Account.</h4>
                            </div>
                        </div>
                    @else
                        <div class="submit-form">
                            @if (isset($user->documents))
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <form role="form" method="post" action="{{ route('user.submitProfile') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" class="form-control" id="user_id" name="user_id"
                                                value="{{ isset($user->id) ? $user->id : ' ' }}" />
                                            <div class="form-group">
                                                <label for="name">Full Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter full name"
                                                    value="{{ isset($user->name) ? $user->name : ' ' }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter an email"
                                                    value="{{ isset($user->email) ? $user->email : ' ' }}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="pancard">Pan Card</label>
                                                <input type="file" class="form-control" id="pancard" name="pancard" />
                                            </div>
                                            <div class="form-group">
                                                <label for="aadharcard">Aadhar Card</label>
                                                <input type="file" class="form-control" id="aadharcard"
                                                    name="aadharcard" />

                                            </div>
                                            <div class="form-group">
                                                <label for="bankstatement">Bank Statement</label>
                                                <input type="file" class="form-control" id="bankstatement"
                                                    name="bankstatement" />
                                            </div>
                                            <div class="form-group">
                                                <label for="otherdocument">Other</label>
                                                <input type="file" class="form-control" id="otherdocument"
                                                    name="otherdocument" />
                                            </div>
                                            <!-- Other file upload fields -->
                                            <div class="row justify-content-center">
                                                <button type="submit"
                                                    class="btn btn-primary btn-sm btn-block w-50">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        @php
                                            $pancardDocument = Storage::disk('s3')->temporaryUrl(
                                                '/regtechdoc' . $user->documents->pancard_document,
                                                now()->addMinutes(50),
                                            );
                                            $aadharDocument = Storage::disk('s3')->temporaryUrl(
                                                '/regtechdoc' . $user->documents->aadharcard_document,
                                                now()->addMinutes(50),
                                            );
                                            $bankDocument = Storage::disk('s3')->temporaryUrl(
                                                '/regtechdoc' . $user->documents->bank_document,
                                                now()->addMinutes(50),
                                            );
                                            $otherDocument = Storage::disk('s3')->temporaryUrl(
                                                '/regtechdoc' . $user->documents->other_document,
                                                now()->addMinutes(50),
                                            );
                                            $pancard_file_exe = pathinfo(
                                                $user->documents->pancard_document,
                                                PATHINFO_EXTENSION,
                                            );
                                            $aadharcard_file_exe = pathinfo(
                                                $user->documents->aadharcard_document,
                                                PATHINFO_EXTENSION,
                                            );
                                            $bankcard_file_exe = pathinfo(
                                                $user->documents->bank_document,
                                                PATHINFO_EXTENSION,
                                            );
                                            $othercard_file_exe = pathinfo(
                                                $user->documents->other_document,
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp
                                        <div class="row">
                                            <div class=" col-md-6">
                                                <div class="mt-5">

                                                    @if (!empty($user->documents->pancard_document) && $user->documents->pancard_document != null)
                                                        <h5 class="text-center"><strong>Pan Card Document.</strong></h5>
                                                        @if (!empty($pancard_file_exe) && $pancard_file_exe == 'pdf')
                                                            <div class="text-center">
                                                                <a href="{{ $pancardDocument }}" target="_blank">
                                                                    <button class="btn btn-success btn-sm"
                                                                        style="margin-top:10px;">Download Pdf</button>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="text-center">
                                                                <img src="{{ $pancardDocument }}"
                                                                    style="width:200; height:200;object-fit:fill;" />
                                                                <br />
                                                                <a href="{{ $pancardDocument }}" target="_blank">
                                                                    <button class="btn btn-success btn-sm"
                                                                        style="margin-top:10px;">Download Image</button>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mt-5">
                                                    @if (!empty($user->documents->aadharcard_document) && $user->documents->aadharcard_document != null)

                                                        <h5 class="text-center"><strong>Aadhar Card Document.</strong></h5>
                                                        @if (!empty($aadharcard_file_exe) && $aadharcard_file_exe == 'pdf')
                                                            <div class="text-center">

                                                                <a href="{{ $aadharDocument }}" target="_blank">
                                                                    <button class="btn btn-success btn-sm"
                                                                        style="margin-top:10px;">Download Pdf</button>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="text-center">
                                                                <img src="{{ $aadharDocument }}"
                                                                    style="width:200; height:200;object-fit:fill;" />
                                                                <br />
                                                                <a href="{{ $aadharDocument }}" target="_blank">
                                                                    <button class="btn btn-success btn-sm"
                                                                        style="margin-top:10px;">Download Image</button>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="div col-md-6">
                                                <div class="mt-5">
                                                    @if (!empty($user->documents->bank_document) && $user->documents->bank_document != null)
                                                        <h5 class="text-center"><strong> Bank Document.</strong></h5>
                                                        <div class="">

                                                            @if (!empty($bankcard_file_exe) && $bankcard_file_exe == 'pdf')
                                                                <div class="text-center">
                                                                    <a href="{{ $bankDocument }}" target="_blank">
                                                                        <button class="btn btn-success btn-sm"
                                                                            style="margin-top:10px;">Download Pdf</button>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div class="text-center">
                                                                    <img src="{{ $bankDocument }}"
                                                                        style="width:200;height:200;object-fit:fill;"
                                                                        alt="no image" />
                                                                    <br />
                                                                    <a href="{{ $bankDocument }}" target="_blank">
                                                                        <button class="btn btn-success btn-sm"
                                                                            style="margin-top:10px;">Download
                                                                            Image</button>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mt-5">
                                                    @if (!empty($user->documents->other_document) && $user->documents->other_document != null)
                                                        <h5 class="text-center"><strong>Others Document.</strong></h5>
                                                        <div class="">
                                                            @if (!empty($othercard_file_exe) && $othercard_file_exe == 'pdf')
                                                                <div class="text-center">
                                                                    <a href="{{ $otherDocument }}" target="_blank">
                                                                        <button class="btn btn-success btn-sm"
                                                                            style="margin-top:10px;">Download Pdf</button>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div class="text-center">
                                                                    <img src="{{ $otherDocument }}"
                                                                        style="width:200; height:200;object-fit:fill;" />
                                                                    <br />
                                                                    <a href="{{ $otherDocument }}" target="_blank">
                                                                        <button class="btn btn-success btn-sm"
                                                                            style="margin-top:10px;">Download
                                                                            Image</button>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form role="form" method="post" action="{{ route('user.submitProfile') }}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                                        value="{{ isset($user->id) ? $user->id : ' ' }}" />
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter full name"
                                            value="{{ isset($user->name) ? $user->name : ' ' }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter an email"
                                            value="{{ isset($user->email) ? $user->email : ' ' }}" />
                                    </div>
                                    <span style="font-size:18px;"><b>Upload Documents</b></span>
                                    <div class="form-group">
                                        <label for="pancard">Pan Card</label>
                                        <input type="file" class="form-control" id="pancard" name="pancard" />
                                    </div>
                                    <div class="form-group">
                                        <label for="aadharcard">Aadhar Card</label>
                                        <input type="file" class="form-control" id="aadharcard" name="aadharcard" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bankstatement">Bank Statement</label>
                                        <input type="file" class="form-control" id="bankstatement"
                                            name="bankstatement" />
                                    </div>
                                    <div class="form-group">
                                        <label for="otherdocument">Other</label>
                                        <input type="file" class="form-control" id="otherdocument"
                                            name="otherdocument" />
                                    </div>
                                    <!-- Other file upload fields -->
                                    <div class="row justify-content-center">
                                        <button type="submit"
                                            class="btn btn-primary btn-sm btn-block w-50">Submit</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endif

                </div>
                {{-- bank prfile --}}
                <div class="tab-pane fade" id="bankProfile" role="tabpanel" aria-labelledby="bank-profile">
                    <div class="text-center">
                        <span style="font-size:18px;font-weight:600;">Documents Details</span>
                    </div>
                    <div class="flex flex-column mb-5 mt-2 faq-section">
                        @if (count($users) > 0)
                            @foreach ($users as $key => $value)
                                <div id="accordion{{ $value->id }}" class="accordion">
                                    <div class="card">
                                        <div class="card-header collapsed" data-toggle="collapse"
                                            id="heading{{ $value->id }}" href="#collapseOne{{ $value->id }}"
                                            onclick="fetchDocuments({{ $value->id }})">
                                            <a class="">
                                                {{ $value->name }}
                                            </a>
                                        </div>
                                        <div id="collapseOne{{ $value->id }}" class="card-body collapse"
                                            data-parent="#accordion{{ $value->id }}">
                                            <div id="documentDetails{{ $value->id }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card mt-5">
                                <div class="title p-3">
                                    <h4 class="text-center text-muted">User has not create account yet.</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @stop
    @section('custom_js')
        <script>
            function fetchDocuments(user_id) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('user.documents') }}",
                    data: {
                        'user_id': user_id
                    },
                    success: function(response) {

                        if (response.documents && response.documents != null) {
                            let submitDate = new Date(response.submit_date);
                            let fullYear = submitDate.getFullYear();
                            let monthName = submitDate.getMonth() + 1;
                            let dayName = submitDate.getDate();
                            let pncard_doc = null;
                            let pncard_doc_exe = null;
                            if (response.documents.pancard_document) {
                                pncard_doc = response.documents.pancard_document;
                                pncard_doc_exe = pncard_doc.split('.').pop().toLowerCase();
                            }
                            let aadhar_doc_exe = null;
                            let aadhar_doc = null;
                            if (response.documents.aadharcard_document) {
                                aadhar_doc = response.documents.aadharcard_document;
                                aadhar_doc_exe = aadhar_doc.split('.').pop().toLowerCase();
                            }
                            let bank_doc = null;
                            let bank_doc_exe = null;
                            if (response.documents.bank_document) {
                                bank_doc = response.documents.bank_document;
                                bank_doc_exe = bank_doc.split('.').pop().toLowerCase();
                            }
                            let other_doc = null;
                            let other_doc_exe = null;
                            if (response.documents.other_document) {
                                other_doc = response.documents.other_document;
                                other_doc_exe = other_doc.split('.').pop().toLowerCase();
                            }
                            let username = response.user.name;
                            let email = response.user.email;
                            let user_id = response.user.id;
                            let container = document.getElementById('documentDetails' + user_id);
                            container.innerHTML = `
                    <div class="card">
                      <div class="card-header">
                          <span class="text-muted">
                             <strong>Document Submit Date</strong> :&nbsp;&nbsp;${dayName}/${monthName}/${fullYear}
                          </span>
                       </div>
                     <div class="card-body">
                           <div class="row">
                                 <div class="col-md-6 col-sm-6 col-lg-6">
                                         <!--Form Submit -->
                                  <form id="documentsUser" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                          <input type="hidden" class="form-control" id="user_id" name="user_id"
                                               value="${user_id}"/>
                                      <div class="form-group">
                                          <label for="name">Full Name</label>
                                          <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Enter full name"
                                               value="${username}" />
                                       </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter an email"
                                            value="${email}" />
                                    </div>
                                    <span style="font-size:18px;"><b>Upload Documents</b></span>
                                    <div class="form-group">
                                        <label for="pancard_docupload">Pan Card</label>
                                        <input type="file" class="form-control" id="pancard_docupload" name="pancard_docupload" />
                                      
                                        <span id="pancard_docupload_msg" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="aadharcard_docupload">Aadhar Card</label>
                                        <input type="file" class="form-control" id="aadharcard_docupload" name="aadharcard_docupload" />
                                      
                                        <span id="aadharcard_docupload_msg" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="bankstatement_docupload">Bank Statement</label>
                                        <input type="file" class="form-control" id="bankstatement_docupload"
                                            name="bankstatement_docupload" />
                                      
                                        <span id="bankstatement_docupload_msg" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="otherdocument_upload">Other</label>
                                        <input type="file" class="form-control" id="otherdocument_upload"
                                            name="otherdocument_upload" />
                                       
                                        <span id="otherdocument_upload_msg" style="color: red;"></span>
                                    </div>
                                    <!-- Other file upload fields -->
                                       <div class="row justify-content-center">
                                          <button type="submit"
                                            class="btn btn-primary btn-sm btn-block w-50">Submit</button>
                                        </div>
                                  </form>
                                         <!--Form Submit End-->
                                 </div>
                                 <div class="col-md-6 col-sm-6 col-lg-6">
                                        <!--show Image open-->
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-sm-6">
                                            <div class="mt-5">
                                                ${ response.documents.pancard_document?
                                                 ` <h5 class="text-center"><strong>Pan Card Document.</strong></h5>
                                                                          <div class="text-center">
                                                                            
                                                                          ${
                                                                           pncard_doc_exe=='pdf'?`
                                                   <a href="${response.document_pancard}" target="_blank">
                                                  <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Pdf</button> 
                                                  </a>`:`
                                                  <img src="${response.document_pancard}" style="width:200; height:200;object-fit:fill;"/>
                                                  <br/>
                                                   <a href="${response.document_pancard}" target="_blank">
                                                  <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Image</button> 
                                                   </a>
                                                 `  
                                                                         }
                                                                         </div>`
                                                 :``
                                                }
                                                 
                                                 
                                            </div>
                                            <div class="mt-5">
                                                ${ response.documents.aadharcard_document?`
                                                                         <h5 class="text-center"><strong>Aadhar Card Document.</strong></h5>
                                                                         <div class="text-center">
                                                                         ${
                                                                             aadhar_doc_exe=='pdf'?`
                                                   <a href="${response.aadhar_document}" target="_blank">
                                                     <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Pdf</button> 
                                                  </a>`:`<img src="${response.aadhar_document}" style="width:200; height:200;object-fit:fill;"/>
                                                  <br/>
                                                  <a href="${response.aadhar_document}" target="_blank">
                                                    <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Image</button> 
                                                   </a>
                                                  `  
                                                                         }
                                                                        </div>`
                                                :``
                                                 }
                                            </div>        
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-sm-6">
                                                <div class="mt-5">
                                                ${ response.documents.bank_document ? `
                                                                            <h5 class="text-center"><strong>Bank Document.</strong></h5>
                                                                            <div class="text-center">
                                                                         ${
                                                                             bank_doc_exe=='pdf'?`
                                                   <a href="${response.bank_document}" target="_blank">
                                                     <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Pdf</button> 
                                                  </a>`:`<img src="${response.bank_document}" style="width:200; height:200;object-fit:fill;"/>
                                                  <br/>
                                                  <a href="${response.bank_document}" target="_blank">
                                                    <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Image</button> 
                                                   </a>
                                                  `  
                                                                         }
                                                                        </div>
                                                                        
                                                                        `
                                                :``
                                                  }
                                               </div> 
                                               <div class="mt-5">
                                                ${ response.documents.other_document ? `
                                                                             <h5 class="text-center"><strong>Other Document.</strong></h5>
                                                                             <div class="text-center">
                                                                         ${ 
                                                                            other_doc_exe=='pdf'?`
                                                   <a href="${response.other_document}" target="_blank">
                                                     <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Pdf</button> 
                                                  </a>`:`<img src="${response.other_document}" style="width:200; height:200;object-fit:fill;"/>
                                                  <br/>
                                                  <a href="${response.other_document}" target="_blank">
                                                    <button class="btn btn-success btn-sm" style="margin-top:10px;">Download Image</button> 
                                                   </a>
                                                  `  
                                                                         }
                                                                        </div>
                                                                        `:``
                                                }
                                               </div>    
                                         </div>
                                         
                                       
                                                            
                                        <!--end Image close-->
                                        ${
                                            response.documents.other_document==null && response.documents.bank_document==null &&  response.documents.aadharcard_document==null &&  response.documents.pancard_document==null?`<div class="d-flex justify-content-center">Please upload any document</div>`:``
                                        }
                                   </div>
                              </div>
                      </div>
                    </div>
               </div>
           `;
                            $('#documentsUser').on('submit', function(event) {
                                event.preventDefault();
                                //  var documentUser = $(this).serialize();
                                var documentUser = new FormData(this);
                                $('#pancard_docupload_msg').text('');
                                $('#aadharcard_docupload_msg').text('');
                                $('#bankstatement_docupload_msg').text('');
                                $('#otherdocument_upload_msg').text('');
                                const obj = {};
                                documentUser.forEach((value, key) => {
                                    obj[key] = value;
                                });
                                console.log('obj: ',obj);
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: "{{ route('users.documents') }}", // Replace with your Laravel route
                                    type: 'POST',
                                    data: documentUser,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.statusCode == 200) {
                                            $('#pancard_docupload').val('');
                                            $('#aadharcard_docupload').val('');
                                            $('#bankstatement_docupload').val('');
                                            $('#otherdocument_upload').val('');
                                            $('#heading' + user_id).click();
                                            alert(response.message);
                                        } else {
                                            alert("Document is not upload.");
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                        if (xhr.status === 422) {
                                            var errors = xhr.responseJSON.errors;
                                            if (errors.pancard_docupload) {
                                                $('#pancard_docupload_msg').text(errors
                                                    .pancard_docupload);
                                            }
                                            if (errors.aadharcard_docupload) {
                                                $('#aadharcard_docupload_msg').text(errors
                                                    .aadharcard_docupload);
                                            }
                                            if (errors.bankstatement_docupload) {
                                                $('#bankstatement_docupload_msg').text(errors
                                                    .bankstatement_docupload);
                                            }
                                            if (errors.otherdocument_upload) {
                                                $('#otherdocument_upload_msg').text(errors
                                                    .otherdocument_upload);
                                            }
                                        }
                                    }
                                });

                            });
                        } else if (response.user != null) {
                            let username = response.user.name;
                            let email = response.user.email;
                            let user_id = response.user.id;
                            let container = document.getElementById('documentDetails' + user_id);
                            container.innerHTML = `
                            <div class="card">
                      <div class="card-header">
                          <span class="text-muted">
                            
                          </span>
                       </div>
                     <div class="card-body">
                           <div class="row">
                                 <div class="col-md-12 col-sm-12 col-lg-12">
                                         <!--Form Submit -->
                                         <form id="documentsUser" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                          <input type="hidden" class="form-control" id="user_id" name="user_id"
                                               value="${user_id}"/>
                                      <div class="form-group">
                                          <label for="name">Full Name</label>
                                          <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Enter full name"
                                               value="${username}" />
                                       </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter an email"
                                            value="${email}" />
                                    </div>
                                    <span style="font-size:18px;"><b>Upload Documents</b></span>
                                    <div class="form-group">
                                        <label for="pancard_docupload">Pan Card</label>
                                        <input type="file" class="form-control" id="pancard_docupload" name="pancard_docupload" />
                                      
                                        <span id="pancard_docupload_msg" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="aadharcard_docupload">Aadhar Card</label>
                                        <input type="file" class="form-control" id="aadharcard_docupload" name="aadharcard_docupload" />
                                      
                                        <span id="aadharcard_docupload_msg" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="bankstatement_docupload">Bank Statement</label>
                                        <input type="file" class="form-control" id="bankstatement_docupload"
                                            name="bankstatement_docupload" />
                                      
                                        <span id="bankstatement_docupload_msg" style="color: red;"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="otherdocument_upload">Other</label>
                                        <input type="file" class="form-control" id="otherdocument_upload"
                                            name="otherdocument_upload" />
                                       
                                        <span id="otherdocument_upload_msg" style="color: red;"></span>
                                    </div>
                                    <!-- Other file upload fields -->
                                       <div class="row justify-content-center">
                                          <button type="submit"
                                            class="btn btn-primary btn-sm btn-block w-50">Submit</button>
                                        </div>
                                  </form>
                                         <!--Form Submit End-->
                                 </div>
                      </div>
                    </div>
                  </div>
                    `
                            $('#documentsUser').on('submit', function(event) {

                                event.preventDefault();

                                var documentUser = new FormData(this);
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: "{{ route('users.documents') }}", // Replace with your Laravel route
                                    type: 'POST',
                                    data: documentUser,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.statusCode == 200) {
                                            $('#pancard_docupload').val('');
                                            $('#aadharcard_docupload').val('');
                                            $('#bankstatement_docupload').val('');
                                            $('#otherdocument_upload').val('');
                                            $('#heading' + user_id).click();

                                            alert(response.message);
                                        } else {
                                            alert("Document is not uploade.");
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                        if (xhr.status === 422) {
                                            // var errors = xhr.responseJSON.errors;
                                            // if (errors.pancard_docupload) {
                                            //     $('#pancard_docupload_msg').text(errors.pancard_docupload);
                                            // }if (errors.aadharcard_docupload) {
                                            //     $('#aadharcard_docupload_msg').text(errors.aadharcard_docupload);
                                            // }if (errors.bankstatement_docupload) {
                                            //     $('#bankstatement_docupload_msg').text(errors.bankstatement_docupload);
                                            // } if (errors.otherdocument_upload) {
                                            //     $('#otherdocument_upload_msg').text(errors.otherdocument_upload);
                                            // }
                                        }
                                    }
                                });

                            });
                        } else {
                            alert("No documents avaliable of users");
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
    @stop
