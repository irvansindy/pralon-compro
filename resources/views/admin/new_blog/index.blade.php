@extends('layouts.admin.app', ['title' => 'News And Blog'])
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
        @include('admin.about_us.modal_header')
        @include('admin.about_us.modal_history')
        @include('admin.about_us.modal_why_pralon')
        @include('admin.about_us.modal_visi_misi')
        @include('admin.about_us.modal_value')
        @include('admin.about_us.modal_certificate')
        @include('admin.about_us.modal_detail_certificate')
    </div>
@endsection
@push('css')
    <style>
        .badge,
        .badge-pill,
        .badge-primary {
            cursor: pointer;
        }
    </style>
    <!-- Fileinput.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/css/fileinput.min.css" integrity="sha256-BOmk7YM0QE1RkIM/AIozfWkJnPNJXo7WZySGa3xXdYc=" crossorigin="anonymous">
    <!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
@endpush
@push('js')
    @include('admin.about_us.about_us_js')
    {{-- <script>
        $('img').click(function() {
            var img=$(this).attr('src');
            $("#detail_certificate").attr('src',img);
            $("#modalDetailCertificateAboutUs").modal('show');
        })
    </script> --}}
@endpush
