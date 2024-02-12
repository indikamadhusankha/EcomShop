@extends('layouts.app')
@section('Title', 'Products')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            @include('components.messages')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Products</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('Products.create') }}" class="btn btn-primary">New Products</a>
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
                        <a class="btn btn-outline-secondary" href="{{route('Products.index')}}">View All Products</a>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th class="text-right px-5">Price</th>
                                <th>SKU</th>
                                <th class="text-center">Sale Status</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($Products->count()>0)
                                @foreach ($Products as $key => $Product)

                                        <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$Product->title}}</td>
                                        @if($Product->sub_category_name)
                                        <td>  {{$Product->category_name}}/<br>{{$Product->sub_category_name}}</td>
                                               @else
                                               <td>  {{$Product->category_name}}</td>
                                               @endif
                                        <td>{{$Product->supplierName}}</td>
                                        <td  class="text-right px-5">{{number_format($Product->price,2)}}</td>
                                        <td>{{$Product->sku}}</td>
                                        <td class="text-center">
                                            @if($Product->sale_status == 'Active')
                                            <span class="badge badge-success">{{$Product->sale_status}}</span>
                                            @elseif ($Product->sale_status == 'Sold')
                                            <span class="badge badge-secondary">{{$Product->sale_status}}</span>
                                            @elseif ($Product->sale_status == 'Repaire')
                                            <span class="badge badge-warning">{{$Product->sale_status}}</span>
                                            @elseif ($Product->sale_status == 'Rejected')
                                            <span class="badge badge-danger">{{$Product->sale_status}}</span>
                                            @endif
                                            </td>

                                        <td>
                                            <h5 class="text-center m-0">
                                                @if ($Product->status == 1)
                                                    <i class="far fa-check-circle text-success"></i>
                                                @else
                                                    <i class="far fa-times-circle text-danger"></i>
                                            </h5>
                                @endif
                                </td>

                                {{-- Action Control --}}
                                <td>
                                    <h5>
                                        <a href="{{route('Products.show',[$Product->id])}}">
                                        <i class="fas fa-edit"></i></a> |
                                        <a href="{{route('Products.delete',[$Product->id])}}">
                                        <i class="fas fa-trash-alt text-danger"></i> </a>
                                    </h5>
                                </td>
                                {{-- End Action Control --}}
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <p class="d-flex justify-content-center m-0 text-secondary">Products not found</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                <div class="card-footer clearfix">
                    {{ $Products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
