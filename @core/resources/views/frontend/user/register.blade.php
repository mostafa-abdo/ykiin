@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Register')}}
@endsection
@section('content')
    <section class="login-page-wrapper py-5 my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-form-wrapper">
                        <h2 class="text-center">{{__('Register New Account')}}</h2><br>
                        @include('backend.partials.message')
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('user.register')}}" method="post" enctype="multipart/form-data" class="account-form">
                            @csrf
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                            </div>
                            <div class="form-group">
                                <select id="country" class="form-control" name="country_id">
                                    @foreach($all_countries as $country)
                                     <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="city" class="form-control" placeholder="{{__('City')}}">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{__('Confirm Password')}}">
                            </div>

                            @if(!empty(get_static_option('site_google_captcha_enable')))
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ get_static_option('recaptcha_2_site_key')}}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>
                            @endif

                            <div class="form-group form-check col-12">
                                <input type="checkbox" class="form-check-input" name="agree_terms" id="Check11">
                                <label class="form-check-label" for="Check11">
                                   {{__('By creating an account, you agree to the')}}
                                    <a href="{{ route('frontend.dynamic.page',[getSlugByPageId(get_static_option('register_page_terms_of_service_url')), get_static_option('register_page_terms_of_service_url')]) }}">{{__('terms of service and Conditions')}},</a> {{__('and')}}
                                    <a href="{{ route('frontend.dynamic.page',[getSlugByPageId(get_static_option('register_page_privacy_policy_url')), get_static_option('register_page_privacy_policy_url')]) }}">{{__('privacy policy')}}</a>
                                </label>
                            </div>

                            <div class="form-group btn-wrapper">
                                <button type="submit" class="submit-btn boxed-btn reverse-color">{{__('Register')}}</button>
                            </div>
                            <div class="row mb-4 rmber-area">
                                <div class="col-12 text-center">
                                    <a href="{{route('user.login')}}">{{__('Already Have account?')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    @if(!empty(get_static_option('site_google_captcha_v3_site_key')) && !empty(get_static_option('site_google_captcha_enable')))
        <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                    document.getElementById('gcaptcha_token').value = token;
                });
            });
        </script>
    @endif
@endsection
