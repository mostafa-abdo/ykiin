@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('User Dashboard')}}
@endsection
@section('content')
    <section class="login-page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">



                    <div class="user-dashboard-wrapper">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            <li class="mobile_nav">
                                <i class="fas fa-cogs"></i>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i class="fa fa-user mr-1"></i>{{ optional(Auth::guard('web')->user())->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home')) active @endif" href="{{route('user.home')}}">{{__('Dashboard')}}</a>
                            </li>

                            @if(!empty(get_static_option('events_module_status')))
                                <li class="nav-item">
                                    <a class="nav-link @if(request()->routeIs('user.home.event.booking')) active @endif" href="{{route('user.home.event.booking')}}">{{get_static_option('events_page_name')}} {{__('Booking')}}</a>
                                </li>
                            @endif
                            @if(!empty(get_static_option('donations_module_status')))
                                <li class="nav-item">
                                    <a class="nav-link @if(request()->routeIs('user.home.donations')) active @endif" href="{{route('user.home.donations')}}" >{{__('All ')}} {{get_static_option('donation_page_name')}}</a>
                                </li>
                            @endif

                          @if(Auth::guard('web')->user()->campaign_permission == 'on')
                            <li class="nav-item">
                                <a class="nav-link @if( request()->routeIs('user.campaign.all') || request()->routeIs('user.campaign.new') ||request()->routeIs('user.campaign.edit') || request()->routeIs('user.all.update.cause.page') || request()->routeIs('user.add.new.update.cause.page') ) active @endif " href="{{route('user.campaign.all')}}">{{__('Campaign List')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @if( request()->routeIs('user.campaign.gift.all') || request()->routeIs('user.campaign.gift.new') ||request()->routeIs('user.campaign.gift.edit')) active @endif " href="{{route('user.campaign.gift.all')}}">{{__('Campaign Gifts')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  @if( request()->routeIs('user.campaign.log.withdraw')) active @endif"  href="{{ route('user.campaign.log.withdraw') }}">{{__('Withdraw Logs')}}</a>
                            </li>
                          @endif

                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.reward.point')) active @endif" href="{{route('user.home.reward.point')}}" >{{__('Reward Points')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  @if( request()->routeIs('user.home.reward.redeem.log')) active @endif"  href="{{ route('user.home.reward.redeem.log') }}">{{__('Reward Redeem Logs')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  @if( request()->routeIs('following.user.campaigns')) active @endif"
                                   @php
                                       $user = auth('web')->user();
                                       $all_follower_donations = \App\UserFollow::where(['follow_status' => 'follow','user_id'=> $user->id])->get();
                                       $data_count = count($all_follower_donations);
                                       $class_condition = request()->routeIs('following.user.campaigns') ? 'text-white' : 'text-warning';
                                   @endphp
                                   href="{{ route('following.user.campaigns') }}">{{__('Following User Campaigns')}} <span class="{{$class_condition}}">{{'('.$data_count.')'}}</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.support.tickets')) active @endif" href="{{route('user.home.support.tickets')}}" >{{__('All')}} {{get_static_option('support_ticket_page_name')}}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.edit.profile')) active @endif " href="{{route('user.home.edit.profile')}}">{{__('Edit Profile')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.verify.update')) active @endif " href="{{route('user.home.verify.update')}}">{{__('User Verify')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.change.password')) active @endif " href="{{route('user.home.change.password')}}">{{__('Change Password')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.tax.information')) active @endif " href="{{route('user.home.tax.information')}}">{{__('Tax Information')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(request()->routeIs('user.home.tax.request.log')) active @endif " href="{{route('user.home.tax.request.log')}}">{{__('Tax Request Logs')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('user.logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                    <button id="logout_submit_btn" type="submit"></button>
                                </form>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @php
                                $auth_user_user_verify_status = \Illuminate\Support\Facades\Auth::guard('web')->user()->user_verify_status;
                            @endphp
                            <div class="tab-pane active" role="tabpanel">
                                @if($auth_user_user_verify_status == 0)
                                    <div class="alert alert-danger text-center"><strong>{{__('Not Verified')}}</strong></div>
                                @elseif($auth_user_user_verify_status == 1)
                                    <div class="alert alert-warning text-center"><strong>{{__('Verification pending for admin approval')}}</strong></div>
                                @else
                                @endif
                                <div class="message-show margin-top-10">
                                    <x-msg.success/>
                                    <x-msg.error/>
                                </div>
                                @yield('section')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
           $('select[name="country"] option[value="{{optional(auth()->guard('web')->user())->country}}"]').attr('selected',true);
           $(document).on('click','.mobile_nav',function(e){
              e.preventDefault(); 
               $(this).parent().toggleClass('show');
           });
        });
    </script>
@endsection
