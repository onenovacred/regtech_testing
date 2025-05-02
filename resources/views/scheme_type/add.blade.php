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
                        <h3 class="card-title">Add Scheme Type</h3>
                    </div>
                    <form role="form" method="post" action="{{route('scheme_type.create')}}">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="scheme_name">Scheme Name</label>
                                        <input type="text" class="form-control characters" id="scheme_name" name="scheme_name" placeholder="Scheme Type Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hit_limits">Hit Limits</label>
                                        <input type="text" class="form-control numbers" id="hit_limits" name="hit_limits" placeholder="Hit Limits" required>
                                    </div>
                                </div>
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
        if (key == 5) 
        {
            e.preventDefault();
        }
    });
</script>
@stop