<div class="col-lg-4">
    <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="flaticon-statistics"></i>
                    </span>
                    <h2 class="m-portlet__head-label m-portlet__head-label--info">
                        <span>{{ $circle->dstCompany->title }}</span>
                    </h2>
                    <div class="m-portlet__body" style="text-align: justify">
                        {{ substr($circle->dstCompany->company_description, 0, 100) }}<br/><br/>
                        <a class="btn m-btn--square  btn-outline-info"
                           href="{{ URL::to('purchaser/companies/' . $company->id) }}">View</a>
                        @if($circle->status == 'ACCEPTED')
                            <a class="btn m-btn--square  btn-outline-info"
                               href="{{ URL::to('purchaser/companies/circles/'. $circle->id.'/status/unfollow') }}">Unfollow</a>
                        @elseif($circle->status == 'REQUESTED')
                            <a class="btn m-btn--square  btn-outline-info"
                               href="{{ URL::to('purchaser/companies/circles/'. $circle->id.'/status/cancelrequest') }}">Cancel Request</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
