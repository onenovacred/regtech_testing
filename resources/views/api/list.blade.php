@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-primary">
                <div class="card-header">
                    <h3 class="card-title">Api Master</h3>
                    <div class="card-tools">
                        <a href="{{route('api.add')}}" class="btn btn-warning"><i class="fa fa-plus-square"></i> Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{route('api.update')}}">
                                {{csrf_field()}}
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td style="width:20%"></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-6"><b>Basic</b></div>
                                                            <div class="col-md-6"><b>Starter</b></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-6"><b>Standard</b></div>
                                                            <div class="col-md-6"><b>Advance</b></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-6"><b>Growth</b></div>
                                                            <div class="col-md-6"><b>Unicorn</b></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>        

                                        @foreach($api_group as $key=>$value)
                                        <?php
                                            $sub_menus=DB::table('api_master')->select('id','api_name','basic_price','starter_price','standard_price','advance_price','growth_price','unicorn_price','api_slug')->where('api_group_id',$value->id)->get();
                                        ?>
                                        <tr>
                                            <td style="width:20%"><b>{{$value->group_name}}</b></td>
                                            <td>
                                                @if(count($sub_menus)>0)
                                                    @foreach ($sub_menus as $sub_menu)
                                                    <div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" id="txtApiName{{$sub_menu->id}}" name="txtApiName{{$sub_menu->id}}" value="{{$sub_menu->api_name}}" title="API SLUG:{{$sub_menu->api_slug}}">
                                                        </div>
                                                        <input type="hidden" class="form-control" id="txt{{$sub_menu->id}}" name="txtApiId[]" value="{{$sub_menu->id}}">
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="txtBasicPrice{{$sub_menu->id}}" name="txtBasicPrice{{$sub_menu->id}}" value="{{$sub_menu->basic_price}}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="txtStarterPrice{{$sub_menu->id}}" name="txtStarterPrice{{$sub_menu->id}}" value="{{$sub_menu->starter_price}}">
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="txtStandardPrice{{$sub_menu->id}}" name="txtStandardPrice{{$sub_menu->id}}" value="{{$sub_menu->standard_price}}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="txtAdvancePrice{{$sub_menu->id}}" name="txtAdvancePrice{{$sub_menu->id}}" value="{{$sub_menu->advance_price}}">
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="txtGrowthPrice{{$sub_menu->id}}" name="txtGrowthPrice{{$sub_menu->id}}" value="{{$sub_menu->growth_price}}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control" id="txtUnicornPrice{{$sub_menu->id}}" name="txtUnicornPrice{{$sub_menu->id}}" value="{{$sub_menu->unicorn_price}}">
                                                                </div>
                                                            </div>    
                                                        </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop