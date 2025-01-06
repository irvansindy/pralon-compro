@extends('layouts.admin.app', ['title' => 'Product Category'])
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Master Products</h1>
            <button class="d-none d-sm-inline-block btn btn-dark shadow-sm" id="add_master_product" data-toggle="modal" data-target="#ModalMasterProduct">
                <i class="fas fa-plus fa-sm text-white-100"></i>
            </button>
        </div>
        <!-- Content -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">List Product</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_products" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Fullname</th>
                                <th>slug</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Fullname</th>
                                <th>slug</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        @include('admin.product.master.modal')
        @include('admin.product.master.modal_brocure')
        @include('admin.product.master.modal_price_list')
    </div>
@endsection
@push('js')
    @include('admin.product.master.product_js')
@endpush