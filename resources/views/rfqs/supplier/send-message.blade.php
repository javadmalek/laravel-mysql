@if($rfq->getOfferBySupplierId($_company_id))
    <div class="modal fade" id="message_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Sending a message to
                        @if( !($offer = $rfq->getOfferBySupplierId($_company_id)) || $offer->status != 'DEAL')
                            Purchaser ID:{{ $offer->supplier->id }}
                        @else
                            {{ $offer->supplier->title }}
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-remove"></span>
                    </button>
                </div>

                <!--begin::Form-->
                {{ Html::ul($errors->all()) }}
                {{ Form::open(array('url' => 'supplier/messages/' . $rfq->channel->id.'/' . $rfq->id.'/' . $rfq->getOfferBySupplierId($_company_id)->id .'/'. $rfq->channel->company->id . '/send',
                                    'method' => 'POST',
                                    'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed',
                                    'id' => '"maskForm"')) }}

                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        {{ Form::label('message', 'Message', array('class' => 'col-lg-2 col-form-label')) }}
                        <div class="col-lg-8">
                            {{ Form::textarea('message', Input::old('message'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your message', 'required' => 'required')) }}
                        </div>
                        {{ Form::hidden('subject', 'Sending Message for RFQ: ' . $rfq->title) }}
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-10">
                                {{ Form::submit('Send', array('class' => 'btn btn-success')) }}
                            </div>
                        </div>
                    </div>
                </div>

            {{ Form::close() }}
            <!--end::Form-->
                <div class="m-portlet__body">
                    <!--begin: Datatable -->
                    <div class="m-section">
                        <div class="m-section__content">
                            <table class="table m-table m-table--head-no-border">
                                <thead>
                                <tr>
                                    <th colspan="2">Messaging with {{ $offer->supplier->title }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($offer->messages as $key => $msg)
                                    <tr>
                                        @if($offer->supplier->id !== $msg->sender->id)
                                            <td scope="row" style="text-align: right">
                                                <p style="text-align: justify; direction: rtl;">
                                                    <strong>{{ $msg->message}}</strong><br/>
                                                    <i>{{ $msg->sender->title }}</i>,
                                                    <i>{{ $msg->created_at }}</i></p>
                                            </td>
                                        @else
                                            <td scope="row">
                                                <p style="text-align: justify;"><strong>{{ $msg->message}}</strong><br/>
                                                    <i>you</i>,
                                                    <i>{{ $msg->created_at }}</i></p>
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
        </div>
    </div>
@endif