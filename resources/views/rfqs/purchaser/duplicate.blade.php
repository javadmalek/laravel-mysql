<div class="modal fade" id="duplicat_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Duplicate <b>{{ $rfq->title }}</b></h5><br />
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <!--begin::Form-->
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}
            {{ Form::open(array('url' => 'purchaser/channels/'.  $rfq->channel->id .'/'.$rfq->id.'/duplicate', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-7">
                        Choose from the below items that you would like to duplicate them:
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        {{ Form::label('_new_channel_id', 'Post in Channel: ') }}
                    </div>
                    <div class="col-lg-5">
                        <select name="_new_channel_id" id="_new_channel_id" class="form-control m-input">
                            @foreach($rfq->Channel->company->channels as  $key => $value)
                                <option value={{ $value->id }} @if($value->id == $rfq->Channel->id ) selected="selected" @endif >{{ $value->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        {{ Form::label('_new_channel_title', 'New Title: ') }}
                    </div>
                    <div class="col-lg-5">
                            {{ Form::text('_new_channel_title', $rfq->title.' - Duplicated!', array('class' => 'form-control m-input', 'placeholder' => 'Enter your New RFQ Title', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-1">
                        {{ Form::checkbox('SPEC', 'YES', true, ['class' => 'form-control m-input']) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('SPEC', 'Duplicate the Specifications Items') }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-1">
                        {{ Form::checkbox('SCHE', 'YES', true, ['class' => 'form-control m-input']) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('SCHE', 'Duplicate the Scheduling Items') }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-1">
                        {{ Form::checkbox('PRICE', 'YES', true, ['class' => 'form-control m-input']) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('PRICE', 'Duplicate the Prices Items') }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-1">
                        {{ Form::checkbox('MEDIA', 'YES', true, ['class' => 'form-control m-input']) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('MEDIA', 'Duplicate the Media Items') }}
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                            {{ Form::submit('Create the Price!', array('class' => 'btn btn-success')) }}
                        </div>
                    </div>
                </div>
            </div>

        {{ Form::close() }}
        <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal-->