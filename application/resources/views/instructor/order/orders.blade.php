@extends('instructor.layouts.app')
@section('instructor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Orders List</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="card" style="text-align: center;">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($orderData as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data['payment']['order_date'] }}</td>
                                    <td>{{ $data['payment']['invoice_no'] }}</td>
                                    <td>{{ $data['payment']['total_amount'] }}</td>
                                    <td>{{ $data['payment']['payment_type'] }}</td>
                                    <td>
                                        @if ($data['payment']['status'] === 'confirm')
                                            <span class="badge bg-success">{{ $data['payment']['status'] }}</span>
                                        @elseif($data['payment']['status'] === 'pending')
                                            <span class="badge bg-danger">{{ $data['payment']['status'] }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $data['payment']['status'] }}</span>
                                            <!-- Default class -->
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="" class="btn btn-info btn-sm" title="Edit"><i
                                                class="lni lni-eraser"></i></a> --}}
                                        <a href="{{ route('instructor.order.details', $data->payment->id) }}" class="btn btn-info btn-sm" title="details"><i
                                                class="lni lni-eye"></i></a>

                                        {{-- <a href="" class="btn btn-warning btn-sm" title="Lecture"><i
                                                class="lni lni-list"></i></a> --}}
                                        <a href="{{ route('instructor.order.invoice', $data->payment->id) }}" class="btn btn-warning btn-sm" title="pdf"><i
                                                class="lni lni-download"></i></a>

                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
