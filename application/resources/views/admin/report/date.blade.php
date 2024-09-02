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
                        <li class="breadcrumb-item active" aria-current="page">Report By Date</li>
                    </ol>
                </nav>
            </div>

        </div>

        <h3>Search By Date: {{ $formatDate }}</h3>

        <div class="card" style="text-align: center;">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payment as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->order_date }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->invoice_no }}</td>
                                    <td>{{ $data->total_amount }}</td>
                                    <td>{{ $data->payment_type }}</td>
                                    <td><span class="badge rounded-pill bg-success">{{ $data->status }}</span></td>
                                </tr>
                            @empty
            
                                <div style="text-align: center; margin-top: 50px;">
                                    <h2 style="color: #ff6b6b;">No Data Available</h2>
                                    <p style="color: #6c757d;">We couldn't find any data to display at this moment. Please
                                        check back later or try refreshing the page.</p>
                                </div>
                    
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
