<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                <h3 class="m-portlet__head-text">List of Pairs as (Key, Value)</h3>
                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                    <span>Specifications</span>
                </h2>
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
                        <th>Key</th>
                        <th>RFQ</th>
                        @if($offer->status != 'DRAFTED')
                            <th>
                                @if($offer->status != 'DEAL')
                                    {{ $offer->supplier->id }}
                                @else
                                    {{ $offer->supplier->title }}
                                @endif
                            </th>
                        @endif
                        <th>Is mandatory?</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'SPEC') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}<br/>
                                <span class="m-widget1__desc">{{ $value->description }}</span>
                            </td>
                            <td>{{ $value->value }}</td>

                            @if($offer->status != 'DRAFTED')
                                <td>
                                    {{ $offer->getOfferValue($value->id)->value }}
                                </td>
                            @endif
                            <td>{{ $value->is_mandatory }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Datatable -->
    </div>
</div>