@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Add</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <form role="form" id="frmAddScheme" method="post" action="{{route('user.update')}}">
                        {{csrf_field()}}
                        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
                        <input type="hidden" id="ids" name="ids" value="{{$user_scheme_ids}}">
                        <input type="hidden" id="delete_ids" name="delete_ids">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Select Scheme Type</label>
                                        <select class="form-control" id="scheme_type" name="scheme_type" required>
                                            <option value="demo" @if($user->scheme_type=='demo') selected @endif>Demo</option>
                                            <option value="production" @if($user->scheme_type=='production') selected @endif>Production</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Select Scheme</label>
                                        <select class="form-control" id="scheme_type_id" name="scheme_type_id" @if($user->scheme_type=='production') disabled @endif>
                                            @if($user->scheme_type=='demo')
                                            @foreach($scheme_types as $key=>$value)
                                            <option value="{{$value->id}}"  @if($user->scheme_type_id==$value->id) selected @endif>{{$value->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" readonly>
                                    </div>
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="form-group">
                            @foreach($api_group as $key=>$value)
                                <!-- <label class="text-red">{{$value->group_name}}</label> -->
                                <?php
                                    $sub_menus=DB::table('api_master')->select('id','api_name','admin_price','api_group_id')->where('api_group_id',$value->id)->get();
                                ?>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input groupcheckbox" type="checkbox" id="grpchk_{{$value->id}}" value="{{$value->id}}">
                                    <label for="grpchk_{{$value->id}}" class="custom-control-label text-red">{{$value->group_name}}</label>
                                </div>
                                @if(count($sub_menus)>0)
                                    @foreach ($sub_menus as $sub_menu)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-checkbox">
                                                    @php
                                                    $checked = 0;   
                                                    @endphp
                                                    <input class="custom-control-input checkbox" type="checkbox" id="chk_{{$sub_menu->id}}_{{$sub_menu->api_group_id}}" name="chk_api_id" value="{{$sub_menu->id}}" @if(in_array($sub_menu->id, $user_scheme_arr)) checked @endif>
                                                    <label for="chk_{{$sub_menu->id}}_{{$sub_menu->api_group_id}}" class="custom-control-label">{{$sub_menu->api_name}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="txtAdminPrice{{$sub_menu->id}}" name="txtAdminPrice{{$sub_menu->id}}" value="{{$sub_menu->admin_price}}" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control grouptext_{{$sub_menu->api_group_id}}" id="txtUserPrice{{$sub_menu->id}}" @if(!in_array($sub_menu->id, $user_scheme_arr)) disabled @else value="{{$user_scheme_price[$sub_menu->id]}}" @endif>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <button type="button" id="btnAdd" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
<script>
	$(function () {
		$("#btnAdd").click(function() {
			var ids = ""; 
			var delete_ids = ""; 
			var curid = "";
			var flag = 0;
			var focusid = "";
			$(document).find("input[name='chk_api_id']:checked").each(function() {
				curid = $(this).attr("id");
				var res = curid.split("_");
				ids = ids + res[1] + "|" + $("#txtUserPrice"+res[1]).val() + "|" + res[2] + ",";
				if($("#txtUserPrice"+res[1]).val()=="") {
					// alert($("#txtUserPrice"+res[1]).val());
					flag=1;
					if(focusid=="")
						focusid = res[1];
				}
			});
			ids = ids.replace(/,\s*$/, "");
			$("#ids").val(ids);

			$(document).find("input[name='chk_api_id']:not(:checked)").each(function() {
				curid = $(this).attr("id");
				var res = curid.split("_");
				delete_ids = delete_ids + res[1] + ",";
			});
			delete_ids = delete_ids.replace(/,\s*$/, "");

			$("#delete_ids").val(delete_ids);
			if(ids=="") {
				alert('Please select at least 1 service');
				return false;
			}
			else if(flag==0) {
				// alert('done');
                $("#frmAddScheme").submit();
            }
            else {
				// alert('flag 1');
				$("#txtUserPrice"+focusid).focus();
            }

        });

		$(document).on("change",".checkbox", function() {
			var curid = $(this).attr('id');
			var res = curid.split("_");
			if(this.checked)
				$("#txtUserPrice"+res[1]).val('').prop('disabled',false);
			else
				$("#txtUserPrice"+res[1]).val('').prop('disabled',true);
		});
	});
</script>
@stop