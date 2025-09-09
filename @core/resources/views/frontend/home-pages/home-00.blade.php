@include('frontend.partials.navbar')
@if(get_static_option('home_page_header_slider_area_00_section_status'))
    <section class="hero">
        @php
            $all_title_fields = get_static_option('home_page_00_header_area_title');
            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [''];

            $all_button_1_title_fields = get_static_option('home_page_00_header_area_button_1_title');
            $all_button_1_title_fields = !empty($all_button_1_title_fields) ? unserialize($all_button_1_title_fields) : [''];

            $all_button_1_title_url_fields = get_static_option('home_page_00_header_area_button_1_url');
            $all_button_1_title_url_fields = !empty($all_button_1_title_url_fields) ? unserialize($all_button_1_title_url_fields) : [''];

            $all_button_2_title_fields = get_static_option('home_page_00_header_area_button_2_title');
            $all_button_2_title_fields = !empty($all_button_2_title_fields) ? unserialize($all_button_2_title_fields) : [''];

            $all_button_2_title_url_fields =  get_static_option('home_page_00_header_area_button_2_url');
            $all_button_2_title_url_fields = !empty($all_button_2_title_url_fields) ? unserialize($all_button_2_title_url_fields) : ['#'];
            $all_image_fields =  get_static_option('home_page_00_header_area_image');
            $all_image_fields = !empty($all_image_fields) ? unserialize($all_image_fields,['class' => false]) : [];
        @endphp
        <div class="hero-carousel owl-carousel">
            @foreach($all_title_fields as $key=> $title)
                <div class="item d-flex flex-column align-items-md-start align-items-center justify-content-md-center"
                    style="background-image: url('{{ get_attachment_image_by_id($all_image_fields[$loop->index])['img_url'] }}');">
                    <h1 class="mb-5 text-white text-center text-md-start">{{$title ?? ''}}</h1>
                    <div class="hero-btns d-flex flex-column flex-md-row gap-3">
                        @php
                            $button_1_title_url = !empty($all_button_1_title_fields[$loop->index]) ? $all_button_2_title_url_fields[$loop->index] : route('frontend.donation.in.separate.page',$donation_cause->id);
                            $button_2_url = !empty($all_button_2_title_url_fields[$loop->index]) ? $all_button_2_title_url_fields[$loop->index] : route('frontend.donations.single',$donation_cause->slug);
                        @endphp
                        <a class="btn btn-primary w-100 fs-6 fw-normal rounded-5" href="{{ $button_1_title_url }}">
                            {{ $all_button_1_title_fields[$loop->index] ?? '' }}
                        </a>
                        <a class="btn btn-border fs-6 w-100 fw-normal rounded-5" href="{{ $button_2_url }}">
                            {{ $all_button_2_title_fields[$loop->index] ?? '' }}
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
        @php 
            $text_loop = get_static_option('home_page_00_header_area_text_loop');
            $text_loop = !empty($text_loop) ? unserialize($text_loop) : null;
        @endphp
        @if(!empty($text_loop))
            <div class="scrolling-text">
                <div class="text-loop">
                    

                    {{ $text_loop }}
                    {{ $text_loop }}
                </div>
            </div>
        @endif
            
    </section>
@endif


@if(get_static_option('home_page_projects_area_00_section_status'))
    <section class="projects-section container-fluid container-xl py-7 px-2">
        @php
            $home_page_00_projects_area_title = get_static_option('home_page_00_projects_area_title');
            $home_page_00_projects_area_title = !empty($home_page_00_projects_area_title) ? unserialize($home_page_00_projects_area_title) : '';

        @endphp
        @if(!empty($home_page_00_projects_area_title))
            <div class="text-center fw-semibold fs-4">
                {{ $home_page_00_projects_area_title }}
            </div>
        @endif
        <div class="project-cats my-5" id="project-cats">
            <button class="btn cat-btn active" data-id="all">الكل</button>
           
        </div>
        <div class="projects-container row m-0 px-4 gap-5 gap-md-4 justify-content-center mb-5" id="projects-container">

        </div>
        <div class="d-flex justify-content-center">
            <a href="#" class="btn border-primary text-primary fs-6 fw-normal px-5 py-1 rounded-4">عرض الكل</a>
        </div>
    </section>
@endif



@section('scripts')
    <script>
        const categories = @json($selected_donation_category);

        const statuses = [
            { id: 1, title: "قيد التبرع" },
            { id: 2, title: "اكتمل التبرع" },
            { id: 3, title: "قيد التنفيذ" },
            { id: 4, title: "منجز" }
        ];

        const donationTypes = [
            { id: 1, title: "تبرع مشترك" },
            { id: 2, title: "تبرع فردي" },
            { id: 3, title: "تبرع دوري" },
            { id: 4, title: "تبرع عيني" },
            { id: 5, title: "تبرع تطوعي" }
        ];

        const allProjects = @json($all_recent_donation);

        
        $(document).ready(function(){

            categories.forEach(cat => {
                $('#project-cats').append(`<button class="btn cat-btn" data-id="${cat.id}">${cat.title}</button>`);
            });

                $(document).on('click', '#project-cats button', function(){
                    $(this).addClass('active').siblings().removeClass('active');
                    showProjects($(this).data('id'));
                });

            showProjects('all');

            
        });




        function showProjects(catId){

            let filteredProjects = [];

            if(catId === 'all'){
                filteredProjects = allProjects.slice(0, 8);

                
            }else {
            
                filteredProjects = allProjects.filter(p => p.categories_id === catId).slice(0, 8);
            }

            
            $('#projects-container').html('');

            if(filteredProjects.length > 0){
                filteredProjects.forEach((p, index) => {
                   
                    let progress = (p.collected / p.goal) * 100;
                    progress = p.percentage;
                    const category = categories.find(c => c.id === p.categories_id);
                    const status = statuses.find(s => s.id === p.status);
                    const donationType = donationTypes.find(dt => dt.id === p.donationType);
                    const PLink = "{{route('frontend.donations.single',['slug' => 'SLG'])}}".replace('SLG',p.slug);
                    console.log(p);
                  
                    

                    let item = $(`
                        <div class="project-item d-flex flex-column col-12 col-md-5 col-lg-4 p-0">
                            <div class="pcat">${category.title}</div>
                            <button class="pshare btn">
                                <i class="fa-solid fa-share-nodes"></i>
                            </button>
                            <div class="pimage">
                                <img src="${p.img_link}" alt="">
                                <div class="pgoal">الهدف: ${p.formatted_amount}</div>
                            </div>
                            <div class="pinfo-container flex-grow-1 py-3 px-4 d-flex flex-column overflow-hidden">
                                <a class="ptitle fs-5 fw-semibold text-decoration-none text-black" href="${PLink}">${p.title}</a>
                                <div class="psubtitle flex-grow-1 fs-7 mb-3">${p.excerpt}</div>
                                <div class="pinfo row m-0 fs-7  mb-3 pb-3 border-bottom">
                                    <div class="col-6 p-0">
                                        <span class="info-icon text-secondary">
                                            <i class="fa-solid fa-clock"></i>
                                        </span>
                                        <span class="info-title">الحالة:</span>
                                        <span class="info-value fw-bold">${status ? status.title : ''}</span>
                                    </div>
                                    <div class="col-6 p-0">
                                        <span class="info-icon text-secondary">
                                            <i class="fa-solid fa-hands-praying"></i>
                                        </span>
                                        <span class="info-title">نوع التبرع:</span>
                                        <span class="info-value fw-bold">${donationType ? donationType.title : ''}</span>
                                    </div>
                                </div>
                                <div class="pdonate d-flex flex-column">
                                    <div class="progress rounded-4 mb-3">
                                        <div class="progress-bar rounded-4" role="progressbar" aria-valuenow="${progress}" aria-valuemin="0" aria-valuemax="100">${progress}%</div>
                                    </div>
                                    <form action="${PLink}" class="d-flex flex-column flex-grow-1">
                                        <div class="donateinfo d-flex flex-column flex-grow-1">
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
                                            <div class="donateamounts d-flex gap-2 justify-content-between flex-wrap mb-3 border-bottom pb-3">
                                                <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-2 rounded-1 amount" data-amount="50">50$</button>
                                                <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-2 rounded-1 amount" data-amount="100">100$</button>
                                                <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-2 rounded-1 amount" data-amount="150">150$</button>
                                                <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-2 rounded-1 amount" data-amount="250">250$</button>
                                                <button type="button" class="amount-btn btn bg-gray bg-primary-hover text-white-hover py-1 fs-7 px-2 rounded-1 amount" data-amount="500">500$</button>
                                            </div>
                                            <div class="donatebtns d-flex gap-2 align-items-end">
                                                <button type="submit" class="btn bg-primary text-white fs-6 fw-normal px-3 py-1 flex-grow-1">
                                                    <i class="fa-solid fa-cart-shopping fw-7 me-1"></i>
                                                    تبرع الان
                                                </button>
                                                <a class="btn border-primary text-primary fs-6 fw-normal px-3 py-1 flex-grow-1">
                                                    <i class="fa-solid fa-plus fs-7 me-1"></i>
                                                    تفاصيل
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `);

                    $('#projects-container').append(item);

                    item.find('.amount-btn').on('click', function (e) {
                        e.preventDefault();

                        $(this).addClass('active').siblings().removeClass('active');
                        item.find('.amount-input input').val($(this).data('amount'));
                    });

                    item.find('.amount-input input').on('input', function () {
                        item.find('.amount-btn').removeClass('active');
                        $(this).val($(this).val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));

                        if ($(this).val() > 0) {
                            item.find('.amount-btn[data-amount="'+$(this).val()+'"]').addClass('active');
                        }
                    })

                    setTimeout(() => {
                        item.addClass('show');
                    },50);
                    setTimeout(() => {
                        item.find('.progress-bar').css('width', progress + '%');
                    }, 300);
                });
            
            } else {
                $('#projects-container').html('<p>لا توجد مشاريع في هذه الفئة حالياً.</p>');
            }
        }
    </script>
@endsection