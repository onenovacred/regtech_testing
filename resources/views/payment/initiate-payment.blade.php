<!DOCTYPE html>
<html lang="en">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f5f5f5;
        font-family: Arial, Helvetica, sans-serif;
    }

    .wrapper {
        background-color: #fff;
        width: 500px;
        padding: 25px;
        margin: 25px auto 0;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
    }

    .wrapper h2 {
        background-color: #fcfcfc;
        color:#44060f;
        font-size: 24px;
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
        border: 1px dotted #333;
    }

    h4 {
        padding-bottom: 5px;
        color: #7ed321;
    }

    .input-group {
        margin-bottom: 8px;
        width: 100%;
        position: relative;
        display: flex;
        flex-direction: row;
        padding: 5px 0;
    }

    .input-box {
        width: 100%;
        margin-right: 12px;
        position: relative;
    }

    .input-box:last-child {
        margin-right: 0;
    }

    .name {
        padding: 14px 10px 14px 50px;
        width: 100%;
        background-color: #fcfcfc;
        border: 1px solid #00000033;
        outline: none;
        letter-spacing: 1px;
        transition: 0.3s;
        border-radius: 3px;
        color: #333;
    }
     .other-name {
        padding: 14px 10px 14px 27px;
        width: 100%;
        background-color: #fcfcfc;
        border: 1px solid #00000033;
        outline: none;
        letter-spacing: 1px;
        transition: 0.3s;
        border-radius: 3px;
        color: #333;
    }

    .name:focus,
    .dob:focus {
        -webkit-box-shadow: 0 0 2px 1px #4e100e;
        -moz-box-shadow: 0 0 2px 1px #4e100e;
        box-shadow: 0 0 2px 1px #4e100e;
        border: 1px solid #4e100e;
    }

    .input-box .icon {
        width: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0px;
        left: 0px;
        bottom: 0px;
        color: #333;
        background-color:#f1f1f1;
        border-radius: 2px 0 0 2px;
        transition: 0.3s;
        font-size: 20px;
        pointer-events: none;
        border: 1px solid #00000033;
        border-right: none;
    }

    .name:focus+.icon {
        background-color:#4e100e;
        color: #fff;
        border-right: 1px solid #f1f1f1;
        border: none;
        transition: 1s;
    }

    .dob {
        width: 30%;
        padding: 14px;
        text-align: center;
        background-color: #fcfcfc;
        transition: 0.3s;
        outline: none;
        border: 1px solid #c0bfbf;
        border-radius: 3px;
    }

    .radio {
        display: none;
    }

    .input-box label {
        width: 50%;
        padding: 13px;
        background-color: #fcfcfc;
        display: inline-block;
        float: left;
        text-align: center;
        border: 1px solid #c0bfbf;
    }

    .input-box label:first-of-type {
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
        border-right: none;
    }

    .input-box label:last-of-type {
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
    }

    .radio:checked+label {
        background-color: #7ed321;
        color: #fff;
        transition: 0.5s;
    }

    .input-box select {
        display: inline-block;
        width: 50%;
        padding: 12px;
        background-color: #fcfcfc;
        float: left;
        text-align: center;
        font-size: 16px;
        outline: none;
        border: 1px solid #c0bfbf;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .input-box select:focus {
        background-color: #7ed321;
        color: #fff;
        text-align: center;
    }

    button {
        width: 100%;
        background: transparent;
        border: none;
        background:#4e100e;
        color: #fff;
        padding: 15px;
        border-radius: 4px;
        font-size: 16px;
        transition: all 0.35s ease;
    }

    button:hover {
        cursor: pointer;
        background: #7a0f0a;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment Form</title>
    <link href="paymentform.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <h2>Payment</h2>
        <form action='{{route("payment-integration-post")}}' method="POST">
        @csrf

            <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="Full Name" name='name' required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Amount"  name='amount' required class="name">
                    <i class="fa-solid fa-indian-rupee-sign icon"></i>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input type="email" placeholder="Email Adress"  name='email' required class="name">
                    <i class="fa fa-envelope icon"></i>
                </div>

            </div>
            <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="Product Info"  name='productinfo' required class="name">
                    <i class="fa-brands fa-product-hunt icon"></i>
                </div>

            </div>

            <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="Mobile no"  name='phone' required class="name">
                   <i class="fa-solid fa-mobile-retro icon"></i>
                </div>

            </div>
             <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="Zip Code"  name='zip_code' required class="other-name">

                </div>
             </div>
             <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="State"  name='state' required class="other-name">

                </div>
             </div>
             <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="Country"  name='country' required class="other-name">
                </div>
             </div>
            <div class="input-group">
                <div class="input-box">
                    <button type="submit">PAY NOW</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js"></script>

<script>
    
</script>
