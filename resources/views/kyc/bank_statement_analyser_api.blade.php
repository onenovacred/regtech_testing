@extends('adminlte::page')

@section('title', 'Bank Ananlyser APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Bank Ananlyser API</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Bank Ananlyser</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/bank_analyser_new</p>
        <p><b>Request Method : POST</b></p>
        <p><b>Header</b> :{<br/>
          "AccessToken":"xxxxxxxxxxxxx"<br/>
        }
        </p>
        <p>
        <b>Request Body</b> :{<br/>
            "bankStemt":"bank_statement_hdfc.pdf",<br/>
            "bankName":"Hdfc Bank",<br/>
            "accountType:""Saving",<br/>
            "password":*******<br/>
          }<br/>
        </p>
        <p><b>Success Response : </b><br>
            &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"response": {<br>
                &nbsp;&nbsp;"atm_withdrawls": "[]",<br>
                &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                &nbsp;&nbsp;"dayBalanceMap": "{",<br>
                &nbsp;&nbsp;"1": "74869.78",<br>
                &nbsp;&nbsp;"5":"52734.78",<br>
                &nbsp;&nbsp;"10": "35900.6"<br>
                &nbsp;&nbsp;"15": "35150.6"<br>
                &nbsp;&nbsp;"20": "35144.85"<br>
                &nbsp;&nbsp;"25": "144.85"<br>
                &nbsp;&nbsp;"30": "14.85"<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;],<br>
                &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;],<br>
                &nbsp;&nbsp;"cash_deposits": "[]",<br>
                &nbsp;&nbsp;"expenses": "[{",<br>
                &nbsp;&nbsp;"amount": "6500.33",<br>
                &nbsp;&nbsp;"bank": "",<br>
                &nbsp;&nbsp;"category": "CREDIT_CARD_PAYMENT",<br>
                &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                &nbsp;&nbsp;"merchantType": "",<br>
                &nbsp;&nbsp;"mode": "INTERNET_FUND_TRANSFER",<br>
                &nbsp;&nbsp;"monthAndYear": "",<br>
                &nbsp;&nbsp;"partyName": "xyz",<br>
                &nbsp;&nbsp;"purpose": "CREDIT_CARD_PAYMENT",<br>
                &nbsp;&nbsp;"total": " ",<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;],<br>
                &nbsp;&nbsp;"high_value_transactions": "[{",<br>
                &nbsp;&nbsp;"amount": "35000",<br>
                &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                &nbsp;&nbsp;"bank": "",<br>
                &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                &nbsp;&nbsp;"category": "OTHER",<br>
                &nbsp;&nbsp;"type": "DEBIT",<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;],<br>
                &nbsp;&nbsp;"incomes": "[{",<br>
                &nbsp;&nbsp;"amount": "6500.33",<br>
                &nbsp;&nbsp;"balanceAfterTransaction": "32786.85",<br>
                &nbsp;&nbsp;"bank": "",<br>
                &nbsp;&nbsp;"category": "SALARY",<br>
                &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                &nbsp;&nbsp;"isSalary": "true",<br>
                &nbsp;&nbsp;"isSalaryCheck": "true",<br>
                &nbsp;&nbsp;"mode": "SALARY",<br>
                &nbsp;&nbsp;"monthAndYear": "",<br>
                &nbsp;&nbsp;"partyName": "",<br>
                &nbsp;&nbsp;"purpose": "SALARY",<br>
                &nbsp;&nbsp;"total": " ",<br>
                &nbsp;&nbsp;"transactionType": "CREDIT",<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;],<br>
                &nbsp;&nbsp;"internalTransactionList": "[]",<br>
                &nbsp;&nbsp;"investments": "[]",<br>
                &nbsp;&nbsp;"minimum_balances": "[{",<br>
                &nbsp;&nbsp;"amount": "35000",<br>
                &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                &nbsp;&nbsp;"bank": "",<br>
                &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                &nbsp;&nbsp;"category": "TRANSFER_TO_WALLET",<br>
                &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;],<br>
                &nbsp;&nbsp;"missingMonths": "[]",<br>
                &nbsp;&nbsp;"money_received_transactions": "[{",<br>
                &nbsp;&nbsp;"amount": "1300",<br>
                &nbsp;&nbsp;"balanceAfterTranscation": "74869.78",<br>
                &nbsp;&nbsp;"bank": "",<br>
                &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                &nbsp;&nbsp;"category": "IMPS",<br>
                &nbsp;&nbsp;"monthAndYear": "",<br>
                &nbsp;&nbsp;"total": "",<br>
                &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;],<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;"statusCode": 200,<br>
                &nbsp;&nbsp;}<br>
      </p>
    </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>
  </div>
</div> 
        
@stop


@section('custom_js')
@stop