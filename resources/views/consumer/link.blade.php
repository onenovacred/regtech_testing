@extends('adminlte::page')

@section('title', 'Consumer Product')

@section('content_header')
@stop
@section('content')

  <main class="my-5">
    <div class="container">
        <table class="table">
            <tbody>
            @if($consumer->count() > 0) 
            @foreach($consumer as $consumers)
                @endforeach
                <tr>
                    <th><h2>{{$consumers->consumerheading}}</h2></th>
                </tr>
                <tr>           
                    @if($consumers->firstname!=null)
                        <td>First Name</td>
                        <td>{{$consumers->firstname}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->lastname!=null)
                        <td>Last Name</td>
                        <td>{{$consumers->lastname}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->fullname!=null)
                        <td>Full Name</td>
                        <td>{{$consumers->fullname}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->emailaddress!=null)
                        <td>Email Address</td>
                        <td>{{$consumers->emailaddress}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->dob!=null)
                    <td>Date Of Birth</td>
                    <td>{{$consumers->dob}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->mobileno!=null)
                    <td>Mobile No</td>
                    <td>{{$consumers->mobileno}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->address!=null)
                    <td>Address</td>
                    <td>{{$consumers->address}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->city!=null)
                    <td>City</td>
                    <td>{{$consumers->city}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->state!=null)
                    <td>State</td>
                    <td>{{$consumers->state}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->addressline1!=null)
                    <td>Address Line1</td>
                    <td>{{$consumers->addressline1}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->addressline2!=null)
                    <td>Address Line2</td>
                    <td>{{$consumers->addressline2}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->addressline3!=null)
                    <td>Address Line3</td>
                    <td>{{$consumers->addressline3}}</td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->consumerimage!=null)
                        <td>Consumer Image</td>
                        <td><img src="{{$url.'/document/consumer/image/'.$consumers->consumerimage}}" style="width:10%;height:10%" /></td>
                    @endif
                </tr>
                <tr>
                    @if($consumers->audiovideo!=null)
                        <td>Audio Video</td>
                        <td>
                        <video  width = "300" height = "200" controls autoplay>
                            <source src = "{{$url.'/document/consumer/audiovideo/'.$consumers->audivideo}}"  />
                                Your browser does not support the <video> element.
                        </video>
                        </td>
                    @endif
                </tr>
                @endif
                @if($business->count() > 0) 
                @foreach($business as $businesses)
                @endforeach
                <tr>
                    <th><h2>{{$businesses->businessheading}}</h2></th>
                </tr>
                <tr>
                @if($businesses->businesskycid!=0)
                    @foreach($businesskycid as $businesskyc)
                    @endforeach
                    <td>Business KYC</td>
                    <td>{{$businesskyc->businesskyc}}
                @endif
                </tr>
                <tr>
                    @if($businesses->businessname!=null)
                    <td>Business Name</td>
                    <td>{{$businesses->businessname}}</td>
                    @endif
                </tr>
                <tr>
                    @if($businesses->businessaddress!=null)
                    <td>Address</td>
                    <td>{{$businesses->businessaddress}}</td>
                    @endif
                </tr>
                <tr>
                    @if($businesses->businesstypeid!=0)
                @foreach($businesstypeid as $businesstype)
                 @endforeach
                    <td>Business Type</td>
                    <td>{{$businesstype->businesstype}}</td>
                    @endif
                </tr>
                <tr>
                    @if($businesses->uploaddocument!=null)
                        <td>uploaded document download</td>
                        <td><a href="{{$url.'/document/business/'.$businesses->uploaddocument}}" download target="_blank">{{$businesses->uploaddocument}}</a></td>
                    @endif
                </tr>
                @endif
                @if($requireddetails->count() > 0)
                    @foreach($requireddetails as $requireddetail)
                    @endforeach
                    <tr>
                        <th><h2>{{$requireddetail->requireddetailsheading}}</h2></th>
                    </tr>
                    <tr>
                        @if($requireddetail->documentdetailsid!=null)
                            <td>uploadeddocumentname</td>
                            @foreach($documentname as $document)
                            @endforeach
                            <td>{{$document->documentname}}</td>
                        @endif
                    </tr>
                    <tr>
                        @if($requireddetail->uploadfile!=null)
                            <td>Uploaded file</td>
                            <td><a href="{{$url.'/document/requireddetails/'.$requireddetail->uploadfile}}" download target="_blank">{{$requireddetail->uploadfile}}</a></td>
                        @endif
                    </tr>
                    <tr>
                        @if($requireddetail->pannumber!=null)
                            <td>Pan Number</td>
                            <td>{{$requireddetail->pannumber}}</td>
                        @endif
                    </tr>
                    <tr>
                        @if($requireddetail->aadhaarnumber!=null)
                            <td>Aadhaar Number</td>
                            <td>{{$requireddetail->aadhaarnumber}}</td>
                        @endif
                    </tr>
                @endif
                @if($termscondition->count() > 0)
                    @foreach($termscondition as $termsconditions)
                    @endforeach
                    <tr>
                        <th><h2>{{$termsconditions->termsconditionheading}}</h2></th>
                    </tr>
                    <tr>
                        @if($termsconditions->termscondition!=null)
                            <td>Terms Condition</td>
                            <td>{{$termsconditions->termscondition}}</td>
                        @endif
                    </tr>
                    <tr>
                        @if($termsconditions->crifapiscore!=null)
                            <td>Crif/Api Score</td>
                            <td>{{$termsconditions->crifapiscore}}</td>
                        @endif
                    </tr>
                    <tr>
                        @if($termsconditions->loansactioned!=null)
                            <td>Loan Sactioned</td>
                            <td>{{$termsconditions->loansactioned}}</td>
                        @endif
                    </tr>
                @endif
                @if($congratulations->count() > 0)
                    @foreach($congratulations as $cong)
                    @endforeach
                    <tr>
                        <th><h2>{{$cong->congratulationsheading}}</h2></th>
                    </tr>
                    <tr>
                        @if($cong->uploadcongfile!=null)
                            <td>Uploaded document</td>
                            <td><a href="{{$url.'/document/congratulations/'.$cong->uploadcongfile}}" downlaod target="_blank">{{$cong->uploadcongfile}}</a></td>
                        @endif
                    </tr>
                    <tr>
                        @if($cong->message!=null)
                            <td>Message</td>
                            <td>{{$cong->message}}</td>
                        @endif
                    </tr>
                @endif
                @if($agreementpolicy->count() > 0)
                    @foreach($agreementpolicy as $agreement)
                    @endforeach
                    <tr>
                        <th><h2>{{$agreement->agreementheading}}</h2></th>
                    </tr>
                    <tr>
                        @if($agreement->agreementupload!=null)
                            <td>Uploaded agreement</td>
                            <td><a href="{{$url.'document/agreement/'.$agreement->agreementupload}}" download>{{$agreement->agreementupload}}</a></td>
                        @endif
                    </tr>
                    <tr>
                        @if($agreement->agreement!=null)
                            <td>Agreement</td>
                            <td>{{$agreement->agreement}}</td>
                        @endif
                    </tr>
                @endif
                @if($bankdetails->count() > 0)
                    @foreach($bankdetails as $bank)
                    @endforeach
                    <tr>
                        <th><h2>{{$bank->bankdetailsheading}}</h2></th>
                    </tr>
                    <tr>
                        @if($bank->bankname!=null)
                            <td>Bank Name</td>
                            <td>{{$bank->bankname}}</td>
                        @endif
                    </tr>
                    <tr>
                        @if($bank->accountnumber!=null)
                            <td>Account Number</td>
                            <td>{{$bank->accountnumber}}</td>
                        @endif
                    </tr>
                    <tr>
                        @if($bank->accounttype!=null)
                            <td>Account Type</td>
                            <td>{{$bank->accounttype}}</td>
                        @endif
                    </tr>
                    <tr>
                        @if($bank->	ifsccode!=null)
                            <td>IFSC Code</td>
                            <td>{{$bank->ifsccode}}</td>
                        @endif
                    </tr>
                @endif
            </tbody>
</table>
    </div>
  </main>
  

@stop

@section('custom_js')
@stop
