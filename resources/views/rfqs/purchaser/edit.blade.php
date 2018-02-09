@extends('../layouts.purchaser-dashboard')
@section('page-title','Profile')

@section('content')

    <div class="m-content">
        <!--Begin::RFQs Edit-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                <h3 class="m-portlet__head-text">Edit the <b>{{ $rfq->title }}</b> Profile</h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}
                    {{ Form::model($rfq, array('route' => array('purchaser.channels.{_channel_id}.rfqs.update', $_channel_id, $rfq->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">

                            {{ Form::label('title', 'RFQ Title', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Request Title', 'required' => 'required')) }}
                            </div>

                            {{ Form::label('deadline', 'Offering Deadline', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-2">
                                <div class="input-group date" id="m_datepicker_2">
                                    {{ Form::text('deadline', (new DateTime(Input::old('deadline')))->format('d/m/Y'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Request deadline', 'required' => 'required')) }}
                                    <span class="input-group-addon"><i class="la la-calendar-check-o"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="col-lg-4 col-md-9 col-sm-12">
                                    {{ Form::text('deadline_time', Input::old('deadline_time'), array('class' => 'form-control m-input', 'placeholder' => 'Select time','id'=>'m_timepicker_1' , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('internal_id', 'Internal Id', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('internal_id', Input::old('internal_id'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Internal ID', 'required' => 'required')) }}
                            </div>

                            {{ Form::label('privacy', 'Type of Privacy', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::select('privacy', array('PUBLIC' => 'Public', 'PRIVATE' => 'Private'), Input::old('privacy'), array('class' => 'form-control m-input')) }}
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('_type_id', 'Type', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    <select name="_type_id" id="_type_id" class="form-control m-input">
                                        @foreach($rfq->channel->variables->where('variable', 'T') as $key => $value)
                                            <option value="{{ $value->id }}"
                                                    @if($rfq->_type_id ==$value->id) selected="selected" @endif>{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="m-form__help">Please select type</span>
                            </div>

                            {{ Form::label('_dimension_id', 'Dimension', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    <select name="_dimension_id" id="_dimension_id" class="form-control m-input">
                                        @foreach($rfq->channel->variables->where('variable', 'D') as $key => $value)
                                            <option value="{{ $value->id }}"
                                                    @if($rfq->_dimension_id ==$value->id) selected="selected" @endif>{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="m-form__help">Please select dimension</span>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('materials', 'Material', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::text('materials', Input::old('materials'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Materials', 'required' => 'required')) }}
                                </div>
                            </div>

                            {{ Form::label('number_mold', 'Number of Mold', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::number('number_mold', Input::old('number_mold'), array('class' => 'form-control m-input', 'placeholder' => 'Enter the Number of MOLD', 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>

                        {{--<div class="form-group m-form__group row">--}}
                        {{--{{ Form::label('sponsor_name', 'Sponsor Name', array('class' => 'col-lg-2 col-form-label')) }}--}}
                        {{--<div class="col-lg-3">--}}
                        {{--{{ Form::text('sponsor_name', Input::old('sponsor_name'), array('class' => 'form-control m-input', 'placeholder' => 'Enter the sponsor name', 'required' => 'required')) }}--}}
                        {{--</div>--}}

                        {{--{{ Form::label('sponsor_id', 'Sponsor ID', array('class' => 'col-lg-2 col-form-label')) }}--}}
                        {{--<div class="col-lg-3">--}}
                        {{--{{ Form::text('sponsor_id', Input::old('sponsor_id'), array('class' => 'form-control m-input', 'placeholder' => 'Enter the sponsor ID', 'required' => 'required')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group m-form__group row">--}}
                        {{--{{ Form::label('agent_name', 'Agent Name', array('class' => 'col-lg-2 col-form-label')) }}--}}
                        {{--<div class="col-lg-3">--}}
                        {{--{{ Form::text('agent_name', Input::old('agent_name'), array('class' => 'form-control m-input', 'placeholder' => 'Enter the agent name', 'required' => 'required')) }}--}}
                        {{--</div>--}}

                        {{--{{ Form::label('agent_id', 'Agent ID', array('class' => 'col-lg-2 col-form-label')) }}--}}
                        {{--<div class="col-lg-3">--}}
                        {{--{{ Form::text('agent_id', Input::old('agent_id'), array('class' => 'form-control m-input', 'placeholder' => 'Enter the Agent ID', 'required' => 'required')) }}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group m-form__group row">
                            {{ Form::label('description', 'Description', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Enter your RFQ description', 'rows'=>'5')) }}
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    @if($_editable)
                                        {{ Form::submit('Save Header!', array('class' => 'btn btn-success')) }}
                                    @else
                                        <span style="color: red;">SINCE the current RFQ IS <i><strong>{{ $rfq->status }}</strong></i> NOT EDITABLE </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                {{ Form::close() }}
                <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                @include('rfqs.purchaser.add-specification')
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                @include('rfqs.purchaser.add-schedule')
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                @include('rfqs.purchaser.add-price')
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                @include('rfqs.purchaser.add-media')
            </div>
        </div>

        @if($_editable)

            <div class="row">
                <div class="col-xl-12">
                    <div class="m-portlet">
                        {{ Html::ul($errors->all()) }}
                        {{ Form::open(array('url' => 'purchaser/channels/'. $_channel_id.'/'.$rfq->id .'/publish', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-10">

                                        <input id="_section" type="hidden" name="status" value="PUBLISHED">
                                        {{ Form::submit('Publish the RFQ!', array('class' => 'btn btn-success',
                                                                                            'onclick' => 'return confirm(\'Are you sure you want to PUBLISH?\nYou can not change it any more and would be available for all suppliers. \')')) }}

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection