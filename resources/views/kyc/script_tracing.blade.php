@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Script Tracing.</h3>
                    <a role="button" class="btn btn-light float-right" href="">Script Tracing APIs</a>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.pancard.script_tracing')}}" id="formSubmitted">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" name="fname" id = "fname" placeholder = "Enter First Name" value="VIJAY"   autofocus required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id = "lname" placeholder = "Enter Last Name" 
                                    value="MEHTA" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="name">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" 
                                    id = "phone_number" placeholder = "Enter phone number" 
                                    value="7830645084" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="dob" name="dob" value="{{old('dob')}}" placeholder="YYYY-MM-DD" required>
                                </div>

                                <div class="form-group" id="pan_no">
                                    <label for="name">ID Number</label>
                                    <input type="text" class="form-control" name="pan_num" 
                                    id = "pan_num" placeholder = "Enter ID number" 
                                    value = "" required>
                                </div>
  
                                <button type="submit" id = "submitForm" class="btn btn-success offset-md-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            @if ($statusCode == 200)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Script Tracing APIs</h3>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            {{-- First Name --}}
                            @if(!empty($pandetailsinfo['data']['FirstName']))
                                <p><strong>First Name:</strong> {{ $pandetailsinfo['data']['FirstName'] }}</p>
                            @endif

                            {{-- Last Name --}}
                            @if(!empty($pandetailsinfo['data']['LastName']))
                                <p><strong>Last Name:</strong> {{ $pandetailsinfo['data']['LastName'] }}</p>
                            @endif

                            {{-- Address Info --}}
                            @if(!empty($pandetailsinfo['data']['AddressInfo']))
                                <p><strong>Addresses:</strong></p>
                                <ul>
                                    @foreach($pandetailsinfo['data']['AddressInfo'] as $address)
                                        <li>
                                            {{ $address['Address'] }},
                                            {{ $address['State'] }},
                                            {{-- {{ $address['Postal'] }} <br> --}}
                                            {{-- <small>Type: {{ $address['Type'] }} | Reported: {{ $address['ReportedDate'] }}</small> --}}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- Email Info --}}
                            @if(!empty($pandetailsinfo['data']['EmailAddressInfo']))
                                <p><strong>Emails:</strong></p>
                                <ul>
                                    @foreach($pandetailsinfo['data']['EmailAddressInfo'] as $email)
                                        <li>{{ $email['EmailAddress'] }} </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- Phone Info --}}
                            @if(!empty($pandetailsinfo['data']['PhoneInfo']))
                                <p><strong>Phone Numbers:</strong></p>
                                <ul>
                                    @foreach($pandetailsinfo['data']['PhoneInfo'] as $phone)
                                        <li>{{ $phone['Number'] }} </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div> 
                    </div>
                </div>
            </div>

            </div>
            @endif
        
        @if ($statusCode == 2000)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>First Name:</strong>{{$pandetailsinfo['data']['FirstName']}}</p>
                        <p><strong>Last Name:</strong>{{$pandetailsinfo['data']['LastName']}}</p>
                        <p><strong>Address : </strong>{{ $pandetailsinfo['data']["AddressInfo"] }}</p>
                        {{-- <p><strong>Email : </strong>{{ $pandetailsinfo['data']["EmailAddressInfo"] }}</p>
                        <p><strong>PhoneInfo : </strong>{{ $pandetailsinfo['data']["PhoneInfo"] }}</p> --}}
                       
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
