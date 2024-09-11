@extends('admin.layouts.app')
@section('panel')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Role In Permission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Add Role In Permission</h5>

                        <form action="{{ route('admin.store.roles.permission') }}" method="POST" id="myForm"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf


                            <div class="form-group col-md-6">
                                <label for="single-select-field" class="form-label">Roles Name</label>
                                <select class="form-select" id="single-select-field" data-placeholder="Choose one thing"
                                    name="role_id">
                                    <option value="" disabled>Open Roles</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach

                                </select>
                                <span class="category_id text-danger"></span>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckMain">
                                <label class="form-check-label" for="flexCheckMain">Select All Permissions</label>
                            </div>

                            <hr>

                            @foreach ($permission_groups as $group)
                                <div class="row">
                                    <div class="col-3">
                                        @php
                                            $permissions = App\Models\User::getpermissionByGroupName(
                                                $group->group_name,
                                            );
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                                {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="flexCheckDefault">{{ $group->group_name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-9">

                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission[]"
                                                    value="{{ $permission->id }}" id="checkDefault{{ $permission->id }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                                <label class="form-check-label"
                                                    for="checkDefault{{ $permission->id }}">{{ $permission->name }}

                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-6">

                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                <button type="submit" class="btn btn-primary px-4" id="formSubmit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // function toggle(source) {
        //     checkboxes = document.getElementsByName('permission[]');
        //     for(var i=0, n=checkboxes.length; i<n; i++) {
        //         checkboxes[i].checked = source.checked;
        //     }
        // }

        $('#flexCheckMain').click(function() {
            if ($(this).is(':checked')) {
                $('input[ type=checkbox]').prop('checked', true)
            } else {
                $('input[ type=checkbox]').prop('checked', false)
            }
        });
    </script>
@endpush
