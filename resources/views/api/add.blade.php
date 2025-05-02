@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Add</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Api</h3>
                    </div>
                    <form role="form" method="post" action="{{route('api.create')}}">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="api_group_id">Api Group</label>
                                <select id="api_group_id" name="api_group_id" class="form-control" required>
                                    <option value="">Select Api Group</option>
                                    @foreach($api_group as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->group_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="api_name">Api Name</label>
                                <input type="text" class="form-control characters" id="api_name" name="api_name" placeholder="Api Name" required>
                            </div>
                            <div class="form-group">
                                <label for="basic_price">Basic Price</label>
                                <input type="text" class="form-control numbers" id="basic_price" name="basic_price" placeholder="Basic Price" required>
                            </div>
                            <div class="form-group">
                                <label for="starter_price">Starter Price</label>
                                <input type="text" class="form-control numbers" id="starter_price" name="starter_price" placeholder="Starter Price" required>
                            </div>
                            <div class="form-group">
                                <label for="standard_price">Standard Price</label>
                                <input type="text" class="form-control numbers" id="standard_price" name="standard_price" placeholder="Standard Price" required>
                            </div>
                            <div class="form-group">
                                <label for="advance_price">Advance Price</label>
                                <input type="text" class="form-control numbers" id="advance_price" name="advance_price" placeholder="Advance Price" required>
                            </div>
                            <div class="form-group">
                                <label for="growth_price">Growth Price</label>
                                <input type="text" class="form-control numbers" id="growth_price" name="growth_price" placeholder="Growth Price" required>
                            </div>
                            <div class="form-group">
                                <label for="unicorn_price">Unicorn Price</label>
                                <input type="text" class="form-control numbers" id="unicorn_price" name="unicorn_price" placeholder="Unicorn Price" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_price">Route Name (As per Laravel web.php)</label>
                                <input type="text" class="form-control" id="route_name" name="route_name" placeholder="Route Name (from Laravel web.php)" required>
                            </div>
                            <div class="form-group">
                                <label for="admin_price">Slug Name (Lowercase, only characters without space)</label>
                                <input type="text" class="form-control nospace" id="api_slug" name="api_slug" placeholder="Slug Name (for internal use)" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
​<script type="text/javascript">
    $(".nospace").keydown(function(e) {
        if (e.shiftKey || e.ctrlKey || e.altKey) {
            e.preventDefault();
        } else {
            var key = e.keyCode;
            if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                e.preventDefault();
            }
        }
    });

    $(".numbers").keyup(function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
        {
            evt.preventDefault();
        }
    });

    $(".characters").keyup(function(e) {
        var key = e.keyCode;
        if (key == 32) 
        {
            e.preventDefault();
        }
    });
</script>
@stop