@extends('layouts.users.app', ['title' => 'Berita'])
@section('content')
    @include('layouts.users.navbar')
    @include('layouts.users.sidebar')
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div>
    <!-- Add your site or application content here -->
    <main>

        <div class="adjust-header-space bg-common-white"></div>
        <div id="header_detail_news">
            
        </div>
        <!-- blog area start  -->
        <section class="df-blog__area section-spacing p-relative fix">
            <div class="circle-2"></div>
            <div class="circle-3"></div>
            <div class="container">
                <div id="header_news">
                    <div class="row justify-content-center section-title-spacing wow fadeInUp" data-wow-delay=".3s">
                        <div class="col-xl-8">
                            <div class="section__title-wrapper text-center">
                                <span class="section__subtitle bg-lighter">BERITA</span>
                                <h2 class="section__title">Berita & Blog</h2>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row g-5">
                    <div class="col-xxl-8 col-xl-7 col-lg-7 col-md-12">
                        <div class="text-center mt-3" id="loading_animation_product">
                            <img src="{{ asset('assets/img/pralon/animation/loading_spinner.svg') }}" class="mx-auto">
                        </div>
                        <div id="list_news_blog">
                            
                        </div>
                        <div class="df-blog2__area-btn text-center mt-60 wow fadeInUp" data-wow-delay=".3s" id="load_more_news">
                            <a href="#" class="load-btn">Load More<i class="fa-duotone fa-spinner"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-12">
                        <div class="sidebar-widget mb-35">
                            <div class="blog-inner-title mb-30">
                                <h4>Search</h4>
                            </div>
                            <div class="sidebar-search p-relative">
                                <form action="#">
                                    <input type="text" name="search_news" id="search_news" placeholder="Search...">
                                    <button type="button" id="submit_search"><i class="icon-049-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-35">
                            <div class="blog-inner-title mb-30">
                                <h4>Recent Post</h4>
                            </div>
                            <div id="list_recent_post_news">

                            </div>
                        </div>
                        <div class="sidebar-widget mb-35">
                            <div class="blog-inner-title mb-30">
                                <h4>Category</h4>
                            </div>
                            <div class="blog-category-link">
                                <ul id="list_news_category">

                                </ul>
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
