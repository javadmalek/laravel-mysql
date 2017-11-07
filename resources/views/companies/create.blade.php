@extends('../layouts.purchaser-dashboard')
@section('page-title','Profile')

@section('content')

    <div class="m-content">
        <!--Begin::Companies List-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                <h3 class="m-portlet__head-text">Create your company profile</h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'purchaser/companies', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">

                            {{ Form::label('title', 'Company Title', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Company Title', 'required' => 'required')) }}
                                <span class="m-form__help">Please enter your Company Title</span>
                            </div>

                            {{ Form::label('web_url', 'Website Url', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('web_url', Input::old('web_url'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your WebSite Url')) }}
                                <span class="m-form__help">Please enter your WebSite Url </span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('co_founder', 'CO-Founder', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('co_founder',  Input::old('co_founder'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company CO-Founder')) }}
                            </div>

                            {{ Form::label('cto', 'CTO', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('cto', Input::old('cto'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company CTO')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('founding_year', 'Founding Year', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('founding_year', Input::old('founding_year'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company Founding Year', 'id' => 'm_inputmask_5', 'maxlength' => '4')) }}
                                <span class="m-form__help">Year:<code>yyyy</code>
										</span>
                            </div>

                            {{ Form::label('turnover', 'Turnover', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('turnover', Input::old('turnover'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company turnover', 'id' => 'm_inputmask_7')) }}
                                <span class="m-form__help">Currency format<code>€ ___.__1.234,56</code></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('vat', 'Vat', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('vat', Input::old('vat'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company Vat')) }}
                            </div>

                            {{ Form::label('employee_number', 'Employee Number', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::number('employee_number', Input::old('employee_number'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company employee number')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('office_address', 'Address', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('office_address', Input::old('office_address'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company office address', 'required' => 'required')) }}
                            </div>

                            {{ Form::label('office_tele', 'Telephone Number', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('office_tele', Input::old('office_tele'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company office telephone number', 'required' => 'required', 'id' => 'm_inputmask_3')) }}
                                {{--{{ Form::text('office_tele', null, array('class' => 'form-control m-input', 'id' => 'm_inputmask_3')) }}--}}
                                <span class="m-form__help">Phone number mask:<code>(999) 999-9999</code></span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('latitude', 'Latitude', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::number('latitude', Input::old('latitude'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company latitude')) }}
                            </div>

                            {{ Form::label('longitude', 'Longitude', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::number('longitude', Input::old('longitude'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company longitude')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('contact_person', 'Contact Person', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('contact_person', Input::old('contact_person'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company contact person', 'required' => 'required')) }}
                            </div>

                            {{ Form::label('skype', 'Skype Account', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('skype', Input::old('skype'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company skype account')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('twitter', 'Twitter Account', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('twitter', Input::old('twitter'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company twitter account')) }}
                            </div>

                            {{ Form::label('fb', 'Facebook Account', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('fb', Input::old('fb'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company Facebook Account')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">

                            {{ Form::label('in', 'LinkedIn Account', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('in', Input::old('in'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company LinkedIn Account')) }}
                            </div>

                            {{ Form::label('gplus', 'Google+ Account', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('gplus', Input::old('gplus'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company Google+ Account')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('operation_type', 'Operation Type', array( 'class' => 'col-lg-2 col-form-label')) }}

                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::select('operation_type', array('NaN' => 'Select a Type', 'PURCHASER' => 'Purchaser Company', 'SUPPLIER' => 'Supplier Company'), Input::old('operation_type'), array('class' => 'form-control m-input')) }}
                                </div>
                                <span class="m-form__help">Please select user group</span>
                            </div>
                            {{ Form::label('subscription_plan_type', 'Subscription Plan Type', array( 'class' => 'col-lg-2 col-form-label')) }}

                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::select('subscription_plan_type', array('NaN' => 'Select a Subscription Plan', 'FREE' => 'Free Account', 'PREMIUM' => 'Premium Account'), Input::old('subscription_plan_type'), array('class' => 'form-control m-input')) }}
                                </div>
                                <span class="m-form__help">Please select Your Subscription Plan</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('ceo', 'CEO', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('ceo', Input::old('ceo'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your company CEO')) }}
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            {{ Form::label('company_description', 'Description', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::textarea('company_description', Input::old('company_description'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Enter your company company description')) }}
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    {{ Form::submit('Update the Company!', array('class' => 'btn btn-success')) }}
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



