@extends('layouts.admin.app', ['title' => 'History Download User'])
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">History Download User</h1>

        </div>
        <!-- Content -->
        <!-- DataTales Example -->
        <div class="row">
            <div class="col-6 col-md-6 col-sm 12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark">Brocure</h6>

                        <div class="dropdown">
                            <i class="fa fa-bars" id="filterDropdownBrocure" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-hidden="true" style="cursor: pointer !important;"></i>
                            <div class="dropdown-menu custom-dropdown-menu keep-open-on-click"
                                aria-labelledby="filterDropdownBrocure">
                                <label class="dropdown-item" for="product_id_filter_brocure">Select Product:</label>
                                <div class="px-2">
                                    <select name="product_id_filter_brocure" id="product_id_filter_brocure"
                                        class="form-control">
                                        <option value="all">All</option>
                                        @php
                                            $products = \App\Models\Product::get(['id', 'name']);
                                            $products->each(function ($product) {
                                                echo "<option value='$product->id'>$product->name</option>";
                                            });
                                        @endphp
                                    </select>
                                </div>

                                <div class="dropdown-divider"></div>

                                <!-- Filter Range Tanggal -->
                                <label class="dropdown-item">Select Date Range:</label>
                                <div class="px-2">
                                    <label for="start_date_brocure">From</label>
                                    <input type="date" name="start_date_brocure" id="start_date_brocure" class="form-control my-2">
                                </div>
                                <div class="px-2">
                                    <label for="end_date_brocure">To</label>
                                    <input type="date" name="end_date_brocure" id="end_date_brocure" class="form-control my-2">
                                </div>

                                <div class="dropdown-divider"></div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-info mx-1 my-1" id="apply_filter_brocure" title="Filter">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success mx-1 my-1" id="export_excel_brocure" title="Export to Excel">
                                            <i class="fas fa-file-excel"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_history_download_brocure" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Product</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Product</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-6 col-sm 12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark">Price List</h6>
                        <div class="dropdown">
                            <i class="fa fa-bars" id="filterDropdownPricelist" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-hidden="true" style="cursor: pointer !important;"></i>
                            <div class="dropdown-menu custom-dropdown-menu keep-open-on-click"
                                aria-labelledby="filterDropdownPricelist">
                                <label class="dropdown-item" for="product_id_filter_brocure">Select Product:</label>
                                <div class="px-2">
                                    <select name="product_id_filter_pricelist" id="product_id_filter_pricelist"
                                        class="form-control">
                                        <option value="all">All</option>
                                        @php
                                            $products = \App\Models\Product::get(['id', 'name']);
                                            $products->each(function ($product) {
                                                echo "<option value='$product->id'>$product->name</option>";
                                            });
                                        @endphp
                                    </select>
                                </div>

                                <div class="dropdown-divider"></div>

                                <!-- Filter Range Tanggal -->
                                <label class="dropdown-item">Select Date Range:</label>
                                <div class="px-2">
                                    <input type="date" id="start_date_pricelist" class="form-control my-2">
                                    <input type="date" id="end_date_pricelist" class="form-control my-2">
                                </div>

                                <div class="dropdown-divider"></div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-info mx-1 my-1" id="apply_filter_pricelist" title="Filter">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success mx-1 my-1" id="export_excel_pricelist" title="Export to Excel">
                                            <i class="fas fa-file-excel"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_history_download_pricelist" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Product</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Product</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.mail.modal_email_template')
    </div>
@endsection
@push('css')
    <style>
        .select2-container {
            width: 100% !important;
        }

        <style>

        /* Membuat dropdown lebih besar */
        .dropdown-menu,
        .custom-dropdown-menu {
            min-width: 14rem !important;
            /* Sesuaikan lebar */
            padding: 15px;
            /* Tambahkan padding agar nyaman */
        }
    </style>
    </style>
@endpush
@push('js')
    <script>
        // Mencegah dropdown tertutup saat klik di dalamnya
        $('.keep-open-on-click').on('click', function(event) {
            event.stopPropagation();
        });
    </script>
    @include('admin.history_download.history_download_js')
@endpush
