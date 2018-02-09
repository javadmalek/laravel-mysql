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
                        <th>Currency</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($rfq->rfqSpecifications->where('_section', 'PRICE') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td>
                                <select id="price_curr_{{$value->id}}" name="price_curr_{{$value->id}}"
                                        class="form-control m-input">
                                    <option value="EURO" @if ( $value->value == 'EURO') selected @endif >EURO</option>
                                    <option value="USD" @if ( $value->value == 'USD') selected @endif >USD</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control m-input" id="price_amount_{{$value->id}}"
                                       name="price_amount_{{$value->id}}"
                                       value="{{ $value->value }}"
                                       required="required">
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