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

                <a href="{{ route('products.create') }}" class="btn btn-primary float-right mb-2">Add New Products</a>
                @include("backend.layouts.partials.notifications")
                <table id="dataTable" class="text-center">
                    <thead class="bg-light text-capitalize">
                        <tr>
                            <th>id</th>
                            <th>name</th>

                            <th>Image</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>

                            <td>
                                <img src="{{getStorageImage($product->image, \App\Models\Product::FILE_STORE_PATH_IMAGE)}}" alt="" class="img-fluid" width="50" height="50">
                            </td>

                            <td>
                                @can('User Edit')

                                <a href="{{ route('users.edit',['user'=>$product->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                @endcan
                                @can('User Delete')

                                <a href="{{ route('users.destroy',['user'=>$product->id]) }}"
                                   data-dltform="role_form_{{ $product->id }}"
                                    class="btn btn-danger btn-sm dlt_btn">Delete</a>

                                <form  action="{{ route('users.destroy',['user'=>$product->id]) }}" method="POST" class="d-none" id="role_form_{{ $product->id }}">
                                    @csrf
                                    {{-- // method spoofing --}}
                                    @method("DELETE")
                                </form>

                                @endcan

                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

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
