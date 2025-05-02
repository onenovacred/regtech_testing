<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form role="form" method="post" action="{{route('kyc.payment')}}" enctype="multipart/form-data"">
{{csrf_field()}}
  <div class="container">
    <!-- <h1>Register</h1>
    <p>Please fill in this form to create an account.</p> -->
    <hr>
    <label for="key"><b>Key</b></label>
        <input type="text" placeholder="Enter key" name="key" id="key" required>
    <label for="salt"><b>Salt</b></label>
        <input type="text" placeholder="Enter salt" name="salt" id="salt" required>
    <label for="txnid"><b>Txnid</b></label>
        <input type="text" placeholder="Enter Texnid" name="txnid" id="txnid" required>
    <label for="amount"><b>Amount</b></label>
        <input type="text" placeholder="Enter Amount" name="amount" id="amount" required>  
    <label for="productinfo"><b>Product Info</b></label>
        <input type="text" placeholder="Enter Product Info" name="productinfo" id="productinfo" required> 
    <label for="surl"><b>Surl</b></label>
        <input type="text" placeholder="Enter Surl" name="surl" id="surl" required>
    <label for="furl"><b>Furl</b></label>
        <input type="text" placeholder="Enter Furl" name="furl" id="furl" required>
    <label for="api_version"><b>API Version</b></label>
        <input type="text" placeholder="Enter Version" name="api_version" id="api_version" required> 
    <label for="si"><b>Si</b></label>
        <input type="text" placeholder="Enter Si" name="si" id="si" required>   
    <label for="firstname"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" required>
    <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>
    <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" id="phone" required>
    <label for="billingamount"><b>Billing Amount</b></label>
        <input type="text" placeholder="Enter Billing Amount" name="billingamount" id="billingamount" required>
    <label for="billingcurrencey"><b>Billing Currency</b></label>
        <input type="text" placeholder="Enter Email" name="billingcurrencey" id="billingcurrencey" required>
    <label for="billingcycle"><b>Billing Cycle</b></label>
        <input type="text" placeholder="Enter Billing Cycle" name="billingcycle" id="billingcycle" required>
    <label for="billinginterval"><b>Billing Interval</b></label>
        <input type="text" placeholder="Enter Billing Interval" name="billinginterval" id="billinginterval" required>
    <label for="startdate"><b>Payment Start Date</b></label>
        <input type="text" placeholder="Enter Payment Start Dat" name="startdate" id="startdate" required>
    <label for="enddate"><b>Payment End Date</b></label>
        <input type="text" placeholder="Enter Payment End Date" name="enddate" id="enddate" required>
    <label for="hash"><b>Hash</b></label>
        <input type="text" placeholder="Enter Hash" name="hash" id="hash" required>

    
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn">Register</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="#">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
