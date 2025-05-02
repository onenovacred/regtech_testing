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
					<img src = "{{asset('/uploads/equifax-logo.jpg')}}" alt="logo" style="margin-right:40px; width:20%; height:30px">
				</div>
				<h1 style = "color:grey;">CONSUMER CREDIT REPORT V2.0</h1>
			</div>	
			
			<table>
				<tbody>
					<tr>
						<td><span class="td-style">CLIENT ID:</span>
						{{isset($equifaxdetails['message']['InquiryResponseHeader']['ClientID']) ? $equifaxdetails['message']['InquiryResponseHeader']['ClientID'] : ""}}
						</td>
						<td><span class="td-style">DATE:</span> {{ isset($equifaxdetails['message']['InquiryResponseHeader']['Date']) ? $equifaxdetails['message']['InquiryResponseHeader']['Date'] : "" }}</td>
					</tr>
					<tr>
						<td><span class="td-style">REPORT ORDER NO:</span> " "</td>
						<td><span class="td-style">TIME:</span> {{ isset($equifaxdetails['message']['InquiryResponseHeader']['Time']) ? $equifaxdetails['message']['InquiryResponseHeader']['Time'] : "" }}</td>
					</tr>
					<tr>
						<td><span class="td-style">REFERENCE NUMBER:</span> {{ $equifaxdetails['message']['InquiryResponseHeader']['CustRefField'] }}</td>
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
									Consumer Name: {{ isset($equifaxdetails['message']['InquiryRequestInfo']['FirstName']) ? $equifaxdetails['message']['InquiryRequestInfo']['FirstName'].$equifaxdetails['message']['InquiryRequestInfo']['LastName'] : "" }}
									
								</h3>
								<h3 class = "data-field">
									
									Mobile: {{ isset($equifaxdetails['message']['InquiryRequestInfo']['InquiryPhones'][0]['Number']) ? $equifaxdetails['message']['InquiryRequestInfo']['InquiryPhones'][0]['Number'] : "" }}
								</h3>
							</td>
						</tr>
					</thead>
				</table>
			</div>

			
			<hr>
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
							<td><span>PAN:</span> {{ isset($pan_num) ? $pan_num : "" }}</td>
							<td><span>Home:</span> {{ isset($equifaxdetails['message']['InquiryRequestInfo']['InquiryPhones'][0]['Number']) ? $equifaxdetails['message']['InquiryRequestInfo']['InquiryPhones'][0]['Number'] : "" }}</td>
						</tr>
						<tr class="td-elements">
							<td><span>Alias Name:</span></td>
							<td><span>Voter ID:</span>{{ isset($equifaxdetails['VoterID']) ? $equifaxdetails['VoterID'] : "" }}</td>
							<td><span>Office:</span> </td>
						</tr>
						<tr class="td-elements">
							<td><span>DOB:</span> {{ isset($equifaxdetails['DOB']) ? $equifaxdetails['DOB'] : "" }}</td>
							<td><span>Passport ID: {{ isset($equifaxdetails['NationalIDCard']) ? $equifaxdetails['NationalIDCard'] : "" }}</span></td>
							<td><span>Mobile:</span> </td>
						</tr>
						<tr class="td-elements">
							<td><span>Age:</span> {{ isset($equifaxdetails['age']) ? $equifaxdetails['age'] : "" }}</td>
							<td><span>UID:</span></td>
							<td><span>Alt. Home/Other No. :</span> </td>
						</tr>
						<tr class="td-elements">
							<td><span>Gender:</span> {{ isset($equifaxdetails['gender']) ? $equifaxdetails['gender'] : "" }}</td>
							<td><span>Driver's License: {{ isset($equifaxdetails['driving_licence']) ? $equifaxdetails['driving_licence'] : "" }}</span></td>
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
			<hr>
			
			<div class = "row">
				<table class = "table text-center">
					<thead class = "data-title">
						<tr>
							<th scope = "col" colspan = 4>Report Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						<td><h>Consumer not found in bureau<h>   
							
						</tr>													
					</tbody>
				</table>
			</div>
			

			
			

			
				
		</div>
	</main>
</body>
</html>