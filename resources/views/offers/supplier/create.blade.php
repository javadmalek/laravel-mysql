@extends('../layouts.supplier-dashboard')
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
                                <h3 class="m-portlet__head-text"><b>{{ $rfq->title }}</b></h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                <div>Number of MOLD: {{ $rfq->number_mold }}</div>
                                <pre>{{ $rfq->description  }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>

        {{ Html::ul($errors->all()) }}
        {{ Form::open(array('url' => 'supplier/channels/'. $_channel_id.'/'.$rfq->id.'/offers', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

        <div class="row">
            <div class="col-xl-12">
                @include('offers.supplier.add-specification')
            </div>
            <div class="col-xl-12">
                @include('offers.supplier.add-schedule')
            </div>
            <div class="col-xl-12">
                @include('offers.supplier.add-price')
            </div>
            <div class="col-xl-12">
                {{--@include('offers.supplier.add-media')--}}

                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-12">
                                {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control m-input m-input--air', 'placeholder' => 'Description')) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                                {{ Form::submit('Save OFFER!', array('class' => 'btn btn-success')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ Form::close() }}
        <!--end::Form-->
    </div>

@endsection



