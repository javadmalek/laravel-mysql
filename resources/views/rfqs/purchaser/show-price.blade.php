<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                <h3 class="m-portlet__head-text">List of Pairs as (Key, Value)</h3>
                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                    <span>Pricing</span>
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
                        <th>Subject</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $sum = 0; ?>
                    @foreach($rfq->rfqSpecifications->where('_section', 'PRICE') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td>@if($value->value) {{ number_format($value->value) }}
                                @else -- @endif {{ $value->type }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><strong>Total Price:</strong></td>
                        <td><strong>{{ number_format($rfq->sum()) }}</strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Datatable -->
    </div>
</div>