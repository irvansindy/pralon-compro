@extends('errors::minimal')
@section('title', __('Not Found'))

@section('message')
    <style>
        .error-image {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            /* Opsional: tambahkan radius jika ingin sudut melengkung */
        }

        .primary-btn {
            padding: 12px 24px;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .df-error__area-btn {
                margin-top: 30px;
            }

            .primary-btn {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
    <section class="df-error__area section-spacing">
        <div class="container">
            <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp"
                data-wow-delay=".3s">
                <div class="col-xl-8 col-lg-10 col-md-12">
                    <div class="df-error__thumb text-center">
                        <img src="{{ asset('storage/uploads/html/404-v1-white.png') }}" alt="404 Error" class="error-image">
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center section-title-spacing wow fadeInUp"
                data-wow-delay=".3s">
                <div class="col-lg-5 col-md-8 col-sm-10">
                    <div class="df-error__area-btn text-center mt-60 wow fadeInUp" data-wow-delay=".3s">
                        <a href="{{ url()->previous() }}" class="primary-btn hover-white">
                            Go Back
                            <span class="icon__box">
                                {{-- <img class="icon__first" src="{{ asset('assets/img/icon/arrow-white.webp') }}"
                                    alt="Go Back"> --}}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
