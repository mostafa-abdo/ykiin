@extends('backend.admin-master')
@section('site-title')
    {{ __('Section Manage') }}
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
                        <h4 class="header-title">{{ __('Home Page Section Manage') }}</h4>
                        <form action="{{ route('admin.home.zero.section.manage') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            @php

                                $section_names = [
                                    'header_slider_area_00',
                                    'projects_area_00',
                                ];
                            @endphp
                            <div class="row">
                                @foreach ($section_names as $section_name)
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label
                                                for="home_page_{{ $section_name }}_section_status"><strong>{{ __(Str::ucfirst(str_replace('_', ' ', $section_name)) . ' Section Show/Hide') }}</strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="home_page_{{ $section_name }}_section_status"
                                                    @if (!empty(get_static_option('home_page_' . $section_name . '_section_status'))) checked @endif
                                                    id="home_page_{{ $section_name }}_section_status">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" id="update"
                                class="btn btn-primary mt-4 pr-4 pl-4">{{ __('Update Settings') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                <
                x - btn.update / >
            });
        })(jQuery);
    </script>
@endsection
