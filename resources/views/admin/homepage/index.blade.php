@extends('layouts.admin.app', ['title' => 'Home Page Setting'])
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Home Page Setting</h1>
            <button class="d-none d-sm-inline-block btn btn-dark shadow-sm" id="add_section_home_page" data-toggle="modal"
                data-target="#ModalHomePageSetting">
                <i class="fas fa-plus fa-sm text-white-100"></i>
            </button>
        </div>
        <!-- Content -->
        <!-- DataTales Example -->
        <div class="row" id="list_section">
            <div class="col-md-4">

            </div>
        </div>
        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">List Section Home Page</h6>
            </div>
            <div class="card-body">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Featured
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
            </div>
            <div class="card-footer">hhhhhhhhhhhh</div>
        </div> --}}
        @include('admin.homepage.modal_master_section.modal_home_page_setting')
    </div>
@endsection
@push('js')
    @include('admin.homepage.homepage_js')
@endpush
