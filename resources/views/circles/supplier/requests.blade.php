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
                                <h3 class="m-portlet__head-text">List of Received Circle Requests </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <div class="m-section__content">
                                <div class="row">
                                    @foreach($circles as $key => $circle)
                                        <div class="col-lg-4">
                                            <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
                                                <div class="m-portlet__head">
                                                    <div class="m-portlet__head-caption">
                                                        <div class="m-portlet__head-title">
                                                            <span class="m-portlet__head-icon m--hide">
                                                                <i class="flaticon-statistics"></i>
                                                            </span>
                                                            <h2 class="m-portlet__head-label m-portlet__head-label--info">
                                                                <span>{{ $circle->srcCompany->title }}</span>
                                                            </h2>
                                                            <div class="m-portlet__body"
                                                                 style="text-align: justify">
                                                                {{ substr($circle->srcCompany->company_description, 0, 100) }}
                                                                <br/><br/>
                                                                <a class="btn m-btn--square  btn-outline-info"
                                                                   href="{{ URL::to('supplier/companies/' . $circle->srcCompany->id) }}">View</a>
                                                                <a class="btn m-btn--square  btn-outline-info"
                                                                   href="{{ URL::to('supplier/companies/circles/'. $circle->id.'/status/accept') }}">Accept Request</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection