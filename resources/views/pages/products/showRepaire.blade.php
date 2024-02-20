@extends('layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid my-2">
            {{-- <div class="alert alert-success" role="alert">

              </div> --}}
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Complete Repaire</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('Products.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="Product_form" action="{{route('Repaire.update',[$Rep_Product->id])}}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input id="id" type="hidden" name="id" value="">
                                            <label for="title">Title</label>
                                            <input readonly type="text" name="" id=""
                                                class="form-control" placeholder="Title" value="{{ $Product->sku }} - {{ $Product->title }}">
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Repaire Note</label>
                                            <textarea name="description" id="description" cols="30" rows="5" class="summernote" placeholder="Description"
                                                value=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Price">Price</label>
                                            <input type="text" name="Price" id="Price" class="form-control"
                                                placeholder="Price" value="">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price">Repire Date</label>
                                            <input type="date" name="ReDate" id="ReDate" class="form-control"
                                                value="">
                                            <p></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Repaire Status</h2>
                                <div class="mb-3">
                                    <select name="ReStatus" id="ReStatus" class="form-control">
                                        <option value="2">Complete
                                        </option>
                                        <option value="3">Return
                                        </option>
                                        <option value="4">Damage
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Supplier</h2>
                                <div class="mb-3">
                                    <select name="supplier" id="supplier" class="form-control" value="">
                                        <option value="">Select a Supplier</option>
                                        @if ($Suppliers->isNotEmpty())
                                            @foreach ($Suppliers as $Supplier)
                                                <option value="{{ $Supplier->id }}">{{ $Supplier->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('Products.index') }}" class="btn btn-outline-danger ml-3">Cancel</a>
                </div>
        </div>
        </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->



@endsection

@push('js')
    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            // Summernote
            $('.summernote').summernote({
                height: '150px'
            });

        });
    </script>
@endpush
