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

                    {{ Form::open(array('url' => 'purchaser/channels/'. $_channel_id.'/rfqs', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">

                            {{ Form::label('title', 'RFQ Title', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Request Title', 'required' => 'required')) }}
                            </div>

                            {{ Form::label('deadline', 'RFQ Deadline', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="input-group date" id="m_datepicker_2">
                                    {{ Form::text('deadline', Input::old('deadline'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Request deadline', 'required' => 'required')) }}
                                    <span class="input-group-addon"><i class="la la-calendar-check-o"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('description', 'Description', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Enter your RFQ description')) }}
                            </div>
                        </div>
                        <input id="_channel_id" type="hidden" name="_channel_id" value="{{ $_channel_id  }}">

                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    {{ Form::submit('Create the RFQ!', array('class' => 'btn btn-success')) }}
                                    {{ Form::reset('Reset!', array('class' => 'btn btn-secondary')) }}
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



