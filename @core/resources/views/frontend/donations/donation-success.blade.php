@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Success For:')}} {{optional($donation_logs->cause)->title}}
@endsection
@section('content')
    <div class="donation-success-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area">
                        <h1 class="title">{{get_static_option('donation_success_page_title')}}</h1>
                        <p>{{get_static_option('donation_success_page_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title">{{__('Donation Details')}}</h2>
                    <ul class="billing-details">

                        <li><strong>{{__('Name')}}:</strong> {{$donation_logs->name}}</li>
                        <li><strong>{{__('Email')}}:</strong> {{$donation_logs->email}}</li>
                        <li><strong>{{__('Amount')}}:</strong> {{amount_with_currency_symbol($donation_logs->amount)}}</li>

                        @if(!empty($donation_logs->gift))
                            <li><strong>{{__('Gift Title')}}:</strong>{{optional($donation_logs->gift)->title}}</li>
                            @php
                                $gifts = optional($donation_logs->gift)->gifts ;
                                $colors = ['warning','info','primary','success'];
                            @endphp
                            <li> <strong>{{__('Donation Gifts')}}:</strong>
                                @foreach (json_decode($gifts) ?? [] as $key=> $item)
                                    <span class="badge badge-{{$colors[$key % count($colors)]}}">{{$item ?? ''}}</span>
                                @endforeach
                            </li>
                        @endif


                    @php
                        $all_custom_fields = json_decode($donation_logs->custom_fields) ?? [];
                    @endphp
                    @if(!empty($all_custom_fields))
                        @foreach($all_custom_fields ?? [] as $key=> $field)
                            @php 
                            if(is_object($field)){
                                continue;
                            }
                            @endphp
                             <li><strong class="text-dark ">{{ ucfirst($key) . ' : ' }}</strong>{{$field}}</li>
                        @endforeach 
                    @endif
                    


                    @if(!empty($donation_logs->reward_point))
                              <li><strong>{{__('Reward Points')}}:</strong> {{$donation_logs->reward_point}}</li>
                        @endif
                        <li><strong>{{__('Payment Method')}}:</strong>  {{str_replace('_',' ',$donation_logs->payment_gateway)}}</li>
                        <li><strong>{{__('Payment Status')}}:</strong> {{$donation_logs->status}}</li>
                        <li><strong>{{__('Transaction id')}}:</strong> {{$donation_logs->transaction_id}}</li>
                    </ul>
                    <div class="donation-wrap donation-success-page">
                        <div class="contribute-single-item">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($donation->image,'','grid') !!}
                                <div class="thumb-content">
                                </div>
                            </div>
                            <div class="content">
                                <a href="{{route('frontend.donations.single',$donation->slug)}}"><h4 class="title">{{$donation->title}}</h4></a>
                                <p>{{strip_tags(Str::words(strip_tags($donation->donation_content),20))}}</p>
                                <div class="btn-wrapper">
                                    <a href="{{route('frontend.donations.single',$donation->slug)}}" class="boxed-btn">{{get_static_option('donation_button_text')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-wrapper margin-top-40">
                        @if(auth()->guard('web')->check())
                            <div class="btn-wrapper">
                              <a href="{{route('user.home')}}" class="boxed-btn reverse-color">{{__('Go To Dashboard')}}</a>
                            </div>
                        @else
                            <div class="btn-wrapper">
                            <a href="{{url('/')}}" class="boxed-btn reverse-color">{{__('Back To Home')}}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
