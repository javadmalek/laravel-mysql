@if($company->id != $_src_company->id && count($circle = $_src_company->isInCircle($company->id)->get()) != 0)
    <div class="col-lg-4">
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="flaticon-statistics"></i>
                    </span>
                        <h2 class="m-portlet__head-label m-portlet__head-label--info">
                            <span>{{ $company->title }}</span>
                        </h2>
                        <div class="m-portlet__body" style="text-align: justify">
                            {{ substr($company->company_description, 0, 100) }}<br/><br/>
                            <a class="btn m-btn--square  btn-outline-info"
                               href="{{ URL::to('purchaser/companies/' . $company->id) }}">View</a>
                            @if($circle[0]->status == 'ACCEPTED')
                                <a class="btn m-btn--square  btn-outline-info"
                                   href="{{ URL::to('purchaser/companies/circles/'. $circle[0]->id.'/status/unfollow') }}">Unfollow</a>
                            @elseif($circle[0]->status == 'REQUESTED')
                                <a class="btn m-btn--square  btn-outline-info"
                                   href="{{ URL::to('purchaser/companies/circles/'. $circle[0]->id.'/status/cancelrequest') }}">Cancel Request</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($company->id != $_src_company->id)
    <div class="col-lg-4">
        <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="flaticon-statistics"></i>
                    </span>
                        <h2 class="m-portlet__head-label m-portlet__head-label--info">
                            <span>{{ $company->title }}</span>
                        </h2>
                        <div class="m-portlet__body" style="text-align: justify">
                            {{ substr($company->company_description, 0, 100) }}<br/><br/>
                            <a class="btn m-btn--square  btn-outline-info" href="{{ URL::to('purchaser/companies/' . $company->id) }}">View</a>
                            @if(count($circle = $_src_company->amInCircle($company->id)->get()) != 0)
                                <a class="btn m-btn--square  btn-outline-info"
                                   href="{{ URL::to('purchaser/companies/circles/' . $circle[0]->id.'/status/accept') }}">Accept Request</a>
                            @else
                                <a class="btn m-btn--square  btn-outline-info"
                                   href="{{ URL::to('purchaser/companies/circles/request/' . $company->id) }}">Friend Request</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif