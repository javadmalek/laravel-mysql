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
                        <th>Subject</th>
                        <th>End Date</th>
                        <th>Your Offer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'SCHE') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td>{{ (new DateTime($value->value))->format('d/m/Y') }}</td>

                            @foreach($rfq->RfqOffers->where('_supplier_company_id', $_company_id) as $key=>$offer)
                                @if(($offerSpec = $offer->getOfferValue($value->id)) != null )
                                    <td>
                                        {{ (new DateTime($offerSpec->value))->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        @if($offer->status == 'DRAFTED')
                                            <a href=""
                                               class="btn m-btn--square  btn-outline-info"
                                               data-toggle="modal"
                                               data-target="#schedule_model_edit_{{ $offerSpec->id }}">
                                                Edit Offer
                                            </a>

                                            <div class="modal fade" id="schedule_model_edit_{{ $offerSpec->id }}"
                                                 tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="">Edit your offer
                                                                <strong><i>{{ $value->key }}</i></strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true" class="la la-remove"></span>
                                                            </button>
                                                        </div>

                                                        <!--begin::Form-->
                                                        {{ Html::ul($errors->all()) }}
                                                        {{ Form::model($offerSpec, array('route' => array('supplier.channels.{_channel_id}.{_rfq_id}.offers.update', $_channel_id, $rfq->id, $offerSpec->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                                                        <div class="m-portlet__body">
                                                            <div class="form-group m-form__group row">
                                                                <div class="col-lg-6">
                                                                    <div class="input-group date" id="m_datepicker_2">
                                                                        {{ Form::label('enddate', 'End Date', array( 'class' => 'col-lg-4 col-form-label')) }}
                                                                        {{ Form::text('value', Input::old('value'), array('class' => 'form-control m-input', 'required' => 'required')) }}
                                                                        <span class="input-group-addon"><i
                                                                                    class="la la-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <input id="_section" type="hidden" name="_section"
                                                                       value="SCHE">
                                                            </div>
                                                        </div>
                                                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                            <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                                                                <div class="row">
                                                                    <div class="col-lg-2"></div>
                                                                    <div class="col-lg-10">
                                                                        {{ Form::submit('Create the Schedule!', array('class' => 'btn btn-success')) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {{ Form::close() }}
                                                    <!--end::Form-->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                @endif
                            @endforeach

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Datatable -->
    </div>
</div>
