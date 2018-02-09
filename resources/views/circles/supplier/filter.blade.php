@extends('../layouts.supplier-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">Companies in the platform</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <!-- Start Search -->
                            {{ Form::open(array('url' => 'supplier/companies/circles/filter', 'method' => 'POST',
                                                'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}
                            <div class="m-portlet__body">

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <select class="form-control m-select2" id="m_select2_3"
                                                    name="_dst_company_id[]" multiple="multiple">
                                                @foreach($companies as $key => $company)
                                                    <option value="{{ $company->id }}"> {{ $company->title }} </option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-btn">
                                                {{ Form::submit('Go!', array('class' => 'btn btn-primary')) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{ Form::close() }}
                            <!-- End Search -->

                            <div class="m-section__content">
                                @if(count($filteredCompanies) != 0)
                                    <div class="row">
                                        @foreach($filteredCompanies as $key => $company)
                                            @include('circles.supplier.contact')
                                        @endforeach
                                    </div>
                                @else
                                    <div class="row">
                                        @foreach($companies as $key => $company)
                                            @include('circles.supplier.contact')
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection