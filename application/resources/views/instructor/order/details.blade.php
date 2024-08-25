@extends('instructor.layouts.app')
@section('instructor')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Order Details</div>


    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">User Name :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->name }}</strong>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->email }}</strong>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->phone }}</strong>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->address }}</strong>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Delivery :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->cash_delivery }}</strong>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Total Amount :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>${{ $payment->total_amount }}</strong>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Payment Type :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->payment_type }}</strong>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Invoice No :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->invoice_no }}</strong>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Order Date :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->order_date }}</strong>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status :</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    @if ($payment->status == 'pending')
                                        <a href="{{ route('admin.pending.confirm', $payment->id) }}"
                                            class="btn btn-block btn-info btn-sm" id="confirm">Confirm Order</a>
                                    @elseif ($payment->status == 'confirm')
                                        <a href="{{ route('admin.confirm.order', $payment->id) }}"
                                            class="btn btn-block btn-success btn-sm">Confirm Order</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-3">
                                <div class="table-responsive">
                                    <table class="table" style="font-weight: 600;">
                                        <tbody>
                                            <tr>
                                                <td class="col-md-1">
                                                    <label>Image</label>
                                                </td>
                                                <td class="col-md-1">
                                                    <label>Course Name</label>
                                                </td>
                                                <td class="col-md-1">
                                                    <label>Category</label>
                                                </td>
                                                <td class="col-md-1">
                                                    <label>Instructor Name</label>
                                                </td>
                                                <td class="col-md-1">
                                                    <label>Price</label>
                                                </td>

                                            </tr>

                                            @php
                                                $totalPrice = 0;
                                            @endphp

                                            @forelse ($order as $data)
                                                <tr>
                                                    <td class="col-md-1">
                                                        <label><img src="{{ asset($data->course->course_image) }}"
                                                                alt="" style="width: 50px; height: 50px;"></label>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <label>{{ $data->course->course_name }}</label>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <label>{{ $data->course->category->category }}</label>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <label>{{ $data->course->user->name }}</label>
                                                    </td>
                                                    <td class="col-md-2">
                                                        <label>${{ $data->price }}</label>
                                                    </td>
                                                </tr>

                                                @php
                                                    $totalPrice += $data->price;
                                                @endphp
                                            @empty
                                            @endforelse

                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="col-md-3">
                                                    <strong>Total Price : ${{ $totalPrice }}</strong>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
