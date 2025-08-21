@extends('frontend.frontend-page-master')

@section('og-meta')
    <meta name="og:title" content="{{purify_html($success_story->og_meta_title)}}">
    <meta name="og:description" content="{{purify_html($success_story->og_meta_description)}}">
    {!! render_og_meta_image_by_attachment_id($success_story->og_meta_image) !!}
    <meta name="og:description" content=" {{purify_html($success_story->description)}}">
@endsection

@section('site-title')
    {{$success_story->title}}
@endsection
@section('page-title')
    {{$success_story->title}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$success_story->meta_tags}}">
    <meta name="tags" content="{{$success_story->meta_description}}">
@endsection
@php
    $success_story_img = null;
    $meta_image = get_attachment_image_by_id($success_story->og_meta_image,"full",false);
    $success_story_img = !empty($meta_image) ? $meta_image['img_url'] : '';
@endphp
@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-event-details">
                        <div class="thumb">
                            {!! render_image_markup_by_attachment_id($success_story->image,'','large') !!}
                        </div>
                        <div class="content">
                            <div class="details-content-area mt-4">
                                {!! purify_html_raw($success_story->story_content )!!}
                            </div>

                            <div class="blog-details-footer">
                                <div class="right">
                                    <ul class="social-share">
                                        <li class="title">{{get_static_option('success_story_single_page_share_title')}}</li>
                                        {!! single_post_share(route('frontend.success.story.single',purify_html($success_story->slug)),purify_html($success_story->title),$success_story_img) !!}
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        {!! render_frontend_sidebar('success-story',['column' => false]) !!}
                    </div>
                </div>
        </div>
    </section>
@endsection
