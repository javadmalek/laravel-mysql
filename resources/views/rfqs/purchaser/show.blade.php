@extends('../layouts.purchaser-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-9">
                @include('rfqs.purchaser.show-offers')
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Portlet-->
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-diagram"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text m--font-brand">{{ $rfq->title }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <strong>{{ $rfq->internal_id }}</strong>
                                <div>Number of MOLD: {{ $rfq->number_mold }}</div>
                                <p>{{ $rfq->description }}</p>
                                Channel: <strong>{{ $rfq->channel->title }}</strong><br>
                                Type: <strong>{{ $rfq->type->title }}</strong>, Dimension: <strong>{{ $rfq->dimension->title }}</strong>,
                                Type of Material:<strong> {{ $rfq->materials }}</strong><br>
                                <p>{{ $rfq->channel->description }}</p>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                {{--begin:: Statistics Widget --}}
                <div class="m-portlet m-portlet--bordered-semi ">
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__content">
                                <div class="m-widget25" style="padding-top: 16px">
                                    <span style="font-size: 18px; text-align: center">RFQ Status: {{ $rfq->status }}</span><hr/>
                                    <span style="font-size: 18px; text-align: center">Offering Deadline: {{ (new DateTime($rfq->deadline))->format('d/m/Y') }} {{ $rfq->deadline_time }}</span><hr/>
                                    <span style="font-size: 18px; text-align: center">Expiration Date:
                                        @if($rfq->is_extended === 'YES') Extended, @endif
                                        {{ (new DateTime( $rfq->getExtendedDate()))->format('d/m/Y') }} {{ $rfq->deadline_time }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end:: Statistics Widget --}}

                {{--begin:: Statistics Widget --}}
                <div class="m-portlet m-portlet--bordered-semi ">
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__content">
                                <div class="m-widget25">
                                    <span style="font-size: 25px; text-align: center">RFQ Actions</span>

                                    @if($rfq->status == 'DRAFTED')
                                        <div class="m-widget25--progress">
                                            <a href="{{$rfq->id . '/edit'}}"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon">
                                            <span>
                                                <i class="fa fa-edit"></i>
                                                <span>Edit RFQ</span>
                                            </span>
                                            </a>
                                        </div>
                                    @endif


                                    @if($rfq->is1stLast7Days() && $rfq->status == 'NEGOTIATION' && $rfq->is_extended=='NO')
                                        <div class="m-widget25--progress">
                                            <a href="#"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon"
                                               data-toggle="modal" data-target="#extend_model">
                                                <span>
                                                    <i class="fa fa-calendar"></i>
                                                    <span>Extend Deadline</span>
                                                </span>
                                            </a>
                                            @include("rfqs.purchaser.extend-deadline")
                                        </div>
                                    @endif

                                    @if($rfq->cancel_requested == 'NO' )
                                        <div class="m-widget25--progress">
                                            <a href="#"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon"
                                               data-toggle="modal" data-target="#rfq_terminate_model">
                                                <span>
                                                    <i class="fa fa-times"></i>
                                                    <span>Remove</span>
                                                </span>
                                            </a>
                                            @include('rfqs.purchaser.rfq-terminate')
                                        </div>
                                    @else
                                        <div class="m-widget25--progress" align="center">
                                            Cancel in-progress
                                        </div>
                                    @endif

                                    @if($rfq->status == 'PUBLISHED')
                                        <div class="m-widget25--progress">
                                            <a href="#"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon"
                                               data-toggle="modal" data-target="#invit_model">
                                            <span>
                                                <i class="fa fa-mail-forward"></i>
                                                <span>Invite a Supplier</span>
                                            </span>
                                            </a>
                                        </div>
                                    @endif

                                    <div class="m-widget25--progress">
                                        <a href="#"
                                           class="btn m-btn--square  btn-secondary  btn-block m-btn--icon"
                                           data-toggle="modal" data-target="#duplicat_model">
                                            <span>
                                                <i class="fa fa-files-o"></i>
                                                <span>Duplicate the RFQ</span>
                                            </span>
                                        </a>
                                        @include('rfqs.purchaser.duplicate')
                                    </div>

                                    <div class="m-widget25--progress">
                                        <a href="#" class="btn m-btn--square  btn-secondary  btn-block m-btn--icon">
                                            <span>
                                                <i class="fa fa-comment"></i>
                                                <span>Message to Administrator</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end:: Statistics Widget --}}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                @include('rfqs.purchaser.show-specification')
            </div>
            <div class="col-lg-3">
                @include('rfqs.purchaser.show-schedule')
            </div>
            <div class="col-lg-3">
                @include('rfqs.purchaser.show-price')
            </div>
            <div class="col-lg-3">
                @include('rfqs.purchaser.show-media')
            </div>
        </div>

    </div>
    @include('rfqs.purchaser.invite-supplier')
@endsection