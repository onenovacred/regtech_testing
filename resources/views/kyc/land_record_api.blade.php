@extends('adminlte::page')

@section('title', 'Land APIs')

@section('content_header')
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Land Record APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Land Record</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/land</p>
        <b>Request Body : </b><br>
        {<br>   
        "Url":"https://bhunaksha.cg.nic.in/"</br>
        "OP":4</br>
        "GstStateCode":22</br>
        "Levels":"55,01,01,058"</br>
        "X_Coordinate":-1985.1836332116745</br>
        "Y_Coordinate":3625.746517505414</br>
        }<br>
        <b>Success Response : </b><br>
          {<br>
        "data": {<br>
             "ID": "j0V_En5ASJKhg-rScbanMA",<br/>
             "PNIU": "null",<br/>
             "attrs": "null",<br/>
             "gisCode": 550101.058,<br/>
             "has_data": "Y",<br/>
             "info": "धारणाधिकार : शासकीय भूमि\nक्षेत्रफल : 97.6810 हेक्टेयर\nक्षेत्रफल(वर्ग फुट) : 10514295.0000\nसिंचित क्षेत्रफल : 0.0000\nअसिंचित क्षेत्रफल : 97.6810\n\nखसरा नंबर  : 3/1/क/1\n नाम  :छ .ग. शासन (राजस्व विभाग)\nपिता का नाम   : null\n पता  : \n\nशामिल खसरा : 3/1/द/2(0.0000 हेकॿटेयर), 3/1/द/3(0.0000 हेकॿटेयर), 3/1/द/3(0.0000 हेकॿटेयर),\n",<br/>
             "pdf_base64": "+mscCzJkoqOlk+Vnpaeqd/hbWLgqqHiquO0frWxOrJ2fvd4v3lJ1QrRHJJXodim8mfeZh7st+1p9Cq2ubbETQTIUYjIToiFjwXECsRNE41aYVq0e3SAyYDMFsw7Pzs4/Lj8v7y9v728vny7PPs+v769vr2UXlPc5Nw0drQTmZLnK2ZwdK+HyocdoRyaXJl7P3k9v7ylaCM6fbc9Pzs+v729vryhI149Pvm+v7y+v7u9fzc5evP+P7i+v7q+v7m5ujc0dS93+LE+PnT/fym/v7i+vrg/v7m/v7q3NzK/v7u8/Pl/v7y/v72+vry/v76+vr29/W7/v3D/v3M/v3U9fTMxsWn/v3c8e2Rz8yV0c+t7uzJ9fTc+vnmw7xr2NF7/vi3s7CI3Nip7+u58+/D+vnq7u3gxsW6+vnu0Mh139aKv7qQ0s2kvLV9y8OI5N2r6OK29PPs+e6n7+Wn3NOb/fTC/vri59ubysKY/PTM3de46ePD/vrm1smU+vPW8+3S9+mz+OvF/PTc/vnq/vnu/vryU01C/fTj39zXs6+q/vr2qaGd083K/",<br/>
             "plotInfoLinks": "<strong>Reports</strong> :<br><a target=\"bhumap\" href=\"22/plotreportCG.jsp?state=22&giscode=550101.058&plotno=3/1/क/1\"  >खसरा नक्शा</a><br /><a target=\"bhumap\" href=\"https://revenue.cg.nic.in/bhuiyanuser/User/Selection_Report_For_KhasraDetail.aspx?villno=550101.058&khasrano=3/1/क/1\"  >खसरा  विवरण</a><br />",<br/>
             "xmin": "-2309.4335258031",<br/>
             "ymin": "3280.217235246",<br/>
             "xmax": "-1436.9552907749",<br/>
             "ymax": "4306.862607357",<br/>
             "plotNo": "3/1/क/1" <br/>  
          },<br>
      "statusCode": 200,<br>
      }<br>
      </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>

    <!-- <div class = "row">
        <div class = "col-md-4">
            
        </div>
    </div> -->
</div> 
@stop


@section('custom_js')
@stop