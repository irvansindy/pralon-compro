@extends('layouts.users.app', ['title' => 'Berita'])
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
                            <h1 class="page__title-2 mb-25">{{ $news->title }}</h1>
                            <div class="breadcrumb-menu-2 d-flex justify-content-center">
                                <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                                    <ul class="trail-items-2">
                                        <li class="trail-item-2 trail-begin"><a href="{{ route('home') }}"><span>Home</span></a></li>
                                        <li class="trail-item-2 trail-center"><a href="{{ route('news') }}"><span>Blog</span></a></li>
                                        <li class="trail-item-2 trail-end"><span>{{ $news->title }}</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page title area start  -->

        <!-- blog area start  -->
        <section class="df-blog__area section-spacing fix">
            <div class="container">
                <div class="row g-5">
                    <div class="col-xxl-8 col-xl-7 col-lg-7 col-md-12">
                        <div class="df-blog-details__wrap">
                            <div class="df-blog-details__box mb-30 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                                <div class="df-blog-details__thumb p-relative">
                                    <div class="df-blog-details__thumb-overlay wow"></div>
                                    <img src="{{ asset('assets/img/pralon/news_blog/'.$news->image) }}" alt="image not found">
                                </div>
                                <div class="df-blog-details__content mb-40">
                                    <div class="df-blog-details__meta mb-25">
                                        <span><i class="fa-thin fa-calendar-days"></i>
                                            {{ \Carbon\Carbon::parse($news->date)->format('d M, Y')}}
                                        </span>
                                    </div>
                                    <div class="df-blog-details__thumb-wrap">
                                        @forelse ($news->imageDetail as $image_detail)
                                        <div class="df-blog-details__thumb1 p-relative mb-30">
                                            <div class="df-blog-details__thumb-overlay wow"></div>
                                            <img src="{{ asset('assets/img/pralon/news_blog/details/'. $image_detail->file_name) }}" alt="image not found">
                                        </div>
                                            
                                        @empty
                                            
                                        @endforelse
                                        {{-- <div class="df-blog-details__thumb2 p-relative mb-30">
                                            <div class="df-blog-details__thumb-overlay wow"></div>
                                            <img src="assets/img/blog/blog-details-thumb-003.webp" alt="image not found">
                                        </div> --}}
                                    </div>
                                    <p class="df-blog-details__text mb-35">
                                        {{ $news->content }}
                                    </p>
                                    {{-- <div class="df-blog-details__tag-wrap d-flex align-items-center justify-content-between">
                                        <div class="sidebar-widget-tag d-flex align-items-center flex-wrap">
                                            <a href="blog-classic.html">Plumber</a>
                                            <a href="blog-classic.html">DIYplumbing</a>
                                            <a href="blog-classic.html">Fixing</a>
                                        </div>
                                        <div class="social-links t-right">
                                            <ul>
                                                <li><a href="https://www.facebook.com/"><i
                                                            class="icon-023-facebook-app-symbol"></i></a>
                                                </li>
                                                <li><a href="https://www.instagram.com/"><i
                                                            class="icon-025-instagram"></i></a>
                                                </li>
                                                <li><a href="https://www.pinterest.com/"><i
                                                            class="icon-029-pinterest"></i></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><i
                                                            class="icon-twitter-x"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="df-blog-details__author-wrap wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                                    <div class="df-blog-details__author-thumb">
                                        <img src="assets/img/blog/blog-author.webp" alt="image not found">
                                    </div>
                                    <div class="df-blog-details__author-content">
                                        <a href="team-details.html">
                                            <h3 class="df-blog-details__author-name">Max C. Tone</h3>
                                        </a>
                                        <p class="df-blog-details__author-text">Dolor set ameyt conse adipiscing elit Ut
                                            et mass Aliquam in Pellentesque sit amet sen.</p>
                                        <div class="social-links">
                                            <ul>
                                                <li><a href="https://www.facebook.com/"><i
                                                            class="icon-023-facebook-app-symbol"></i></a>
                                                </li>
                                                <li><a href="https://www.instagram.com/"><i
                                                            class="icon-025-instagram"></i></a>
                                                </li>
                                                <li><a href="https://www.pinterest.com/"><i
                                                            class="icon-029-pinterest"></i></a>
                                                </li>
                                                <li><a href="https://twitter.com/"><i
                                                            class="icon-twitter-x"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            {{-- <div class="df-blog-details__nav mb-30 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                                <div class="df-blog-details__nav-item">
                                    <a href="blog-details.html" class="circle-btn rotate">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-black.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-white.webp"
                                                alt="image not found">
                                        </span>
                                    </a><span>Previous Post</span>
                                </div>
                                <div class="df-blog-details__nav-item  d-none d-sm-block">
                                    <div class="df-blog-details__nav-dot">
                                        <img src="assets/img/icon/dot-icon.webp" alt="image not found">
                                    </div>
                                </div>
                                <div class="df-blog-details__nav-item">
                                    <span>Next Post</span>
                                    <a href="blog-details.html" class="circle-btn">
                                        <span class="icon__box">
                                            <img class="icon__first" src="assets/img/icon/arrow-black.webp"
                                                alt="image not found">
                                            <img class="icon__second" src="assets/img/icon/arrow-white.webp"
                                                alt="image not found">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="post-comment-form mb-40 wow fadeInUp animated" data-wow-duration="1.5s" data-wow-delay="0.3">
                                <div class="df-booking2__form">
                                    <h3 class="df-blog-details__subtitle mb-35">Leave a Reply</h3>
                                    <form action="#">
                                        <div class="row gx-5">
                                            <div class="col-md-6">
                                                <div class="df-input-field">
                                                    <input type="text" id="name" name="name" placeholder="Your Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="df-input-field">
                                                    <input type="text" id="email" name="email" placeholder="Your Email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="df-input-field">
                                                    <input type="text" id="address" name="address" placeholder="House Address">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="df-input-field">
                                                    <textarea id="message" name="message" placeholder="Write Message Here..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="df-booking2__form-btn mt-0">
                                                    <button type="submit" class="primary-btn">send now
                                                        <span class="icon__box">
                                                            <img class="icon__first"
                                                                src="assets/img/icon/arrow-white.webp"
                                                                alt="image not found">
                                                            <img class="icon__second"
                                                                src="assets/img/icon/arrow-white.webp"
                                                                alt="image not found">
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-12">
                        <div class="sidebar-widget mb-35">
                            <div class="blog-inner-title mb-30">
                                <h4>Search</h4>
                            </div>
                            <div class="sidebar-search p-relative">
                                <form action="#">
                                    <input type="text" placeholder="Search...">
                                    <button><i class="icon-049-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-35">
                            <div class="blog-inner-title mb-30">
                                <h4>Recent Post</h4>
                            </div>
                            <div class="blog-sideber-meta mb-25">
                                <div class="blog-sideber-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog-15.webp" alt="blog-meta"></a>
                                </div>
                                <div class="blog-sideber-text">
                                    <div class="df-blog3__meta">
                                        <span class="blog-date">25 Oct 2022</span>
                                    </div>
                                    <h4><a href="blog-details.html">The Frost Guard Conditioning</a></h4>
                                </div>
                            </div>
                            <div class="blog-sideber-meta mb-25">
                                <div class="blog-sideber-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog-12.webp" alt="blog-meta"></a>
                                </div>
                                <div class="blog-sideber-text">
                                    <div class="df-blog3__meta">
                                        <span class="blog-date">12 Aug 2022</span>
                                    </div>
                                    <h4><a href="blog-details.html">Your source for all things of Fix</a></h4>
                                </div>
                            </div>
                            <div class="blog-sideber-meta mb-25">
                                <div class="blog-sideber-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/blog-14.webp" alt="blog-meta"></a>
                                </div>
                                <div class="blog-sideber-text">
                                    <div class="df-blog3__meta">
                                        <span class="blog-date">12 Oct 2022</span>
                                    </div>
                                    <h4><a href="blog-details.html">Choosing the Right Plumbing</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-35">
                            <div class="blog-inner-title mb-30">
                                <h4>Category</h4>
                            </div>
                            <div class="blog-category-link">
                                <ul>
                                    <li><a href="blog-details.html">Plumbing Service</a></li>
                                    <li><a href="blog-details.html">Drain Cleaning</a></li>
                                    <li><a href="blog-details.html">Gasoline Service</a></li>
                                    <li><a href="blog-details.html">Kitchen Plumbing </a></li>
                                    <li><a href="blog-details.html">Kitchen Plumbing </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-35">
                            <div class="blog-inner-title mb-30">
                                <h4>Tags</h4>
                            </div>
                            <div class="sidebar-widget-tag">
                                <a href="blog-classic.html">Plumber</a>
                                <a href="blog-classic.html">DIYplumbing</a>
                                <a href="blog-classic.html">Fixing</a>
                                <a href="blog-classic.html">Plumbtips</a>
                                <a href="blog-classic.html">Plumbmat</a>
                                <a href="blog-classic.html">Plumb</a>
                                <a href="blog-classic.html">Plumbingpros</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog area end  -->

    </main>
    @include('layouts.users.footer')
@endsection
@push('js')
    @include('users.news.news_js')
@endpush