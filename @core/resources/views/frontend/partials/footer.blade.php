@php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
@endphp

@if($home_page_variant != '00')
    <footer class="footer-area home-variant-{{$home_page_variant}}">
            <div class="footer-top bg-black bg-image padding-top-90 padding-bottom-65 @if($home_page_variant == '02') style-01 bg-image @endif"
                @if($home_page_variant == '02') style="background-image: url({{asset('/frontend/img/shape/footer-bg.png')}})" @endif>

                <div class="container">
                    <div class="row">
                        {!! render_frontend_sidebar('footer',['column' => true]) !!}
                    </div>
                </div>
            </div>
        <div class="copyright-area  @if($home_page_variant == '02') style-01 bg-image @endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-item">
                            <div class="copyright-area-inner">
                                {!! purify_html_raw(get_footer_copyright_text()) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="back-to-top">
        <span class="back-top">
            <i class="fas fa-angle-up"></i>
        </span>
    </div>
@else
    <footer class="bg-primary  pt-7 pb-0">
        <div class="container pb-8 px-3">
            <div class="row">
                {!! render_frontend_sidebar('footer',['column' => true]) !!}              
            </div>
        </div>
        <div class="copy-right bg-secondary text-white text-center py-3 fw-bold">
            © 2025 جمعية يقين الخيرية – إندونيسيا. جميع الحقوق محفوظة.
        </div>
    </footer>

@endif

<!-- load all script -->
<script src="{{ asset('assets/frontend/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-migrate-3.1.0.min.js') }}"></script>
<script src="{{asset('assets/frontend/vendor/bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/dynamic-script.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.waypoints.js')}}"></script>
<script src="{{asset('assets/frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/frontend/vendor/fontawesome-free-6.6.0-web/js/all.min.js')}}"></script>

<script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/jQuery.rProgressbar.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/active.rProgressbar.js')}}"></script>
<script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
<script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
<script src="{{asset('assets/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/common/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/slick.min.js')}}"></script>
<script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
@if($home_page_variant != '00')
    <script src="{{asset('assets/frontend/js/main.js')}}"></script>
    <script src="{{asset('assets/frontend/js/main2.js')}}"></script>
@else
    <script src="{{asset('assets/frontend/js/main-00.js')}}"></script>
@endif


@include('frontend.partials.google-captcha')
@include('frontend.partials.gdpr-cookie')
@include('frontend.partials.inline-script')
@include('frontend.partials.twakto')

<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'left','color':'green'});
    });
</script>


<x-sweet-alert-msg/>
@yield('scripts')


</body>
</html>
