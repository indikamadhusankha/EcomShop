@extends('layouts.app')
@section('Title', 'Categories')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            @include('components.messages')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('Categories.create') }}" class="btn btn-primary">New Category</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">

                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword"
                                    class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-outline-secondary" href="{{ route('Categories.index') }}">View All Categories</a>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($Category->count()>0)
                                @foreach ($Category as $key => $Cat)
                                    <tr>

                                        <td>{{ ++$key }}</td>
                                        <td>{{ $Cat->name }}</td>
                                        <td>{{ $Cat->slug }}</td>
                                        <td>
                                            <h5 class="text-center m-0">
                                                @if ($Cat->status == 1)
                                                    <i class="far fa-check-circle text-success"></i>
                                                @else
                                                    <i class="far fa-times-circle text-danger"></i>
                                            </h5>
                                @endif
                                </td>
                                {{-- Action Control --}}
                                <td>
                                    <h5>
                                        <a href="{{ route('Categories.show', [$Cat->id]) }}">
                                            <i class="fas fa-edit"></i></a> |
                                        <a href="{{ route('Categories.delete', [$Cat->id]) }}">
                                            <i class="fas fa-trash-alt text-danger"></i> </a>
                                    </h5>
                                </td>
                                {{-- End Action Control --}}
                                </tr>
                            @endforeach
                        @else
                            <td class="text-center" colspan="5"><p class="m-0">Categories not found!</p></td>
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="card-footer clearfix">
                    {{ $Category->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
