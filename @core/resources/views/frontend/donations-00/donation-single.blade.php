@extends('frontend.frontend-page-master')
@php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($donation->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 @endphp
@section('og-meta')

@endsection

@section('site-title')
    {{$donation->title}}
@endsection

@section('page-title')
    {{$donation->title}}
@endsection
@section('page-meta-data')
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$donation->title}}">
    <meta property="og:description" content="{{strip_tags(\Str::words($donation->cause_content,150))}}">
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta property="og:image" content="{{$post_img}}"/>
	<meta property="og:image:secure" content="{{$post_img}}">
    
    <meta property="og:url" content="{{route('frontend.donations.single',$donation->slug)}}">
    <meta property="twitter:card" content="summary_large_image">


    <meta property="title" content="{{$donation->title}}">
    <meta property="description" content="{{$donation->meta_tags}}">
    <meta property="tags" content="{{$donation->meta_description}}">
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/project-00.css') }}">
@endsection


@section('content')
    <section class="project-section mb-6">
        <div class="container">
            <div class=" d-flex flex-column justify-content-center flex-lg-row-reverse gap-5 text-center text-lg-start  px-3 py-5">
                <div class="project-info-container d-flex flex-column mb-5">
                    <div class="d-flex flex-column border-bottom pb-4 mb-3">
                        <div class="fs-3 fw-bold mb-3">{{ $donation->title }}</div>
                        <div class="text-gray-dark fw-medium">{{ $donation->excerpt }}</div>
                    </div>
                    <div class="infos mb-4">
                        <div class="info">
                            <span class="text-muted fw-medium">الموقع : </span>
                            <span class="fw-semibold">تانقرانق، إندونيسيا</span>
                        </div>
                        <div class="info">
                            <span class="text-muted fw-medium">عدد المستفيدين : </span>
                            <span class="fw-semibold">250+ شخص</span>
                        </div>
                        <div class="info">
                            <span class="text-muted fw-medium">المساحة : </span>
                            <span class="fw-semibold">62 م² (مسجد + مرافق)</span>
                        </div>
                        <div class="info">
                            <span class="text-muted fw-medium">الحالة : </span>
                            <span class="fw-semibold">جاهز للتنفيذ فور اكتمال التبرع</span>
                        </div>
                    </div>

                    <div class="border-bottom pb-4 mb-4">
                        <a href="#" class="text-black fw-medium">اضغط هنا لعرض مسودة عقد التنفيذ</a>
                    </div>
                    <div class="progress rounded-4 mb-3">
                        <div class="progress-bar rounded-4" role="progressbar" data-progress="{{ $donation->percentage }}" aria-valuenow="{{ $donation->percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $donation->percentage }}%</div>
                    </div>
                    <div class="donateamount">
                        <div class="title">
                            مبلغ التبرع
                        </div>
                        <div class="amount-input">
                            <input type="text" name="amount" value="0">
                        </div>
                        <div class="currency">
                            $
                        </div>      
                    </div>
                   <div class="donateamounts d-flex gap-2 justify-content-between flex-wrap mb-3 pb-3">
                        <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-4 rounded-1 amount" data-amount="50">50$</button>
                        <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-4 rounded-1 amount" data-amount="100">100$</button>
                        <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-4 rounded-1 amount" data-amount="150">150$</button>
                        <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-4 rounded-1 amount" data-amount="250">250$</button>
                        <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-4 rounded-1 amount" data-amount="500">500$</button>
                    </div>

                    <button class="btn bg-primary text-white fs-6 fw-normal px-3 py-2  rounded-1">
                        <i class="fa-solid fa-cart-shopping fw-8 me-1"></i>
                        تبرع الان
                    </button>
                </div>
                <div class="project-images-container mb-5">
                    <div class="project-image-view mb-4" id="project-image-view">
                        <img src="{{ $donation->img_link }}">
                    </div>
                    <div class="project-images mb-5">
                        @php
                            $images = explode("|",$donation->image_gallery);
                           
                        @endphp
                        @foreach ($images as $image) 
                            <div class="project-image">
                                <img src="{{ get_attachment_image_by_id($image)['img_url'] }}">

                            </div>
                            
                        @endforeach
                    </div>
                    <div class="d-flex align-items-center gap-3 justify-content-center justify-content-lg-start">
                        <div class="d-flex align-items-center gap-2 text-gray-dark fw-medium fs-5">
                            <span class="bg-gray-dark rounded-circle-perfect p-2">
                                <svg width="25" height="20" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.6869 14.6456C10.1145 14.6456 9.62789 14.4327 9.22717 14.0069C8.82646 13.5811 8.6261 13.0641 8.6261 12.4558C8.6261 12.3828 8.64327 12.2125 8.67762 11.9448L3.85186 8.95211C3.66868 9.13459 3.45687 9.27766 3.21644 9.38131C2.97601 9.48496 2.71841 9.53654 2.44363 9.53606C1.87118 9.53606 1.3846 9.32316 0.983885 8.89737C0.58317 8.47157 0.382812 7.95454 0.382812 7.34626C0.382812 6.73798 0.58317 6.22095 0.983885 5.79515C1.3846 5.36936 1.87118 5.15646 2.44363 5.15646C2.71841 5.15646 2.97601 5.20829 3.21644 5.31194C3.45687 5.41559 3.66868 5.55841 3.85186 5.74041L8.67762 2.74769C8.65472 2.66253 8.64052 2.58053 8.63503 2.5017C8.62953 2.42287 8.62656 2.33454 8.6261 2.23673C8.6261 1.62846 8.82646 1.11142 9.22717 0.685627C9.62789 0.259833 10.1145 0.046936 10.6869 0.046936C11.2594 0.046936 11.746 0.259833 12.1467 0.685627C12.5474 1.11142 12.7477 1.62846 12.7477 2.23673C12.7477 2.84501 12.5474 3.36205 12.1467 3.78784C11.746 4.21363 11.2594 4.42653 10.6869 4.42653C10.4121 4.42653 10.1545 4.37471 9.91411 4.27105C9.67368 4.1674 9.46188 4.02458 9.27869 3.84258L4.45294 6.83531C4.47583 6.92047 4.49026 7.0027 4.49621 7.08202C4.50217 7.16134 4.50491 7.24942 4.50446 7.34626C4.504 7.4431 4.50125 7.53142 4.49621 7.61123C4.49117 7.69103 4.47675 7.77303 4.45294 7.85721L9.27869 10.8499C9.46188 10.6675 9.67368 10.5246 9.91411 10.4215C10.1545 10.3183 10.4121 10.2665 10.6869 10.266C11.2594 10.266 11.746 10.4789 12.1467 10.9047C12.5474 11.3305 12.7477 11.8475 12.7477 12.4558C12.7477 13.0641 12.5474 13.5811 12.1467 14.0069C11.746 14.4327 11.2594 14.6456 10.6869 14.6456Z" fill="white"/>
                                </svg>
                            </span>
                            مشاركة التبرع : 
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="" class="text-primary fs-2">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="" class="text-white rounded-circle-perfect-small p-1 fs-6 bg-primary text-center">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="" class="text-white rounded-circle-perfect-small p-1 fs-6 bg-primary text-center">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>

                        </div>
                    </div>  
                </div>
                
            </div>
           
        </div>
    </section>

    <section class="border-top py-6 px-7 text-center text-md-start d-flex flex-column gap-5">
        @php
            $faq_items = !empty($donation->faq) ? unserialize($donation->faq,['class' => false]) : ['title' => []];
        @endphp
        @foreach ($faq_items['title'] as $faq)
            @if (!empty($faq))
                <div>
                    <div class="fs-2 fw-bold mb-4">{{ $faq }}</div>
                    <div class="text-gray-dark fs-4 fw-medium">
                       {{ $faq_items['description'][array_search($faq, $faq_items['title'])] }}
                    </div>
                </div>
            @endif
        @endforeach
    </section>

@endsection

@section('scripts')
    <script src="{{asset('assets/frontend/js/project-00.js')}}"></script>
@endsection
