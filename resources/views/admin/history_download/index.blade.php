@extends('layouts.admin.app', ['title' => 'History Download User'])
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">History Download User</h1>
            {{-- <button class="d-none d-sm-inline-block btn btn-dark shadow-sm" id="add_email_template" data-toggle="modal" data-target="#ModalEmailTemplate">
                <i class="fas fa-plus fa-sm text-white-100"></i>
            </button> --}}
        </div>
        <!-- Content -->
        <!-- DataTales Example -->
        <div class="row">
            <div class="col-6 col-md-6 col-sm 12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark">Brocure</h6>
                        <select name="product_id_filter_brocure" id="product_id_filter_brocure" class="form-control">
                            @php
                                $products = \App\Models\Product::get(['id', 'name']);
                                $products->each(function($product) {
                                    echo "<option value='$product->id'>$product->name</option>";
                                });
                            @endphp
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_history_download_brocure" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
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
                        <select name="product_id_filter_pricelist" id="product_id_filter_pricelist" class="form-control">
                            @php
                                $products = \App\Models\Product::get(['id', 'name']);
                                $products->each(function($product) {
                                    echo "<option value='$product->id'>$product->name</option>";
                                });
                            @endphp
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_history_download_pricelist" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
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
            width: auto !important;
        }
    </style>
@endpush
@push('js')
    @include('admin.history_download.history_download_js')
@endpush