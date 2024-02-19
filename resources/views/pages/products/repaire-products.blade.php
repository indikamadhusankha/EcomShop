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

                    <form action="{{ route('Repaire.add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="sku" id="sku"
                                        placeholder="Enter Product SKU" aria-label="Enter Product SKU"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit">Add Repaire</button>
                                    </div>
                                </div>
                    </form>
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
                            <th class="text-right px-5">Repaire Price</th>
                            <th>Repaire Date</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->count() > 0)
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->ProName }}</td>
                                    <td>{{ $product->CatName }}</td>
                                    <td class="text-right px-5">{{ $product->Price }}</td>
                                    <td>{{ date('Y-m-d', strtotime($product->created_at))  }}</td>
                                    <td>
                                        @if ($product->Rep_status == 1)
                                            <span class="badge badge-warning">{{ $product->rep_status }}</span>
                                        @elseif ($product->Rep_status == 2)
                                            <span class="badge badge-success">{{ $product->rep_status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-success" href="?id={{ $product->sku }}" data-toggle="modal"
                                            data-target="#exampleModal">
                                            Complete</a>
                                        <a class="btn btn-secondary" href="?id={{ $product->sku }}" data-toggle="modal"
                                            data-target="#exampleModal">
                                            View Report</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td class="text-center" colspan="8">Repaire Item NOT Found!</td>
                        @endif

                    </tbody>
                </table>



            </div>
            <div class="card-footer clearfix">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
