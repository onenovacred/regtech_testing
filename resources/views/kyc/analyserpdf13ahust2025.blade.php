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

        body {
            font-size: 13px;
            height: 100%;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
            vertical-align: top;
            border: 1px solid #ddd;
        }

        .data-title {
            background-color: #8B0000;
            color: #FFFFFF;
            height: 20px;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;
        }

        h3 {
            color: white;
            margin: 0;
        }

        .data-field {
            color: grey;
        }

        .td-style {
            color: #8B0000;
            font-style: italic;
        }

        .td-elements span {
            color: grey;
            font-style: italic;
        }

        .table-style tr:nth-child(even) {
            background: #CCC;
        }

        .table-style tr:nth-child(odd) {
            background: #FFF;
        }

        .section {
            margin-bottom: 30px;
        }

        .anomaly {
            color: red;
            font-weight: bold;
        }

        .logo-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .logo-container img {
            height: 50px;
        }
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
        <h1>Bank Statement Analysis Report</h1>
{{-- <pre>{{ print_r($metadata, true) }}</pre> --}}


{{-- Metadata --}}
<div class="section">
    <h2>Account  Details</h2>
    <table cellspacing="0">
        <thead class="data-title">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody class="table-style">
            <tr><td>Bank Name</td><td>{{ $metadata['bank_name'] ?? 'N/A' }}</td></tr>
            <tr><td>Account Holder</td><td>{{ $metadata['account_holder_name'] ?? 'N/A' }}</td></tr>
            <tr><td>Account Number</td><td>{{ $metadata['account_number'] ?? 'N/A' }}</td></tr>
            <tr><td>Account Type</td><td>{{ $metadata['account_type'] ?? 'N/A' }}</td></tr>
            <tr><td>Statement Period</td><td>{{ $metadata['statement_period_start'] ?? 'N/A' }} to {{ $metadata['statement_period_end'] ?? 'N/A' }}</td></tr>
            <tr><td>Currency</td><td>{{ $metadata['currency'] ?? 'N/A' }}</td></tr>
            <tr><td>Confidence Score</td><td>{{ $metadata['confidence_score'] ?? 'N/A' }}</td></tr>
        </tbody>
    </table>
</div>

{{-- Summary --}}
<div class="section">
    <h2>Summary</h2>
    <table cellspacing="0">
        <thead class="data-title">
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody class="table-style">
            <tr><td>Total Debit</td><td>{{ $summary['total_debit'] ?? 'N/A' }}</td></tr>
            <tr><td>Total Credit</td><td>{{ $summary['total_credit'] ?? 'N/A' }}</td></tr>
            <tr><td>Opening Balance</td><td>{{ $summary['opening_balance'] ?? 'N/A' }}</td></tr>
            <tr><td>Closing Balance</td><td>{{ $summary['closing_balance'] ?? 'N/A' }}</td></tr>
            <tr><td>Net Balance Change</td><td>{{ $summary['net_balance_change'] ?? 'N/A' }}</td></tr>
            <tr><td>Number of Transactions</td><td>{{ $summary['num_transactions'] ?? 'N/A' }}</td></tr>
        </tbody>
    </table>
</div>

        {{-- High Value Transactions --}}
        <div class="section">
            <h2>High Value Transactions</h2>
            <table cellspacing="0">
                <thead class="data-title">
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody class="table-style">
                    @foreach ($high_value_txns as $txn)
                        <tr>
                            <td>{{ $txn['date'] ?? 'N/A' }}</td>
                            <td>{{ $txn['amount'] ?? 'N/A' }}</td>
                            <td>{{ $txn['description'] ?? 'N/A' }}</td>
                            <td>{{ $txn['transaction_type'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Transactions --}}
        <div class="section">
            <h2>Transactions</h2>
            <table cellspacing="0">
                <thead class="data-title">
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody class="table-style">
                    @foreach ($transactions as $txn)
                        <tr>
                            <td>{{ $txn['date'] ?? 'N/A' }}</td>
                            <td>{{ $txn['description'] ?? 'N/A' }}</td>
                            <td>{{ $txn['debit'] ?? 'N/A' }}</td>
                            <td>{{ $txn['credit'] ?? 'N/A' }}</td>
                            <td>{{ $txn['balance'] ?? 'N/A' }}</td>
                            <td>{{ $txn['category'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Insights --}}
        <div class="section">
            <h2>Insights</h2>
            <table cellspacing="0">
                <tr><th>Average Monthly Savings</th><td>{{ $insights['average_monthly_savings'] ?? 'N/A' }}</td></tr>
                <tr><th>Spending to Income Ratio</th><td>{{ $insights['spending_to_income_ratio'] ?? 'N/A' }}</td></tr>
                <tr><th>Estimated Annual Income</th><td>{{ $insights['estimated_annual_income'] ?? 'N/A' }}</td></tr>
            </table>
            @if (!empty($insights['anomaly_remarks']))
                <h3>Anomalies Detected</h3>
                <ul>
                    @foreach ($insights['anomaly_remarks'] as $remark)
                        <li class="anomaly">{{ $remark }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Include other sections like ATM Withdrawals, Expenses, Incomes, etc. here in same format --}}
        {{-- You can simply paste the rest of your existing sections below this if needed --}}
    </main>

    <footer class="footer">
        <hr>
        <div class="footer__inner">
            <h3 style="color:darkblue; margin-left:40px">
                @ Powered by RegTech&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Us: support@regtechapi.in
            </h3>
        </div>
    </footer>
</body>
</html>





{{-- <!DOCTYPE HTML>
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

    <h1>Bank Statement Analysis Report</h1>

    <div class="section">
        <h2>Metadata</h2>
        <table cellspacing="0">
            <tr><th>Bank Name</th><td>{{ $metadata['bank_name'] ?? 'N/A' }}</td></tr>
            <tr><th>Account Holder</th><td>{{ $metadata['account_holder_name'] ?? 'N/A' }}</td></tr>
            <tr><th>Account Number</th><td>{{ $metadata['account_number'] ?? 'N/A' }}</td></tr>
            <tr><th>Account Type</th><td>{{ $metadata['account_type'] ?? 'N/A' }}</td></tr>
            <tr><th>Statement Period</th><td>{{ $metadata['statement_period_start'] ?? 'N/A' }} to {{ $metadata['statement_period_end'] ?? 'N/A' }}</td></tr>
            <tr><th>Currency</th><td>{{ $metadata['currency'] ?? 'N/A' }}</td></tr>
            <tr><th>Confidence Score</th><td>{{ $metadata['confidence_score'] ?? 'N/A' }}</td></tr>
        </table>
    </div>

    <div class="section">
        <h2>Summary</h2>
        <table cellspacing="0">
            <tr><th>Total Debit</th><td>{{ $summary['total_debit'] ?? 'N/A' }}</td></tr>
            <tr><th>Total Credit</th><td>{{ $summary['total_credit'] ?? 'N/A' }}</td></tr>
            <tr><th>Opening Balance</th><td>{{ $summary['opening_balance'] ?? 'N/A' }}</td></tr>
            <tr><th>Closing Balance</th><td>{{ $summary['closing_balance'] ?? 'N/A' }}</td></tr>
            <tr><th>Net Balance Change</th><td>{{ $summary['net_balance_change'] ?? 'N/A' }}</td></tr>
            <tr><th>Number of Transactions</th><td>{{ $summary['num_transactions'] ?? 'N/A' }}</td></tr>
        </table>
    </div>

    <div class="section">
        <h2>High Value Transactions</h2>
        <table cellspacing="0">
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Type</th>
            </tr>
            @foreach ($high_value_txns as $txn)
                <tr>
                    <td>{{ $txn['date'] ?? 'N/A' }}</td>
                    <td>{{ $txn['amount'] ?? 'N/A' }}</td>
                    <td>{{ $txn['description'] ?? 'N/A' }}</td>
                    <td>{{ $txn['transaction_type'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h2>Transactions</h2>
        <table cellspacing="0">
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
                <th>Category</th>
            </tr>
            @foreach ($transactions as $txn)
                <tr>
                    <td>{{ $txn['date'] ?? 'N/A' }}</td>
                    <td>{{ $txn['description'] ?? 'N/A' }}</td>
                    <td>{{ $txn['debit'] ?? 'N/A' }}</td>
                    <td>{{ $txn['credit'] ?? 'N/A' }}</td>
                    <td>{{ $txn['balance'] ?? 'N/A' }}</td>
                    <td>{{ $txn['category'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h2>Insights</h2>
        <table cellspacing="0">
            <tr><th>Average Monthly Savings</th><td>{{ $insights['average_monthly_savings'] ?? 'N/A' }}</td></tr>
            <tr><th>Spending to Income Ratio</th><td>{{ $insights['spending_to_income_ratio'] ?? 'N/A' }}</td></tr>
            <tr><th>Estimated Annual Income</th><td>{{ $insights['estimated_annual_income'] ?? 'N/A' }}</td></tr>
        </table>
        @if (!empty($insights['anomaly_remarks']))
            <h3>Anomalies Detected</h3>
            <ul>
                @foreach ($insights['anomaly_remarks'] as $remark)
                    <li class="anomaly">{{ $remark }}</li>
                @endforeach
            </ul>
        @endif
    </div>


</main>
	<footer class="footer">
		<hr tyle = "color:red;">
		<div class="footer__inner">
			<h3 style = "color:darkblue;margin-left:40px">@ Powered by RegTech&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Us: support@docboyz.in</h3>
		</div>
    </footer>
</body>
</html> --}}
