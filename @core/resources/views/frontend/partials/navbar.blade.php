@php
    $home_page_variant = isset($home_page) ? $home_page : get_static_option('home_page_variant');
@endphp


@if($home_page_variant != '00')
    <div class="header-style-01  header-variant-{{$home_page_variant}} @if(request()->path() !== '/') inner-page @endif">
        <div class="header-style-01">
            <div class="topbar-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="topbar-inner">
                                <div class="left-contnet">
                                    <ul class="info-items">
                                        @php
                                            $all_icon_fields =  filter_static_option_value('home_page_01_topbar_info_list_icon_icon',$global_static_field_data);
                                            $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                                            $all_title_fields = filter_static_option_value('home_page_01_topbar_info_list_text',$global_static_field_data);
                                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                                        @endphp
                                        @foreach($all_icon_fields as $index => $icon)
                                        <li><i class="{{$icon}}"></i> {{isset($all_title_fields[$index]) ? $all_title_fields[$index] : ''}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="right-contnet">
                                    <div class="social-link">
                                        <ul>
                                            @foreach($all_social_item as $data)
                                                <li><a href="{{$data->url}}"><i class="{{$data->icon}}"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="volunteer-right">
                                        <ul class="info-items-02">
                                            <x-front-user-login-li/>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-area navbar-expand-lg has-topbar nav-style-02">
                <div class="container nav-container">
                    <div class="responsive-mobile-menu">
                        <div class="logo-wrapper">
                            <a href="{{url('/')}}" class="logo">
                                @if(!empty(filter_static_option_value('site_logo',$global_static_field_data)))
                                    {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)) !!}
                                @else
                                    <h2 class="site-title">{{filter_static_option_value('site_title',$global_static_field_data)}}</h2>
                                @endif
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                        <ul class="navbar-nav">
                            {!! render_frontend_menu($primary_menu) !!}
                            <li class="search-lists">
                            @if(!empty(get_static_option('home_page_navbar_search_show_hide')))
                                <div class="search navbar-search position-relative">
                                    <div class="search-open">
                                        <i class="las la-search icon"></i>
                                    </div>
                                    <div class="search-bar">
                                        <form class="menu-search-form" action="{{ route('frontend.donation.search') }}">
                                            <div class="search-close"> <i class="las la-times"></i> </div>
                                            <input class="item-search" name="search" id="search" type="text" placeholder="{{__('Search Here.....')}}">
                                            <button type="submit"> {{__('Search')}}</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            </li>
                        </ul>
                    </div>
                    @if(!empty(filter_static_option_value('home_page_navbar_button_status',$global_static_field_data)))
                    <div class="nav-right-content">
                        <ul>
                            </li>
                                <x-front-donate-btn/>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>

@else
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid p-0">
            <div class="navbar-brand bg-primary">
                <a href="{{url('/')}}">
                    @if(!empty(filter_static_option_value('site_logo',$global_static_field_data)))
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)) !!}
                    @else
                        <h2 class="site-title">{{filter_static_option_value('site_title',$global_static_field_data)}}</h2>
                    @endif
                </a>
            </div>
            <div class="navbars">
                <div class="secondary-navbar">
                    <a href="{{route('user.login')}}" class="navbar-login">تسجيل الدخول</a>
                    <ul class="navbar-social-list">
                        @foreach($all_social_item as $data)
                            <li><a href="{{$data->url}}"><i class="{{$data->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="main-navbar">
                    <div class="collapse navbar-collapse" id="mainNavbar">
                        <ul class="navbar-nav">
                            {!! render_frontend_menu($primary_menu) !!}
                        </ul>
                    </div>
                    <div class="navbar-btns">
                        <button class="btn btn-sm-md navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#mainNavbar">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                        <button class="btn btn-sm-md navbar-search-btn">
                            <i class="btn fa-solid fa-magnifying-glass"></i>
                        </button>
                        <button class="btn btn-sm-md navbar-cart-btn">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    <a href="#" class="btn bg-primary text-white py-2 px-3 fs-6">
                            <span class="btn-icon bg-rounded-icon bg-tertiary">
                                <i class="fa-solid fa-heart"></i>
                            </span>
                            تبرع الان
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif
