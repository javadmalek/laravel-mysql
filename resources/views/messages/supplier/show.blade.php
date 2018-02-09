@extends('../layouts.supplier-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-diagram"></i>
                                </span>
                                <h3 class="m-portlet__head-text m--font-brand">
                                    {{ $message->subject }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        {{ $message->message }}
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>

@endsection