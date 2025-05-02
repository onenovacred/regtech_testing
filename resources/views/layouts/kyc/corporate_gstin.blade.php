@extends('adminlte::page')

@section('title', 'CORPORATE GSTIN')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">
    Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">CORPORATE GSTIN</h3>
                    <a role = "button" class = "btn btn-light float-right"
                        href = "{{ route('kyc.corporate_gstin_apis') }}">GSTIN APIs</a>
                </div>
                <div class="card-body">
                    {{-- @if (
                        (isset($corporate_gstin[0]['corporate_gstin']['code']) &&
                            $corporate_gstin[0]['corporate_gstin']['code'] == '102') ||
                            $corporate_gstin[0]['corporate_gstin']['code'] == '404')
                        <div class="alert alert-danger" role="alert">
                            CORPORATE GSTIN is Invalid
                        </div>
                    @endif
                    @if (isset($corporate_gstin[0]['corporate_gstin']['code']) && $corporate_gstin[0]['corporate_gstin']['code'] == '400')
                        <div class="alert alert-danger" role="alert">
                            Server Error, Please try later
                        </div>
                    @endif
                    @if (isset($corporate_gstin[0]['corporate_gstin']['code']) && $corporate_gstin[0]['corporate_gstin']['code'] == '500')
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif --}}
                    @if (isset($statusCode) &&  $statusCode == 500)
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                    </div>
                    @endif
                    @if (isset($statusCode) &&  $statusCode == 102)
                     <div class="alert alert-danger" role="alert">
                         CORPORATE GSTIN Is Invalid
                     </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.corporate_gstin') }}">
                                {{ csrf_field() }}
                                @if (isset($gstinRequest[1]) && $gstinRequest[1] == 'gstin')
                                    <div class="form-group">
                                        <label for="name">CORPORATE GSTIN NUMBER</label>
                                        <input type="text" class="form-control" id="corporate_gstin"
                                            name="corporate_gstin" value="{{ old('corporate_gstin') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                    @else
                                    <div class="form-group">
                                        <label for="name">CORPORATE GSTIN NUMBER</label>
                                        <input type="text" class="form-control" id="corporate_gstin" name="corporate_gstin"
                                            value="{{ old('corporate_gstin') }}" placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @endif
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($corporate_gstin) && $corporate_gstin[0]['corporate_gstin']['code'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">CORPORATE GSTIN Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Business Name:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['legal_name']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['legal_name'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>GSTIN Number:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['gstin']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['gstin'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Status:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['status']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['status'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Trade Name:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['trade_name']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['trade_name'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Taxpayer Type:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['taxpayer_type']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['taxpayer_type'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Registration Date:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['reg_date']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['reg_date'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Nature:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['nature']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['nature'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Jurisdiction:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['jurisdiction']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['jurisdiction'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Business Type:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['business_type']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['business_type'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Last Update:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['last_update']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['last_update'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>State Code:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['state_code']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['state_code'] }}
                                        @else
                                            ''
                                        @endif
                                    </p>
                                    <p><strong>Address:</strong>
                                        @if (isset($corporate_gstin[0]['corporate_gstin']['response']['address']['addr1']))
                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['address']['addr1'] }}
                                        @else
                                            ''
                                            @endif, @if (isset($corporate_gstin[0]['corporate_gstin']['response']['address']['addr2']))
                                                {{ $corporate_gstin[0]['corporate_gstin']['response']['address']['addr2'] }}
                                            @else
                                                ''
                                                @endif, @if (isset($corporate_gstin[0]['corporate_gstin']['response']['address']['pin']))
                                                    {{ $corporate_gstin[0]['corporate_gstin']['response']['address']['pin'] }}
                                                @else
                                                    ''
                                                    @endif, @if (isset($corporate_gstin[0]['corporate_gstin']['response']['address']['state']))
                                                        {{ $corporate_gstin[0]['corporate_gstin']['response']['address']['state'] }}
                                                    @else
                                                        ''
                                                        @endif, @if (isset($corporate_gstin[0]['corporate_gstin']['response']['address']['city']))
                                                            {{ $corporate_gstin[0]['corporate_gstin']['response']['address']['city'] }}
                                                        @else
                                                            ''
                                                            @endif, @if (isset($corporate_gstin[0]['corporate_gstin']['response']['address']['district']))
                                                                {{ $corporate_gstin[0]['corporate_gstin']['response']['address']['district'] }}
                                                            @else
                                                                ''
                                                            @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($corporate_gstin_response[0]['corporate_gstin']) && $corporate_gstin_response[0]['corporate_gstin'] != null)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">CORPORATE GSTIN Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['request_id']))
                                <p><strong>Request Id:</strong>
                                    {{ $corporate_gstin_response[0]['corporate_gstin']['response']['request_id'] }}
                                </p>
                                @else
                                  
                                @endif
                                @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['legal_name']))
                                <p><strong>Business Name:</strong>
                                    {{ $corporate_gstin_response[0]['corporate_gstin']['response']['legal_name'] }}
                                </p>
                                @else
                                  
                                @endif
                                 @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['gstin']) )
                                    <p><strong>GSTIN Number:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['gstin'] }}
                                    </p>   
                                 @else
                                 @endif
                                   @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['status']))
                                     <p><strong>Status :</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['status'] }}
                                    </p>    
                                    @else
                                      
                                    @endif
                                    @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['trade_name']))
                                       <p><strong>Trade Name:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['trade_name'] }}
                                       </p>
                                    @else
                                      
                                    @endif
                                    @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['taxpayer_type']))
                                    <p><strong>Taxpayer Type:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['taxpayer_type'] }}
                                    </p>
                                    @else
                                       
                                    @endif
                                     @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['reg_date']))
                                        <p><strong>Registration Date:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['reg_date'] }}
                                       </p>
                                    @else
                                    @endif
                                    @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['state_code']))
                                    <p><strong>Status Code:</strong>
                                       {{ $corporate_gstin_response[0]['corporate_gstin']['response']['state_code'] }}
                                   </p>    
                                   @else
                                     
                                   @endif
                                   @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['nature']))
                                   <p><strong>Nature:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['nature'] }}
                                    </p>    
                                    @else
                                       
                                    @endif
                                    @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['jurisdiction']))
                                    <p><strong>Jurisdiction:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['jurisdiction'] }}
                                    </p>
                                    @else
                                    
                                    @endif
                                 @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['business_type']))
                                     <p><strong>Business Type:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['business_type'] }}
                                    </p>   
                                    @else
                                    @endif
                                    @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['last_update']))
                                    <p><strong>Last Update:</strong>
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['last_update'] }}
                                    </p>
                                    @else
                                    @endif
                                @if(isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']))
                                <p><strong>Address:</strong>
                                    @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['addr1']))
                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['addr1'] }}
                                    @else
                                       
                                        @endif, @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['addr2']))
                                            {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['addr2'] }}
                                        @else
                                            
                                            @endif, @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['pin']))
                                                {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['pin'] }}
                                            @else
                                               
                                                @endif, @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['state']))
                                                    {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['state'] }}
                                                @else
                                                    
                                                    @endif, @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['city']))
                                                        {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['city'] }}
                                                    @else
                                                       
                                                        @endif, @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['district']))
                                                            {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['district'] }}
                                                        @else
                                                          
                                                        @endif,
                                                        @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['nature']))
                                                            {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['nature'] }}
                                                        @else
                                                          
                                                        @endif,
                                                        @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['lat']))
                                                            {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['lat'] }}
                                                        @else
                                                          
                                                        @endif,
                                                        @if (isset($corporate_gstin_response[0]['corporate_gstin']['response']['address']['long']))
                                                            {{ $corporate_gstin_response[0]['corporate_gstin']['response']['address']['long'] }}
                                                        @else
                                                          
                                                        @endif
                                   </p>
                               @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endif
        </div>
    </div>
@stop


@section('custom_js')

@stop
