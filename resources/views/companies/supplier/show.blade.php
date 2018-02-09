@extends('../layouts.supplier-dashboard')
@section('page-title','Profile')

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-8">
                <!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text"> {{ $company->title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_1" role="tab" aria-expanded="false">
                                    Overview
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_2" role="tab" aria-expanded="false">
                                    Information
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_3" role="tab" aria-expanded="true">
                                    Contacts
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_tabs_1" role="tabpanel">
                                {{ $company->company_description }}
                            </div>
                            <div class="tab-pane" id="m_tabs_2" role="tabpanel">
                                <div class="m-widget13">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">CO-Founder</span>
                                        <span class="m-widget13__text m-widget13__text-bolder" style="width: 35%;text-align: left;">{{ $company->co_founder }}</span>
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">CEO</span>
                                        <span class="m-widget13__text m-widget13__text-bolder" style="width: 35%;text-align: left;">{{ $company->ceo }}</span>
                                    </div>
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">CTO</span>
                                        <span class="m-widget13__text" style="width: 35%;text-align: left;">{{ $company->cto }}</span>
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">Founding Year:</span>
                                        <span class="m-widget13__text" style="width: 35%;text-align: left;">{{ $company->founding_year }}</span>
                                    </div>
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">Employee Amount:</span>
                                        <span class="m-widget13__text m-widget13__text-bolder" style="width: 35%;text-align: left;">{{ $company->employee_number  }}</span>
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">Turnover:</span>
                                        <span class="m-widget13__text m-widget13__text-bolder" style="width: 35%;text-align: left;">{{ $company->turnover }}</span>
                                    </div>
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">Vat:</span>
                                        <span class="m-widget13__text" style="width: 35%;text-align: left;">{{ $company->vat  }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_tabs_3" role="tabpanel">
                                <div class="m-widget13">
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">Address</span>
                                        <span class="m-widget13__text m-widget13__text-bolder" style="width: 35%;text-align: left;">{{ $company->office_address }}, {{ $company->country_name }}</span>
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">Telephone Number</span>
                                        <span class="m-widget13__text m-widget13__text-bolder" style="width: 35%;text-align: left;">{{ $company->office_tele }}</span>
                                    </div>
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc m--align-right" style="width: 15%;text-align: left;">Contact Person</span>
                                        <span class="m-widget13__text" style="width: 35%;text-align: left;">{{ $company->contact_person }}</span>
                                    </div>
                                    <div class="m-widget13__item">
                                        <span class="m-widget13__desc m--align-right" style="width: 10%;"><a href="{{ $company->skype  }}">
                                                <div class="m-demo-icon">
													<div class="m-demo-icon__preview">
														<i class="fa fa-skype"></i>
													</div>
												</div>
                                            </a></span>
                                        <span class="m-widget13__desc m--align-right" style="width: 10%;"><a href="{{ $company->fb  }}">
                                            <div class="m-demo-icon">
													<div class="m-demo-icon__preview">
														<i class="fa fa-facebook-square"></i>
													</div>
												</div>
                                            </a></span>
                                        <span class="m-widget13__desc m--align-right" style="width: 10%;"><a href="{{ $company->in  }}">
                                                <div class="m-demo-icon">
													<div class="m-demo-icon__preview">
														<i class="fa fa-linkedin-square"></i>
													</div>
												</div>
                                            </a></span>
                                        <span class="m-widget13__desc m--align-right" style="width: 10%;"><a href="{{ $company->gplus  }}">
                                                <div class="m-demo-icon">
													<div class="m-demo-icon__preview">
														<i class="fa fa-google-plus-official"></i>
													</div>
												</div>
                                            </a></span>
                                        <span class="m-widget13__desc m--align-right" style="width: 10%;"><a href="{{ $company->twitter  }}">
                                                <div class="m-demo-icon">
													<div class="m-demo-icon__preview">
														<i class="fa fa-twitter-square"></i>
													</div>
												</div>
                                            </a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-separator m-separator--dashed"></div>
                    </div>
                </div>
                <!--end::Portlet-->

                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Support Tickets
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                        <i class="la la-ellipsis-h m--font-brand"></i>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <span class="m-nav__link-text">New Product</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <span class="m-nav__link-text">New Service</span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <span class="m-nav__link-text">New Machine</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_categorization_1" role="tab" aria-expanded="false">
                                    Products
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_categorization_2" role="tab" aria-expanded="false">
                                    Services
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_categorization_3" role="tab" aria-expanded="true">
                                    Machines
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_tabs_categorization_1" role="tabpanel">
                                <div class="m-nav-grid">
                                    <div class="m-nav-grid__row">
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Product 1</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Product 2</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Product 3</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Product 4</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Product 5</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Product 6</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_tabs_categorization_2" role="tabpanel">
                                <div class="m-nav-grid">
                                    <div class="m-nav-grid__row">
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Service 1</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Service 2</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Service 3</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Service 4</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Service 5</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Service 6</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="m_tabs_categorization_3" role="tabpanel">
                                <div class="m-nav-grid">
                                    <div class="m-nav-grid__row">
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Machine 1</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Machine 2</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Machine 3</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Machine 4</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Machine 5</span>
                                        </a>
                                        <a href="#" class="m-nav-grid__item">
                                            <img src="../../assets/app/media/img//blog/blog1.jpg" alt="" width="100px" height="100px">
                                            <span class="m-nav-grid__text">Machine 6</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <!--begin:: Widgets-->
                <div class="m-portlet m-portlet--bordered-semi ">
                    <div class="m-portlet__head m-portlet__head--fit">
                        <div class="m-portlet__head-caption"></div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides">
                                <img src="../../assets/app/media/img//blog/blog1.jpg" alt="">
                                <h3 class="m-widget19__title m--font-light">{{ $company->title }}</h3>
                                <div class="m-widget19__shadow"></div>
                            </div>
                            <div class="m-widget19__content">
                                <div class="m-widget19__header">
                                    <div class="m-widget19__user-img">
                                        <img class="m-widget19__img" src="../../assets/app/media/img//users/user1.jpg"
                                             alt="">
                                    </div>
                                    <div class="m-widget19__info">
                                        <span class="m-widget19__username">Anna Krox</span> <br>
                                        <span class="m-widget19__time">UX/UI Designer, Google</span>
                                    </div>
                                    <div class="m-widget19__stats">
                                        <span class="m-widget19__number m--font-brand">18</span>
                                        <span class="m-widget19__comment">RFQs</span>
                                    </div>
                                    <div class="m-widget19__stats">
                                        <span class="m-widget19__number m--font-brand">5</span>
                                        <span class="m-widget19__comment">Deals</span>
                                    </div>
                                </div>
                                <div class="m-widget19__body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets-->

                {{--begin:: Statistics Widget --}}
                <div class="m-portlet m-portlet--bordered-semi ">
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__content">
                                <div class="m-widget25">
                                    <span class="m-widget25__price m--font-brand">
                                        $237,650
                                    </span>
                                    <span class="m-widget25__desc">
                                        Total Requests
                                    </span>
                                    <div class="m-widget25--progress">
                                        <div class="m-widget25__progress">
                                            <span class="m-widget25__progress-number">
                                                63%
                                            </span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-danger" role="progressbar"
                                                     style="width: 63%;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="m-widget25__progress-sub">
                                                Sales Growth
                                            </span>
                                        </div>
                                        <div class="m-widget25__progress">
                                            <span class="m-widget25__progress-number">
                                                39%
                                            </span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-accent" role="progressbar"
                                                     style="width: 39%;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="m-widget25__progress-sub">
                                                Product Growth
                                            </span>
                                        </div>
                                        <div class="m-widget25__progress">
                                            <span class="m-widget25__progress-number">
                                                54%
                                            </span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-warning" role="progressbar"
                                                     style="width: 54%;" aria-valuenow="50" aria-valuemin="0"
                                                     aria-valuemax="100"></div>
                                            </div>
                                            <span class="m-widget25__progress-sub">
                                                Community Growth
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end:: Statistics Widget --}}
            </div>
        </div>

    </div>

@endsection