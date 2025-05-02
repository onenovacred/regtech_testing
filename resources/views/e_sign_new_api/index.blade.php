<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>E-Sign</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        form {

            max-width: 375px;
            margin: 10px auto;
            padding: 20px 20px;
            background: rgb(243 243 243 / 95%);
            border-radius: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        }


        h1 {
            margin: 0 0 10px 0;
            text-align: center;
            font-family: 'Oswald', Helvetica, sans-serif;
            font-size: 50px;
            transform: skewY(0deg);
            letter-spacing: 2px;
            word-spacing: -8px;
            color: rgb(110 0 0);
            text-shadow: 0px 3px 1px rgba(113, 83, 62, 0.5);
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin: 0 4px 8px 0;
        }

        button {
            padding: 8px 44px 8px 33px;
            color: #FFF;
            background-image: linear-gradient(to right, #bd2fd5 0%, #607D8B 51%, #3F51B5 100%);
            font-size: 19px;
            text-align: center;
            font-style: normal;
            border-radius: 5px;
            width: 100%;
            border: 1px solid #5a6a5f;
            border-width: 1px 1px 3px;
            box-shadow: 0 -1px 0 rgba(255, 255, 255, 0.1) inset;
            margin-bottom: 10px;

        }

        button,
        select {
            text-transform: none;
        }

        .choice_text {
            display: flex;
            justify-content: center;
        }
         label {
            display: block;
            margin-bottom: 8px;
            display: block;
            margin-bottom: 8px;
            font-size: 17px;
            color: black;
            font-weight: 500;
        }
       .request_xml_error {
            display: flex;
            text-align: justify;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #919191 !important;
            border-color: #9e8fa1e0 !important;
        }

        .btn-primary:hover {
            color: #fff !important;
            background-color: #0b1643 !important;
            border-color: #4b0858e0 !important;
        }
         @media screen and (max-device-width:640px) {

            form {
                max-width: 375px;
                margin: 10px auto;
                padding: 20px 20px;
                background: rgb(243 243 243 / 95%);
                border-radius: 20px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
            }
            .request_xml_error {
                display: flex;
                text-align: justify;
            }
         }
    </style>
</head>
<body>
    <div class="container-fluid background">
        <div class="row">
            <div class="col-md-12 mt-5">
                <form id="submitForm" method="post" enctype="multipart/form-data">
                    <h1>E-Sign</h1>
                    @csrf
                    <div class="col-md-12 col-sm-6">
                        <input type="hidden" name="access_token" value="{{$access_token}}"/>
                        <div class="form-group">
                            <label>Upload Sample Pdf File.<span style="font-weight:800;font-size:18px;color:red;">*</span></label>
                            <input type='file' name="pdf_file" class="form-control pdf_file" />
                            <span id="pdfError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="form-group">
                            <label>Name Show Signature.<span style="font-weight:800;font-size:18px;color:red;">*</span></label>
                            <input type='text' name="name_show_signature" class="form-control name_show_signature" />
                            <span id="name_show_signature" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="form-group">
                            <label>Location Show Signature.<span style="font-weight:800;font-size:18px;color:red;">*</span></label>
                            <input type='text' name="location_show_signature"
                                class="form-control location_show_signature" />
                            <span id="location_show_signature" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="form-group">
                            <label>Reason For Sign.<span style="font-weight:800;font-size:18px;color:red;">*</span></label>
                            <input type='text' name="reasone_for_signature"
                                class="form-control reasone_for_signature" />
                            <span id="reasone_for_signature" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6 mb-3">
                        <div class="form-group">
                            <label>Choose Option.<span style="font-weight:800;font-size:18px;color:red;">*</span></label>
                            <select name='choice_option' class="form-control choice_option">
                                <option value="">Select option</option>
                                <option value="one">E-Sign</option>
                            </select>
                            <span id="choose_option_error" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6 mb-3">
                        <div class="form-group">
                            <label>Signature Page option.<span style="font-weight:800;font-size:18px;color:red;">*</span></label>
                            <select name='page_options' class="form-control page_options" id="page_options">
                                <option value="">Select page method</option>
                                <option value="single">Single page</option>
                                <option value="all">All page</option>
                            </select>
                            <span id="page_options_error" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6 mb-3" id="stamp_signature">
                        <div class="form-group">
                            <label>Signature stamp insert page number.<span style="font-weight:800;font-size:18px;color:red;">*</span></label>
                            <input type='number' name="signature_stamp_page"
                                class="form-control" min="1"/>
                            <span id="signature_stamp_page" style="color: red;"></span>
                        </div>
                    </div>
                    <button type="submit" id="btn-submit">Submit</button>
                </form>
                <div class='getESign_xml'>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
               $("#submitForm").submit(function(e) {
               e.preventDefault();
                var formData = new FormData(this);
                $('#pdfError').text('');
                $('#name_show_signature').text('');
                $('#location_show_signature').text('');
                $('#reasone_for_signature').text('');
                $('#signature_stamp_page').text('');
                $('#choose_option_error').text('');
                $('#page_options_error').text('');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('esign_generatexmal') }}',
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.e_sign_xml != null) {
                           $('body').find('.getESign_xml').html(response.e_sign_xml);

                        } else if (response.e_unsign_xml) {
                             $('body').find('.getESign_xml').html(response.e_unsign_xml);
                        } else {
                            // $('body').find('.getESign_xml').html(response.e_unsign_xml);
                        }
                     },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors.pdf_file) {
                                $('#pdfError').text(errors.pdf_file);
                            }if (errors.name_show_signature) {
                                $('#name_show_signature').text(errors.name_show_signature);
                            }if (errors.location_show_signature) {
                                $('#location_show_signature').text(errors.location_show_signature);
                            } if (errors.reasone_for_signature) {
                                $('#reasone_for_signature').text(errors.reasone_for_signature);
                            }
                            if (errors.signature_stamp_page) {
                                $('#signature_stamp_page').text(errors.signature_stamp_page);
                            }
                            if (errors.choice_option) {
                                $('#choose_option_error').text(errors.choice_option);
                            }
                            if (errors.page_options) {
                                $('#page_options_error').text(errors.page_options);
                            }
                        }
                    }
                })
            });
            $('#stamp_signature').hide();
            $("#page_options").change(function(){
                  var selectedValue = $(this).val();
                if(selectedValue=="single"){
                    $('#stamp_signature').show();
                }
                else{
                    $('#stamp_signature').hide();
                }
            });

        });

    </script>
</body>

</html>
