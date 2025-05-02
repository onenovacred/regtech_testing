@extends('adminlte::page')

@section('title', 'User Details')
<style>
    .faq-section .mb-0>a {
        display: block;
        position: relative;
    }

    .faq-section .mb-0>a:after {
        content: "\f067";
        font-family: "Font Awesome 5 Free";
        position: absolute;
        right: 0;
        font-weight: 600;
    }

    .faq-section .mb-0>a[aria-expanded="true"]:after {
        content: "\f068";
        font-family: "Font Awesome 5 Free";
        font-weight: 600;
    }
</style>
{{-- @section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop --}}
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <span>Documents Details</span>
        </div>
        <div class="card-body">
            <div class="flex flex-column mb-5 mt-4 faq-section">
                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="heading-1">
                                    <h5 class="mb-0">
                                        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true"
                                            aria-controls="collapse-1">
                                            Mahesh Kumar Singh
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-1" class="collapse show" data-parent="#accordion"
                                    aria-labelledby="heading-1">
                                    <div class="card-body">
                                        FXCOPIER is the worlds most reliable remote trade copier. Its allow you to copy
                                        trades almost instantly between hundreds of MT4 accounts through the use of
                                        technology. Many of the industries leading money managers use FXCopier to easily
                                        manage multiple
                                        client accounts in tandem.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
