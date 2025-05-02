<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #a46cca;
            padding: 30px 10px;
        }
       .card {
            max-width:650px;
            margin: auto;
            color: black;
            border-radius:20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        }
        .card:hover {
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        p {
            margin: 0px;
        }

        .container .h8 {
            font-size: 30px;
            font-weight: 800;
            text-align: center;
        }

        .btn.btn-primary {
            width: 100%;
            height: 45px;
            padding: 0 15px;
            background-image: linear-gradient(to right, #680e2b 0%, #e3a1a1 51%, #91041d 100%);
            border: none;
            transition: 0.5s;
            background-size: 200% auto;

        }


        .btn.btn.btn-primary:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }



        .btn.btn-primary:hover .fas.fa-arrow-right {
            transform: translate(15px);
            transition: transform 0.2s ease-in;
        }

        .form-control {
            /* color: white; */
            background-color: #dcdcdd;
            border: 2px solid #766969;
            /* height: 45px; */
            padding-left: 20px;
            vertical-align: middle;
        }
        .form-control option{
            color: rgb(55, 54, 54);
            background-color: #ffffff;
            border: 2px solid #766969;
            /* height: 45px; */
            padding-left: 20px;
            vertical-align: middle;
        }
        .form-control:focus option{
            color: rgb(55, 54, 54);
            background-color: #d0cccc;
            border: 2px solid #766969;
            /* height: 45px; */
            padding-left: 20px;
            vertical-align: middle;
        }
        .form-control:focus {
            color: rgb(46, 45, 45);
            background-color: #f4f4fa;
            border: 2px solid #363433;
            box-shadow: none;
        }

        .text {
            font-size: 16px;
            font-weight: 500;
        }
        .text_p{
            font-size: 15px;
            font-weight: 600;
        }

        ::placeholder {
            font-size: 14px;
            font-weight: 600;
        }

        .mandatory-mark {
            margin-left: 3px;
            color: red;
            font-size: 18px;
            font-weight: 800;
        }

        .validation-message {
            color: red;
            font-weight: 500;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .amount-udf5 {
            font-size: 15px;
            font-weight: bold;
            font-family: sans-serif;
        }

        .fa-circle-info {
            padding-left: 5px !important;
            cursor: pointer;
        }
       .h8 {
            text-align: center;
            font-family: 'Oswald', Helvetica, sans-serif;
            font-size: 90px;
            transform: skewY(0deg);
            letter-spacing: 4px;
            word-spacing: -8px;
            color:rgba(142, 32, 32, 0.796);
            text-shadow: 2px 2px 5px rgba(129, 111, 111, 0.5);
        }
    </style>
</head>
<body>
    <div class="container p-0">
        <div class="card px-4">
            <p class="h8 py-3">E Mandate</p>
            <form role="form" method="post" action="{{ route('enach_seameless_submit') }}">
                {{ csrf_field() }}
                <div class="row gx-3">
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Amount <span class="fa-sharp fa-solid fa-circle-info amount"></span><span class="mandatory-mark">*</span></p>
                            <input type="hidden" id="access_token" name="access_token" value="{{$access_token}}">
                            <input type="text" class="form-control mb-3" placeholder="Enter Amount" name="amount"
                                id="amount">
                            @error('amount')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Product Info<span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3" placeholder="Enter Product Info"
                                name="productinfo" id="productinfo" />
                            @error('productinfo')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Firstname <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter Firstname"
                                name="firstname" id="firstname" />
                            @error('firstname')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Phone <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter Phone"
                                name="phone" id="phone" />
                            @error('phone')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Email <span class="mandatory-mark">*</span></span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter email"
                                name="email" id="email" />
                            @error('email')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">udf1 <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter udf1" name="udf1"
                                id="udf1" />
                            @error('udf1')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">udf2 <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter udf2" name="udf2"
                                id="udf2" />
                            @error('udf2')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">udf3 <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter udf3" name="udf3"
                                id="udf3" />
                            @error('udf3')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">udf4 <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter udf4"
                                name="udf4" id="udf4" />
                            @error('udf4')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">udf5<span class="fa-sharp fa-solid fa-circle-info udf5"></span><span
                                    class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter udf5"
                                name="udf5"  />
                            @error('udf5')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">udf6 <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter udf6"
                                name="udf6" id="udf6" />
                            @error('udf6')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">udf7 <span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter udf7"
                                name="udf7" id="udf7" />
                            @error('udf7')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1"><b>Address</b></p>
                            <textarea placeholder="Enter Address" class="form-control mb-3 pt-2" name="address_one" id="address_one"
                                rows="4" cols="70"></textarea>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">City</p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter City"
                                name="city" id="city" />
                             </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Country</p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter country"
                                name="country" id="country" />

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Zip Code</p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter zip code"
                                name="zip_code" id="zip_code" />

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Final Collection Date <span class="fa-sharp fa-solid fa-circle-info final-collection-date"></span></p>
                            <input type="date" class="form-control mb-3 pt-2" name="final_collection_date"
                                id="final-collection-date"  min="{{ now()->toDateString() }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Payment Mode</p>
                            <select name="payment_mode" class="form-control mb-3 pt-2" id="payment_mode">
                                <option>Select Payment Mode</option>
                                <option value="EN">Debit Card</option>
                                <option value="EN">NetBanking</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type='submit' class="btn btn-primary mb-3" value="Pay Now" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.udf5').popover({
                content: function() {
                    var infoDetails =
                        '<span class="amount-udf5"><small>In Udf5 maximum amount should be above from amount. </small></span>';
                    return infoDetails;
                },
                trigger: 'hover', // Show popover on click (you can use 'hover' if you want to show on hover)
                placement: 'right',
                html: true
            });
            $('.amount').popover({
                content: function() {
                    var infoDetails =
                        '<span class="amount-udf5"><small>Amount will be initiate from one rupay like 1.0</small></span>';
                    return infoDetails;
                },
                trigger: 'hover', // Show popover on click (you can use 'hover' if you want to show on hover)
                placement: 'right',
                html: true
            });
            $('.final-collection-date').popover({
                content: function() {
                    var infoDetails =
                        '<span class="amount-udf5"><small>Final collection date will be by default 1 year from mandate registration date </small></span>';
                    return infoDetails;
                },
                trigger: 'hover', // Show popover on click (you can use 'hover' if you want to show on hover)
                placement: 'right',
                html: true
            });
        })
    </script>
</body>

</html>
