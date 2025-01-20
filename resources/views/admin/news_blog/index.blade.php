@extends('layouts.admin.app', ['title' => 'News And Blog'])
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">News and Blog</h1>
            <button class="d-none d-sm-inline-block btn btn-dark shadow-sm" id="add_master_news_blog" data-toggle="modal"
                data-target="#ModalMasterNewsBlog">
                <i class="fas fa-plus fa-sm text-white-100"></i>
            </button>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">List News and Blog</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="news_blog_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Desc</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Desc</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.news_blog.modal_news_blog')
    </div>
@endsection
@push('css')
    <style>
        .badge,
        .badge-pill,
        .badge-primary {
            cursor: pointer;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 6px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
        }
    </style>
    <!-- Fileinput.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/css/fileinput.min.css"
        integrity="sha256-BOmk7YM0QE1RkIM/AIozfWkJnPNJXo7WZySGa3xXdYc=" crossorigin="anonymous">
    <!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
@endpush
@push('js')
    @include('admin.news_blog.news_blog_js')
@endpush
