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
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-md-4">

                                <form action="{{ route('admin.search.by.date') }}" method="POST" id="myForm" enctype="multipart/form-data"
                                    class="row g-3">
                                    @csrf

                                    <div class="form-group col-md-12">
                                        <label for="input1" class="form-label">Search By Date</label>
                                        <input type="date" name="date" class="form-control" id="catName">

                                    </div>

                                    <div class="col-md-6">

                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                        <button type="submit" class="btn btn-primary px-4" id="formSubmit">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">

                                <form action="{{ route('admin.search.by.month') }}" method="POST" id="myForm" enctype="multipart/form-data"
                                    class="row g-3">
                                    @csrf

                                    <div class="form-group col-md-12">
                                        <label for="input1" class="form-label">Search By Month</label>
                                        <select name="month" id="" class="form-select mb-3"
                                            aria-label="Default Select example">
                                            <option selected="">Open this select menu</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="input1" class="form-label">Search By Year</label>
                                        <select name="year_name" id="" class="form-select mb-3"
                                            aria-label="Default Select example">
                                            <option selected="">Open this select menu</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                        <button type="submit" class="btn btn-primary px-4" id="formSubmit">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">

                                <form action="{{ route('admin.search.by.year') }}" method="POST" id="myForm" enctype="multipart/form-data"
                                    class="row g-3">
                                    @csrf

                                    <div class="form-group col-md-12">
                                        <label for="input1" class="form-label">Search By Year</label>
                                        <select name="year" id="" class="form-select mb-3"
                                            aria-label="Default Select example">
                                            <option selected="">Open this select menu</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                        <button type="submit" class="btn btn-primary px-4" id="formSubmit">Search</button>
                                    </div>
                                </form>
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
