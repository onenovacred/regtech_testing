@if (!empty($BasicGstinVerification) && !empty($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code'] ==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">BASIC GSTIN Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <p><strong>StjCd:</strong>
                        {{ isset($BasicGstinVerification['response']['stjCd']) ? $BasicGstinVerification['response']['stjCd'] : 'null' }}
                    </p>
                    <p><strong>LegalName:</strong>
                        {{ isset($BasicGstinVerification['response']['lgnm']) ? $BasicGstinVerification['response']['lgnm'] : 'null' }}
                    </p>
                    <p><strong>Stj:</strong>
                        {{ isset($BasicGstinVerification['response']['stj']) ? $BasicGstinVerification['response']['stj'] : 'null' }}
                    </p>
                    <p><strong>Dty:</strong>
                        {{ isset($BasicGstinVerification['response']['dty']) ? $BasicGstinVerification['response']['dty'] : 'null' }}
                    </p>
                    <p><strong>Cxdt:</strong>
                        {{ isset($BasicGstinVerification['response']['cxdt']) ? $BasicGstinVerification['response']['cxdt'] : 'null' }}
                    </p>
                    <p><strong>Gstin:</strong>
                        {{ isset($BasicGstinVerification['response']['gstin']) ? $BasicGstinVerification['response']['gstin'] : 'null' }}
                    </p>
                    <p><strong>NBA:</strong>
                        {{ isset($BasicGstinVerification['response']['nba'][0]) ? $BasicGstinVerification['response']['nba'][0] : 'null' }}
                    </p>
                    <p><strong>LastUpdate:</strong>
                        {{ isset($BasicGstinVerification['response']['lstupdt']) ? $BasicGstinVerification['response']['lstupdt'] : 'null' }}
                    </p>
                    <p><strong>Registration Date:</strong>
                        {{ isset($BasicGstinVerification['response']['rgdt']) ? $BasicGstinVerification['response']['rgdt'] : 'null' }}
                    </p>
                    <p><strong>CTB:</strong>
                        {{ isset($BasicGstinVerification['response']['ctb']) ? $BasicGstinVerification['response']['ctb'] : 'null' }}
                    </p>
                    <p><strong>TradeName:</strong>
                        {{ isset($BasicGstinVerification['response']['tradeNam']) ? $BasicGstinVerification['response']['tradeNam'] : 'null' }}
                    </p>
                    <p><strong>CtjCd:</strong>
                        {{ isset($BasicGstinVerification['response']['ctjCd']) ? $BasicGstinVerification['response']['ctjCd'] : 'null' }}
                    </p>
                    <p><strong>STS:</strong>
                        {{ isset($BasicGstinVerification['response']['sts']) ? $BasicGstinVerification['response']['sts'] : 'null' }}
                    </p>
                    <p><strong>CTJ:</strong>
                        {{ isset($BasicGstinVerification['response']['ctj']) ? $BasicGstinVerification['response']['ctj'] : 'null' }}
                    </p>
                    <p><strong>EinvoiceStatus:</strong>
                        {{ isset($BasicGstinVerification['response']['einvoiceStatus']) ? $BasicGstinVerification['response']['einvoiceStatus'] : 'null' }}
                    </p>
                    @if(isset($BasicGstinVerification['response']['pradr']['addr']))
                    <hr/>
                    <h4 class="text-center text-muted"><strong>Permanent Address</strong></h4>
                      <p><strong>BNM:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['bnm']) ?$BasicGstinVerification['response']['pradr']['addr']['bnm'] : 'null' }}
                      </p>
                      <p><strong>Location:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['loc']) ? $BasicGstinVerification['response']['pradr']['addr']['loc'] : 'null' }}
                       </p>
                       <p><strong>ST:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['st']) ? $BasicGstinVerification['response']['pradr']['addr']['st'] : 'null' }}
                       </p>
                       <p><strong>BNO:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['bno']) ? $BasicGstinVerification['response']['pradr']['addr']['bno'] : 'null' }}
                       </p>
                       <p><strong>District:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['dst']) ? $BasicGstinVerification['response']['pradr']['addr']['dst'] : 'null' }}
                       </p>
                       <p><strong>Latitude:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['lt']) ? $BasicGstinVerification['response']['pradr']['addr']['lt'] : 'null' }}
                       </p>
                       <p><strong>Pincode:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['pncd']) ? $BasicGstinVerification['response']['pradr']['addr']['pncd'] : 'null' }}
                       </p>
                       <p><strong>LandMark:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['landMark']) ? $BasicGstinVerification['response']['pradr']['addr']['landMark'] : 'null' }}
                       </p>
                       <p><strong>Stcd:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['stcd']) ? $BasicGstinVerification['response']['pradr']['addr']['stcd'] : 'null' }}
                       </p>
                       <p><strong>Geocodelvl:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['geocodelvl']) ? $BasicGstinVerification['response']['pradr']['addr']['geocodelvl'] : 'null' }}
                       </p>
                       <p><strong>Flate Number:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['flno']) ? $BasicGstinVerification['response']['pradr']['addr']['flno'] : 'null' }}
                       </p>
                       <p><strong>Longitude:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['addr']['lg']) ? $BasicGstinVerification['response']['pradr']['addr']['lg'] : 'null' }}
                       </p>
                       <p><strong>NTR:</strong>
                        {{ isset($BasicGstinVerification['response']['pradr']['ntr']) ? $BasicGstinVerification['response']['pradr']['ntr'] : 'null' }}
                       </p>
                    @endif
                  
                    @if(isset($BasicGstinVerification['response']['adadr'][0]))
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
                  
                      @foreach($BasicGstinVerification['response']['adadr'] as $data)
                       <tr class="td-elements">
                               <td> {{isset($data['addr']['bnm'])?  $data['addr']['bnm'] : "null" }}</td>
                               <td>{{ isset($data['addr']['loc']) ? $data['addr']['loc'] : "null" }}</td>
                               <td>{{ isset($data['addr']['st']) ? $data['addr']['st'] : "null" }}</td>
                               <td>{{ isset($data['addr']['bno']) ? $data['addr']['bno'] : "null" }}</td>
                               <td>{{ isset($data['addr']['dst']) ? $data['addr']['dst'] : "null" }}</td>
                               <td>{{ isset($data['addr']['lt']) ? $data['addr']['lt'] : "null" }}</td>
                               <td>{{ isset($data['addr']['locality']) ? $data['addr']['locality'] : "null" }}</td>
                               <td>{{ isset($data['addr']['pncd']) ? $data['addr']['pncd'] : "null" }}</td>
                               <td>{{ isset($data['addr']['landMark']) ? $data['addr']['landMark'] : "null" }}</td>
                               <td>{{ isset($data['addr']['stcd']) ? $data['addr']['stcd'] : "null" }}</td>
                               <td>{{ isset($data['addr']['geocodelvl']) ? $data['addr']['geocodelvl'] : "null" }}</td>
                               <td>{{ isset($data['addr']['flno']) ? $data['addr']['flno'] : "null" }}</td>
                               <td>{{ isset($data['addr']['lg']) ? $data['addr']['lg'] : "null" }}</td>
                               <td>{{ isset($data['ntr'])?  $data['ntr'] : "null" }}</td>
                           </tr>
                       @endforeach
               </tbody>
               </table>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif
<!--Basic GSTIN End-->