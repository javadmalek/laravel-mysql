<div class="modal fade" id="extend_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Adding a new Specification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            @if($rfq->is_extended == 'YES')
                <div><h3 style="text-align: center; color: #f05b4f;">You have already extended before and
                        cannot do it again.</h3></div>
            @elseif($rfq->is_extended == 'NO' && $rfq->is1stLast7Days() && $rfq->status == 'NEGOTIATION')
            <!--begin::Form-->
                <!-- if there are creation errors, they will show here -->
                {{ Html::ul($errors->all()) }}
                {{ Form::open(array('url' => 'purchaser/channels/'. $_channel_id.'/'.$rfq->id.'/extend', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        {{ Form::label('action', 'Action', array('class' => 'col-lg-2 col-form-label')) }}
                        <div class="col-lg-6">
                            {{ Form::select('action',
                                        array('EXTEND' => 'Extend for +30 days',
                                             'TERMINATE' => 'Terminate the RFQ and Reject all the existed offers'
                                             ), Input::old('type'), array('class' => 'form-control m-input',
                                                                          'onchange'=>'changeSelect(this)',
                                                                          'onfocus'=>'changeSelect(this)',
                                                                          'onclick'=>'changeSelect(this)'))
                            }}
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-10">
                                {{ Form::submit('Save !', array('class' => 'btn btn-success')) }}
                            </div>
                        </div>
                    </div>
                </div>

                {{ Form::close() }}
            <!--end::Form-->
            @endif

        </div>
    </div>
</div>