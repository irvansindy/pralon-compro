@extends('layouts.users.app', ['title' => 'Produk'])
@section('content')
    @include('layouts.users.navbar')
    @include('layouts.users.sidebar')
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div>
    <main>

        <div class="adjust-header-space bg-common-white"></div>
        <!-- product start  -->
        <section class="df-services__area section-spacing p-relative x-clip" id="product_list" style="padding-bottom: 10px !important;">
            
            <div class="data_product_list">
                <div class="area-shapes">
                    <div class="df-inner-area__shape1"></div>
                    <div class="df-inner-area__shape2"></div>
                </div>
                <div class="container mb-5">
                    <div class="row justify-content-center section-title-spacing mb-4 wow fadeInUp" data-wow-delay=".3s">
                        <div class="col-xl-8">
                            <div class="section__title-wrapper text-center">
                                <span class="section__subtitle bg-lighter">PRODUK KAMI</span>
                                <h2 class="section__title mb-2">Jelajahi Produk Kami</h2>
                            </div>
                            
                        </div>
                    </div>
                    {{-- filter pill button --}}
                    <ul class="nav nav-pills my-5 justify-content-center wow fadeInUp" id="list_category" style="--bs-nav-link-padding-x: 1.5rem !important;">
                        <li class="nav-item wow fadeInUp">
                    </ul>
                    <div class="text-center mt-3">
                        <img src="{{ asset('assets/img/pralon/animation/loading_spinner.svg') }}" class="mx-auto" id="loading_animation_product">
                    </div>
                    {{-- end filter pill button --}}
                    <div class="row g-5 row-cols-xl-4 row-cols-md-2 row-cols-1 wow fadeInUp mt-2" id="list_product"
                        data-wow-delay=".3s">
    
                    </div>
                </div>
                
            </div>
        </section>
        <!-- product end  -->
        <section class="df-services__area section-spacing p-relative x-clip" style="padding-top: 10px !important; padding-bottom: 10px !important;">
            <nav class="" aria-label="Page navigation" id="pagination_product"></nav>
        </section>

        <!-- horizontal line start  -->
        <div class="container">
            <div class="hr1"></div>
        </div>
        <!-- horizontal line end  -->
    </main>
    @include('layouts.users.footer')
@endsection
@push('js')
    @include('users.product.product_js')
@endpush
