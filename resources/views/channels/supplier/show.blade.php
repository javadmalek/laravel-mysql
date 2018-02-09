@extends('../layouts.supplier-dashboard')
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
                    </div>
                    <div class="m-portlet__body">
                        {{ $channel->description }}
                        <div style="width: 80%; text-align: left;margin-top: 16px">
                            <div class="m-widget12 m--margin-top-10">
                                <div class="m-widget12__item">
                                    <span class="m-widget12__text1">
                                        <span> {{ $channel->keywords }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
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
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-no-border">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company</th>
                                        <th>title</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($channel->rfqsNotDrafted as $key => $value)
                                            <tr>
                                                <td scope="row">{{ $value->internal_id }}</td>
                                                <td>{{ $channel->company->title }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td><div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $value->status }}</div></td>
                                                <td>
                                                    <div style="white-space: nowrap;width: 150px;overflow: hidden;">{{ (new DateTime($value->deadline))->format('d/m/Y') }} {{ $value->deadline_time }}</div>
                                                </td>
                                                <td>
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('supplier/channels/' . $channel->id.'/'.$value->id) }}">View</a>

                                                    @if($myoffer = $value->getOfferBySupplierId($_company_id))

                                                        @if($myoffer->status == "DRAFTED" || ($myoffer->status == "POSTED" && !$value->isOfferingExpired()))
                                                            <a class="btn m-btn--square  btn-outline-info"
                                                               href="{{ URL::to('supplier/channels/' . $channel->id . '/rfqs/' . $value->id . '/offers/' . $myoffer->id .'/status/canceloffer') }}">Cancel
                                                                Offer</a>
                                                        @else
                                                            <div style="white-space: nowrap;width: 100px;overflow: hidden;">{{ $myoffer->status }} </div>
                                                        @endif
                                                    @elseif($value->status == 'PUBLISHED' && !$value->isOfferingExpired())
                                                        <a class="btn m-btn--square  btn-outline-info"
                                                           href="{{ URL::to('supplier/channels/' . $channel->id.'/'.$value->id.'/offers/create') }}">Offering</a>
                                                    @endif

                                                </td>
                                            </tr>

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