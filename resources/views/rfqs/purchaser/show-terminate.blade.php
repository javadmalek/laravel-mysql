<div class="modal fade" id="terminate_model" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Inspecting Offers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            {{ Html::ul($errors->all()) }}
            {{ Form::open(array('url' => 'purchaser/channels/'. $rfq->channel->id.'/'.$rfq->id.'/' . $value->id . '/' . $value->deal->id , 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    {{ Form::label('action', 'Terminate as', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-6">
                        {{ Form::select('action', array('rejected' => 'Rejected', 'win' => 'Win', 'cancelled' => 'cancelled'), Input::old('action'), array('class' => 'form-control m-input')) }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    {{ Form::label('descr', 'Descr', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-6">
                        {{ Form::textarea('descr', Input::old('descr'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your description for the selected action', 'required' => 'required')) }}
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                            {{ Form::submit('Save !', array('class' => 'btn btn-succeed')) }}
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</div>