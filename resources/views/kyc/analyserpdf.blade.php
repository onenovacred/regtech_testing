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
					<img src = "{{public_path('/logos/regtech.png')}}" alt="logo" style="margin-left:40px; margin-bottom:6px; width:10%; height:65px">
				</div>
				<img src = "{{public_path('/logos/regtech4.png')}}" alt="logo" style="margin-left:30px; width:15%; height:35px">
				
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
						<td><h3 class = "data-field">Amount Withdrawls: </h3></td>
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
							<td>Bank</td>
							<td>MonthAndYear</td>
							<td>Total</td>
							
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($atm_withdrawl as $atm_withdrawls)
							<tr>
								<td>{{isset($atm_withdrawls['date']) ? $atm_withdrawls['date']  : ""}}</td>
							
								<td>{{isset($atm_withdrawls['amount']) ? $atm_withdrawls['amount']  : ""}}</td>
								<td>{{isset($atm_withdrawls['description']) ? $atm_withdrawls['description']  : ""}}</td>
								<td>{{isset($atm_withdrawls['bank']) ? $atm_withdrawls['bank']  : ""}}</td>
								<td>{{isset($atm_withdrawls['monthAndYear']) ? $atm_withdrawls['monthAndYear']  : ""}}</td>
								<td>{{isset($atm_withdrawls['total']) ? $atm_withdrawls['total']  : ""}}</td>
							</tr>
						@endforeach	
					
					</tbody>
					
				</table>
			</div>
		<hr>
		<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<td><h3 class = "data-field">Average Monthly Balance: </h3></td>
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>MonthAndYear</td>
							<td>netAverageBalance</td>
							
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($averageMonthlyBalance as $averageMonthlyBalances)
							<tr>
								<td>{{isset($averageMonthlyBalances['monthAndYear']) ? $averageMonthlyBalances['monthAndYear']  : ""}}</td>
								<td>{{isset($averageMonthlyBalances['netAverageBalance']) ? $averageMonthlyBalances['netAverageBalance']  : ""}}</td>
							</tr>
						@endforeach	
					
					</tbody>
					
				</table>
			</div>
		<hr>
		<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<td><h3 class = "data-field">Average Quarterly Balance: </h3></td>
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>MonthAndYear</td>
							<td>netAverageBalance</td>
							
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($averageQuarterlyBalance as $averageQuarterlyBalances)
							<tr>
								<td>{{isset($averageQuarterlyBalances['monthAndYear']) ? $averageQuarterlyBalances['monthAndYear']  : ""}}</td>
								<td>{{isset($averageQuarterlyBalances['netAverageBalance']) ? $averageQuarterlyBalances['netAverageBalance']  : ""}}</td>
							</tr>
						@endforeach	
					
					</tbody>
					
				</table>
			</div>
		<hr>
		<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<td><h3 class = "data-field">Expenses: </h3></td>
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>Date</td>
							<td>Description</td>
							<td>Category</td>
							<td>Amount</td>
							<td>Mode</td>
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($expenses as $expensess)
							<tr>
								<td>{{isset($expensess['date']) ? $expensess['date']  : ""}}</td>
								<td>{{isset($expensess['description']) ? $expensess['description']  : ""}}</td>
								<td>{{isset($expensess['category']) ? $expensess['category']  : ""}}</td>
								<td>{{isset($expensess['amount']) ? $expensess['amount']  : ""}}</td>
								<td>{{isset($expensess['mode']) ? $expensess['mode']  : ""}}</td>
							</tr>
						@endforeach	
					
					</tbody>
					
				</table>
			</div>
		<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<td><h3 class = "data-field">High Value Transactions: </h3></td>
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>Date</td>
							<td>Description</td>
							<td>Category</td>
							<td>Amount</td>
							<td>Balance After Transcation</td>
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($high_value_transactions as $high_value_transactionss)
							<tr>
								<td>{{isset($high_value_transactionss['date']) ? $high_value_transactionss['date']  : ""}}</td>
								<td>{{isset($high_value_transactionss['description']) ? $high_value_transactionss['description']  : ""}}</td>
								<td>{{isset($high_value_transactionss['category']) ? $high_value_transactionss['category']  : ""}}</td>
								<td>{{isset($high_value_transactionss['amount']) ? $high_value_transactionss['amount']  : ""}}</td>
								<td>{{isset($high_value_transactionss['balanceAfterTranscation']) ? $high_value_transactionss['balanceAfterTranscation']  : ""}}</td>
							</tr>
						@endforeach	
					
					</tbody>
					
				</table>
			</div>
		<hr>
		<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<td><h3 class = "data-field">Incomes: </h3></td>
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>Date</td>
							<td>Description</td>
							<td>Mode</td>
							<td>IsSalary</td>
							<td>Amount</td>
							<td>Balance After Transcation</td>
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($incomes as $incomess)
							<tr>
								<td>{{isset($incomess['date']) ? $incomess['date']  : ""}}</td>
								<td>{{isset($incomess['description']) ? $incomess['description']  : ""}}</td>
								<td>{{isset($incomess['mode']) ? $incomess['mode']  : ""}}</td>
								<td>{{isset($incomess['isSalary']) ? $incomess['isSalary']  : ""}}</td>
								<td>{{isset($incomess['amount']) ? $incomess['amount']  : ""}}</td>
								<td>{{isset($incomess['balanceAfterTransaction']) ? $incomess['balanceAfterTransaction']  : ""}}</td>
							</tr>
						@endforeach	
					
					</tbody>
					
				</table>
			</div>
		<hr>
		<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<td><h3 class = "data-field">Minimum Balances: </h3></td>
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>Date</td>
							<td>Description</td>
							<td>TransactionType</td>
							<td>Amount</td>
							<td>Balance After Transcation</td>
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($minimum_balances as $minimum_balancess)
							<tr>
								<td>{{isset($minimum_balancess['date']) ? $minimum_balancess['date']  : ""}}</td>
								<td>{{isset($minimum_balancess['description']) ? $minimum_balancess['description']  : ""}}</td>
								<td>{{isset($minimum_balancess['transactionType']) ? $minimum_balancess['transactionType']  : ""}}</td>
								<td>{{isset($minimum_balancess['amount']) ? $minimum_balancess['amount']  : ""}}</td>
								<td>{{isset($minimum_balancess['balanceAfterTransaction']) ? $minimum_balancess['balanceAfterTransaction']  : ""}}</td>
							</tr>
						@endforeach	
					
					</tbody>
					
				</table>
			</div>
		<hr>
		<hr>
		<div class = "row">
			<table>
				<thead>
					<tr>
						<td><h3 class = "data-field">Money Received Transactions: </h3></td>
					</tr>
				</thead>
			</table>
		</div>


			<div class = "row">
				<table cellspacing="0">
					<thead class = "data-title">
						<tr>
							<td>Date</td>
							<td>Description</td>
							<td>Category</td>
							<td>TransactionType</td>
							<td>Amount</td>
							<td>Balance After Transcation</td>
						</tr>
					</thead>
					<tbody class="table-style">
						@foreach($money_received_transactions as $money_received_transactionss)
							<tr>
								<td>{{isset($money_received_transactionss['date']) ? $money_received_transactionss['date']  : ""}}</td>
								<td>{{isset($money_received_transactionss['description']) ? $money_received_transactionss['description']  : ""}}</td>
								<td>{{isset($money_received_transactionss['category']) ? $money_received_transactionss['category']  : ""}}</td>
								<td>{{isset($money_received_transactionss['transactionType']) ? $money_received_transactionss['transactionType']  : ""}}</td>
								<td>{{isset($money_received_transactionss['amount']) ? $money_received_transactionss['amount']  : ""}}</td>
								<td>{{isset($money_received_transactionss['balanceAfterTransaction']) ? $money_received_transactionss['balanceAfterTransaction']  : ""}}</td>
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
			<h3 style = "color:darkblue;margin-left:40px">@ Powered by RegTech&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Us: support@docboyz.in</h3>
		</div>
    </footer>
</body>
</html>