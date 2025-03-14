@extends('layouts.admin.app', ['title' => 'Email Messages'])
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Email Messages</h1>
            {{-- <button class="d-none d-sm-inline-block btn btn-dark shadow-sm" id="add_email_template" data-toggle="modal" data-target="#ModalEmailTemplate">
                <i class="fas fa-plus fa-sm text-white-100"></i>
            </button> --}}
        </div>
        <!-- Content -->
        <!-- DataTales Example -->
        <div class="row">
            <div class="col-6 col-md-6 col-sm 12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Email from Contact Us</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_email_contact_us" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
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
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Email from Brocure/Price list</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_email_brocure_pricelist" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Type</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Type</th>
                                        <th>Subject</th>
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
@push('js')
@include('admin.email_message.email_message_js')
@endpush