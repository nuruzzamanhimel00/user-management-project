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

                <a href="{{ route('roles.index') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i>Back</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Key</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Role Name</td>
                        <td>{{ $role->name }}</td>
                    </tr>
                    <tr>
                        <td>Permissions</td>
                        <td>
                            <ul class="list-group">


                                @forelse ($permission_groups as $permission_group)

                                  <li class="list-group-item list-group-item-primary  ">   {{ $permission_group->group_name }}</li>

                                  @foreach ($role->permissions  as $permission)

                                    @if($permission->group_name == $permission_group->group_name)

                                    <li class="list-group-item ml-5" style="margin-left: 50px;"> {{ $permission->name }}</li>

                                    @endif

                                  @endforeach
                                @empty
                                @endforelse

                            </ul>
                        </td>
                    </tr>
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
