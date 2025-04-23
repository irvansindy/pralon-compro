@extends('layouts.admin.app', ['title' => 'Home Page Setting'])

@section('title', 'Home Page Setting')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Home Page Setting</h1>
    <div class="row">
        @php
            $sections = DB::table('home_page_section_masters')->where('title', '!=', 'Why Us')->get()->map(function ($section) {
                return [
                    'name_section' => $section->title,
                    'icon_section' => $section->icon,
                ];
            });
        @endphp
        
        @foreach ($sections as $section)
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card shadow h-100 py-2 border-left-secondary" id="card_{{ strtolower(str_replace(' ', '_', $section['name_section'])) }}" style="cursor: pointer;" data-toggle="modal" data-target="#ModalHomePageSetting" data-section="{{ $section['name_section'] }}">
                <div class="card-body d-flex align-items-center">
                    <div class="mr-3">
                        <i class="{{ $section['icon_section'] }} fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">{{ $section['name_section'] }}</h6>
                        <small class="text-muted">Manage {{ $section['name_section'] }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @include('admin.homepage.modal.modal_header')
    @include('admin.homepage.modal.modal_product')
    @include('admin.about_us.modal_history')
    @include('admin.homepage.modal.modal_project')
    @include('admin.homepage.modal.modal_testimonial')
    @include('admin.homepage.modal.modal_form_testimonial')
    @include('admin.homepage.modal.modal_news')
</div>
@endsection
@push('js')
    @include('admin.homepage.homepage_js')
@endpush