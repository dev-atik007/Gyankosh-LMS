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
                        <li class="breadcrumb-item active" aria-current="page">All Roles in Permission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.add.roles.permission') }}" class="btn btn-primary btn-sm">Add Roles
                        Permission</a>
                </div>
            </div>
        </div>

        <div class="card" style="text-align: center;">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Roles Name</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>{{ $data->name }}</td>
                                    <td>

                                        @foreach ($data->permissions as $permission)
                                            <span class="badge bg-danger">{{ $permission->name }}</span>
                                        @endforeach

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.edit.roles.permission', $data->id) }}"
                                            class="btn btn-success btn-sm">Details</a>
                                        <a href="{{ route('admin.delete.roles.permission', $data->id) }}"
                                            class="btn btn-danger btn-sm" id="delete">Trash</a>
                                    </td>
                                </tr>
                            @empty
                                <h1>No Data Avaible in table</h1>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
