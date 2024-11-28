@extends('layouts.users.app', ['title' => 'Detail Produk'])
@section('content')
    @include('layouts.users.navbar')
    @include('layouts.users.sidebar')
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div>
    <main>
        <div class="adjust-header-space bg-common-white"></div>

        <!-- page title area start  -->
        <section class="page-title-area-2 breadcrumb-spacing bg-theme-4 section-spacing">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="page-title-wrapper-2 text-center">
                            <h1 class="page__title-2 mb-25">{{ $product->name }}</h1>
                            <div class="breadcrumb-menu-2 d-flex justify-content-center">
                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <ul class="trail-items-2">
                                        <li class="trail-item-2 trail-begin"><a
                                                href="{{ route('home') }}"><span>Beranda</span></a></li>
                                        <li class="trail-item-2 trail-center"><a
                                                href="{{ route('product') }}"><span>Produk</span></a></li>
                                        <li class="trail-item-2 trail-end"><span>{{ $product->name }}</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area start  -->

        <!-- service area start -->
        <section class="df-service5__area section-spacing">
            <div class="container">
                <div class="row g-50 align-items-center">
                    <div class="col-lg-6 order-lg-0 order-1">
                        <div class="df-service5__thumb">
                            <img src="{{ asset('assets/img/pralon/list_product/' . $product->image) }}" alt="img not found">
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-1 order-0">
                        <div class="df-service5__content">
                            <div class="section__title-wrapper">
                                <span class="section__subtitle bg-lighter">TENTANG PRODUK</span>
                                <h2 class="section__title">{{ $product->full_name }}</h2>
                            </div>
                            <p class="mt-35 mb-35">{!! $product->main_desc !!}</p>
                            <div class="df-service5__info" style="gap: 16px 0 !important;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- service area start -->

        <!-- challenge area start -->
        <section class="df-challenge__area pb-20">
            <div class="container">
                <div class="row section-title-spacing">
                    <div class="col-lg-4">
                        <div class="section__title-wrapper">
                            <span class="section__subtitle bg-lighter">Unduh</span>
                            <h2 class="section__title">Katalog dan Daftar Harga</h2>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex justify-content-end">
                        <div class="df-challenge__content">
                            <p class="mb-40 mt-40">
                                Untuk informasi lebih lengkap mengenai produk {{ $product->full_name }} dapat langsung
                                mengunduh Katalog & Daftar Harga dibawah ini.
                            </p>
                            <div class="df-challenge__feature-list">
                                <ul>
                                    {{-- {{ asset('assets/file/brocure/brosur_fabricated.pdf') }}
                                    {{ asset('assets/file/pricelist/pricelist_fabricated.pdf') }} --}}
                                    @if ($product->brocure != null)
                                        <li>
                                            <button type="button" class="primary-btn bordered btn-small hover-white"
                                                id="btn_download_brocure" data-id="{{ $product->id }}"
                                                data-brocure="{{ $product->brocure->brocure_file }}" data-bs-toggle="modal" data-bs-target="#confirm_download_brocure">Katalog Produk
                                                <span class="icon__box">
                                                    <img class="icon__first"
                                                        src="{{ asset('assets/img/icon/arrow-theme.png') }}"
                                                        alt="image not found" style="color: #C21010 !important;">
                                                    <img class="icon__second"
                                                        src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                                        alt="image not found">
                                                </span>
                                            </button>
                                        </li>
                                    @endif
                                    @if ($product->priceList != null)
                                        <li>
                                            <button type="button" class="primary-btn bordered btn-small hover-white"
                                                id="btn_download_pricelist" data-id="{{ $product->id }}"
                                                data-pricelist="{{ $product->priceList->price_list_file }}" data-bs-toggle="modal" data-bs-target="#confirm_download_pricelist">Daftar Harga
                                                <span class="icon__box">
                                                    <img class="icon__first"
                                                        src="{{ asset('assets/img/icon/arrow-theme.png') }}"
                                                        alt="image not found" style="color: #C21010 !important;">
                                                    <img class="icon__second"
                                                        src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                                        alt="image not found">
                                                </span>
                                            </button>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- challenge area start -->

        <!-- img area start -->
        <div class="df-img-area-start section-spacing-bottom">
            <div class="container">
                <div class="row g-5">
                    
                    @forelse ($product->detailImage as $image)
                        <div class="col-lg-6">
                            <div class="df-img-thumb">
                                <img src="{{ asset('assets/img/pralon/list_product/detail_product/' . $image->image_detail) }}"
                                    alt="tidak ada">
                            </div>
                        </div>

                    @empty
                        <div class="col-lg-6">
                            <div class="df-img-thumb">
                                <img src="{{ asset('assets/img/blog/blog-details-thumb-003.webp') }}"
                                    alt="tidak ada">
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- img area start -->

        <!-- result area start -->
        <section class="df-result__area section-spacing-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section__title-wrapper">
                            <span class="section__subtitle bg-lighter">{{ $product->detailProduct->title }}</span>
                            <h2 class="section__title">{{ $product->detailProduct->subtitle }}</h2>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex justify-content-end">
                        <div class="df-challenge__content section-spacing-bottom">
                            <p class="mb-40 mt-40">
                                {{-- {{ $product->detailProduct->desc }} --}}
                                {!! $product->detailProduct->desc !!}
                            </p>
                            <div class="df-challenge__feature-list">
                                <ul>
                                    @forelse ($product->detailProduct->feature as $feature)
                                        <li>
                                            <span class="list-icon">
                                                <i class="icon-058-check"></i>
                                            </span>
                                            <p>{{ $feature->name }}</p>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- service style 01 start -->
                    <section class="service-box-styles section-spacing">
                        <div class="container">
                            <div class="section__title-wrapper text-center section-title-spacing">
                                <span class="section__subtitle bg-lighter">PRODUK</span>
                                <h2 class="section__title">Produk Terkait</h2>
                            </div>
                            <div class="row g-5 row-cols-xl-3 row-cols-md-2 row-cols-1">
                                @forelse ($related_products as $related_product)
                                    <div class="col">
                                        <a
                                            href="{{ route('product-detail', ['id' => $related_product->id, 'slug' => $related_product->slug]) }}">
                                            <div class="service__box wow fadeInUp" data-wow-delay=".5s">
                                                <div class="service__content">
                                                    <div class="service__img">
                                                        <img src="{{ asset('assets/img/pralon/list_product/' . $related_product->image) }}"
                                                            alt="image not found">
                                                    </div>
                                                    <h4 class="service__title">{{ $related_product->name }}</h4>
                                                    <p class="service__text">
                                                        {{ $related_product->short_desc }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                @empty
                                @endforelse
                            </div>
                        </div>
                    </section>
                    <!-- service style 01 end -->
                </div>
            </div>
        </section>
        <!-- result area start -->
    </main>
    @if ($product->brocure != null)
    @include('users.product.modal_confirm_download_brocure')
    @endif
    @if ($product->priceList != NULL)
        @include('users.product.modal_confirm_download_pricelist')
    @endif
    @include('layouts.users.footer')
@endsection
@push('js')
    @include('users.product.product_detail_js')
@endpush
