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
			background-color:#397613;
			color:#FFFFFF;
			font-size:15px;	 
			font-weight: 700;	
			height:25px;
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
			color: rgb(44, 42, 42);
            font-family: 'ui-monospace';
            font-size:18px;
			font-weight:500;
		}

		body{
			height:100%;
			width:100%;
		}
		.td-style{
			color: black;
			font-family:'ui-monospace';
			font-size:16px;
			font-weight: 700;
		}
		.td-elements span{
			color: #060606;
            font-style: initial;
            font-size: 13px;
            font-weight: 700;
		}
	</style>

</head>
<body> 
	<header>
		<div class = "header">
			<div class="row">
				<div class="col-md-4 offset-md-3">
					<img src = "{{public_path('/uploads/dunzo-logo.png')}}" alt="logo" style="margin-right:40px; width:25%; height:6%;">
				</div>
				<h1 style = "color:grey;">CREATE TASK DUNZO API REPORT</h1>
			</div>	
			 <table>
				<tbody>
					<tr>
						<td><span class="td-style">TASK ID:{{$data['task_id']}}</span>
					    </td>
						<td><span class="td-style">STATE:{{$data['state']}}</span></td>
					</tr>
					<tr>
						<td><span class="td-style">DISTANCE:{{$data['distance']}}</span></td>
						<td><span class="td-style">ESTIMATED PRICE:{{$data['estimated_price']}}</span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<hr>
	</header>
	<main>
      <div class = "container" style = "background-color: white;">
		<div class = "row">
			<table class = "table">
				<thead>
					<tr>
						<td><h3 class = "data-field">Surge Charge Information:</h3></td>
					</tr>
				</thead>
			</table>
		</div>
		<div class = "row">
			<table class = "table text-center" cellspacing="0">
				<tbody class="table-style">	
					<tr  class = "data-title" style="text-align: center">
						<th scope = "col">Surge</th>
						<th scope = "col">Surge Multiplier</th>
						<th scope = "col">Multi Drop Price</th>
						<th scope = "col">Multidrop Price Per Drop</th>
					</tr>
					 <tr>
						 <td style ="text-align: center;">{{ $data['estimated_price_breakup']['delivery_charge_breakup']['surge']}}</td>
						 <td style ="text-align: center;">{{ $data['estimated_price_breakup']['delivery_charge_breakup']['surge_multiplier']}}</td>
						 <td style ="text-align: center;">{{ $data['estimated_price_breakup']['delivery_charge_breakup']['multi_drop_price']}}</td>
						 <td style ="text-align: center;">{{$data['estimated_price_breakup']['delivery_charge_breakup']['multi_drop_price_per_drop']}}</td>
					</tr>	
				</tbody>
			</table>
		</div>
		<hr/>
		<div class = "row">
			<table class = "table">
				<thead>
					<tr>
						<td><h3 class = "data-field">COD Transaction Fee Breakdown:</h3></td>
					</tr>
				</thead>
			</table>
		</div>
		<div class = "row">
			<table class = "table text-center" cellspacing="0">
				<tbody>	
					<tr  class = "data-title" style="text-align: center">
						<th scope = "col">Transaction fee</th>
						<th scope = "col">Amount</th>
						<th scope = "col">Rount Off</th>
						<th scope = "col">Value</th>
						<th scope = "col">Type</th>
					</tr>
					<tr>
						<td style ="text-align: center;">{{ $data['estimated_price_breakup']['cod_txn_fee']}}</td>
						<td style ="text-align: center;">{{ $data['estimated_price_breakup']['cod_txn_fee_breakup']['amount']}}</td>
						<td style ="text-align: center;">{{ $data['estimated_price_breakup']['cod_txn_fee_breakup']['round_off']}}</td>
						<td style ="text-align: center;">{{ $data['estimated_price_breakup']['cod_txn_fee_breakup']['txn_fee_rule']['value']}}</td>
						<td style ="text-align: center;">{{$data['estimated_price_breakup']['cod_txn_fee_breakup']['txn_fee_rule']['type']}}</td>
				   </tr>		
				</tbody>
			</table>
		</div>		
		<hr/>
		<div class = "row">
			<table class = "table">
				<thead>
					<tr>
						<td><h3 class = "data-field">Drop Breakup Information:</h3></td>
					</tr>
				</thead>
			</table>
		</div>
		<div class = "row">
			<table class = "table text-center" cellspacing="0">
				<tbody class="table-style">		
					<tr  class = "data-title" style="text-align: center">
						<th scope = "col">Reference Id</th>
						<th scope = "col">Product Amount</th>
						<th scope = "col">Transaction Fee Amount</th>
					</tr>
					@foreach ($data['estimated_price_breakup']['cod_txn_fee_breakup']['drop_breakup'] as $drop)
                    <tr>
                        <td style ="text-align: center;">{{ $drop['drop_reference_id'] }}</td>
                        <td style ="text-align: center;">{{ $drop['product_amount'] }}</td>
                        <td style ="text-align: center;">{{ $drop['txn_fee_amount'] }}</td>
                     </tr>
                	@endforeach
				</tbody>
			</table>
		</div>
		<div class = "row">
			<table class = "table">
				<thead>
					<tr>
						<td><h3 class = "data-field">Goods and Services Tax (GST):</h3></td>
					</tr>
				</thead>
			</table>
		</div>
			<div class = "row">
				<table class = "table" cellspacing="0">
					<tbody>
						<tr class = "data-title">
							<td scope = "col">Goods and Services Tax Percentage (GSTP)</td>
							<td scope = "col">Goods and Services Tax (GST)</td>
							<td scope = "col">GST Amount</td>
						</tr>
						<tr class="td-elements">
							<td><span>Central Goods and Services Tax : ({{ $data['estimated_price_breakup']['delivery_charge_breakup']['gst_breakup']['cgst_percentage'] }}%)</span></td>
							<td><span>Central Goods and Services Tax :{{$data['estimated_price_breakup']['delivery_charge_breakup']['gst_breakup']['cgst']}}</span></td>
							<td><span>Total GST Amount: 13000</span></td>
						</tr>	
						<tr class="td-elements">
                            <td><span>State Goods and Services Tax:({{ $data['estimated_price_breakup']['delivery_charge_breakup']['gst_breakup']['sgst_percentage'] }}%)</span></td>
							<td><span>State Goods and Services Tax:{{$data['estimated_price_breakup']['delivery_charge_breakup']['gst_breakup']['sgst']}}</span></td>
							
						</tr>	
						<tr class="td-elements">
							<td><span>Integrated Goods and Services Tax:</span>({{ $data['estimated_price_breakup']['delivery_charge_breakup']['gst_breakup']['igst_percentage'] }}%)</td>
							<td><span>Integrated Goods and Services Tax:{{$data['estimated_price_breakup']['delivery_charge_breakup']['gst_breakup']['igst']}}</span></td>
						</tr>


					</tbody>
				</table>
			</div>
			<hr/>
			<div class = "row">
				<table class = "table text-center">
					<thead class = "data-title">
						<tr>
							<th scope = "col" colspan ="4">Delivery Report</th>
						</tr>
					</thead>
					<tbody>
					    <tr class="td-elements text-center"  style="text-align: center">
								<td><span>Delivery Charage:{{$data['estimated_price_breakup']['delivery_charge']}}</span></td>
								<td><span>Delivery Base Charage:{{$data['estimated_price_breakup']['delivery_charge_breakup']['base_delivery_charge']}}</span></td>
						</tr>													
					</tbody>
				</table>
			</div>
			<hr/>
			<div class = "row">
				<table class = "table text-center">
					<thead class = "data-title">
						<tr>
							<th scope = "col" colspan ="4">Estimated Time of Arrival</th>
						</tr>
					</thead>
					<tbody>
						<tr class="td-elements text-center"  style="text-align: center">
								<td><span>Pick Up:{{$data['eta']['pickup']}}</span></td>
								<td><span>Drop Off:{{$data['eta']['dropoff']}}</span></td>
						</tr>													
					</tbody>
				</table>
			</div>
		</div>
	</main>
</body>
</html>