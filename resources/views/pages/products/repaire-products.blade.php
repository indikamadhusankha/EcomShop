@extends('layouts.app')
@section('title','Repaire Products')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Repaire Products</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="" class="btn btn-primary">Back</a>
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
                    <form id="catform" action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mx-auto">

                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" value="" id="name" class="form-control"
                                        placeholder="Category Name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" id="slug" class="form-control" value="">
                                                @error('slug')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary">Create</button>
                <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection

@push('js')
<script>



</script>
@endpush




