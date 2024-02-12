@extends('layouts.app')
@section('Title', 'Sub Categories')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            @include('components.messages')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Sub Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('Sub-Categories.create') }}" class="btn btn-primary">New Sub Category</a>
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
                        <a class="btn btn-outline-secondary" href="{{ route('Sub-Categories.index') }}">View All Sub
                            Categories</a>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent Category</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($SubCategory->isNotEmpty())
                                @foreach ($SubCategory as $key => $SubCat)
                                    <tr>

                                        <td>{{++$key}}</td>
                                        <td>{{$SubCat->name}}</td>
                                        <td>{{$SubCat->slug}}</td>
                                        <td>{{$SubCat->category_name}}</td>
                                        <td>
                                            <h5 class="text-center m-0">
                                                @if ($SubCat->status == 1)
                                                    <i class="far fa-check-circle text-success"></i>
                                                @else
                                                    <i class="far fa-times-circle text-danger"></i>
                                                @endif
                                            </h5>
                                        </td>
                                        {{-- Action Control --}}
                                        <td>
                                            <h5>
                                                <a href="{{route('Sub-Categories.show',[$SubCat->id])}}">
                                                    <i class="fas fa-edit"></i></a> |
                                                <a href="{{route('Sub-Categories.delete',[$SubCat->id])}}">
                                                    <i class="fas fa-trash-alt text-danger"></i> </a>
                                            </h5>
                                        </td>
                                        {{-- End Action Control --}}
                                    </tr>
                                @endforeach
                                @else
                                <td colspan="6"><p class="text-center m-0">Sub Categories Not Found!</p></td>
                            @endif
                        </tbody>
                    </table>

                </div>
                <div class="card-footer clearfix">
                       {{ $SubCategory->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
