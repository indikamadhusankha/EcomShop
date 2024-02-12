@extends('layouts.app')
@section('title','Add New Supplier')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modify Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('Categories.index') }}" class="btn btn-primary">Back</a>
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
                    <form id="catform" action="{{route('Categories.update',[$catData->id])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mx-auto">

                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" value="{{$catData->name}}" id="name" class="form-control"
                                        placeholder="Category Name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                            <label for="slug">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control" value="{{$catData->slug}}" aria-describedby="help">

                                                @error('slug')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="status">Status</label>
                                <select class="form-control" name="status" id="">
                                    <option {{($catData->status == 1) ? 'selected': '' }} value="1">Active</option>
                                    <option {{($catData->status == 0) ? 'selected': '' }} value="0">Inactive</option>

                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-success">Update</button>
                <a href="{{ route('Categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection

@push('js')
<script>

    $('#name').change(function(){
        data = $(this);
        $.ajax({
            url: '{{route("Categories.slug")}}',
            type:'get',
            data:{name: data.val()},
            dataType: 'json',
            success: function(response){
            if(response["status"] == true){
                $('#slug').val(response["slug"]);

            }
        }

        });
    });

    </script>
@endpush




