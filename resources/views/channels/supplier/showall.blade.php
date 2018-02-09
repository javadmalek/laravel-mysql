@extends('../layouts.supplier-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">List of your RFQs</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <!-- Start Search -->
                            {{ Form::open(array('url' => 'supplier/channels/rfqs/filter', 'method' => 'POST',
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
                                        <th>ID</th>
                                        <th>Company</th>
                                        <th>title</th>
                                        <th>RFQ Status</th>
                                        <th>Channel</th>
                                        <th>Offering Deadline</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($channels as $key => $channel)
                                        @foreach($channel->rfqsNotDrafted as $key => $value)
                                            @if( $filter_key != '' &&
                                                (strpos( strtolower($value->internal_id), strtolower($filter_key) ) !== false ||
                                                 strpos( strtolower($value->title), strtolower($filter_key) ) !== false ||
                                                 strpos( strtolower($channel->title), strtolower($filter_key) ) !== false
                                                 )
                                             )
                                                <tr>
                                                    <td scope="row">{{ $value->internal_id }}</td>
                                                    <td>{{ $channel->company->title }}</td>
                                                    <td>{{ $value->title }}</td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $value->status }}</div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $channel->title }}</div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ (new DateTime($value->deadline))->format('d/m/Y') }}</div>
                                                    </td>
                                                    <td>
                                                        <a class="btn m-btn--square  btn-outline-info"
                                                           href="{{ URL::to('supplier/channels/' . $channel->id . '/' . $value->id) }}">View</a>

                                                        {{-- ToDo: If the offer status is deal, new company not allowded to make an offer --}}
                                                        @if($myoffer = $value->getOfferBySupplierId($_company_id))
                                                            @if($myoffer->status == "DRAFTED"  || !$value->isOfferingExpired())
                                                                <a class="btn m-btn--square  btn-outline-info"
                                                                   href="{{ URL::to('supplier/channels/' . $channel->id . '/rfqs/' . $value->id . '/offers/' . $myoffer->id .'/status/canceloffer') }}">Cancel
                                                                    Offer</a>
                                                            @else
                                                                <span class="m-widget4__number m--font-info">{{ $myoffer->status  }}</span>
                                                            @endif
                                                        @elseif($value->status == 'PUBLISHED' && !$value->isOfferingExpired())
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('supplier/channels/' . $channel->id.'/'.$value->id.'/offers/create') }}">Offering</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @elseif( $filter_key == '')
                                                <tr>
                                                    <td scope="row">{{ $value->internal_id }}</td>
                                                    <td>{{ $channel->company->title }}</td>
                                                    <td>{{ $value->title }}</td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $value->status }}</div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $channel->title }}</div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 150px;overflow: hidden;">{{ (new DateTime($value->deadline))->format('d/m/Y') }} {{ $value->deadline_time }}</div>
                                                    </td>
                                                    <td>
                                                        <a class="btn m-btn--square  btn-outline-info"
                                                           href="{{ URL::to('supplier/channels/' . $channel->id . '/' . $value->id) }}">View</a>

                                                        {{-- ToDo: If the offer status is deal, new company not allowded to make an offer --}}
                                                        @if($myoffer = $value->getOfferBySupplierId($_company_id))
                                                            @if($myoffer->status == "DRAFTED" || ($myoffer->status == "POSTED" && !$value->isOfferingExpired()))
                                                                <a class="btn m-btn--square  btn-outline-info"
                                                                   href="{{ URL::to('supplier/channels/' . $channel->id . '/rfqs/' . $value->id . '/offers/' . $myoffer->id .'/status/canceloffer') }}">Cancel
                                                                    Offer</a>
                                                            @else
                                                                <span class="m-widget4__number m--font-info">{{ $myoffer->status  }}</span>
                                                            @endif
                                                        @elseif($value->status == 'PUBLISHED' && !$value->isOfferingExpired())
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('supplier/channels/' . $channel->id.'/'.$value->id.'/offers/create') }}">Offering</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach

                                    <tr>
                                        <td colspan="5">
                                            {{ $channels->links() }}
                                        </td>
                                    </tr>
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