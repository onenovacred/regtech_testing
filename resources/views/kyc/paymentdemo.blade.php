<?php

$key="QyT13U";
$salt="UnJ0FGO0kt3dUgnHo9Xgwi0lpipBV0hB"; 
   

    $action = '';

    $txnid = isset($_POST['txnid']) ? $_POST['txnid'] : 'reg-' . round(microtime(true) * 1000);
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '1.00';
    $productinfo = isset($_POST['productinfo']) ? $_POST['productinfo'] : 'SI Registration';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : 'Test Name';
    $email = isset($_POST['email']) ? $_POST['email'] : 'test@gmail.com';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '9876543210';
    $url = isset($_SERVER['HTTPS']) ? 'https"//' : 'http://' . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/'));
    $surl = $url . '/response.php';
    $furl = $url . '/response.php';

    $api_version = '7';
    $si = '1';
    $free_trial = '';

    $billingCycle = isset($_POST['billingCycle']) ? $_POST['billingCycle'] : 'DAILY';
    $billingInterval = isset($_POST['billingInterval']) ? $_POST['billingInterval'] : '1';
    $billingAmount = isset($_POST['billingAmount']) ? $_POST['billingAmount'] : '1.00';
    $billingCurrency = 'INR';
    $paymentStartDate = isset($_POST['paymentStartDate']) ? $_POST['paymentStartDate'] : date('Y-m-d');
    $paymentEndDate = isset($_POST['paymentEndDate']) ? $_POST['paymentEndDate'] : date('Y-m-d', strtotime('+5 day'));

    $si_details = array('billingCycle'=>$billingCycle, 'billingInterval'=>$billingInterval, 'billingAmount'=>$billingAmount, 'billingCurrency'=>$billingCurrency, 'paymentStartDate'=>$paymentStartDate, 'paymentEndDate'=>$paymentEndDate);
    $si_details = json_encode($si_details);

    $hash = '';

    if(!empty($_POST)) {
        $hash = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $si_details . '|' . $salt;
        
       // $hashsequence = $hash;
        
        $hash = hash('sha512', $hash);
        

        $action = 'https://test.payu.in/_payment';
        //$action = 'https://secure.payu.in/_payment';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI</title>
    <style>
        html, body, h2 { margin: 0; padding: 0; font-family: arial; }
        div { padding: 5px; }
        label { display: inline-block; padding: 2px; width: 150px; }
        input[type='text'], [type='date'], select { padding: 2px; width: 250px; }
        input[type='submit'] { padding: 2px; width: 100px; }
    </style>
    <script>
        function submitPayuForm() {
            var hash = '<?php echo $hash ?>';
            if(hash !== '') {
                var payu_form = document.forms.payu_form;
                payu_form.submit();
            }
        }
    </script>
</head>
<body onload="submitPayuForm()">
    <div>
        <div>
            <h2>PayU SI Transaction</h2>
        </div>
        <form action="<?php echo $action ?>" method="post" name="payu_form">
            <div style="display: none;">
                <label for="key">Key</label>
                <input type="text" name="key" id="key" value="<?php echo $key ?>">
            </div>
            <div>
                <label for="txnid">Txn Id</label>
                <input type="text" name="txnid" id="txnid" value="<?php echo isset($_POST['txnid']) ? $_POST['txnid'] : $txnid ?>">
            </div>
            <div>
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : $amount ?>">
            </div>
            <div>
                <label for="productinfo">Product Info</label>
                <input type="text" name="productinfo" id="productinfo" value="<?php echo isset($_POST['productinfo']) ? $_POST['productinfo'] : $productinfo ?>">
            </div>
            <div>
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : $firstname ?>">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $email ?>">
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $phone ?>">
            </div>
            <div>
                <label for="surl">Surl</label>
                <input type="text" name="surl" id="surl" value="<?php echo isset($_POST['surl']) ? $_POST['surl'] : $surl ?>">
            </div>
            <div>
                <label for="furl">Furl</label>
                <input type="text" name="furl" id="furl" value="<?php echo isset($_POST['furl']) ? $_POST['furl'] : $furl ?>">
            </div>
            <div>
                <label for="api_version">API Version</label>
                <input type="text" name="api_version" id="api_version" value="<?php echo isset($_POST['api_version']) ? $_POST['api_version'] : $api_version ?>">
            </div>
            <div>
                <label for="si">SI</label>
                <input type="text" name="si" id="si" value="<?php echo isset($_POST['si']) ? $_POST['si'] : $si ?>">
            </div>
            <div>
                <label for="free_trial">Free Trial</label>
                <input type="text" name="free_trial" id="free_trial" value="<?php echo isset($_POST['free_trial']) ? $_POST['free_trial'] : $free_trial ?>">
            </div>
            <div>
                <label for="si_details" style="font-weight: bold">SI Details</label>
                <div>
                    <label for="billingCycle">Billing Cycle</label>
                    <select name="billingCycle" id="billingCycle">
                        <option value="DAILY" <?php if(isset($_POST['billingCycle']) && $_POST['billingCycle'] == 'DAILY') echo 'selected' ?>>DAILY</option>
                        <option value="WEEKLY" <?php if(isset($_POST['billingCycle']) && $_POST['billingCycle'] == 'WEEKLY') echo 'selected' ?>>WEEKLY</option>
                        <option value="MONTHLY" <?php if(isset($_POST['billingCycle']) && $_POST['billingCycle'] == 'MONTHLY') echo 'selected' ?>>MONTHLY</option>
                        <option value="YEARLY" <?php if(isset($_POST['billingCycle']) && $_POST['billingCycle'] == 'YEARLY') echo 'selected' ?>>YEARLY</option>
                        <option value="ONCE" <?php if(isset($_POST['billingCycle']) && $_POST['billingCycle'] == 'ONCE') echo 'selected' ?>>ONCE</option>
                        <option value="ADHOC" <?php if(isset($_POST['billingCycle']) && $_POST['billingCycle'] == 'ADHOC') echo 'selected' ?>>ADHOC</option>
                    </select>
                </div>
                <div>
                    <label for="billingInterval">Billing Interval</label>
                    <input type="text" name="billingInterval" id="billingInterval" value="<?php echo isset($_POST['billingInterval']) ? $_POST['billingInterval'] : $billingInterval ?>">
                </div>
                <div>
                    <label for="billingAmount">Billing Amount</label>
                    <input type="text" name="billingAmount" id="billingAmount" value="<?php echo isset($_POST['billingAmount']) ? $_POST['billingAmount'] : $billingAmount ?>">
                </div>
                <div>
                    <label for="billingCurrency">Billing Currency</label>
                    <input type="text" name="billingCurrency" id="billingCurrency" value="<?php echo isset($_POST['billingCurrency']) ? $_POST['billingCurrency'] : $billingCurrency ?>">
                </div>
                <div>
                    <label for="paymentStartDate">Payment Start Date</label>
                    <input type="date" name="paymentStartDate" id="paymentStartDate" value="<?php echo isset($_POST['paymentStartDate']) ? $_POST['paymentStartDate'] : $paymentStartDate ?>">
                </div>
                <div>
                    <label for="paymentEndDate">Payment End Date</label>
                    <input type="date" name="paymentEndDate" id="paymentEndDate" value="<?php echo isset($_POST['paymentEndDate']) ? $_POST['paymentEndDate'] : $paymentEndDate ?>">
                </div>
                <div style="display: none;">
                    <input type="text" name="si_details" id="si_details" value="<?php echo htmlspecialchars($si_details) ?>">
                </div>
            </div>
            <div style="display: none;">
                <label for="hash">Hash</label>
                <input type="text" name="hash" id="hash" value="<?php echo $hash ?>">
            </div> 

            <!-- <div style="display: none;">
                <label for="hash">Hash_sequence</label>
                <input type="hidden" name="hashsequence" id="hashsequence" value=''>
            </div>  -->

            
            
                <input type="submit" value="Pay">
            </div>
        </form>
    </div>
</body>
</html>
