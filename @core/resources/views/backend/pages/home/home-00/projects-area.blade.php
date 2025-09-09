@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/vendor/select2-4.1.0-rc.0/css/select2.min.css') }}">
    <x-media.css />
@endsection

@section('site-title')
    {{ __('Projects Area') }}
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
                        <h4 class="header-title">{{ __('Projects Area Settings') }}</h4>
                        <form action="{{ route('admin.home.zero.projects.area') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                @php
                                    $home_page_00_projects_area_title = get_static_option('home_page_00_projects_area_title');
                                    $home_page_00_projects_area_title = !empty($home_page_00_projects_area_title) ? unserialize($home_page_00_projects_area_title) : '';
                                @endphp
                                <label for="home_page_00_projects_area_title">{{ __('Projects Area Title') }}</label>
                                <input type="text" class="form-control" id="home_page_00_projects_area_title"
                                    name="home_page_00_projects_area_title"
                                    value="{{ $home_page_00_projects_area_title }}">
                            </div>

                            <div class="form-group">
                                @php
                                    $selected_categories = get_static_option('home_page_00_projects_area_categories');
                                    $selected_categories = !empty($selected_categories)
                                        ? unserialize($selected_categories)
                                        : [];
                                @endphp
                                <label for="home_page_00_projects_area_categories">{{ __('Select Categories') }}</label>
                                <select name="home_page_00_projects_area_categories[]" class="form-control select2"
                                    multiple>
                                    @foreach ($all_categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, $selected_categories) ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button id="update" type="submit"
                                class="btn btn-primary mt-4 pr-4 pl-4">{{ __('Update Settings') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/common/vendor/select2-4.1.0-rc.0/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            <x-btn.update/>

            $('.select2').select2();

        });
    </script>
@endsection
