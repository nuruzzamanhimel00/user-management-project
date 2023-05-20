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

                <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="form-label"> Name <span class="error">*</span></label>
                            <input name="name" type="text" class="form-control" required="" placeholder="Enter Name"
                                   value="{{ $user->name ?? old('name') }}">
                            @error('name')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Roles </label>
                            <div class="select2-custom">
                                <select class="select-item form-control" name="role">
                                    <option value="">Select Role</option>
                                    @forelse ($roles as $role )
                                        <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ ucwords($role->name) }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            @error('role')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Email Address <span class="error">*</span></label>
                            <input name="email" type="email" class="form-control" required="" placeholder="Email Address"
                                   value="{{ $user->email ?? old('email') }}">
                            @error('email')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Password </label>
                            <input name="password" type="password" class="form-control"  placeholder="Enter Password"
                                   value="{{ old('password') }}">
                            @error('password')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="form-label">Confirm Password </label>
                            <input name="password_confirmation" type="password" class="form-control"  placeholder="Enter Confirm Password"
                                   value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>


                    <div class="mb-3">
                        <div>
                            <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
                                <i class="fa fa-save"></i> Update
                            </button>
                            <a class="btn btn-secondary waves-effect" href="{{ route('users.index') }}">
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
