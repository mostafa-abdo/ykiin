@extends('backend.admin-master')
@section('style')
    <x-media.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('site-title')
    {{__('Our Vision Section')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Our Vision Section Settings')}}</h4>

                        <form action="{{route('admin.about.our.vision')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                                $all_icon_fields =  get_static_option('about_page_our_vision_list_section_icon');
                                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : ['fas fa-check'];
                            @endphp
                            @foreach($all_icon_fields as $index => $icon_field)
                                <div class="iconbox-repeater-wrapper">
                                    <div class="all-field-wrap">
                                        @php
                                            $all_title_fields = get_static_option('about_page_our_vision_list_section_title');
                                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : ['If you want to change the world'];
                                            $all_description_fields = get_static_option('about_page_our_vision_list_section_description');
                                            $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : ['If you want to change the world'];
                                        @endphp


                                        <div class="form-group">
                                            <label for="about_page_our_vision_list_section_title">{{__('Title')}}</label>
                                            <input type="text" name="about_page_our_vision_list_section_title[]" class="form-control" value="{{$all_title_fields[$index] ?? ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="about_page_our_vision_list_section_description">{{__('Description')}}</label>
                                            <textarea name="about_page_our_vision_list_section_description[]" class="form-control" rows="5">{{$all_description_fields[$index] ?? ''}}</textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="about_page_our_vision_list_section_icon" class="d-block">{{__('Icon')}}</label>
                                            <div class="btn-group ">
                                                <button type="button" class="btn btn-primary iconpicker-component">
                                                    <i class="{{$icon_field}}"></i>
                                                </button>
                                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                        data-selected="{{$icon_field}}" data-bs-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu"></div>
                                            </div>
                                            <input type="hidden" class="form-control" value="{{$icon_field}}" name="about_page_our_vision_list_section_icon[]">
                                        </div>

                                        <div class="action-wrap">
                                            <span class="add"><i class="ti-plus"></i></span>
                                            <span class="remove"><i class="ti-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <x-repeater/>
    <x-icon-picker-activate-js/>
    <script>
        (function($){
            "use strict";
            $(document).ready(function () {
                <x-btn.update/>
            });
        })(jQuery)
    </script>
@endsection
