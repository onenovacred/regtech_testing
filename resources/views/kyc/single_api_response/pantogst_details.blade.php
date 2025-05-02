@if (!empty($pantogstDetails) && !empty($pantogstDetails['status_code']) && $pantogstDetails['status_code'] ==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PAN TO GST Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <table class = "table text-center table-responsive table-bordered" cellspacing="0">
                     <thead>
                        <tr class = "card-header">
                            <th scope = "col" style="border-radius: 0.25rem 0 0 0 !important;">stjCd</th>
                            <th scope = "col">LegalName</th>
                            <th scope = "col">Stj</th>
                            <th scope = "col">Dty</th>
                            <th scope = "col">Adadr</th>
                            <th scope = "col">Cxdt</th>
                            <th scope = "col">GSTIN</th>
                            <th scope = "col">Nba</th>
                            <th scope = "col">LastUpdate</th>
                            <th scope = "col">RegisterDate</th>
                            <th scope = "col">Ctb</th>
                            <th scope = "col">STS</th>
                            <th scope = "col">TradeName</th>
                            <th scope = "col">CtjCd</th>
                            <th scope = "col">Ctj</th>
                            <th scope = "col">EinvoiceStatus</th>
                        </tr>

                     </thead>
                     <tbody>
                    @if(isset($pantogstDetails['response']))
                       @foreach($pantogstDetails['response'] as $data)
                        <tr class="td-elements">
                                <td> {{ isset($data['stjCd']) ? $data['stjCd'] : "null" }}</td>
                                <td>{{ isset($data['lgnm']) ? $data['lgnm'] : "null" }}</td>
                                <td>{{ isset($data['stj']) ? $data['stj'] : "null" }}</td>
                                <td>{{ isset($data['dty']) ? $data['dty'] : "null" }}</td>
                                <td> {{ isset($data['adadr'][0]) ? $data['adadr'][0] : "null" }}</td>
                                <td>{{ isset($data['cxdt']) ? $data['cxdt'] : "null" }}</td>
                                <td>{{ isset($data['gstin']) ? $data['gstin'] : "null" }}</td>
                                <td>{{ isset($data['nba'][0]) ? $data[ 'nba'][0] : "null" }}</td>
                                <td>{{ isset($data['lstupdt']) ? $data['lstupdt'] : "null" }}</td>
                                <td>{{ isset($data['rgdt']) ? $data['rgdt'] : "null" }}</td>
                                <td>{{ isset($data['ctb']) ? $data['ctb'] : "null" }}</td>
                                <td>{{ isset($data['sts']) ? $data['sts'] : "null" }}</td>
                                <td>{{ isset($data['tradeNam']) ? $data['tradeNam'] : "null" }}</td>
                                <td>{{ isset($data['ctjCd']) ? $data['ctjCd'] : "null" }}</td>
                                <td>{{ isset($data['ctj']) ? $data['ctj'] : "null" }}</td>
                                <td>{{ isset($data['einvoiceStatus'])?$data['einvoiceStatus'] : "null" }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                </table>
                   <h4 class="text-center text-muted"><strong>Address</strong></h4>
                   <hr/>
                   <table class = "table text-center table-responsive table-bordered" cellspacing="0">
                    <thead>
                       <tr class = "card-header">
                           <th scope = "col">BNM</th>
                           <th scope = "col">Location</th>
                           <th scope = "col">ST</th>
                           <th scope = "col">BNO</th>
                           <th scope = "col">District</th>
                           <th scope = "col">Latitude </th>
                           <th scope = "col">Locality</th>
                           <th scope = "col">Pincode</th>
                           <th scope = "col">LandMark</th>
                           <th scope = "col">Stcd</th>
                           <th scope = "col">Geocodelvl</th>
                           <th scope = "col">FlateNo</th>
                           <th scope = "col">Longitude</th>
                           <th scope = "col">NTR</th>
                       </tr>
                   </thead>
                    <tbody>
                   @if(isset($pantogstDetails['response']))
                      @foreach($pantogstDetails['response'] as $data)
                       <tr class="td-elements">
                               <td> {{isset($data['pradr']['addr']['bnm'])?  $data['pradr']['addr']['bnm'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['loc']) ? $data['pradr']['addr']['loc'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['st']) ? $data['pradr']['addr']['st'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['bno']) ? $data['pradr']['addr']['bno'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['dst']) ? $data['pradr']['addr']['dst'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['lt']) ? $data['pradr']['addr']['lt'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['locality']) ? $data['pradr']['addr']['locality'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['pncd']) ? $data['pradr']['addr']['pncd'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['landMark']) ? $data['pradr']['addr']['landMark'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['stcd']) ? $data['pradr']['addr']['stcd'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['geocodelvl']) ? $data['pradr']['addr']['geocodelvl'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['flno']) ? $data['pradr']['addr']['flno'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['addr']['lg']) ? $data['pradr']['addr']['lg'] : "null" }}</td>
                               <td>{{ isset($data['pradr']['ntr'])?  $data['pradr']['ntr'] : "null" }}</td>
                           </tr>
                       @endforeach
                   @endif
               </tbody>
               </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif