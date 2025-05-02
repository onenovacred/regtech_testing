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
                <h3 class="card-title">Land Record</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.land_api') }}">Land APIs</a>
            </div>
            <div class="card-body">
                @if(isset($land_details['statusCode']) && $land_details['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        Invalid land details.Please enter correct land details.
                  </div>
                @endif
                @if(isset($land_details['statusCode'])&& $land_details['statusCode'] ==202)
                <div class="alert alert-danger" role="alert">
                    Server Error Please try later.
                </div>
                @endif
    
                @if(isset($land_details['statusCode']) && ($land_details['statusCode'] ==103))
                <div class="alert alert-danger" role="alert">
                       You are not registered to use this service. Please update your plan.
                </div>
                @endif
                @if(isset($land_details['statusCode']) && $land_details['statusCode'] ==500)
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error.Please contact techsupport@docboyz.in. for more details
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.land')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Url</label>
                                 <input type="text" class="form-control" 
                                    id="url" name="url" value="{{old('url')}}" 
                                    placeholder="Ex: https://bhunaksha.cg.nic.in/" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Original Ploat Number</label>
                                     <input type="text" class="form-control" 
                                    id="original_ploat_number" name="original_ploat_number" value="{{old('original_ploat_number')}}" 
                                    placeholder="Ex: 3459" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">GST StateCode</label>
                                     <input type="text" class="form-control" 
                                    id="gst_state_code" name="gst_state_code" value="{{old('gst_state_code')}}" 
                                    placeholder="Ex: 22" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Levels</label>
                                     <input type="text" class="form-control" 
                                    id="levels" name="levels" value="{{old('levels')}}" 
                                    placeholder="Ex: 3459" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">X-Coordinate</label>
                                     <input type="text" class="form-control" 
                                    id="x_coordinate" name="x_coordinate" value="{{old('x_coordinate')}}" 
                                    placeholder="Ex: -1985.1836332116745" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Y-Coordinate</label>
                                     <input type="text" class="form-control" 
                                    id="y_coordinate" name="y_coordinate" value="{{old('y_coordinate')}}" 
                                    placeholder="Ex: 3625.746517505414" required>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($land_details['statusCode']) && $land_details['statusCode']==200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">GSTIN Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> @if(isset($land_details['data']['ID'])){{ $land_details['data']['ID'] }}@else '' @endif</p>
                        <p><strong>PNIU:</strong> @if(isset($land_details['data']['PNIU'])){{ $land_details['data']['PNIU']}}@else '' @endif</p>
                        <p><strong>Attrs:</strong> @if(isset($land_details['data']['attrs'])){{ $land_details['data']['attrs'] }}@else '' @endif</p>
                        <p><strong>gisCode:</strong> @if(isset($land_details['data']['gisCode'])){{ $land_details['data']['gisCode']}}@else '' @endif</p>
                        <p><strong>has_data:</strong> @if(isset($land_details['data']['has_data'])){{ $land_details['data']['has_data'] }}@else '' @endif</p>
                        <p><strong>info:</strong> @if(isset($land_details['data']['info'])){{ $land_details['data']['info']}}@else '' @endif</p>
                        <p><strong>pdfReport:</strong> @if(isset($land_details['data']['pdf_base64'])) <button class="btn btn-sm btn-success" id="downloadPdfBtn">Download Report</button>
                            <script>
                                document.getElementById('downloadPdfBtn').addEventListener('click', function() {
                                  
                                    var base64String = '{{$land_details['data']['pdf_base64']}}';
                                    var pdfData = atob(base64String);
                                    var pdfBlob = new Blob([new Uint8Array(pdfData.split('').map(function(c) {
                                        return c.charCodeAt(0);
                                    }))], { type: 'application/pdf' });
                                    var link = document.createElement('a');
                                    link.href = URL.createObjectURL(pdfBlob);
                                    link.download = 'downloaded.pdf';
                                    document.body.appendChild(link);
                                     link.click();
                                    document.body.removeChild(link);
                                });
                            </script>
                            @else '' @endif</p>
                        <p><strong>PloatLink:</strong> @if(isset($land_details['data']['plotInfoLinks'])){{ $land_details['data']['plotInfoLinks']}}@else '' @endif</p>
                        <p><strong>xmin:</strong> @if(isset($land_details['data']['xmin'])){{ $land_details['data']['xmin']}}@else '' @endif</p>
                        <p><strong>ymin:</strong> @if(isset($land_details['data']['ymin'])){{ $land_details['data']['ymin']}}@else '' @endif</p>
                        <p><strong>xmax:</strong> @if(isset($land_details['data']['xmax'])){{ $land_details['data']['xmax']}}@else '' @endif</p>
                        <p><strong>ymax:</strong> @if(isset($land_details['data']['ymax'])){{ $land_details['data']['ymax']}}@else '' @endif</p>
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