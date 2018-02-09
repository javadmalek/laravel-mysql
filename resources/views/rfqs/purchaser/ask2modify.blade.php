<div class="modal fade" id="ask2modify_model{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Ask to Modify the offer
                    @if($value->status != 'DEAL')
                        Supplier ID: {{ $value->supplier->id }}
                    @else
                        {{ $value->supplier->title }}
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <!--begin::Form-->
            {{ Html::ul($errors->all()) }}
            {{ Form::open(array('url' => 'purchaser/messages/' . $rfq->channel->id.'/' . $rfq->id.'/' . $value->id .'/'.  $value->supplier->id . '/send',
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

        </div>
    </div>
</div>