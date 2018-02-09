@extends('../layouts.purchaser-dashboard')

@section('content')
    {{--RFQs Section--}}
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
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-no-border">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>RFQ Status</th>
                                        <th>offers</th>
                                        <th>Channel</th>
                                        <th>Offering Deadline</th>
                                        <th>Expire Date</th>
                                        <th></th>
                                        <th>New Messages</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($channels as $key => $channel)
                                        @foreach($channel->rfqs as $key => $value)

                                            @if( $filter_key != ''
                                                        &&
                                                    (strpos( strtolower($value->title), strtolower($filter_key) ) !== false ||
                                                     strpos( strtolower($channel->title), strtolower($filter_key) ) !== false
                                                     )
                                                 )
                                                <tr>
                                                    <td scope="row">{{ $value->internal_id }}</td>
                                                    <td>{{ $value->title }}</td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $value->status }}</div>
                                                    </td>
                                                    <td>
                                                        <span class="m-widget4__number m--font-info">{{ count($value->RfqNotDraftedOffers) }}</span>
                                                        @if ($notread = count($value->RfqOffersNotRead))
                                                            <a href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">
                                                                <span class="m-badge m-badge--danger">{{$notread}} </span>
                                                            </a>
                                                        @endif</td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $channel->title }}</div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 150px;overflow: hidden;">
                                                            {{ (new DateTime($value->deadline))->format('d/m/Y') }} {{ $value->deadline_time }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ (new DateTime($value->expire_date))->format('d/m/Y') }}</div>
                                                    </td>

                                                    <td>
                                                        @if($value->status == 'DRAFTED')
                                                            {{ Form::open(array('url' => 'purchaser/channels/' . $channel->id.'/rfqs/' . $value->id , 'class' => 'pull-right')) }}
                                                            {{ Form::hidden('_method', 'DELETE') }}
                                                            {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                                                            'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                                            {{ Form::close() }}
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">View</a>
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('purchaser/channels/'. $channel->id.'/rfqs/'.$value->id . '/edit') }}">Edit</a>
                                                        @else
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">View</a>
                                                            <span>NOT EDITABLE </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">
                                                            @if(($count = $value->countNotReadMsgs()) > 0)
                                                                <span class="m-badge m-badge--danger">{{ $count }}</span>
                                                            @else
                                                                0
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @elseif( $filter_key == '')
                                                <tr>
                                                    <td scope="row">{{ $value->internal_id }}</td>
                                                    <td>{{ $value->title }}</td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $value->status }}</div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ count($value->RfqNotDraftedOffers) }}</div>
                                                        @if ($notread = count($value->RfqOffersNotRead))
                                                            <a href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">
                                                                <span class="m-badge m-badge--danger">{{$notread}} </span>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $channel->title }}</div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 150px;overflow: hidden;">
                                                            {{ (new DateTime($value->deadline))->format('d/m/Y') }} {{ $value->deadline_time }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ (new DateTime($value->expire_date))->format('d/m/Y') }}</div>
                                                    </td>

                                                    <td>
                                                        @if($value->status == 'DRAFTED')
                                                            @if($value->canDelete())
                                                                {{ Form::open(array('url' => 'purchaser/channels/' . $channel->id.'/rfqs/' . $value->id , 'class' => 'pull-right')) }}
                                                                {{ Form::hidden('_method', 'DELETE') }}
                                                                {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                                                                'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                                                {{ Form::close() }}
                                                            @endif
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">View</a>
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('purchaser/channels/'. $channel->id.'/rfqs/'.$value->id . '/edit') }}">Edit</a>
                                                        @else
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">View</a>
                                                            <span>NOT EDITABLE </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div style="white-space: nowrap;width: 100px;overflow: hidden;">
                                                            @if(($count = $value->countNotReadMsgs()) > 0)
                                                                <span class="m-badge m-badge--danger">{{ $count }}</span>
                                                            @else
                                                                0
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif

                                        @endforeach
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