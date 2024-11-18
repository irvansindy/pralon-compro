@extends('layouts.admin.app', ['title' => 'Menu Setting'])
@section('content')
    {{-- @include('layouts.admin.sidebar') --}}
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Menu</h6>
                <button class="btn btn-outline-primary" id="button_create_menu" style="float: right !important;" data-toggle="modal" data-target="#createMenu">
                    <i class="fas fa-solid fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="list_menu" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.menu.menu_modal')
        @include('admin.menu.submenu_modal')
        @include('admin.menu.list_submenu')
        {{-- <button class="btn btn-outline-secondary mx-1 my-1 add_submenu" id="" style="float: right !important;" data-toggle="modal" data-target="#createSubMenu" data-delete_id="${menu.id}" title="create submenu">
            <i class="fas fa-solid fa-plus"></i>
        </button> --}}
    </div>
@endsection
@push('js')
    @include('admin.menu.menu_js')
@endpush