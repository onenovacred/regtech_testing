@if(!empty($uan_details['UAN Details']) && $uan_details['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">UAN Details</h3>
            </div>
            <div class="card-body">
                <div class = "row">
                    <table class = "table text-center" cellspacing="0">
                        <tbody>
                            <tr class = "data-title">
                                <td scope = "col"><b>UAN:</b> {{$uan_details['UAN Details']['data']['pf_uan']}}</td>
                                <td scope = "col"><b>Client ID:</b> {{$uan_details['UAN Details']['data']['client_id']}}</td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>
</div>
@endif 