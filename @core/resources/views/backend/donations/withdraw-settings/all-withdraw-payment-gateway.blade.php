@extends('backend.admin-master')
@section('site-title')
    {{__('Events Category')}}
@endsection
@section('style')
    <x-datatable.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.error/>
                <x-msg.success/>
            </div>
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Withdraw Payment Gateways')}}</h4>
                        @can('event-category-delete')
                            <div class="bulk-delete-wrapper">
                                <div class="select-box-wrap">
                                    <select name="bulk_option" id="bulk_option">
                                        <option value="">{{{__('Bulk Action')}}}</option>
                                        <option value="delete">{{{__('Delete')}}}</option>
                                    </select>
                                    <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                </div>
                            </div>
                        @endcan

                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                @foreach ($gateways as $gateway)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($gateway->name) }}</td>
                                        <td>{{ implode(' , ', unserialize($gateway->field)) }}</td>
                                        <td>
                                            <x-gateway-status :status="$gateway->status" />
                                        </td>
                                        <td>
                                            <a class="mb-3 mx-1 btn btn-warning edit_gateway_modal update-gateway"
                                               data-bs-toggle="modal"
                                               data-bs-target="#edit-gateway-modal"
                                               data-name="{{ ucfirst($gateway->name) }}"
                                               data-id="{{ $gateway->id }}"
                                               data-blog-filed="{{ json_encode(unserialize($gateway->field)) }}">
                                                {{ __('Edit Gateway') }}
                                            </a>
                                            <x-delete-popover :url="route('admin.withdraw.gateway.delete',$gateway->id)"/>
                                            <x-status-change :url="route('admin.withdraw.gateway.status', $gateway->id)"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Withdraw Payment Gateway Create')}}</h4>
                        <form action="{{route('admin.withdraw.gateway.create')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">{{__('Payment Gateway Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Write gateway name')}}">
                            </div>
                            <h4 class="header-title">{{__('Gateway required filed.')}}</h4>

                            <div class="dashboard__card__body mb-5">
                                <div class="form-group row">
                                    <div class="w-90 d-flex align-items-center mx-4">
                                        <input class="form-control" name="field[]" placeholder="{{ __('Write filed name...') }}">
                                    </div>
                                    <div class="col-md-1 align-items-center justify-content-center gap-2 d-flex mx-2">
                                        <button type="button" class="btn btn-info btn-sm gateway-filed-add mx-2">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                           <div class="mt-5">
                               <button id="submit" type="submit" class="btn btn-primary mt-5 pr-4 pl-4">{{__('Create Gateway')}}</button>
                           </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit-gateway-modal" tabindex="-1"
         aria-labelledby="edit-gateway-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="" method="POST" action="{{ route('admin.withdraw.gateway.update') }}">
                    @csrf
                    <input type="hidden" value="" name="id" />
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __("Update wallet withdraw gateway") }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="single-input mb-3">
                            <label class="label-title"> {{ __('Payment Gateway Name') }}</label>
                            <input class="form-control" name="name" placeholder="{{ __("Write gateway name...") }}">
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="title">{{ __('Gateway required filed.') }}</h4>
                            </div>
                            <div class="card-body gateway-filed-body">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __("Close") }}</button>
                        <div class="btn_wrapper">
                            <button type="submit" id="update" class="btn btn-warning">{{ __('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // change status
        $(document).on('click','.swal_status_change',function(e){
            e.preventDefault();
            Swal.fire({
                title: '{{__("Are you sure to change status complete? Once you done you can not revert this !!")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, change it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on("click", ".update-gateway", function() {
            let fileds = JSON.parse($(this).attr("data-blog-filed"));
            $("#edit-gateway-modal input[name='name']").val($(this).attr("data-name"))
            $("#edit-gateway-modal input[name='id']").val($(this).attr("data-id"))

            if (fileds.length > 0) {
                let list_filed = "";

                fileds.forEach(function(value, index, array) {
                    list_filed += `
                        <div class="form-group row mb-5">
                            <div class="w-90 d-flex align-items-center mx-5">
                                <input class="form-control" value="${value}" name="field[]" placeholder="Write filed name...">
                            </div>
                            <div class="col-md-1 align-items-center justify-content-center gap-3 d-flex">
                                <button type="button" class="btn btn-info btn-sm gateway-filed-add mx-2">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    `;
                })

                $(".gateway-filed-body").html(list_filed);
            } else {
                $(".gateway-filed-body").html(`<div class="form-group row mb-5">
                    <div class="w-90 d-flex align-items-center mx-5">
                        <input class="form-control" name="field[]" placeholder="Write filed name...">
                    </div>
                    <div class="col-md-1 align-items-center justify-content-center gap-3 d-flex">
                        <button type="button" class="btn btn-info btn-sm gateway-filed-add mx-2">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm gateway-filed-remove">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>`);
            }
        });

        $(document).on("click", ".gateway-filed-add", function() {
            let elem = $(this).parent().parent();
            elem.parent().append(elem.clone());
        });

        $(document).on("click", ".gateway-filed-remove", function() {
            if ($(".gateway-filed-remove").length == 1) {
                return null;
            }
            let elem = $(this).parent().parent().fadeOut(250, () => {
                $(this).parent().parent().remove();
            });
        });
    </script>
    <x-datatable.js/>
@endsection