<div class="modal fade" id="one_by_one_offer_model_{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Inspecting Offers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

        @if($offer->status == 'DEAL')
            <!-- if there are creation errors, they will show here -->
                {{ Html::ul($errors->all()) }}
                {{ Form::open(array('url' => 'purchaser/channels/'. $rfq->channel->id.'/rfqs/'.$rfq->id.'/offers/' . $offer->id . '/invoice', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">Status:</label>
                        <div class="col-lg-6">
                            {{ $offer->status }} and {{ $offer->deal->payment_status }}
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">Reason:</label>
                        <div class="col-lg-6">
                            {{ $offer->reason }}
                            {{ $offer->deal->description }}
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        {{ Form::label('payment_status', 'Billable or Invoice', array('class' => 'col-lg-2 col-form-label')) }}
                        <div class="col-lg-6">
                            {{ Form::select('payment_status', array('billable' => 'Billable', 'invoice' => 'Invoice'), $offer->deal->payment_status, array('class' => 'form-control m-input')) }}
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        {{ Form::label('description', 'Description', array('class' => 'col-lg-2 col-form-label')) }}
                        <div class="col-lg-6">
                            {{ Form::textarea('description', $offer->deal->description, array('class' => 'form-control m-input', 'placeholder' => 'Enter your description')) }}
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                        <div class="row">
                            <div class="col-lg-12">
                                {{ Form::submit('Save !', array('class' => 'btn btn-success')) }}
                            </div>
                        </div>
                    </div>
                </div>

                {{ Form::close() }}

                <div class="row">
                    <div class="col-lg-12">
                        @include('rfqs.purchaser.show-1by1-specification')
                        @include('rfqs.purchaser.show-1by1-schedule')
                        @include('rfqs.purchaser.show-1by1-price')
                        @include('rfqs.purchaser.show-1by1-media')
                    </div>
                </div>

        @elseif($rfq->status == 'NEGOTIATION' || $rfq->status == 'DEAL' )
            <!-- if there are creation errors, they will show here -->
                {{ Html::ul($errors->all()) }}
                {{ Form::open(array('url' => 'purchaser/channels/'. $rfq->channel->id.'/rfqs/'.$rfq->id.'/offers/' . $offer->id . '/status', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                @if ( $offer->status == 'REJECTED' || $offer->status == 'CANCELED' || ( $offer->status == 'POSTED' && $rfq->isLeadExpired()))
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Status:</label>
                            <div class="col-lg-6">
                                {{ $offer->status }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Reason:</label>
                            <div class="col-lg-6">
                                {{ $offer->reason }}
                                @if($rfq->isLeadExpired())
                                    <div><h3 style="text-align: center; color: #f05b4f;">
                                            Your RFQ is <strong>{{ $rfq->status }}</strong>.</h3>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @elseif ( $offer->status == 'POSTED' && !$rfq->isLeadExpired())
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            {{ Form::label('action', 'Action', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                    {{ Form::select('action', array('reject' => 'Reject the offer', 'deal' => 'Making a Deal'), Input::old('action'), array('class' => 'form-control m-input')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('reason', 'Reason', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::textarea('reason', Input::old('reason'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your reason for selected action', 'required' => 'required')) }}
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                            <div class="row">
                                <div class="col-lg-12" >
                                    {{ Form::submit('Save !', array('class' => 'btn btn-success')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{ Form::close() }}

                <div class="row">
                    <div class="col-lg-12">
                        @include('rfqs.purchaser.show-1by1-specification')
                        @include('rfqs.purchaser.show-1by1-schedule')
                        @include('rfqs.purchaser.show-1by1-price')
                        @include('rfqs.purchaser.show-1by1-media')
                    </div>
                </div>
            @elseif($rfq->status == 'EXPIRED' )
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">Status:</label>
                        <div class="col-lg-6">
                            {{ $offer->status }}
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">Reason:</label>
                        <div class="col-lg-6">
                            {{ $offer->reason }}
                            {{--@if($rfq->isLeadExpired())--}}
                                <div><h3 style="text-align: center; color: #f05b4f;">
                                        Your RFQ is <strong>{{ $rfq->status }}</strong>.</h3>
                                </div>
                            {{--@endif--}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @include('rfqs.purchaser.show-1by1-specification')
                        @include('rfqs.purchaser.show-1by1-schedule')
                        @include('rfqs.purchaser.show-1by1-price')
                        @include('rfqs.purchaser.show-1by1-media')
                    </div>
                </div>

            @elseif($rfq->status == 'DRAFTED' || $rfq->status == 'PUBLISHED' )
                <div align="center" style="color: red">
                    <h2>Not possible to Visit because the RFQ status is {{ $rfq->status }} </h2>
                </div>
            @endif

        </div>
    </div>
</div>