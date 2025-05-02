@extends('adminlte::page')

@section('title', 'BASIC GSTIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>BASIC GSTIN API</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>BASIC GSTIN</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/gstverification</p>
        <p><b>Request Method : POST</b></p>
        <p><b>Header</b> :{<br/>
          "AccessToken":"xxxxxxxxxxxxx"<br/>
        }
        </p>
        <p>
        <b>Request Body</b> :{<br/>
          "gstin_number":"08AABCM1857H2ZF"<br/>
          }<br/>
        </p>
        <p><b>Success Response : </b><br>
        &nbsp;&nbsp;{<br>
        &nbsp;&nbsp;"response":{<br>
            "stjCd": "RJ812",<br/>
            "lgnm": "MEGHA FINLOAN PRIVATE LIMITED",<br/>
            "stj": "Circle-I, Jaipur III, AC / CTO Ward",<br/>
            "dty": "Regular",<br/>
            "adadr": [<br/>
              {<br/>
                    "addr": {<br/>
                        "bnm": "HP HONDA",<br/>
                        "st": "NEAR NAGAR PALIKA",<br/>
                        "loc": "NAWALGARH",<br/>
                        "bno": "WARD NO. 7",<br/>
                        "dst": "Jhunjhunu",<br/>
                        "lt": "",<br/>
                        "locality": "",<br/>
                        "pncd": "333042",<br/>
                        "landMark": "",<br/>
                        "stcd": "Rajasthan",<br/>
                        "geocodelvl": "NA",<br/>
                        "flno": "",<br/>
                        "lg": ""
                        <br/>
                       },
                         <br/>
                         "ntr": "Supplier of Services"<br/>
                    },<br/>
                {<br/>
                    "addr": {<br/>
                        "bnm": "JAIN MARKET",<br/>
                        "st": "OPPOSITE PAHARIYA TOWER, STATION ROAD",<br/>
                        "loc": "SIKAR",<br/>
                        "bno": ".",<br/>
                        "dst": "Sikar",<br/>
                        "lt": "",<br/>
                        "locality": "",<br/>
                        "pncd": "332001",<br/>
                        "landMark": "",<br/>
                        "stcd": "Rajasthan",<br/>
                        "geocodelvl": "NA",<br/>
                        "flno": "1ST FLOOR",<br/>
                        "lg": ""<br/>
                    },<br/>
                    "ntr": "Supplier of Services"<br/>
                }<br/>
            ],<br/>
            "cxdt": "",<br/>
            "gstin": "08AABCM1857H2ZF",<br/>
            "nba": [<br/>
                "Supplier of Services"<br/>
            ],<br/>
            "lstupdt": "03/07/2023",<br/>
            "rgdt": "16/08/2017",<br/>
            "ctb": "Private Limited Company",<br/>
            "pradr": {<br/>
                "addr": {<br/>
                    "bnm": "PARIJAT BUILDING",<br/>
                    "st": "ASHOK MARG",<br/>
                    "loc": "C-SCHEME",<br/>
                    "bno": "9",<br/>
                    "dst": "Jaipur",<br/>
                    "lt": "",<br/>
                    "locality": "",<br/>
                    "pncd": "302001",<br/>
                    "landMark": "",<br/>
                    "stcd": "Rajasthan",<br/>
                    "geocodelvl": "NA",<br/>
                    "flno": "2nd floor O-12",<br/>
                    "lg": ""<br/>
                },<br/>
                "ntr": "Supplier of Services"<br/>
            },<br/>
            "sts": "Active",<br/>
            "ctjCd": "WM0802",<br/>
            "tradeNam": "MEGHA FINLOAN PRIVATE LIMITED",<br/>
            "ctj": "GST RANGE-XXXVII",<br/>
            "einvoiceStatus": "Yes"<br/>
        }<br/>
        &nbsp;&nbsp;"status_code": 200,<br/>
        &nbsp;&nbsp;"message_code": "success",<br/>
        &nbsp;&nbsp;"success": true<br/>
        }
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