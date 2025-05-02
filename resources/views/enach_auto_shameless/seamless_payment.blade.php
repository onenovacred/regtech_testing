<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

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
            max-width: 650px;
            margin: auto;
            color: black;
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
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

        .form-control option {
            color: rgb(55, 54, 54);
            background-color: #ffffff;
            border: 2px solid #766969;
            /* height: 45px; */
            padding-left: 20px;
            vertical-align: middle;
        }

        .form-control:focus option {
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

        .text_p {
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
            <p class="h8 py-3">Enach Auto Debit</p>
            <form role="form" method="post" action="{{ url('seamless_payment_submit') }}">
                
                <div class="row gx-3">
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <input type="hidden" name="access_key" value="{{ $access_key }}" id="access_key" />
                            <p class="text_p mb-1">Account no<span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3" placeholder="Enter Account no"
                                name="account_no" id="account_no" />
                            @error('account_no')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Ifsc<span class="mandatory-mark">*</span></p>
                            <input type="text" class="form-control mb-3" placeholder="Enter ifsc" name="ifsc"
                                id="ifsc" />
                            @error('ifsc')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Bank Code<span class="mandatory-mark">*</span></span></p>
                            <input type="text" class="form-control mb-3 pt-2" placeholder="Enter Bank Code"
                                name="bank_code" id="bank_code" />
                            @error('bank_code')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Account Type<span class="mandatory-mark">*</span></p>
                            <select name="account_type" class="form-control mb-3" id="account_type">
                                <option value=" ">Select Account Type</option>
                                <option value="SAVINGS">SAVINGS</option>
                                <option value="CURRENT">CURRENT</option>
                            </select>
                            @error('account_type')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Auth Mode<span class="mandatory-mark">*</span></p>
                            <select name="auth_mode" id="auth_mode" class="form-control mb-3">
                                <option value=" ">Select Auth Mode</option>
                                <option value="NetBanking">NetBanking</option>
                                <option value="DebitCard">DebitCard</option>
                                <option value="Paperbase">Paperbase</option>
                            </select>
                            @error('auth_mode')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text_p mb-1">Payment Mode<span class="mandatory-mark">*</span></p>
                            <select name="payment_mode" class="form-control mb-3" id="payment_mode">
                                <option value=" ">Select Payment Mode</option>
                                <option value="EN">Debit Card</option>
                                <option value="EN">NetBanking</option>
                            </select>
                            @error('payment_mode')
                                <div class="validation-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <input type='submit' class="btn btn-primary mb-3" value="Save Now" />
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
