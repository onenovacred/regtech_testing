<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .td_class{
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        td{
            font-family:sans-serif;
        }
        p{
            font-family:sans-serif;
        }
        h3{
            font-family:sans-serif;
        }
        .panel-title{
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
            color: inherit;
        }
        .panel-success{
            border-color:#0cc2aa  ;

        }
        hr{
            border-color:#0cc2aa  ;
        }
		
		<!---for footer in PDF 
		 #footer .page:after { content: counter(page); }
		 -->
		@page { margin: 180px 50px; }
		#footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 200px;}
		
		<!---end footer css--->
        table, tr, th, td {
            border: 1px solid #000000;
        }
    </style>

</head>
<body>
<!--footer for pdf start-->
 <div id="footer">
     <p class="page" style="font-size:12px;float:right;color:#C0C0C0;">Zapfin Tekhnologies Pvt. Limited</br>(DocBoyz)</p>
   </div>
<!--content area start-->
<div id="content" class="container-fluid full-width-container blank">
    <div class="pmd-card-body">
        <div class="row" style="width: 100%">
            <div class="col-md-8 col-sm-5 col-xs-5" style="width:45%; border-right: 2px solid black;
            height: auto;">
                <img src="" alt="image" style="height: auto;width: 200px">
                <h3 style="margin-top: -37px;padding-left: 54px;">DocBoyz</h3>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-5" style="width:45%;">
                <p><b>Zapfin Tekhnologies pvt. ltd.</b><br>
                    Aditya Business Center S N 1 A B Wing<br>
                    3rd Floor Above ICICI Bank Kondhwa<br>
                    Pune- 411048.</p>
                <a target="new" href="www.docboyz.in">www.docboyz.in</a>
            </div>
        </div>
        <div class="row" style="width: 100%;padding-top: 20px;">
            <div class="col-md-12 col-sm-12 col-xs-12" style="width:100%;">
                <div class="panel panel-success" >
                    <div class="heading ">
                        <h3 class="panel-title" style="padding-top: 5px;padding-left: 10px;padding-bottom: -5px;margin-bottom: -10px;"><b>REPORTS</b></h3><hr>
                    </div>
                    <div class="table-responsive" style="padding:5px;margin-top: -20px;margin-bottom:10px;">
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sr</th>
                                    <th>Service</th>
                                    <th style="width: 10%;">Price</th>
                                    <th style="width: 15%;">Hit Count</th>
                                    <th style="width: 10%;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $key=>$value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value['api_name']}}</td>
                                <td class="text-right">{{$value['scheme_price']}}</td>
                                <td class="text-center">{{$value['hit_count']}}</td>
                                <td class="text-right">{{ ($value['total'])}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-12 col-sm-12 col-xs-12" style="width:100%;">
                <div class="panel panel-success" >

                    <div class="heading ">
                        <h3 class="panel-title" style="padding-top: 5px;padding-left: 10px;padding-bottom: -5px;margin-bottom: -10px;"><b>FC Details</b></h3><hr>
                    </div>
                    <div class="table-responsive" style="padding:5px;margin-top: -20px;margin-bottom:10px;">
                        <table>
                            <tbody>
                            <tr style="">
                                <td class="title"><strong>FCID : </strong>
                                    asd
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="heading ">
                        <h3 class="panel-title" style="padding-top: 5px;padding-left: 10px;padding-bottom: -5px;margin-bottom: -10px;"><b>POD Details</b></h3><hr>
                    </div>
                    <div class="table-responsive" style="padding:5px;margin-top: -20px;margin-bottom:10px;">
                        <table>
                            <tbody>
                            <tr>
                                <td class="title"><strong>POD No : </strong>Not Submited</td>
                            </tr>
                            <tr>
                                <td class="title"><strong>POD Completed Date : </strong>Not Submited</td>
                            </tr>
                            <tr>
                                <td class="title"><strong>Latitude : </strong>Not Submited</td>
                            </tr>
                            <tr>
                                <td class="title"><strong>Longitude : </strong>Not Submited</td>
                            </tr>
                            	<tr>
                                	<td class="title"><strong>Map View : </strong><a style="color:#00acc1;text-decoration: underline;" href="#" target="_blank">View Location</a></td>
                            	</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>


        <!-- to check if demo company has the Bike Loan Product -->
        <div class="panel panel-success" style="margin-top: 30px;">
            <div class="heading ">
                <h4> <font color="red"><b>Letter of Acknowledgment</b></font></h4><hr>
            </div>
            <div class="table-responsive" style="padding:5px;margin-top: -20px;margin-bottom:10px;">
                <table>
                    <tbody>
						<tr><td>
						<font size="3" ><b>I acknowledge and agree to have shared the below mentioned documents with SHOPX in
											pursuance of availing a credit facility from the Lending Partner(s) of SHOPX.
											I hereby authorize SHOPX to share the below mentioned documents with its Lending Partner
											to facilitate the credit facility.</b></font></td>
						</tr>
						<tr><td>
						<h4> <font color="red"><b>Documents</b></font></h4>
								<font size="3" ><b>1. Application Form filled and signed with Email id</b></font><br/><br/>
								 <font size="3" ><b>2. Business registration proof (any one)</b></font><br/>
								  <font size="3" >GST Registration / Udyog Aadhaar / ITR / Weighing scale / Shop and establishment</font><br/><br/>
								  <font size="3" ><b>3. Proprietor PAN</b></font><br/><br/>
								  <font size="3" ><b>4. Current residence address proof (any one)</b></font><br/>
								  <font size="3" >Rent agreement / Adhaar both side  / Driving licence both side  / Passport with address page  / Electricity bill / Utility bill / Voter ID</font><br/><br/>
								   <font size="3" ><b>5. Passport Size Photo</b></font><br/><br/>
								  <font size="3" ><b>6. Cancelled cheque/Bank Account Details </b></font><br/><br/></td>
						</tr>
						<tr><td>
						<font size="3" ><b>I understand and agree that any claims arising from, related with or incidental to the sharing
								of such documents shall not be held valid or legally tenable. Further, I shall not hold SHOPX
								liable to indemnify me against any losses or damages that may be consequent to such
								sharing.</b></font></td>
                      	</tr>
                        <tr>
                         <td  style="padding-left: 70%;">
                            <h4> <font color="red"><b>Customer Details</b></font></h4>
                            <b><label style="padding-right:5%;">Mobile:</label></b>No Record<br>
                            <b><label style="padding-right:5%;">Device Details :</label></b>No Record<br>
                            <b><label style="padding-right:5%;">Browser Details :</label></b>No Record<br>
                            <b><label style="padding-right:5%;">IP:</label></b>No Record<br>
                            <b><label style="padding-right:5%;">Latitude Details :</label></b>No Record<br>
                            <b><label style="padding-right:5%;">Longitude Details :</label></b>No Record<br>
                          </td>    
                         </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-success" style="margin-top: 30px;">
            <div class="heading ">
                <h3 class="panel-title" style="padding-top: 5px;padding-left: 10px;padding-bottom: -5px;margin-bottom: -10px;"><b>Company Disclaimer</b></h3><hr>
            </div>
            <div class="table-responsive" style="padding:5px;margin-top: -20px;margin-bottom:10px;">
                <table>
                    <tbody>
                    <tr>
                        <td class="title">
                            asd
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</body>
</html>
