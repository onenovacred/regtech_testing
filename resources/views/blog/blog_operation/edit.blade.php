@extends('blog.layouts.index')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('update', $blogedit->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title"
                                    value="{{ $blogedit->title }}">
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
                                <label class="form-label">Meta Description</span></label>
                                <input type="text" class="form-control" name="meta_description"
                                    value='{{ $blogedit->meta_description }}' placeholder="Enter meta description">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Keywords</span></label>
                                <input type="text" class="form-control" name="meta_keyword" placeholder="Enter keyword"
                                    value='{{ $blogedit->meta_description }}' />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Url</span></label>
                                <input type="text" class="form-control" name="url" value="{{ $blogedit->url }}"
                                    placeholder="Enter url">
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
                                    {{ $blogedit->description }}
                                </textarea>
                                @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn btn-success" value="Update" />
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
                placeholder: 'Enter a description',
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
