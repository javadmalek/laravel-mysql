@extends('../layouts.purchaser-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <!--Begin::RFQs List-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                <h3 class="m-portlet__head-text">Create New RFQ</h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}
                    {{ Form::open(array('url' => 'purchaser/channels/'. $_channel_id.'/rfqs/', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            {{ Form::label('title', 'RFQ Title', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Request Title', 'required' => 'required')) }}
                            </div>

                            {{ Form::label('deadline', 'Offering Deadline', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-2">
                                <div class="input-group date" id="m_datepicker_2">
                                    {{ Form::text('deadline', Input::old('deadline'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Request deadline', 'required' => 'required')) }}
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
                            {{ Form::label('internal_id', 'Domestic Id', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('internal_id', 'VBS-0000000000', array('class' => 'form-control m-input', 'placeholder' => 'Enter your Domestic ID', 'required' => 'required')) }}
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
                                        @foreach($channel->variables->where('variable', 'T') as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="m-form__help">Please select type</span>
                            </div>

                            {{ Form::label('_dimension_id', 'Dimension', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    <select name="_dimension_id" id="_dimension_id" class="form-control m-input">
                                        @foreach($channel->variables->where('variable', 'D') as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
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
                                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Enter your RFQ description')) }}
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    {{ Form::submit('Save & Continue!', array('class' => 'btn btn-success')) }}
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
    </div>
@endsection



