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
                            <th>Email</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                <a href="{{ route('users.show',['user'=>$user->id]) }}" class="btn btn-success btn-sm">View</a>


                                <a href="{{ route('users.edit',['user'=>$user->id]) }}" class="btn btn-success btn-sm">Edit</a>

                                @if($user->id != auth()->user()->id)
                                <a href="{{ route('users.destroy',['user'=>$user->id]) }}"
                                   data-dltform="role_form_{{ $user->id }}"
                                    class="btn btn-danger btn-sm dlt_btn">Delete</a>

                                <form  action="{{ route('users.destroy',['user'=>$user->id]) }}" method="POST" class="d-none" id="role_form_{{ $user->id }}">
                                    @csrf
                                    {{-- // method spoofing --}}
                                    @method("DELETE")
                                </form>
                                @endif
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
