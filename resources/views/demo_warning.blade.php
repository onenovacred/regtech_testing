@if(Auth::user()->scheme_type=='demo')
@php
$hits_remaining = 0;
$scheme_hit_count = Auth::user()->scheme_hit_count;
$scheme_type=DB::table('scheme_types')->where('id',Auth::user()->scheme_type_id)->first();
if(isset($scheme_type)){
    $hits_remaining = $scheme_type->hit_limits - $scheme_hit_count;
}
@endphp
@if($hits_remaining==0 || $hits_remaining<0)
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Your free usage of API are ends. Please subscribe to plan.</h5>
    </div>
@else
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> You are using free version of DocBoyzApi. You have left {{$hits_remaining}} free hits.</h5>
    </div>
@endif
@endif