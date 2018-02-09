@extends('../layouts.supplier-dashboard')
@section('page-title','Profile')

@section('content')

    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">

                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                <h3 class="m-portlet__head-text">Create a Catalog</h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'supplier/companies/catalogs/',
                                        'files'=>true,
                                        'enctype' => 'multipart/form-data',
                                        'method' => 'POST',
                                        'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed',
                                        'id' => '"maskForm"')) }}

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            {{ Form::label('title', 'Catalog Title', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Catalog Title', 'required' => 'required')) }}
                                <span class="m-form__help">Please enter your Catalog Title</span>
                            </div>

                            {{ Form::label('type', 'Catalog Type', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                <div class="m-radio-inline">
                                    {{ Form::select('type', array('PRO' => 'PRODUCT', 'SERVICE' => 'SER', 'MAC' => 'MACHINE'), Input::old('type'), array('class' => 'form-control m-input')) }}
                                </div>
                                <span class="m-form__help">Please select the type of catalog</span>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('application', 'Catalog Application', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('application', Input::old('application'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Catalog Application', 'required' => 'required')) }}
                                <span class="m-form__help">Please enter your Catalog Application</span>
                            </div>

                            {{ Form::label('keywords', 'Keywords', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('keywords', Input::old('keywords'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your catalog Keywords')) }}
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('standards', 'Catalog Standards', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('standards', Input::old('standards'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Catalog Standards', 'required' => 'required')) }}
                                <span class="m-form__help">Please enter your Catalog Standards</span>
                            </div>

                            {{ Form::label('crc', 'CRC', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('crc', Input::old('crc'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your catalog CRC')) }}
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('price', 'Price', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::text('price', Input::old('price'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your Catalog Price', 'required' => 'required')) }}
                                <span class="m-form__help">Please enter your Catalog Price</span>
                            </div>

                            {{ Form::label('logo', 'Logo', array('class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-3">
                                {{ Form::file('logo', Input::old('logo'), array('class' => 'form-control m-input', 'placeholder' => 'Select your Logo', 'required' => 'required')) }}
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            {{ Form::label('description', 'Description', array( 'class' => 'col-lg-2 col-form-label')) }}
                            <div class="col-lg-6">
                                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Enter your catalog description')) }}
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-10">
                                    {{ Form::submit('Create the Catalog!', array('class' => 'btn btn-success')) }}
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



