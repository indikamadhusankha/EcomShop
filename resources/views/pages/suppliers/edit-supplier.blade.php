@extends('layouts.app')
@section('title','Add New Supplier')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modify Supplier</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('Suppliers.index') }}" class="btn btn-primary">Back</a>
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
                    <form id="supform" action="{{route('Suppliers.update',[$Supplier->id])}}" method="post">
                        @csrf
                        <div class="row">
                            @if ($Supplier)

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $Supplier->name }}" id="name" class="form-control"
                                        placeholder="Supplier Name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{ $Supplier->email }}" id="email" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Email Address">

                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" value="{{ $Supplier->phone }}" name="phone" id="phone" class="form-control"
                                        placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="phone">Address</label>
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5">{{ $Supplier->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <select class="form-control" name="status" id="">
                                            <option {{($Supplier->status == 1) ? 'selected': '' }} value="1">Active</option>
                                            <option {{($Supplier->status == 0) ? 'selected': '' }} value="0">Inactive</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="pb-5 pt-3">
                        <button class="btn btn-success">Update</button>
                <a href="{{ route('Suppliers.index')}}" class="btn btn-outline-secondary ml-3">Cancel</a>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection


