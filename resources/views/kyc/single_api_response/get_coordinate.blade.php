@if (isset($get_coordinate['status_code']) && $get_coordinate['status_code']==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
   <div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Coordinate  Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">Sr No</th>
                                <th scope="col" class="text-center">Address</th>
                                <th scope="col" class="text-center">Longitude</th>
                                <th scope="col" class="text-center">Latitude</th>
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($get_coordinate['data']))
                                @foreach ($get_coordinate['data'] as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item['label']}}</td>
                                    @foreach ($item['point'] as $key1=>$coordinate )
                                        <td>{{$coordinate}}</td>
                                    @endforeach
                                </tr>  
                                @endforeach
                               @else
                                <tr>
                                    <td colspan="2" class="text-center">No Coordinate</td>
                                </tr>
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