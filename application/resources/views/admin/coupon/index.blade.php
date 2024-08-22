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
                        <li class="breadcrumb-item active" aria-current="page">All Coupon</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.add.coupon') }}" class="btn btn-primary px-5">New Coupon</a>
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
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Coupon Validity</th>
                                <th>Coupon Status</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($coupon as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->coupon_name }}</td>
                                    <td>{{ $item->coupon_discount }}%</td>
                                    <td>{{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}</td>
                                    <td>
                                        @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge bg-success">Valid</span>
                                        @else
                                            <span class="badge bg-danger">Invalid</span>                                            
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.edit.coupon', $item->id) }}" class="btn btn-info px-t btn-sm"><i class="lni lni-eye"></i></a>
                                        <a href="{{ route('admin.delete.coupon', $item->id) }}" class="btn btn-danger px-t btn-sm" id="delete"><i class="lni lni-archive"></i></a>
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
