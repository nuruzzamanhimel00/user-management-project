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

                <form action="{{ route('roles.update',['role'=>$role->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="name" class="col-lg-2 col-sm-12 col-form-label">Role Name <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-12">
                                <input type="text" id="name" value="{{ old('name') ?? $role->name }}" class="form-control" name="name" placeholder="Enter role name" autofocus required>
                            </div>
                        </div>
                        @php
                            $allPermissionArray = $permissions->pluck('id')->toArray();
                            $roleWiseAllParm = \App\Models\User::roleWiseAllParm($role->id);
                        @endphp
                        <div class="form-group row">
                            <label class="col-lg-12 col-sm-12 col-form-label">Permissions <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="allPermission" {{ array_diff($allPermissionArray, $roleWiseAllParm->pluck('permission_id')->toArray() ) != false ? '' : 'checked' }}  >
                                <label class="form-check-label" for="allPermission">
                                    Check all permissions
                                </label>
                            </div>
                        </div>
                        <hr>
                        @forelse ($permission_groups as $permission_group )
                            @php

                                $grupNameWiseAllParm = $permissions->where('group_name',$permission_group->group_name)->pluck('id')->toArray();

                                $hasRoleWiseGrupParm = $roleWiseAllParm->whereIn('permission_id',$grupNameWiseAllParm)->pluck('permission_id')->toArray();

                            @endphp
                            <div class="form-group row">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input perGrpName" data-gname="{{ str_replace(' ','_',$permission_group->group_name) }}_checkbox" id="{{ $permission_group->group_name }}_checkbox"  data-pclass="hidden-{{ $permission_group->group_name }}" {{ array_diff($grupNameWiseAllParm,$hasRoleWiseGrupParm) != false ? '' : 'checked' }}  >
                                    <label class="form-check-label" for="{{ $permission_group->group_name }}_checkbox">
                                        {{ $permission_group->group_name }}
                                    </label>
                                </div>
                                <div class="col-lg-12 col-sm-12 ml-2 mt-2 hidden-{{ $permission_group->group_name }}">

                                    <div class="row">
                                        @forelse ($permissions->where('group_name',$permission_group->group_name) as $permission )
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="pretty p-default p-round p-thick">
                                                    <input type="checkbox" class="form-check-input singPerName {{ str_replace(' ','_',$permission_group->group_name) }}_checkbox" data-gname="{{ $permission_group->group_name }}_checkbox"
                                                    id="permissionName_{{ $permission->id }}"  data-pclass="hidden-{{ $permission_group->group_name }}" name="permissions[]"  value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="permissionName_{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                            <hr>
                        @empty
                        @endforelse


                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary waves-effect waves-lightml-2" type="submit">
                                    <i class="fa fa-save"></i> Update
                                </button>
                                <a class="btn btn-secondary waves-effect" href="{{ route('roles.index') }}">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
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
