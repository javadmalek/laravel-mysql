<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                <h3 class="m-portlet__head-text">List of Pairs as (Key, Value)</h3>
                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                    <span>Schedules</span>
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
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'SCHE') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            @if ( $value->is_mandatory == 'YES')
                                <td>{{ (new DateTime( $value->value))->format('d/m/Y') }}</td>
                            @else
                                <td>
                                    <div class="input-group date" id="m_datepicker_3">
                                        <input type="text" class="form-control m-input" id="key_end_{{$value->id}}"
                                               name="key_end_{{$value->id}}"
                                               value="{{ (new DateTime( $value->value))->format('d/m/Y') }}"
                                               required="required">
                                        <span class="input-group-addon"><i class="la la-calendar"></i></span>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Datatable -->
    </div>
</div>