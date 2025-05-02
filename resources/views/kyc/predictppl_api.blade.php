@extends('adminlte::page')

@section('title', 'PredictPPL')

@section('content_header')
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>PredictPPL APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>PredictPPL</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/predictppl</p>
        <b>Request Body : </b><br>
        {<br>   
        "file":"predict_report.csv"<br>
        }<br>
        <b>Success Response : </b><br>
        {<br>
            {<br/>
                "statusCode": 200,<br/>
                "data": [<br/>
                    {<br/>
                        "LoanAmount": 10000,<br/>
                        "LoanIntent": "PERSONAL",<br/>
                        "LoanInterestRate": 8.5,<br/>
                        "LoanPercentIncome": 0.15,<br/>
                        "PersonAge": 25,<br/>
                        "PersonHomeOwnership": "RENT",<br/>
                        "PersonIncome": 70000,<br/>
                        "Prediction": "No Default"<br/>
                    },<br/>
                    {<br/>
                        "LoanAmount": 15000,<br/>
                        "LoanIntent": "EDUCATION",<br/>
                        "LoanInterestRate": 10.2,<br/>
                        "LoanPercentIncome": 0.12,<br/>
                        "PersonAge": 35,<br/>
                        "PersonHomeOwnership": "OWN",<br/>
                        "PersonIncome": 120000,<br/>
                        "Prediction": "No Default"<br/>
                    },<br/>
                    {<br/>
                        "LoanAmount": 20000,<br/>
                        "LoanIntent": "PERSONAL",<br/>
                        "LoanInterestRate": 13,<br/>
                        "LoanPercentIncome": 0.2,<br/>
                        "PersonAge": 40,<br/>
                        "PersonHomeOwnership": "MORTGAGE",<br/>
                        "PersonIncome": 95000,<br/>
                        "Prediction": "No Default"<br/>
                    },<br/>
                    {<br/>
                        "LoanAmount": 8000,<br/>
                        "LoanIntent": "EDUCATION",<br/>
                        "LoanInterestRate": 16,<br/>
                        "LoanPercentIncome": 0.18,<br/>
                        "PersonAge": 29,<br/>
                        "PersonHomeOwnership": "RENT",<br/>
                        "PersonIncome": 45000,<br/>
                        "Prediction": "Default"<br/>
                    }<br/>
                ]<br/>
            }<br/>
      }<br/>
   </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>
</div> 
@stop


@section('custom_js')
@stop