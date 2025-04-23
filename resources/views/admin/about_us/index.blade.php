@extends('layouts.admin.app', ['title' => 'About Us Setting'])
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">About Us Setting</h1>
        </div>
        <!-- Content -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">About Us Content Section</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- <div class="col-md-4">
                        <section id="header-about-us">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-dark">Header Content</h6>
                                    <span class="badge badge-pill badge-primary py-1" id="btn-header-about-us" data-header_id=''><i class="fas fa-solid fa-eye"></i> View</span>
                                </div>
                                <div class="card-body">
                                    <p>Dummy link header</p>
                                </div>
                            </div>
                        </section>
                    </div> --}}
                    <div class="col-md-4">
                        <section id="history-about-us">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-dark">History/Sejarah</h6>
                                    <span class="badge badge-pill badge-primary py-1" id="btn-history-about-us" data-history_id=''><i class="fas fa-solid fa-eye"></i> View</span>
                                </div>
                                <div class="card-body">
                                    <p>Dummy link history</p>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section id="why-pralon-about-us">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-dark">Why Pralon</h6>
                                    <span class="badge badge-pill badge-primary py-1" id="btn-why-pralon-about-us" data-why_pralon_id=""><i class="fas fa-solid fa-eye"></i> View</span>
                                </div>
                                <div class="card-body">
                                    <p>Dummy Why Pralon</p>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section id="visi-misi-about-us">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-dark">Visi & Misi</h6>
                                    <span class="badge badge-pill badge-primary py-1" id="btn-visi-misi-about-us" data-vision_id=""><i class="fas fa-solid fa-eye"></i> View</span>
                                </div>
                                <div class="card-body">
                                    <p>Dummy Visi & Misi</p>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section id="value-with-contact-us-about-us">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-dark">Value Pralon</h6>
                                    <span class="badge badge-pill badge-primary py-1" id="btn-value-with-contact-us-about-us" data-value_pralon_id=""><i class="fas fa-solid fa-eye"></i> View</span>
                                </div>
                                <div class="card-body">
                                    <p>Value Pralon</p>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section id="sertifikat-about-us">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-dark">List Sertifikat</h6>
                                    <span class="badge badge-pill badge-primary py-1"  id="btn-sertifikat-about-us" data-certificate_id=""><i class="fas fa-solid fa-eye"></i> View</span>
                                </div>
                                <div class="card-body">
                                    <p>List Sertifikat</p>
                                </div>
                            </div>
                        </section>
                    </div>
                    {{-- <a href="#">
                        <img src="{{ asset("assets/img/pralon/sertifikat/9001.jpg") }}" alt="">
                    </a> --}}
                </div>
            </div>
        </div>
        @include('admin.about_us.modal_header')
        @include('admin.about_us.modal_history')
        @include('admin.about_us.modal_why_pralon')
        @include('admin.about_us.modal_visi_misi')
        @include('admin.about_us.modal_value')
        @include('admin.about_us.modal_certificate')
        {{-- @include('admin.about_us.modal_detail_certificate') --}}
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
@endpush
