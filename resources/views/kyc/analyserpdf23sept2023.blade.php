<!DOCTYPE HTML>
<html>
<head>
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
		position: absolute;
		width: 100%;
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
	
		/* .header img {
			float: left;
			width: 150px;
			height: 140px;
			
		} */

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
					<img src = "{{asset('/logos/regtech.png')}}" alt="logo" style="margin-left:40px; margin-bottom:6px; width:10%; height:65px">
				</div>
				<img src = "{{asset('/logos/regtech4.png')}}" alt="logo" style="margin-left:30px; width:15%; height:35px">
				
			</div>	
			</div>	
			
			
		</div>
		
	</header>
	<main>
	<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<!-- <td><h3 class = "data-field">Statement: </h3></td> -->
						<div class="row">
							<div class="col-md-4 offset-md-3">
							
							</div>
							<h1 style = "color:grey;margin-left:250px;">Bank Analyser</h1>
						</div>	
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>Date</td>							
							<td>Amount</td>
							<td>Description</td>
							<td>Type</td>
							<td>bank</td>
							<td>Balance</td>
							
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($statmendata as $statmendatas)
							<tr>
								<td>{{isset($statmendatas['dateTime']) ? $statmendatas['dateTime']  : ""}}</td>
								<td>{{isset($statmendatas['amount']) ? $statmendatas['amount']  : ""}}</td>
								<td>{{isset($statmendatas['transactionNumber']) ? $statmendatas['description']  : ""}}</td>
								<td>{{isset($statmendatas['type']) ? $statmendatas['type']  : ""}}</td>	
								<td>{{isset($statmendatas['bank']) ? $statmendatas['bank']  : ""}}</td>
								<td>{{isset($statmendatas['balanceAfterTransaction']) ? $statmendatas['balanceAfterTransaction']  : ""}}</td>
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
		<h3 style = "color:darkblue;margin-left:40px">@ Powered by RegTech &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: support@regtech.in</h3>
		</div>
    </footer>
	
</body>
</html>