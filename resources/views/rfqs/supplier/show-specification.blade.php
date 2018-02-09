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
                        <th>Requested Value</th>
                        <th>Your Offer</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'SPEC') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}<br/>
                                <span class="m-widget1__desc">{{ $value->description }}</span>
                            </td>
                            <td>{{ $value->value }}</td>

{{--                            @if ( $value->is_mandatory == 'NO')--}}
                                @foreach($rfq->RfqOffers->where('_supplier_company_id', $_company_id) as $key=>$offer)
                                    @if(($offerSpec = $offer->getOfferValue($value->id)) != null )
                                        <td>
                                            {{ $offerSpec->value }}
                                        </td>
                                        <td>
                                            @if(($offer->status == 'DRAFTED' || !$rfq->isOfferingExpired() ) && $value->is_mandatory == 'NO')
                                                <a href=""
                                                   class="btn m-btn--square  btn-outline-info"
                                                   data-toggle="modal"
                                                   data-target="#specification_model_edit_{{ $offerSpec->id }}">
                                                    Edit Offer
                                                </a>

                                                <div class="modal fade" id="specification_model_edit_{{ $offerSpec->id }}"
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
                                                                    {{ Form::label('value', $value->key , array('class' => 'col-lg-4 col-form-label')) }}
                                                                    <div class="col-lg-3">
                                                                        @if ( $value->type == 'TEXT')
                                                                            <input type="text" class="form-control m-input" id="value" name="value"
                                                                                   value="{{ $offerSpec->value }}" placeholder="Enter your{{$value->key }}"
                                                                                   required="required">
                                                                        @else
                                                                             <select id="value" name="value" class="form-control m-input">
                                                                                @if ( $value->type == 'YESNO')
                                                                                    <option value="YES" @if ( $offerSpec->value == 'YES') selected @endif >YES</option>
                                                                                    <option value="NO"  @if ( $offerSpec->value == 'NO') selected @endif >NO</option>
                                                                                @elseif ( $value->type == 'DELIVERY')
                                                                                    <option value="EXW" @if($offerSpec->value == 'EXW') selected @endif>EXW</option>
                                                                                    <option value="FCA" @if($offerSpec->value == 'FCA') selected @endif>FCA</option>
                                                                                    <option value="CIP" @if($offerSpec->value == 'CIP') selected @endif>CIP</option>
                                                                                    <option value="DAP" @if($offerSpec->value == 'DAP') selected @endif>DAP</option>
                                                                                    <option value="DAT" @if($offerSpec->value == 'DAT') selected @endif>DAT</option>
                                                                                    <option value="DDP" @if($offerSpec->value == 'DDP') selected @endif>DDP</option>
                                                                                    <option value="OTHERSDEL" @if($offerSpec->value == 'OTHERSDEL') selected @endif>OTHERS</option>
                                                                                @elseif ( $value->type == 'INJECTSYSTEM')
                                                                                    <option value="HOTRUNNER" @if($offerSpec->value == 'HOTRUNNER') selected @endif>HOT RUNNER</option>
                                                                                    <option value="HOTNOZZLE" @if($offerSpec->value == 'HOTNOZZLE') selected @endif>HOT NOZZLE</option>
                                                                                    <option value="COLDRUNNER" @if($offerSpec->value == 'COLDRUNNER') selected @endif>COLD RUNNER</option>
                                                                                    <option value="OTHERSINJ" @if($offerSpec->value == 'OTHERSINJ') selected @endif>OTHERS</option>
                                                                                @elseif ( $value->type == 'MOLDFLOWSIMULATION')
                                                                                    <option value="FILLING" @if($offerSpec->value == 'FILLING') selected @endif>FILLING</option>
                                                                                    <option value="CODING" @if($offerSpec->value == 'CODING') selected @endif>CODING</option>
                                                                                    <option value="SHRINKAGE" @if($offerSpec->value == 'SHRINKAGE') selected @endif>SHRINKAGE</option>
                                                                                    <option value="WARPAGE" @if($offerSpec->value == 'WARPAGE') selected @endif>WARPAGE</option>
                                                                                    <option value="OTHERSMOLD" @if($offerSpec->value == 'OTHERSMOLD') selected @endif>OTHERS</option>
                                                                                @endif
                                                                            </select>
                                                                        @endif
                                                                    </div>

                                                                    <input id="_section" type="hidden" name="_section" value="SPEC">
                                                                </div>
                                                            </div>
                                                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                                <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                                                                    <div class="row">
                                                                        <div class="col-lg-2"></div>
                                                                        <div class="col-lg-10">
                                                                            {{ Form::submit('Update the Key!', array('class' => 'btn btn-success')) }}
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
                            {{--@else--}}
                                {{--<td>{{ $value->value }}</td>--}}
                            {{--@endif--}}

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Datatable -->
    </div>
</div>