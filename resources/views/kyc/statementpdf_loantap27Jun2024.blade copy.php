<!DOCTYPE HTML>
<html>
<head>
	<style>
		header {
			top: 0px;
			left: 0px;
			right: 0px;
			width:100%;
		}

		footer {
		bottom: 0;
		height: 25px;
		left: 0;
		position: absolute;
		width:100%;
		}

		body{
			font-size: 16px;
			width:100%;
			height:100%;
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
		/* MY Css*/
		.header h3{
			margin:auto;
		}

		h3{
			color:white;
		}

		.data-field{
			color:grey;
		}
		.data-title{
			height:100%;
			width:100%;
		}
		.data-title tr td{
			font-size:16px;
		}
		/* body{
			height:100%;
			width:100%;
		} */
	
	
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
					<img src = "{{public_path('/logos/regtech.png')}}" alt="logo" style="margin-left:40px; margin-bottom:6px; width:10%; height:65px">
				</div>
				<img src = "{{public_path('/logos/regtech4.png')}}" alt="logo" style="margin-left:30px; width:15%; height:35px">
			</div>	
			</div>	
	</header>
	<main>
	<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<div class="row">
							<div class="col-md-4 offset-md-3">
							</div>
							<h1 style = "color:grey;margin-left:500px;">Bank Statement</h1>
						</div>	
					</tr>
				</thead>
			</table>
		</div>
		 @if(isset($bankStatements))
		  <div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>Date</td>
							<td>TransactionId</td>
							<td>Description</td>
							<td>Category</td>
							<td>Type</td>
							<td>Amount</td>
							<td>Balance</td>
							
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($bankStatements as $statmendatas)
							<tr>
								<td class=" text-break text-center">{{isset($statmendatas['dateTime']) ? $statmendatas['dateTime']  : ""}}</td>
								<td class=" text-break text-center">{{isset($statmendatas['TransactionId']) ? $statmendatas['TransactionId']  : ""}}</td>
								<td class=" text-break text-center">{{isset($statmendatas['description']) ? $statmendatas['description']  : ""}}</td>
								<td class=" text-break text-center">{{isset($statmendatas['category']) ? $statmendatas['category']  : ""}}</td>
								<td class=" text-break text-center">{{isset($statmendatas['type']) ? $statmendatas['type']  : ""}}</td>
								<td class=" text-break text-center">{{isset($statmendatas["amount"]) ? $statmendatas["amount"]  : ""}}</td>
								<td class=" text-break text-center">{{isset($statmendatas["balanceAfterTransaction"]) ? $statmendatas[ "balanceAfterTransaction"]  : ""}}</td>
							</tr>
						@endforeach	
					</tbody>
				</table>
			</div>
			@endif
			@if(isset($bankStatement))
			<div class = "row">
				<?php
				   $keys = array_keys($bankStatement['table_data'][0]);
                   $keys = array_slice($keys, 0,7);
                ?>  
				<table cellspacing="0">
					<thead class = "data-title">	
						<tr>
							@foreach($keys as $key)
							   <td style="text-align:center;">{{ isset($key)?$key:''}}</td>
						    @endforeach
						</tr>
					</thead>
					 <tbody class="table-style">
					   @foreach($bankStatement['table_data'] as $statmendatas)
					   <tr>
						   @foreach($keys as $key)
						   <td class="text-wrap text-break">{{ isset($statmendatas[$key])?$statmendatas[$key]:'' }}</td>
					       @endforeach
					   </tr>
					   @endforeach
					 </tbody>
				</table>
			</div>
			@endif
		<hr>
	</main>
	<footer class="footer">
		<hr tyle = "color:red;">	
		<div class="footer__inner">
		<h3 style = "color:darkblue;margin-left:300px">@ Powered by RegTech &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email: support@regtech.in</h3>
    </footer>
	
</body>
</html>