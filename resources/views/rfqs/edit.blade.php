@extends('../layouts.purchaser-dashboard')
@section('page-title','Profile')

@section('content')

    <div class="m-content">
        <!--Begin::Channels List-->
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

                    {{ Form::model($rfq, array('route' => array('purchaser.channels.update', $rfq->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">

                            {{ Form::label('title', 'Channel Title', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Channel Title', 'required' => 'required')) }}
                                <span class="m-form__help">Please enter your Channel Title</span>
                            </div>

                            {{ Form::label('_sector_id', 'Sector of Industry', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::select('_sector_id', array('NaN' => 'Select a Sector of Industry', '1' => 'Metals', '2' => 'Woods'), Input::old('_sector_id'), array('class' => 'form-control m-input')) }}
                                </div>
                                <span class="m-form__help">Please select channel sector</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('_sub_sector_id', 'Sub-sector of Industry', array( 'class' => 'col-lg-2 col-form-label')) }}

                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::select('_sub_sector_id', array('NaN' => 'Sub-sector of Industry', '1' => 'SUB1', '2' => 'SUB2'), Input::old('_sub_sector_id'), array('class' => 'form-control m-input')) }}
                                </div>
                                <span class="m-form__help">Please select channel sub-sector</span>
                            </div>
                            {{ Form::label('_group_id', 'Group of Industry', array( 'class' => 'col-lg-2 col-form-label')) }}

                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::select('_group_id', array('NaN' => 'Select a Group of Industry', '1' => 'GROUP1', '2' => 'GROUP2'), Input::old('_group_id'), array('class' => 'form-control m-input')) }}
                                </div>
                                <span class="m-form__help">Please select Your Group</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('keywords', 'Keywords', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('keywords', Input::old('keywords'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your channel Keywords')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('description', 'Description', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Enter your channel description')) }}
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    {{ Form::submit('Create the Channel!', array('class' => 'btn btn-success')) }}
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



