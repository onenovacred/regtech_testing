@if (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Auto Complete  Details</h3>
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
                              </tr>
                            </thead>
                            <tbody>
                             @if(!empty($auto_complate['data']))
                                @foreach ($auto_complate['data'] as $key => $item)
                                <tr>
                                    <td>{{$item['sn']}}</td>
                                    <td>{{$item['address']}}</td>
                                </tr>  
                                @endforeach
                               @else
                                <tr>
                                    <td colspan="2" class="text-center">No Address</td>
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