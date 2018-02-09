@extends('../layouts.purchaser-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">List of Received Offers</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <!-- Start Search -->
                            {{ Form::open(array('url' => 'purchaser/companies/offersin/filter', 'method' => 'POST',
                                                'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            {{ Form::text('filter_key', Input::old('filter_key'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your search key')) }}
                                            <span class="input-group-btn">
                                                {{ Form::submit('Go!', array('class' => 'btn btn-primary')) }}
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        {{ Form::close() }}
                        <!-- End Search -->

                            <div class="m-section__content">
                                <table class="table m-table m-table--head-no-border">
                                    <thead>
                                    <tr>
                                        <th>RFQ ID</th>
                                        <th>RFQ Title</th>
                                        <th>RFQ Deadline</th>
                                        <th>RFQ Status</th>
                                        <th>Offer ID</th>
                                        <th>Supplier ID</th>
                                        <th>Offering Date</th>
                                        <th>Offer Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($offers as $key => $offer)
                                        @if( $filter_key != ''
                                                       &&
                                                   (strpos( strtolower($offer->rfq->internal_id), strtolower($filter_key) ) !== false ||
                                                    strpos( strtolower($offer->rfq->title), strtolower($filter_key) ) !== false ||
                                                    strpos( strtolower($offer->supplier->title), strtolower($filter_key) ) !== false ||
                                                    strpos( strtolower($offer->rfq->status), strtolower($filter_key) ) !== false ||
                                                    strpos( strtolower($offer->status), strtolower($filter_key) ) !== false
                                                    )
                                                )
                                            <tr>
                                                <td scope="row">{{ $offer->rfq->internal_id }}</td>
                                                <td>{{ $offer->rfq->title }}</td>
                                                <td>{{ (new DateTime($offer->rfq->deadline))->format('d/m/Y') }} {{ $offer->rfq->deadline_time }}</td>
                                                <td>{{ $offer->rfq->status }}</td>
                                                <td scope="row">{{ $offer->id }}</td>
                                                <td>
                                                    @if($offer->status != 'DEAL')
                                                        {{ $offer->supplier->id }}
                                                    @else
                                                        {{ $offer->supplier->title }}
                                                    @endif
                                                </td>
                                                <td>{{ (new DateTime($offer->updated_at))->format('d/m/Y h:i a') }}</td>
                                                <td>{{ $offer->status }}</td>
                                                <td><a class="btn m-btn--square  btn-outline-info"
                                                       href="#" data-toggle="modal"
                                                       data-target="#message_model{{ $offer->id }}">Message
                                                        @if(($count = $offer->countNotReadMsgs()) > 0)
                                                            <span class="m-badge m-badge--danger">{{ $count }}</span>
                                                        @endif
                                                    </a>
                                                    @include('offers.purchaser.send-message')
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('purchaser/channels/' . $offer->rfq->channel->id.'/rfqs/'.$offer->rfq->id) }}">Open RFQ</a>

                                                </td>
                                            </tr>
                                        @elseif( $filter_key == '')
                                            <tr>
                                                <td scope="row">{{ $offer->rfq->internal_id }}</td>
                                                <td>{{ $offer->rfq->title }}</td>
                                                <td>{{ (new DateTime($offer->rfq->deadline))->format('d/m/Y') }} {{ $offer->rfq->deadline_time }}</td>
                                                <td>{{ $offer->rfq->status }}</td>
                                                <td scope="row">{{ $offer->id }}</td>
                                                <td>
                                                    @if($offer->status != 'DEAL')
                                                        {{ $offer->supplier->id }}
                                                    @else
                                                        {{ $offer->supplier->title }}
                                                    @endif
                                                </td>
                                                <td>{{ (new DateTime($offer->updated_at))->format('d/m/Y h:i a') }}</td>
                                                <td>{{ $offer->status }}</td>
                                                <td><a class="btn m-btn--square  btn-outline-info"
                                                       href="#" data-toggle="modal"
                                                       data-target="#message_model{{ $offer->id }}">Message
                                                        @if(($count = $offer->countNotReadMsgs()) > 0)
                                                            <span class="m-badge m-badge--danger">{{ $count }}</span>
                                                        @endif
                                                    </a>
                                                    @include('offers.purchaser.send-message')
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('purchaser/channels/' . $offer->rfq->channel->id.'/rfqs/'.$offer->rfq->id) }}">Open RFQ</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection