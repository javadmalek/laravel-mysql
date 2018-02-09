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
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href=""
                       class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                       data-toggle="modal" data-target="#schedule_model">
                        <i class="fa fa-plus" title="Add new property to product"></i>
                    </a>
                </li>
            </ul>
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
                        <th>Ending Date</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'SCHE') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td>{{ (new DateTime($value->value))->format('d/m/Y') }} </td>
                            <td style="width: 35%">{{ $value->description }}</td>
                            <td>
                                @if($_editable)
                                    {{ Form::open(array('url' => 'purchaser/channels/' . $rfq->Channel->id.'/rfqs/' . $rfq->id.'/specifications/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                        'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                    {{ Form::close() }}

                                    <a href=""
                                       class="btn m-btn--square  btn-outline-info"
                                       data-toggle="modal" data-target="#schedule_model_edit_{{ $value->id }}">
                                        Edit
                                    </a>

                                    <div class="modal fade" id="schedule_model_edit_{{ $value->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="">Edit a Schedule</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true" class="la la-remove"></span>
                                                    </button>
                                                </div>

                                                <!--begin::Form-->
                                                <!-- if there are creation errors, they will show here -->
                                                {{ Html::ul($errors->all()) }}
                                                {{ Form::model($value, array('route' => array('purchaser.channels.{_channel_id}.rfqs.{_rfq_id}.specifications.update', $_channel_id, $rfq->id, $value->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                                                <div class="m-portlet__body">
                                                    <div class="form-group m-form__group row">
                                                        {{ Form::label('key', 'Subject', array('class' => 'col-lg-3 col-form-label')) }}
                                                        <div class="col-lg-6">
                                                            {{ Form::text('key', Input::old('key'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your key', 'required' => 'required')) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <div class="col-lg-6">
                                                            <div class="input-group date" id="m_datepicker_2">
                                                                {{ Form::label('enddate', 'End Date', array( 'class' => 'col-lg-4 col-form-label')) }}
                                                                {{ Form::text('value', Input::old('value'), array('class' => 'form-control m-input', 'required' => 'required')) }}
                                                                <span class="input-group-addon"><i
                                                                            class="la la-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <input id="_section" type="hidden" name="_section" value="SCHE">
                                                    </div>
                                                </div>

                                                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                    <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                                                        <div class="row">
                                                            <div class="col-lg-2"></div>
                                                            <div class="col-lg-10">
                                                                {{ Form::submit('Update the Schedule!', array('class' => 'btn btn-success')) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            {{ Form::close() }}
                                            <!--end::Form-->
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span style="color: red;">NOT EDITABLE</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end: Datatable -->
    </div>
</div>

<div class="modal fade" id="schedule_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Adding a new Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <!--begin::Form-->
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => 'purchaser/channels/'. $_channel_id.'/rfqs/'.$rfq->id.'/specifications/store', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    {{ Form::label('key', 'Subject', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-6">
                        {{ Form::text('key', Input::old('key'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your key', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">
                        <div class="input-group date" id="m_datepicker_2">
                            {{ Form::label('enddate', 'End Date', array( 'class' => 'col-lg-4 col-form-label')) }}
                            {{ Form::text('value', Input::old('value'), array('class' => 'form-control m-input', 'required' => 'required')) }}
                            <span class="input-group-addon"><i class="la la-calendar"></i></span>
                        </div>
                    </div>
                    <input id="_section" type="hidden" name="_section" value="SCHE">
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
<!--end::Modal-->