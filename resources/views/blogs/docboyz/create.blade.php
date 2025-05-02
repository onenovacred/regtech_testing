@extends('blogs.layouts.index')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('doccreate-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>
                            <div class="col">
                                <label class="form-label">Image <span style="color:red;font-weight:700;">*</span></label>
                                <input type="file" class="form-control" name="image" placeholder="Image">
                                @error('image')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Meta Description</label>
                                <input name="meta_description" class="form-control meta_description"
                                    placeholder="Enter meta description" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Keywords</span></label>
                                <input type="text" class="form-control" name="meta_keywords" placeholder="Enter keyword">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Url</span></label>
                                <input type="text" class="form-control" name="url" placeholder="Enter url">
                                @error('url')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description <span
                                        style="color:red;font-weight:700;">*</span></label>
                                <textarea name="description" class="form-control description" placeholder="Description">
                                </textarea>
                                @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.description').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
