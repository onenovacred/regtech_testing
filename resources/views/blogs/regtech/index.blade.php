@extends('blogs.layouts.index')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <a class="btn btn-primary float-end" href="{{ route('create') }}">
                            Create
                        </a>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Keyword</th>
                            <th>Url</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if (isset($item))
                                @foreach ($item as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/' . $value->image) }}" width='60' height='60' />
                                        </td>
                                        @if (isset($value->meta_keyword))
                                            <td>{{ $value->meta_keyword }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if (isset($value->url))
                                            <td>{{ $value->url }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>
                                            <a class="btn btn-success" href="{{ url('edit', $value->id) }}">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger" href="{{ route('delete', $value->id) }}">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection
