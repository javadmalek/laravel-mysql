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
                        <th>Requested Amount</th>
                        <th>Your Offer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'PRICE') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td>@if($value->value) {{ number_format($value->value) }}
                                @else -- @endif {{ $value->type }}</td>
                            @foreach($rfq->RfqOffers->where('_supplier_company_id', $_company_id) as $key=>$offer)
                                @if(($offerSpec = $offer->getOfferValue($value->id)) != null )
                                    <td>
                                        @if($offerSpec->value) {{ number_format($offerSpec->value) }}
                                        @else -- @endif
                                    </td>
                                    <td>
                                        @if($offer->status == 'DRAFTED')
                                            <a href=""
                                               class="btn m-btn--square  btn-outline-info"
                                               data-toggle="modal"
                                               data-target="#price_model_edit_{{ $offerSpec->id }}">
                                                Edit Offer
                                            </a>

                                            <div class="modal fade" id="price_model_edit_{{ $offerSpec->id }}"
                                                 tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="">Edit your offer <strong><i>{{ $value->key }}</i></strong></h5>
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
                                                                {{ Form::label('value', 'Value', array('class' => 'col-lg-2 col-form-label')) }}
                                                                <div class="col-lg-3">
                                                                    {{ Form::text('value', Input::old('value'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your amount', 'required' => 'required')) }}
                                                                </div>
                                                                <input id="_section" type="hidden" name="_section" value="PRICE">
                                                            </div>
                                                        </div>
                                                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                            <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                                                                <div class="row">
                                                                    <div class="col-lg-2"></div>
                                                                    <div class="col-lg-10">
                                                                        {{ Form::submit('Update the Price!', array('class' => 'btn btn-success')) }}
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
                    <tr>
                        <td><strong>Total Price:</strong></td>
                        <td ><strong>{{ number_format($rfq->sum()) }}</strong></td>
                        @foreach($rfq->RfqOffers->where('_supplier_company_id', $_company_id) as $key=>$offer)
                            <td colspan="2">{{ number_format($offer->sum()) }}</td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Datatable -->
    </div>
</div>