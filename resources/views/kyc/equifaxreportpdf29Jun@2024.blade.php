<!DOCTYPE HTML>
<html>
<head>
	<style>
		header {
			top: 0px;
			left: 0px;
			right: 0px;
		}

		body{
			font-size:13px;
		}
		.container:{
			background-color: white;
		}
		table{
			width:100%;
		}
		.text_space{
		   color: black !important;
           font-weight: 700 !important;
           word-spacing: normal !important;
		   font-size: 15px !important;
		}
	
		.data-title{
			background-color:#8B0000;
			color:#FFFFFF;
			height:20px;
			table-layout: fixed;
			-webkit-font-smoothing: antialiased;	
		}
	
		.header img {
			float: left;
			width: 150px;
			height: 140px;
			background: #555;
		}

		.header h3{
			margin:auto;
		}

		h3{
			color:white;
		}

		.data-field{
			color:grey;
		}
		.consumer_address{
			color: rgb(3, 1, 1) !important;				
		    font-size: 14px !important;
		}			

		body{
			height:100%;
			width:100%;
		}
		.td-style{
			color: #8B0000;
			font-style: italic;
		}
		.td-elements span{
			color: grey;
			font-style: italic;
		}
		.table-style tr:nth-child(even) {background: #CCC}
		.table-style tr:nth-child(odd) {background: #FFF}
	</style>

</head>
<body> 
	<header>
		<div class = "header">
			<div class="row">
				<div class="col-md-4 offset-md-3">
					<img src = "{{public_path('/uploads/equifax-logo.jpg')}}" alt="logo" style="margin-right:40px; width:20%; height:30px">
				</div>
				<h1 style = "color:grey;">CONSUMER CREDIT REPORT V2.0</h1>
			</div>	
			
			<table>	
				<tbody>
					<tr>
						<td><span class="td-style">CLIENT ID:</span>
						<span class="text_space">{{isset($equifax['InquiryResponseHeader']['ClientID']) ? $equifax['InquiryResponseHeader']['ClientID'] : ""}}
						</span>
						</td>
						<td><span class="td-style">DATE:</span> <span class="text_space">{{ isset($myarray['date']) ? $myarray['date'] : "" }}</span></td>
					</tr>
					<tr>
						<td><span class="td-style">REPORT ORDER NO:</span> <span class="text_space">{{ isset($myarray['orderNo']) ? $myarray['orderNo'] : "" }}</span></td>
						<td><span class="td-style">TIME:</span> <span class="text_space">{{ isset($myarray['time']) ? $myarray['time'] : "" }}</span></td>
					</tr>
					<tr>
						<td><span class="td-style">REFERENCE NUMBER:</span> <span class="text_space">{{ $myarray['CustRefField'] }}</span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<hr>
	</header>
	<main>
		<div class = "container" style = "background-color: white;">
			<div class = "row">
				<table>
					<thead>
						<tr>
							<td>
								<h3 class = "data-field">
									Consumer Name: {{ isset($myarray['consumerName']) ? $myarray['consumerName'] : "" }}
								</h3>
							</td>
						</tr>
					</thead>
				</table>
			</div>

			<div class = "row">
				<table class = "table" cellspacing="0">
					
					<tbody>
						<tr class = "data-title">
							<td scope = "col">Personal Information</td>
							<td scope = "col">Identification</td>
							<td scope = "col">Contact Details</td>
						</tr>	
						<tr class="td-elements">
							<td><span>Previous Name:</span></td>
							<td><span>PAN:</span>  <span class="text_space">{{ isset($myarray['PAN']) ? $myarray['PAN'] : "" }}</span></td>
							<td><span>Home:</span>  <span class="text_space">{{ isset($myarray['Number']) ? $myarray['Number'] : "" }}</span></td>
						</tr>
						<tr class="td-elements">
							<td><span>Alias Name:</span></td>
							<td><span>Voter ID:</span><span class="text_space">{{ isset($myarray['VoterID']) ? $myarray['VoterID'] : "" }}</span></td>
							<td><span>Office:</span> </td>
						</tr>
						<tr class="td-elements">
							<td><span>DOB:</span><span class="text_space"> {{ isset($myarray['DOB']) ? $myarray['DOB'] : "" }}</span></td>
							<td><span>Passport ID:<span class="text_space"> {{ isset($myarray['NationalIDCard']) ? $myarray['NationalIDCard'] : "" }}<span></span></td>
							<td><span>Mobile:</span> </td>
						</tr>
						<tr class="td-elements">
							<td><span>Age:</span><span class="text_space"> {{ isset($myarray['age']) ? $myarray['age'] : "" }}</span></td>
							<td><span>UID:</span></td>
							<td><span>Alt. Home/Other No. :</span> </td>
						</tr>
						<tr class="td-elements">
							<td><span>Gender:</span> <span class="text_space">{{ isset($myarray['gender']) ? $myarray['gender'] : "" }}</span></td>
							<td><span>Driver's License: <span class="text_space">{{ isset($myarray['driving_licence']) ? $myarray['driving_licence'] : "" }}</span></td>
							<td><span>Alt. Office:</span> </td>
						</tr>
						
						<tr class="td-elements">
							<td><span>Total Income:</span></td>
							<td><span>Ration Card:</span></td>
							<td><span>Alt. Mobile :</span> </td>
						</tr>
						<tr class="td-elements">
							<td><span>Occupation:</span></td>
							<td><span>Photo Credit Card:</span></td>
							<td><span>Email:</span> </td>
						</tr>
						<tr class="td-elements">
							<td></td>
							<td><span>ID - Other:</span></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<hr/>
			<div class = "row">
				<table>
					<thead>
						<tr>
							<td><h3 class = "data-field">Consumer EmailInfo:</h3></td>
						</tr>
					</thead>
				</table>
			</div>		
			<div class = "row">
				<table class = "table text-center" cellspacing="0"  style="text-align: center;">
					<thead class = "data-title">
						<tr>
							<th scope = "col">ReportedDate</th>
							<th scope = "col">Email</th>
						</tr>
					</thead>
					<tbody class="table-style">
					  @foreach($myarray['EmailAddressInfo'] as $email_info)
						<tr>
							<td>{{ isset($email_info['ReportedDate']) ? $email_info['ReportedDate'] : " " }}</td>
							<td>{{ isset($email_info['EmailAddress']) ? $email_info['EmailAddress'] : " " }}</td>
						</tr>
					  @endforeach						
					</tbody>
				</table>
			</div>
			<hr/>
			<div class = "row">
				<table>
					<thead>
						<tr>
							<td><h3 class = "data-field">Consumer PhoneInfo:</h3></td>
						</tr>
					</thead>
				</table>
			</div>		
			<div class = "row">
				<table class = "table text-center" cellspacing="0"  style="text-align: center;">
					<thead class = "data-title">
						<tr>
							<th scope = "col">Type</th>
							<th scope = "col">ReportedDate</th>
							<th scope = "col">Number</th>
						</tr>
					</thead>
					<tbody class="table-style">
					  @foreach($myarray['PhoneInfo'] as $phone_info)
						<tr>
							<td>{{ isset($phone_info['typeCode']) ? $phone_info['typeCode'] : " " }}</td>
							<td>{{ isset($phone_info['ReportedDate']) ? $phone_info['ReportedDate'] : " " }}</td>
							<td>{{ isset($phone_info['Number']) ? $phone_info['Number'] : " " }}</td>
						</tr>
					  @endforeach						
					</tbody>
				</table>
			</div>
			<hr/>
			<div class = "row">
				<table>
					<thead>
						<tr>
							<td><h3 class = "data-field">Consumer Address:</h3></td>
						</tr>
					</thead>
				</table>
			</div>
			<div class = "row">
				<table class = "table text-center" cellspacing="0">
					<thead class = "data-title">
						<tr>
							<th scope = "col">Type</th>
							<th scope = "col">Address</th>
							<th scope = "col">State</th>
							<th scope = "col">Postal</th>
							<th scope = "col">Date Reported</th>
						</tr>
					</thead>
					<tbody class="table-style">
						
						@foreach($myarray['consumer_address'] as $consumer_address)
						<tr>
							<td>Primary</td>
							<td>{{ isset($consumer_address['Address']) ? $consumer_address['Address'] : " " }}</td>
							<td>{{ isset($consumer_address['State']) ? $consumer_address['State'] : " " }}</td>
							<td>{{ isset($consumer_address['Postal']) ? $consumer_address['Postal'] : " " }}</td>
							<td>{{ isset($consumer_address['ReportedDate']) ? $consumer_address['ReportedDate'] : " "}}</td>
						</tr>
						@endforeach						
					</tbody>
				</table>
			</div>
			<hr>
				
			<div class = "row">
				<table class = "table">
					<thead>
						<tr>
							<td><h3 class = "data-field">Equifax Score(s):</h3></td>
						</tr>
					</thead>
				</table>
			</div>

			<div class = "row">
				<table class = "table text-center" cellspacing="0">
					<tbody>
						<tr class = "data-title" style="text-align: center">
							<td scope = "col">Score Name</td>
							<td scope = "col">Score</td>
							<td scope = "col">Scoring Elements</td>
						</tr>	
						@foreach($myarray['score_details'] as $score_details)
							<tr>
								<td style = "text-align: center;">Equifax Risk Score - {{ isset($score_details['Name']) ? $score_details['Name'] : "" }} {{ isset($score_details['Version']) ? $score_details['Version'] : "" }}</td>
								<td style = "font-weight:bold; text-align: center;"> {{ isset($score_details['Value']) ? $score_details['Value'] : "" }}</td>
								<td>
									@if(isset($score_details['ScoringElements']))
										@foreach($score_details['ScoringElements'] as $scoringelements)
										
											{{$scoringelements['seq'].". ".$scoringelements['Description']}}<br>
										
										@endforeach
									@endif	
								</td>
								
							</tr>
						@endforeach						
					</tbody>
				</table>
			</div>
			<hr>
			<div class = "row">
				<table class = "table">
					<thead>
						<tr>
							<td><h3 class = "data-field">Recent Activity: </h3></td>
						</tr>
					</thead>
				</table>
			</div>

			<div class = "row">
				<table class = "table text-center">
					<thead class = "data-title">
						<tr>
							<th scope = "col" colspan = 4>Recent Activity(last 90 days)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Total Inquiries: {{ isset($myarray['enquiry_summary']['TotalInquiries']) ? $myarray['enquiry_summary']['TotalInquiries'] : ""}}  
							</td>
							<td>Accounts Opened:  {{ isset($myarray['enquiry_summary']['AccountsOpened']) ? $myarray['enquiry_summary']['AccountsOpened'] : ""}}
							</td>
							<td>Accounts Updated:  {{ isset($myarray['enquiry_summary']['AccountsDeliquent']) ? $myarray['enquiry_summary']['AccountsDeliquent'] : ""}}
							</td>
							<td>Accounts Delinquent: {{ isset($myarray['enquiry_summary']['AccountsUpdated']) ? $myarray['enquiry_summary']['AccountsUpdated'] : ""}}</td>
						</tr>													
					</tbody>
				</table>
			</div>


			<hr>

			<br><br><br><br><br><br><br><br><br><br><br>
				
			<div class = "container" style = "background-color: white;">
				
				<div class = "row">
					<table>
						<thead>
							<tr>
								<td><h3 class = "data-field">Summary* : </h3></td>
							</tr>
						</thead>
					</table>
				</div>

					<div class = "row">
						<table class = "table text-center">
							<thead class = "data-title">
								<tr>
									<th scope = "col" colspan = 4>Credit Report Summary</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Number of Accounts : {{ isset($myarray['numberofAccounts']) ? $myarray['numberofAccounts'] : "" }}</td>
									<td>Total Balance Amount : {{ isset($myarray['TotalBalanceAmount']) ? $myarray['TotalBalanceAmount'] : "" }}</td>
									<td>Recent Account : {{isset($myarray['recentAccount']) ? $myarray['recentAccount'] : ""}}</td>
								</tr>
								<tr>
									<td>Number of Open Accounts : {{isset($myarray['numberOfOpenAccount']) ? $myarray['numberOfOpenAccount'] : ""}}</td>
									<td>Total Past Due Amount : {{ isset($myarray['TotalPastAmount']) ? $myarray['TotalPastAmount'] : "" }}</td>
									<td>Oldest Account : {{isset($myarray['oldestAccount']) ? $myarray['oldestAccount'] : ""}}</td>
								</tr>
								<tr>
									<td>Number of Past Due Accounts : {{isset($myarray['numberOfPastDueAccount']) ? $myarray['numberOfPastDueAccount'] : ""}}</td>
									<td>Total High Credit : {{isset($myarray['TotalHighCredit']) ? $myarray['TotalHighCredit'] : ""}}</td>
									<td>Total Credit Limit :  {{isset($myarray['TotalCreditLimit']) ? $myarray['TotalCreditLimit'] : ""}}</td>
								</tr>
								<tr>
									<td>Number of Write-off Accounts : {{isset($myarray['NoOfWriteOffs']) ? $myarray['NoOfWriteOffs'] : ""}}</td>
									<td>Total Sanction Amount : {{isset($myarray['TotalSanctionAmount']) ? $myarray['TotalSanctionAmount'] : ""}} </td>
									<td>Single Highest Credit :  {{isset($myarray['SingleHighestCredit']) ? $myarray['SingleHighestCredit'] : ""}}</td>
								</tr>
								<tr>
									<td>Number of Zero Balance Accounts : {{isset($myarray['NoOfZeroBalanceAccounts']) ? $myarray['NoOfZeroBalanceAccounts'] : ""}}</td>
									<td>Total Monthly Payment Amount : {{isset($myarray['TotalMonthlyPaymentAmount']) ? $myarray['TotalMonthlyPaymentAmount'] : ""}} </td>
									<td>Single Highest Sanction Amount : {{isset($myarray['SingleHighestSanctionAmount']) ? $myarray['SingleHighestSanctionAmount'] : ""}}</td>
								</tr>
								<tr>
									<td>Most Severe Status < 24 Months : </td>
									<td>Average Open Balance : {{isset($myarray['NoOfZeroBalanceAccounts']) ? $myarray['NoOfZeroBalanceAccounts'] : ""}}</td>
									<td>Single Highest Balance : {{isset($myarray['SingleHighestBalance']) ? $myarray['SingleHighestBalance'] : ""}}</td>
								</tr>

							</tbody>
						</table>

						<p style = "color:grey;">*As per data reported at a tradeline level in the account details section</p>
						<br><br>
					</div>
					<hr>


					<div class = "row" style="overflow-x:auto;width:100%;border-collapse:collapse;">
						<table>
							<thead>
								<tr>
									<td><h3 class = "data-field">Account Details: </h3></td>
								</tr>
							</thead>
						</table>

						@foreach($myarray['RetailAccountDetails'] as $RetailAccountDetail)
						
						<table style = "border: 1px solid black;">
							<thead class = "data-title">
								<tr>
									<th scope = "col" colspan = 4>Account</td>
								</tr>
							</thead>
								
							
							<tbody>
								
								
								<tr>
									<td>Acct# {{ isset($RetailAccountDetail['AccountNumber']) ? $RetailAccountDetail['AccountNumber'] : "" }}</td>
									<td>Balance: {{ isset($RetailAccountDetail['Balance']) ? $RetailAccountDetail['Balance'] : "" }}</td>
									<td>Open: {{ isset($RetailAccountDetail['Open']) ? $RetailAccountDetail['Open'] : "" }}</td>
									<td>Date Reported:</td>	
								</tr>
								<tr>
									<td>
									Institution: {{ isset($RetailAccountDetail['Institution']) ? $RetailAccountDetail['Institution'] : "" }}
									</td>
									<td>
										Past Due Amount: {{ isset($RetailAccountDetail['PastDueAmount']) ? $RetailAccountDetail['PastDueAmount'] : " " }}
									</td>
									<td>Interest Rate: </td>
									<td>Date Opened: {{ isset($RetailAccountDetail['DateOpened']) ? $RetailAccountDetail['DateOpened'] : "" }}
									</td>	
								</tr>
								<tr>
									<td>Type: {{ isset($RetailAccountDetail['AccountType']) ? $RetailAccountDetail['AccountType'] : "" }}</td>
									<td>Last Payment: </td>
									<td>
										Last Payment Date: {{ isset($RetailAccountDetail['LastPaymentDate']) ? $RetailAccountDetail['LastPaymentDate'] : " " }}
									</td>
									<td>Date Closed: </td>	
								</tr>
								<tr>
									<td>Ownership Type: {{ isset($RetailAccountDetail['OwnershipType']) ? $RetailAccountDetail['OwnershipType'] : "" }}</td>
									<td>Write-off Amount:</td>
									<td>Sanction Amount: {{isset($RetailAccountDetail['SanctionAmount']) ? $RetailAccountDetail['SanctionAmount'] : ""}}</td>
									<td>Reason:</td>							
								</tr>
							</tbody>
						</table>



						<!-- <table>
								<tr>
									<td>Repayment Tenure :</td>
									<td>Monthly Payment Amount:</td>
									<td>Credit Limit:</td>
									<td>Collateral Value:</td>							
								</tr>
								
								<tr>
									<td>Dispute Code:</td>
									<td>Term Frequency:</td>
									<td></td>
									<td>Collateral Type:</td>							
								</tr>
								
								<tr>
									<td>Account Status: {{isset($RetailAccountDetail['AccountStatus']) ? $RetailAccountDetail['AccountStatus'] : ""}}</td>
								</tr>
								
								<tr>
									<td>Asset Classification:</td>
								</tr>

								<tr>
									<td>Suit Filed Status:</td>
								</tr>
								
						</table> -->



						<table style = "border: 1px solid black;">
							<tbody>
								<tr>
									<td style = "text-decoration: underline;">Account History</td>
								</tr>

								<tr>
									<td>Account Status:</td>
									@foreach($RetailAccountDetail['History48Months'] as $History)
										<td>{{$History['PaymentStatus']}}</td>
									@endforeach
								</tr>
								<tr>
									<td>Asset Classifcation</td>
									@foreach($RetailAccountDetail['History48Months'] as $History)
										<td>{{$History['AssetClassificationStatus']}}</td>
									@endforeach
								</tr>
								<tr>
									<td>Suit Filed Status</td>
									@foreach($RetailAccountDetail['History48Months'] as $History)
										<td>{{$History['SuitFiledStatus']}}</td>
									@endforeach
								</tr>
								<tr>
									<td></td>
									@foreach($RetailAccountDetail['History48Months'] as $History)
										<td>{{$History['key']}}</td>
									@endforeach
								</tr>							
							
							</tbody>
						</table>
						@endforeach
						<hr>
						@if($myarray['enquiries'] != "")
							<div class = "row">
								<table>
									<thead>
										<tr>
											<td><h3 class = "data-field">Enquiries: </h3></td>
										</tr>
									</thead>
								</table>
							</div>


							<div class = "row">
								<table cellspacing="0">
									<thead class = "data-title">
										<tr>
											<td>Sequence</td>
											<td>Institution</td>
											<td>Date</td>
											<td>Time</td>
											<td>Request Purpose</td>
											<td>Amount</td>
											
										</tr>
									</thead>
									<tbody class="table-style">
										@foreach($myarray['enquiries'] as $enquiries)
											<tr>
												<td>{{isset($enquiries['seq']) ? $enquiries['seq'] + 1 : ""}}</td>
												<td>{{isset($enquiries['Institution']) ? $enquiries['Institution'] : ""}}</td>
												<td>{{isset($enquiries['Date']) ? $enquiries['Date'] : ""}}</td>
												<td>{{isset($enquiries['Time']) ? $enquiries['Time'] : ""}}</td>
												<td>{{isset($enquiries['RequestPurpose']) ? $enquiries['RequestPurpose'] : ""}}</td>
												<td>{{isset($enquiries['Amount']) ? $enquiries['Amount'] : ""}}</td>
											</tr>
										@endforeach	
									</tbody>
									
								</table>
							</div>
							<hr>
						@endif	
						<div class = "row">
							<table>
								<thead>
									<tr>
										<td><h3 class = "data-field">Enquiry Summary: </h3></td>
									</tr>
								</thead>
							</table>
						</div>


						<div class = "row">
							<table cellspacing="0">
								<thead class = "data-title">
									<tr>
										<td>Purpose</td>
										<td>Total</td>
										<td>Past 30 Days</td>
										<td>Past 12 Months</td>
										<td>Past 24 Months</td>
										<td>Recent</td>
										
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{isset($myarray['Purpose']) ? $myarray['Purpose'] : ""}}</td>
										<td>{{isset($myarray['Total']) ? $myarray['Total'] : ""}}</td>
										<td>{{isset($myarray['Past30Days']) ? $myarray['Past30Days'] : ""}}</td>
										<td>{{isset($myarray['Past12Months']) ? $myarray['Past12Months'] : ""}}</td>
										<td>{{isset($myarray['Past24Months']) ? $myarray['Past24Months'] : ""}}</td>
										<td>{{isset($myarray['Recent']) ? $myarray['Recent'] : ""}}</td>
										
									</tr>
								</tbody>
								
							</table>
						</div>
				</div>
		</div>
	</main>
</body>
</html>