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

                <a href="{{ route('roles.create') }}" class="btn btn-primary float-right mb-2">Add New Role</a>
                @include("backend.layouts.partials.notifications")
                <table id="dataTable" class="text-center">
                    <thead class="bg-light text-capitalize">
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>

                            <td>
                                <a href="{{ route('roles.show',['role'=>$role->id]) }}" class="btn btn-success btn-sm">View</a>


                                <a href="{{ route('roles.edit',['role'=>$role->id]) }}" class="btn btn-success btn-sm">Edit</a>


                                <a href="{{ route('roles.destroy',['role'=>$role->id]) }}"
                                   data-dltform="role_form_{{ $role->id }}"
                                    class="btn btn-danger btn-sm dlt_btn">Delete</a>

                                <form  action="{{ route('roles.destroy',['role'=>$role->id]) }}" method="POST" class="d-none" id="role_form_{{ $role->id }}">
                                    @csrf
                                    {{-- // method spoofing --}}
                                    @method("DELETE")
                                </form>
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
