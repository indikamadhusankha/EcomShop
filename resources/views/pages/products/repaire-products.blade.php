@extends('layouts.app')
@section('Title', 'Products')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            @include('components.messages')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Repaire Products</h1>
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
                <div class="card-body">
                    <form id="catform" action="{{ route('Categories.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mx-auto">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Product SKU" aria-label="Enter Product SKU" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                      <button class="btn btn-warning" type="button">Add Repaire</button>
                                    </div>
                                  </div>
                        </div>
                </div>
            </div>

            {{-- Table --}}
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
                        <a class="btn btn-outline-secondary" href="{{ route('Products.index') }}">View All Products</a>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th class="text-right px-5">Repaire Price</th>
                                <th>Repaire Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tbody>
                    </table>

                </div>
                <div class="card-footer clearfix">
                    {{-- {{ $Products->links('pagination::bootstrap-5') }} --}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
