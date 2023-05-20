@extends('backend.master.app')
@section('page-title')
    @include('backend.layouts.page-title-section')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">{{get_page_meta('title', true)}}</h4>

                <form  action="{{ route('products.update',['product'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="form-label"> Name <span class="error">*</span></label>
                            <input name="name" type="text" class="form-control" required="" placeholder="Enter Name"
                                   value="{{ $product->name ?? old('name') }}">
                            @error('name')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label"> Price <span class="error">*</span></label>
                            <input name="price" type="number" class="form-control" required="" placeholder="Enter price"
                                   value="{{ $product->price ?? old('price') }}">
                            @error('price')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3 col-6">
                            <label class="form-label">Images </label>
                            <input name="image" type="file" class="form-control"
                                   value="{{ old('image') }}">
                                   <img src="{{getStorageImage($product->image, \App\Models\Product::FILE_STORE_PATH_IMAGE)}}" alt="" class="img-fluid" width="50" height="50">
                            @error('image')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>


                    <div class="mb-3">
                        <div>
                            <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a class="btn btn-secondary waves-effect" href="{{ route('products.index') }}">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush

@push('script')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable({
                responsive: true
            });
        } );

    </script>
@endpush
