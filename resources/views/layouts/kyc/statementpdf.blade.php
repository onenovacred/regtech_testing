<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        header {
            top: 0px;
            left: 0px;
            right: 0px;
        }

        footer {
            bottom: 0;
            height: 25px;
            left: 0;
            position: relative;
            width: 100%;
        }

        body {
            font-size: 13px;
        }

        .container: {
            background-color: white;
        }

        table {
            width: 100%;
        }

        .data-title {
            background-color: #8B0000;
            color: #FFFFFF;
            height: 20px;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;
        }
      .header h3 {
            margin: auto;
        }

        h3 {
            color: white;
        }

        .data-field {
            color: grey;
        }

        .bank_statement_header {
            color: grey;
            text-align: center;
        }

        body {
            height: 100%;
            width: 100%;
        }

        .td-style {
            color: #8B0000;
            font-style: italic;
        }

        .td-elements span {
            color: grey;
            font-style: italic;
        }

        .table-style tr:nth-child(even) {
            background: #CCC
        }

        .table-style tr:nth-child(odd) {
            background: #FFF
        }
		.bank_account{
			display: flex;
		}
		.column{
			flex:33.33%;
		}
		@media (max-width: 768px) {
			body {
            height: 100%;
            width: 100%;
          }
			.bank_account{
			display: flex;
		    }
			.column{
			flex:33.33%;
	    	}
     }

    @media (min-width: 769px) and (max-width: 1024px) {

		.bank_account{
			display: flex;
		}
		.column{
			flex:33.33%;
		 }
     }
  </style>

</head>

<body>
    <header>
        <div class = "header">
            <div class="row">
                <div class="col-md-4 offset-md-3">
                    <img src="https://www.regtechapi.in/public/logos/regtech.png" alt="logo"
                        style="margin-left:49px;margin-bottom:6px;width: 75px;height: 68px;">
                </div>
                <img src="https://www.regtechapi.in/public/logos/regtech4.png" alt="logo"
                    style="margin-left: 29px;width: 130px;height: 31px;">

            </div>
        </div>
    </header>
    <main>
        <hr>
        <div class="row">

            <h1 class="bank_statement_header">Bank Account</h1>
            <div class="bank_account">
               
                    <div class="column">
                        <p style="margin-top:10px;font-size:17px;"><strong style="font-size:17px;">Account
                                Name:&nbsp;&nbsp;</strong>{{ isset($bankstatment['bank_account']['accountName']) ? $bankstatment['bank_account']['accountName'] : ' ' }}
                        </p>
                        <p style="margin-top:10px;font-size:17px;"><strong style="font-size:17px;">Account
                                Number:&nbsp;&nbsp;</strong>{{ isset($bankstatment['bank_account']['accountNumber']) ? $bankstatment['bank_account']['accountNumber'] : ' ' }}
                        </p>
                    </div>
                    <div class="column">
                        <p style="margin-top:10px;font-size:17px;"><strong style="font-size:17px;">Bank
                                Name:&nbsp;&nbsp;</strong>{{ isset($bankstatment['bank_account']['bankName']) ? $bankstatment['bank_account']['bankName'] : ' ' }}
                        </p>
                        <p style="margin-top:10px;font-size:17px;"><strong style="font-size:17px;">Account
                                Type:&nbsp;&nbsp;</strong>{{ isset($bankstatment['bank_account']['accountType']) ? $bankstatment['bank_account']['accountType'] : ' ' }}
                        </p>
                    </div>
                    <div class="column">
                        <p style="margin-top:10px;font-size:17px;"><strong style="font-size:17px;">Email
                                Id:&nbsp;&nbsp;</strong>{{ isset($bankstatment['bank_account']['email']) ? $bankstatment['bank_account']['email'] : ' ' }}
                        </p>
                        <p style="margin-top:10px;font-size:17px;"><strong style="font-size:17px;">Mobile
                                No:&nbsp;&nbsp;</strong>{{ isset($bankstatment['bank_account']['mobile']) ? $bankstatment['bank_account']['mobile'] : ' ' }}
                        </p>
                    </div>
            </div>
            {{-- <table>
					<thead>
					   <tr>
						
					   </tr>
					</thead>
					<tbody>
					  <tr>
							<td>
							  
						   </td>
						   <td>
							 
						   </td>
						   <td>
							 
						   </td>
					   </tr>
					  </tbody>
			  </table> --}}

        </div>
        <hr />
        <div class = "row">
            <table>
                <thead>
                    <tr>
                        <h1 class="bank_statement_header">Bank Statement</h1>
                    </tr>
                </thead>
            </table>

        </div>
        <hr />
        <div class="row">
            <table cellspacing="0">
                <thead class="data-title">
                    <tr>
                        <td>Date</td>
                        <td>Transaction Id</td>
                        <td>Description</td>
                        <!-- <td>TransactionNo</td> -->
                        <td>Category</td>
                        <td>Type</td>
                        <td>Amount</td>
                        <td>Balance</td>

                    </tr>
                </thead>
                <tbody class="table-style">
                    @foreach ($bankstatment['transactions'] as $statmendatas)
                        <tr>
                            <td>{{ isset($statmendatas['dateTime']) ? $statmendatas['dateTime'] : '' }}</td>
                            <td>{{ isset($statmendatas['transactionId']) ? $statmendatas['transactionId'] : '' }}</td>
                            <td>{{ isset($statmendatas['transactionNumber']) ? $statmendatas['description'] : '' }}
                            </td>
                            <td>{{ isset($statmendatas['category']) ? $statmendatas['category'] : '' }}</td>
                            <td>{{ isset($statmendatas['type']) ? $statmendatas['type'] : '' }}</td>
                            <td>{{ isset($statmendatas['amount']) ? $statmendatas['amount'] : '' }}</td>
                            <td>{{ isset($statmendatas['balanceAfterTransaction']) ? $statmendatas['balanceAfterTransaction'] : '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
    </main>
    <footer class="footer">
        <hr tyle = "color:red;">
        <div class="footer__inner">
            <h3 style="color:darkblue;margin-left:40px">@ Powered by RegTech
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email:
                support@regtech.in</h3>
        </div>
    </footer>

</body>

</html>
