<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="flaticon-statistics"></i>
                    </span>
                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                    <span>Offers</span>
                </h2>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        @if($rfq->isLeadExpired())
            <div><h3 style="text-align: center; color: #f05b4f;">
                    Your RFQ is <strong>{{ $rfq->status }}</strong>.</h3>
            </div>
        @elseif($rfq->is_extended == 'YES' && $rfq->is2ndLast7Days() && $rfq->status == 'NEGOTIATION')
            <div><h3 style="text-align: center; color: #f05b4f;">
                    Your extended negotiation is expiring.<br/>
                    please, decide about your RFQ else it would be terminated automatically
                </h3></div>
        @elseif($rfq->is_extended == 'NO' && $rfq->is1stLast7Days() && $rfq->status == 'NEGOTIATION')
            <div><h3 style="text-align: center; color: #f05b4f;">
                    Your negotiation is expiring.<br/>
                    please, decide to terminate or extend your RFQ. </h3></div>
    @endif

    <!--begin: Datatable -->
        <div class="m-section">
            <div class="m-section__content">
                <table class="table m-table m-table--head-no-border">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Offer Date</th>
                        <th>SUM</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($rfq->get3Offers as $key => $value)
                        <tr>
                            <td>{{ $value->supplier->id }}</td>
                            <td>
                                @if($value->status != 'DEAL')
                                    {{ $value->supplier->id }}
                                @else
                                    {{ $value->supplier->title }}
                                @endif
                            </td>
                            <td>{{ (new DateTime($value->updated_at))->format('d/m/Y h:i a') }} </td>
                            <td>{{ number_format($value->sum())}}</td>
                            <td>{{ $value->status }}</td>
                            <td>{{ $value->reason }}</td>
                            <td>
                                <a href=""
                                   class="btn m-btn--square  btn-outline-info"
                                   data-toggle="modal" data-target="#one_by_one_offer_model_{{$value->id}}">
                                    <i class="fa fa-envelope-open-o"></i>
                                    Inspect Offer
                                </a>
                                <a class="btn m-btn--square  btn-outline-info"
                                   href="#" data-toggle="modal"
                                   data-target="#message_model{{ $value->id }}"><i class="fa fa-comment"></i> Message

                                    @if(($count = $value->readMsgs()) > 0)
                                        <span class="m-badge m-badge--danger">{{ $count }}</span>
                                    @endif
                                </a>
                                @include('rfqs.purchaser.send-message')

                            </td>
                        </tr>
                    @endforeach

                    @if(count($rfq->RfqNotDraftedOffers) > 3 && $rfq->offer_extention === 'NO' && $rfq->status == 'EXPIRED' )
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                {{ Form::open(array('url' => 'purchaser/channels/' .  $rfq->channel->id . '/' . $rfq->id .'/seemore')) }}
                                {{ Form::hidden('_method', 'POST') }}
                                {{ Form::submit('View More', array('class' => 'btn m-btn--square  btn-outline-info',
                                                    'onclick' => 'return confirm(\'Are you sure you want to Request to see more offers?\n\n
                                                                                    This would be an extra service by Toogle, the cost will be charged on your account. Do you want to confirm it \')')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
                <h3> Total offers: {{ count($rfq->RfqNotDraftedOffers) }}</h3>
                <h3> View more offer: {{ $rfq->offer_extention  }}</h3>
            </div>
        </div>
        <!--end: Datatable -->
    </div>

</div>

<!--start::Modal-->
@foreach($rfq->get3Offers as $key => $offer)
    @include('rfqs.purchaser.show-1by1')
@endforeach
<!--end::Modal-->