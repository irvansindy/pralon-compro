@extends('layouts.users.app', ['title' => 'Hubungi Kami'])
@section('content')
    @include('layouts.users.navbar')
    @include('layouts.users.sidebar')
    {{-- <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div> --}}

    <main>
        
        <div class="adjust-header-space bg-common-white"></div>
        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;">
        <!-- contact area start  -->
        <section class="df-services__area section-spacing p-relative x-clip">
            <div class="container">
                <div class="row justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                    <div class="col-xl-8">
                        <div class="section__title-wrapper text-center">
                            <span class="section__subtitle bg-lighter">Hubungi Kami</span>
                            <h2 class="section__title">Terhubung Bersama Kami</h2>
                        </div>
                    </div>
                </div>
                <!-- blog style 02 start  -->
                <div class="df-blog4__wrapper">
                    <div class="row g-5 row-cols-lg-2 row-cols-md-2 row-cols-1 wow fadeInUp" id="list_contact_us" data-wow-delay=".5s" style="padding-left: 50px !important; padding-right: 50px !important;">
                    </div>
                </div>
                <!-- blog style 02 end  -->
                <div class="df-booking2__form-wrapper section-spacing-top" style="padding-top: 180px !important; padding-left: 50px !important; padding-right: 50px !important;">
                    <div class="df-booking__video">
                        <img src="{{ asset('storage/uploads/contact_us/Head Office 2.jpg') }}" alt="image not found">
                    </div>
                    <div class="df-booking2__form">
                    {{-- <div class=""> --}}
                        <form action="#" id="form_contact_us">
                            <div class="row gx-5">
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <input type="text" id="name" name="name" placeholder="Nama Lengkap">
                                        <span class="text-sm text-danger mt-2 message_name" id="message_name" role="alert" style="font-size: 12px !important;"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <input type="text" id="email" name="email" placeholder="Email">
                                        <span class="text-sm text-danger mt-2 message_email" id="message_email" role="alert" style="font-size: 12px !important;"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <input type="number" id="phone_number" name="phone_number" placeholder="Nomor Handphone">
                                        <span class="text-sm text-danger mt-2 message_phone_number" id="message_phone_number" role="alert" style="font-size: 12px !important;"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="df-input-field">
                                        <select name="type_service" id="type_service">
                                            @foreach ($typeServices as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-sm text-danger mt-2 message_type_service" id="message_type_service" role="alert" style="font-size: 12px !important;"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="df-input-field">
                                        <textarea id="message_contact" name="message_contact" placeholder="ketik pesan disini..."></textarea>
                                        <span class="text-sm text-danger mt-2 message_message_contact" id="message_message_contact" role="alert" style="font-size: 12px !important;"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="df-booking2__form-btn mt-0">
                                        <button type="button" class="primary-btn hover-white">kirim pesan
                                            <span class="icon__box">
                                                <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                                    alt="image not found">
                                                <img class="icon__second" src="{{ asset('assets/img/icon/arrow-black.webp') }}"
                                                    alt="image not found">
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="df__map p-relative section-spacing-top">
                <div class="df__google-map mapouter">
                    <div class="gmap_canvas">
                        <iframe width="1920" height="580" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=Pralon.+PT%2C+Alam+Sutera%2C+Synergy%2C+Jl.+Jalur+Sutera+Bar.+No.17%2C+RT.002%2FRW.003%2C+East+Panunggangan%2C+Pinang%2C+Tangerang+City%2C+Banten+15143&t=k&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                        <a href="https://textcaseconvert.com"></a>
                        <br>
                        <a href="https://www.tabclocktab.com"></a><br>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 580px;
                                width: 1920px;
                            }
                        </style>
                        {{-- <a href="https://www.ongooglemaps.com">adding google map to website</a> --}}
                        <style>
                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 580px;
                                width: 1920px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact area end  -->

    </main>

    @include('layouts.users.footer')
@endsection
@push('js')
    @include('users.contact_us.contact_us_js')
@endpush
