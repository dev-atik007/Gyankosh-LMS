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
                        <li class="breadcrumb-item active" aria-current="page">All Permission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.add.permission') }}" class="btn btn-primary btn-sm">Add Permission</a>
                </div>
                &nbsp;
                <div class="btn-group">
                    <a href="{{ route('admin.import.permission') }}" class="btn btn-warning btn-sm">Import</a>
                </div>
                &nbsp;
                <div class="btn-group">
                    <a href="{{ route('admin.export') }}" class="btn btn-danger btn-sm">Export</a>
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
                                <th>Permission Name</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->group_name }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit.permission', $data->id) }}" class="btn btn-success btn-sm">Details</a>
                                        <a href="{{ route('admin.delete.permission', $data->id) }}" class="btn btn-danger btn-sm" id="delete">Trash</a>
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
