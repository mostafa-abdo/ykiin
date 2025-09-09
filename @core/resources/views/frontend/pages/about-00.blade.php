@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('about_page_name')}}
@endsection
@section('page-title',get_static_option('about_page_name'))
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('about_page_meta_description')}}">
    <meta name="tags" content="{{get_static_option('about_page__meta_tags')}}">
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/about-00.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/common/vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/common/vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}">
@endsection
@section('content')
    <!-- About Section -->
    <section class="aboutus-section bg-primary text-white py-6 overflow-hidden  decor-large-bottom" id="about-us">
        <div class="container d-flex flex-column flex-lg-row justify-content-between gap-lg-5 px-3">
            @if(!empty(get_static_option('about_page_about_us_section_status')))
                <div class="d-flex flex-column text-center text-lg-start mb-6">
                    <div class="text-secondary fw-medium fs-5 mb-4">
                        <i class="fa-solid fa-hand-holding-heart me-2"></i>
                        {{get_static_option('about_page_about_section_subtitle')}}
                    </div>
                    <div class="fs-big fw-bolder mb-4">
                        {!! render_colored_text(get_static_option('about_page_about_section_title')) !!}
                    </div>
                    <div class="fs-7 fw-normal desc mb-3 lh-lg">
                       {!! get_static_option('about_page_about_section_description') !!}
                    </div>
                    <div class="fs-5 text-secondary fw-medium mb-3">
                        شعارنا هو
                    </div>
                    <div class="fs-big fw-semibold mb-5">
                        كُـنْ <span class="text-secondary">يَـقـيـنًا</span> لِـمُـحْـتَـاجٍ ......
                    </div>
                </div>
                <div class="simg" {!! render_background_image_markup_by_attachment_id(get_static_option('about_page_about_section_left_image_image')) !!}>
                </div>
            @endif

        </div>
    </section>
    @if(!empty(get_static_option('about_page_our_vision_section_status')))
        <section class="px-3 py-5 d-flex justify-content-center align-items-center">
            <div class="container-small d-flex flex-column flex-lg-row align-items-center justify-content-center gap-5">
                @php
                    $all_icon_fields =  get_static_option('about_page_our_vision_list_section_icon');
                    $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                    $all_title_fields = get_static_option('about_page_our_vision_list_section_title');
                    $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                    $all_description_fields = get_static_option('about_page_our_vision_list_section_description');
                    $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : [];
                @endphp
                @foreach($all_icon_fields as $icon)
                    <div class="item d-flex flex-column align-items-center rounded-4 p-5 bg-gray-light w-100">
                        <div class="mb-4">
                            <i class="fa-solid {{$icon}} text-secondary fs-1"></i>
                        </div>

                        <div class="fs-1 fw-bold mb-4 text-black">
                            {!! render_colored_text($all_title_fields[array_search($icon, $all_icon_fields)]) !!}
                        </div>
                        <div class="text-center fs-4 text-black">
                            {!! render_colored_text($all_description_fields[array_search($icon, $all_icon_fields)]) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if(!empty(get_static_option('about_page_our_values_section_status')))
        <section class="ourvalues-section"  id="our-values" {!! render_background_image_markup_by_attachment_id(get_static_option('about_page_our_values_section_background_image')) !!}>
            <div class="container d-flex flex-column align-items-center">
                <div class="fs-big fw-bold mb-6 text-white">
                    {!! render_colored_text(get_static_option('about_page_our_values_title')) !!}
                </div>
                <div class="values">
                    @php
                        $all_icon_fields =  get_static_option('about_page_our_values_list_section_icon');
                        $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                        $all_title_fields = get_static_option('about_page_our_values_list_section_title');
                        $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                    @endphp
                    @foreach($all_icon_fields as $icon)
                        <div class="value-item">
                           <div class="mb-4">
                                <i class="fa-solid {{$icon}} text-secondary fs-2"></i>
                            </div>
                            {!! render_colored_text($all_title_fields[array_search($icon, $all_icon_fields)]) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

   
    @if(!empty(get_static_option('about_page_testimonial_section_status')))
        <!-- testimonial area start  -->
        <section class="testimonials-section d-flex justify-content-center px-3" id="testimonials">
            <div class="text-center container-small d-flex flex-column align-items-center py-6">
                <div class="fs-big fw-bold mb-4">{{get_static_option('about_page_testimonial_subtitle')}}</div>
                <div class="fs-5 fw-medium mb-6">{!! render_colored_text(get_static_option('about_page_testimonial_title')) !!}</div>
                <div class="testimonials-carousel owl-carousel">
                    @foreach($all_testimonial as $data)
                        <div class="item d-flex flex-column p-4 border rounded-4 text-start">
                            <div class="d-flex flex-row gap-3 mb-4">
                                <div class="user-img">
                                    <img src="{{ get_attachment_image_by_id($data->image)['img_url'] }}" alt="">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="fs-6 fw-semibold mb-2">{{$data->name}}</div>
                                    <div class="fs-8 text-light-emphasis">{{$data->designation}} </div>
                                </div>
                            </div>
                            <div class="testimonial-content fw-medium">
                               {{$data->description}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- testimonial area end -->
@endsection

@section('scripts')
        <script src="{{ asset('assets/common/vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
@endsection