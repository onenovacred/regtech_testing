{{-- @extends('adminlte::page')

@section('title', 'Bank Analyser')

@section('content')
<body>
    <div class="container">
        <h2>Bank Statement Analyser</h2>

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('kyc.bank_analyser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Upload Bank Statement (PDF)</label>
                <input type="file" class="form-control" id="file" name="file" accept="application/pdf" required>
                @error('file')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="INDIA" required>
                @error('country')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
    <label for="password" class="form-label">Password (Optional)</label>
    <input type="password" class="form-control" id="password" name="password">
</div>
<div class="mb-3">
    <label for="bank" class="form-label">Bank (Optional)</label>
    <input type="text" class="form-control" id="bank" name="bank">
</div>
<div class="mb-3">
    <label for="accounttype" class="form-label">Account Type (Optional)</label>
    <input type="text" class="form-control" id="accounttype" name="accounttype">
</div>
            <button type="submit" class="btn btn-primary">Analyze</button>
        </form>

        @if (session('stream_pdf') || (isset($stream_pdf) && $stream_pdf))
            <p class="mt-3">
                <a href="{{ session('stream_url', isset($stream_url) ? $stream_url : '#') }}" target="_blank" class="btn btn-success">View PDF in New Tab</a>
            </p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        @if (session('stream_pdf') || (isset($stream_pdf) && $stream_pdf))
            document.addEventListener('DOMContentLoaded', function () {
                const streamUrl = "{{ session('stream_url', isset($stream_url) ? $stream_url : '') }}";
                if (streamUrl) {
                    window.open(streamUrl, '_blank');
                }
            });
        @endif
    </script>
</body>
@stop --}}


@extends('adminlte::page')

@section('title', 'Bank Analyser')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Bank Analyser</h3>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (isset($statusCode) && $statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        Invalid Input
                    </div>
                @endif
                @if (isset($statusCode) && ($statusCode == '404' || $statusCode == '400'))
                    <div class="alert alert-danger" role="alert">
                        Server Error, Please try later
                    </div>
                @endif
                @if (isset($statusCode) && $statusCode == '500')
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in for more details.
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="post" action="{{ route('kyc.bank_analyser') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="file">Bank Statement</label>
                                <input type="file" class="form-control" name="file" id="file" accept="application/pdf" required>
                                @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" id="country" value="INDIA" required>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
    <label for="is_password">Is Password</label>
    <select class="form-control" id="is_password" name="is_password" required>
        <option value="no" selected>No</option>
        <option value="yes">Yes</option>
    </select>
</div>
<div class="form-group" id="password_group" style="display: none;">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
                            <div class="form-group">
                                <label for="bank">Bank (Optional)</label>
                                <input type="text" class="form-control" value="SBI" name="bank" id="bank" placeholder="Enter Bank Name">
                                @error('bank')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="accounttype">Account Type (Optional)</label>
                                <input type="text" class="form-control" value="SAVING" name="accounttype" id="accounttype" placeholder="Enter Account Type">
                                @error('accounttype')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
 <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="submit" class="btn btn-success">Analyze</button>
                                @if (session('stream_pdf') || (isset($stream_pdf) && $stream_pdf))
                                    <a href="{{ session('stream_url', isset($stream_url) ? $stream_url : '#') }}" target="_blank" class="btn btn-success">View PDF</a>
                                @endif
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('custom_js')
<script>
      document.getElementById('is_password').addEventListener('change', function () {
        let passwordGroup = document.getElementById('password_group');
        if (this.value === 'yes') {
            passwordGroup.style.display = 'block';
        } else {
            passwordGroup.style.display = 'none';
            document.getElementById('password').value = ''; // Clear value if hidden
        }
    });
</script>
    @if (session('stream_pdf') || (isset($stream_pdf) && $stream_pdf))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const streamUrl = "{{ session('stream_url', isset($stream_url) ? $stream_url : '') }}";
                if (streamUrl) {
                    window.open(streamUrl, '_blank');
                }
            });



        </script>
    @endif
@stop
