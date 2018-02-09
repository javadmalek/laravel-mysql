@extends('../layouts.supplier-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-8">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-diagram"></i>
                                </span>
                                <h3 class="m-portlet__head-text m--font-brand">{{ $rfq->title }}
                                    <small>
                                        Deadline: {{ (new DateTime($rfq->deadline))->format('d/m/Y') }} {{ $rfq->deadline_time }}</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <h3 class="m-portlet__head-text m--font-focus">
                            Purchaser: {{ $rfq->channel->company->title }}</h3>

                        <div>Number of MOLD: {{ $rfq->number_mold }}</div>
                        <p>{{ $rfq->description }}</p>
                        Channel: <strong>{{ $rfq->channel->title }}</strong><br>
                        Type: <strong>{{ $rfq->type->title }}</strong>, Dimension:
                        <strong>{{ $rfq->dimension->title }}</strong>, Type of
                        Material:<strong> {{ $rfq->materials }}</strong><br>
                        <p>{{ $rfq->channel->description }}</p>

                    </div>
                </div>
                <!--end::Portlet-->

                @include('rfqs.supplier.show-specification')
                @include('rfqs.supplier.show-schedule')
                @include('rfqs.supplier.show-price')
                @include('rfqs.supplier.show-media')
            </div>

            <div class="col-lg-4">
                {{--begin:: Statistics Widget --}}
                <div class="m-portlet m-portlet--bordered-semi ">
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__content">
                                <div class="m-widget25">
                                    <span style="font-size: 20px; text-align: center">RFQ Status: {{ $rfq->status }}</span>
                                    <hr/>
                                    <span style="font-size: 20px; text-align: center">Offering Deadline: {{ (new DateTime($rfq->deadline))->format('d/m/Y') }} {{ $rfq->deadline_time }}</span>
                                    <hr/>
                                    <span style="font-size: 20px; text-align: center">Expiration Date:
                                        @if($rfq->is_extended === 'YES') Extended, @endif
                                        {{ (new DateTime( $rfq->getExtendedDate()))->format('d/m/Y') }} {{ $rfq->deadline_time }}</span>
                                    <hr/>
                                    @if($myoffer = $rfq->getOfferBySupplierId($_company_id))
                                        <span style="font-size: 20px; text-align: center">Offer Status: {{ $myoffer->status }} {{ (new DateTime($myoffer->updated_at))->format('d/m/Y h:i a') }}</span>
                                    @endif
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
                                    <span class="m-widget25__price m--font-brand"
                                          style="font-size: 30px; text-align: center">RFQ Actions</span>

                                    @if($myoffer && $myoffer->status == 'CANCELED' && !$rfq->isOfferingExpired())
                                        <div class="m-widget25--progress">
                                            <a href="{{ URL::to('supplier/channels/' .  $rfq->channel->id . '/rfqs/' . $rfq->id . '/offers/' . $myoffer->id .'/status/posting') }}"
                                               onclick="return confirm('Are you sure you want to Re-post your Offer?')"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon">
                                            <span>
                                                <i class="fa fa-send-o"></i>
                                                <span>Re-send my Offer</span>
                                            </span>
                                            </a>
                                        </div>
                                    @elseif($myoffer && $myoffer->status == 'POSTED' && !$rfq->isOfferingExpired())
                                        <div class="m-widget25--progress">
                                            <a href="{{ URL::to('supplier/channels/' .  $rfq->channel->id . '/rfqs/' . $rfq->id . '/offers/' . $myoffer->id .'/status/canceloffer') }}"
                                               onclick="return confirm('Are you sure you want to Cancel your Offer?')"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon">
                                            <span>
                                                <i class="fa fa-times"></i>
                                                <span>Cancel Offer</span>
                                            </span>
                                            </a>
                                        </div>

                                    @elseif($myoffer && $myoffer->status == 'DRAFTED')
                                        <div class="m-widget25--progress">
                                            <a href="{{ URL::to('supplier/channels/' .  $rfq->channel->id . '/rfqs/' . $rfq->id . '/offers/' . $myoffer->id .'/status/posting') }}"
                                               onclick="return confirm('Are you sure you want to Post your Offer?')"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon">
                                            <span>
                                                <i class="fa fa-send-o"></i>
                                                <span>Send my Offer</span>
                                            </span>
                                            </a>
                                        </div>
                                        <div class="m-widget25--progress">
                                            <a href="{{ URL::to('supplier/channels/' .  $rfq->channel->id . '/rfqs/' . $rfq->id . '/offers/' . $myoffer->id .'/status/canceloffer') }}"
                                               onclick="return confirm('Are you sure you want to Cancel your Offer?')"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon">
                                            <span>
                                                <i class="fa fa-times"></i>
                                                <span>Cancel Offer</span>
                                            </span>
                                            </a>
                                        </div>

                                    @elseif(!$myoffer && $rfq->status == 'PUBLISHED')
                                        <div class="m-widget25--progress">
                                            <a href="{{ $rfq->id }}/offers/create"
                                               class="btn m-btn--square  btn-secondary  btn-block m-btn--icon">
                                            <span>
                                                <i class="fa fa-send-o"></i>
                                                <span>Make an Offer</span>
                                            </span>
                                            </a>
                                        </div>
                                    @endif

                                    <div class="m-widget25--progress">
                                        <a href="" class="btn m-btn--square  btn-secondary  btn-block m-btn--icon"
                                           data-toggle="modal" data-target="#message_model">
                                            <span>
                                                <i class="fa fa-comment"></i>
                                                <span>Message to Purchaser</span>

                                                @if($myoffer && ($count = $myoffer->readMsgs()) > 0)
                                                    &nbsp;
                                                    <span class="m-badge m-badge--danger">{{ $count }}</span>
                                                @endif

                                            </span>
                                        </a>
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
    </div>
    @include('rfqs.supplier.send-message')
@endsection