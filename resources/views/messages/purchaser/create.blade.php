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
                                <h3 class="m-portlet__head-text">Create a new Message</h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}
                    {{ Form::open(array('url' => 'purchaser/messages/compose/send',
                                        'method' => 'POST',
                                        'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed',
                                        'id' => '"maskForm"')) }}

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            {{ Form::label('subject', 'Subject', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::text('subject', Input::old('subject'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your message subject here', 'required' => 'required')) }}
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('_receiver_company_id', 'To', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                <select class="form-control m-select2" id="m_select2_3" name="_receiver_company_id[]" multiple="multiple"  required="required">
                                    @foreach($companies as $key => $company)
                                        <option value="{{ $company->id }}"> {{ $company->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('message', 'Message', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::textarea('message', Input::old('message'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Enter your message here', 'required' => 'required')) }}
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    {{ Form::submit('Send Message!', array('class' => 'btn btn-success')) }}
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



