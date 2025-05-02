@if(isset($land_details['statusCode']) && $land_details['statusCode']==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
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
</div>
</div>
@endif