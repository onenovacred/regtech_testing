@extends('adminlte::page')

@section('title', 'PAN TO GST APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>PAN TO GST API</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>PAN TO GST</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/pantogst</p>
        <p><b>Request Method : POST</b></p>
        <p><b>Header</b> :{<br/>
          "AccessToken":"xxxxxxxxxxxxx"<br/>
        }
        </p>
        <p>
        <b>Request Body</b> :{<br/>
          "pancard_number":"868889041183"<br/>
          }<br/>
        </p>
        <p><b>Success Response : </b><br>
        &nbsp;&nbsp;{<br>
        &nbsp;&nbsp;"response": [<br>
            {<br/>
                "stjCd": "UP1596",<br/>
                "lgnm": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                "stj": "Ghaziabad Sector-1",<br/>
                "dty": "Regular",<br/>
                "adadr": [],<br/>
                "cxdt": "",<br/>
                "gstin": "09AAJCC5200A1Z9",
                "nba": [<br/>
                    "Supplier of Services"<br/>
                ],<br/>
                "lstupdt": "28/02/2024",<br/>
                "rgdt": "10/06/2021",<br/>
                "ctb": "Private Limited Company",<br/>
                "pradr": {<br/>
                    "addr": {<br/>
                        "bnm": "MAHENDRA ENCLAVE",<br/>
                        "st": "NEAR KARTE HOSPITAL CHOWK",<br/>
                        "loc": "GHAZIABAD",<br/>
                        "bno": "B-24",<br/>
                        "dst": "Ghaziabad",<br/>
                        "lt": "",<br/>
                        "locality": "",<br/>
                        "pncd": "201001",<br/>
                        "landMark": "",<br/>
                        "stcd": "Uttar Pradesh",<br/>
                        "geocodelvl": "NA",<br/>
                        "flno": "",<br/>
                        "lg": ""<br/>
                    },<br/>
                    "ntr": "Supplier of Services"<br/>
                },
                "sts": "Active",<br/>
                "tradeNam": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                "ctjCd": "YE0103",<br/>
                "ctj": "RANGE - 3",<br/>
                "einvoiceStatus": "No"<br/>
            },<br/>
            {<br/>
                "stjCd": "HR049",<br/>
                "lgnm": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                "stj": "Gurgaon (East) Ward 4",<br/>
                "dty": "Regular",<br/>
                "adadr": [],<br/>
                "cxdt": "",<br/>
                "gstin": "06AAJCC5200A1ZF",<br/>
                "nba": [<br/>
                    "Supplier of Services"<br/>
                ],<br/>
                "lstupdt": "15/02/2024",<br/>
                "rgdt": "18/01/2024",<br/>
                "ctb": "Private Limited Company",<br/>
                "pradr": {<br/>
                    "addr": {<br/>
                        "bnm": "Bestech Park View Ananda",<br/>
                        "loc": "Gurugram",
                        "st": "New Sector Road",<br/>
                        "bno": "Bestech Park View Ananda",<br/>
                        "dst": "Gurugram",<br/>
                        "lt": "28.391131",<br/>
                        "locality": "Sector 81",<br/>
                        "pncd": "122004",<br/>
                        "landMark": "",<br/>
                        "stcd": "Haryana",<br/>
                        "geocodelvl": "Building",<br/>
                        "flno": "villa no-02",
                        "lg": "76.9519460000001"<br/>
                    },<br/>
                    "ntr": "Supplier of Services"<br/>
                },<br/>
                "tradeNam": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                "sts": "Active",<br/>
                "ctjCd": "ZO0603",<br/>
                "ctj": "R-38",<br/>
                "einvoiceStatus": "No"<br/>
            }<br/>
        ]<br/>
        &nbsp;&nbsp;"status_code": 200,<br>
        &nbsp;&nbsp;"message_code": "success",<br>
        &nbsp;&nbsp;"success": true<br>
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