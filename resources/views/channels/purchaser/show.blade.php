@extends('../layouts.purchaser-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon"><i class="flaticon-diagram"></i></span>
                                <h3 class="m-portlet__head-text m--font-brand">{{ $channel->title }}</h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <a class="btn m-btn--square  btn-outline-info pull-right"
                               href="{{ URL::to('purchaser/channels/'.$channel->id.'/rfqs/create/') }}">Create a new
                                RFQ</a>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        {{ $channel->description }} <br/>
                        Keywords: {{ $channel->keywords }}
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    List of your RFQs
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!-- Start Search -->
                        {{ Form::open(array('url' => 'purchaser/channels/filter/' . $channel->id, 'method' => 'POST',
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

                        <!--begin: Datatable -->
                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-no-border">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>Status</th>
                                        <th>Offers</th>
                                        <th>Offering Deadline</th>
                                        <th></th>
                                        <th>New Messages</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rfqs as $key => $value)
                                        @if( $filter_key != ''
                                                        &&
                                                    (strpos( strtolower($value->title), strtolower($filter_key) ) !== false ||
                                                     strpos( strtolower($value->internal_id), strtolower($filter_key) ) !== false
                                                     )
                                                 )
                                            <tr>
                                                <td scope="row">{{ $value->internal_id }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{  $value->status }}</td>
                                                <td>
                                                    <span class="m-widget4__number m--font-info">{{ count($value->RfqNotDraftedOffers) }}</span>
                                                    @if ($notread = count($value->RfqOffersNotRead))
                                                        <a href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">
                                                            <span class="m-badge m-badge--danger">{{$notread}} </span>
                                                        </a>
                                                    @endif</td>
                                                <td>
                                                    <div style="white-space: nowrap;width: 150px;overflow: hidden;">
                                                        {{ (new DateTime($value->deadline))->format('d/m/Y') }} {{ $value->deadline_time }}
                                                    </div>
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
                                        @elseif( $filter_key == '')
                                            <tr>
                                                <td scope="row">{{ $value->internal_id }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{  $value->status }}</td>
                                                <td>
                                                    <span class="m-widget4__number m--font-info">{{ count($value->RfqNotDraftedOffers) }}</span>
                                                    @if ($notread = count($value->RfqOffersNotRead))
                                                        <a href="{{ URL::to('purchaser/channels/' . $channel->id.'/rfqs/'.$value->id) }}">
                                                            <span class="m-badge m-badge--danger">{{$notread}} </span>
                                                        </a>
                                                    @endif</td>
                                                <td>
                                                    <div style="white-space: nowrap;width: 150px;overflow: hidden;">
                                                        {{ (new DateTime($value->deadline))->format('d/m/Y') }} {{ $value->deadline_time }}
                                                    </div>
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