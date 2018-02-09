<div class="modal fade" id="invit_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Sending a message to {{ $rfq->channel->company->title }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <!--begin::Form-->
            {{ Html::ul($errors->all()) }}
            {{ Form::open(array('url' => 'purchaser/messages/' . $rfq->channel->id.'/' . $rfq->id.'/sendInvitation',
                                'method' => 'POST',
                                'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed',
                                'id' => '"maskForm"')) }}
            <div class="col-xl-12">

                <div class="form-group m-form__group row">
                    {{ Form::label('subject', 'Invitation Subject', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-8">
                        {{ Form::text('subject', 'Inviting you to make an Offer for '. $rfq->title,
                        array('class' => 'form-control m-input', 'placeholder' => 'Invited to make your Offer for RFQ: ' . $rfq->title, 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    {{ Form::label('m_select2_3', 'To', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-8">
                        <select class="form-control m-input m-select2" id="m_select2_3" name="_receiver_company_id[]"
                                multiple="multiple" required="required" style="width: 100%;">
                            @foreach($companies as $key => $company)
                                <option value="{{ $company->id }}"> {{ $company->title }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    {{ Form::label('message', 'message', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-8">
                        {{ Form::textarea('message', Input::old('message'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your message', 'required' => 'required')) }}
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
            </div>

        {{ Form::close() }}
        <!--end::Form-->
        </div>
    </div>
</div>