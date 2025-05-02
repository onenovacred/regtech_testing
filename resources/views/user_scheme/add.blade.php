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
                        <h3 class="card-title">Add User Scheme</h3>
                    </div>
                    <form role="form" id="frmAddScheme" method="post" action="{{route('user.scheme.create')}}" style="display: none;">
                        {{csrf_field()}}
                        <input type="text" id="user_id" name="user_id">
                        <input type="text" id="ids" name="ids">
                        <input type="text" id="delete_ids" name="delete_ids">
                    </form>
                    <!-- <form role="form" method="post" action="{{route('user.scheme.create')}}"> -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="api_id">User</label>
                                <select id="ddl_user" name="ddl_user" class="form-control">
                                    @foreach($users as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                @foreach($api_group as $key=>$value)
                                    <label class="text-red">{{$value->group_name}}</label>
                                    <?php
                                        $sub_menus=DB::table('api_master')->select('id','api_name','admin_price')->where('api_group_id',$value->id)->get();
                                    ?>
                                    @if(count($sub_menus)>0)
                                        @foreach ($sub_menus as $sub_menu)
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input checkbox" type="checkbox" id="chk_{{$sub_menu->id}}" name="chk_api_id" value="{{$sub_menu->id}}">
                                                        <label for="chk_{{$sub_menu->id}}" class="custom-control-label">{{$sub_menu->api_name}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="txtAdminPrice" value="{{$sub_menu->admin_price}}" disabled>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" id="txtUserPrice{{$sub_menu->id}}" disabled>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <button type="button" id="btnAdd" class="btn btn-primary">Add</button>
                        </div>
                    <!-- </form> -->
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
			$("#user_id").val($("#ddl_user option:selected").val());

			$(document).find("input[name='chk_api_id']:checked").each(function() {
				curid = $(this).attr("id");
				var res = curid.split("_");
				ids = ids + res[1] + "|" + $("#txtUserPrice"+res[1]).val() + ",";
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