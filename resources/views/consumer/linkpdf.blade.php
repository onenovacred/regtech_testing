<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
               
            </tbody>
</table>
    </div>
  </main>
</body>
</html>

  
  

