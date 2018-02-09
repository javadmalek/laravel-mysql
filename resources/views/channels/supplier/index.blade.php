@extends('../layouts.supplier-dashboard')

@section('content')

    <div class="m-content">
        <!--Begin::Channels List-->
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    List of all Channels
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->

                        <!-- Start Search -->
                        {{ Form::open(array('url' => 'supplier/channels/filter', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                {{ Form::label('filter_key', 'Search for a channel', array('class' => 'col-lg-2 col-form-label')) }}

                                <div class="col-lg-6">
                                    <div class="input-group">
                                        {{ Form::text('filter_key', Input::old('filter_key'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your search key')) }}
                                        <span class="input-group-btn">
                                                {{ Form::submit('Go!', array('class' => 'btn btn-primary')) }}
											</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <!-- End Search -->

                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-no-border">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Purchaser</th>
                                        <th>title</th>
                                        <th>RFQs</th>
                                        <th>publishing type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($channels as $key => $value)
                                        @if( $filter_key != ''
                                                      &&
                                                  (strpos( strtolower($value->company->title), strtolower($filter_key) ) !== false ||
                                                   strpos( strtolower($value->title), strtolower($filter_key) ) !== false ||
                                                   strpos( strtolower($value->publish_type), strtolower($filter_key) ) !== false
                                                   )
                                               )
                                            <tr>
                                                <td scope="row">{{ $value->id }}</td>
                                                <td>{{ $value->company->title }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ count($value->rfqsNotDrafted) }}</td>
                                                <td>{{ $value->publish_type }}</td>
                                                <td>
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('supplier/channels/' . $value->id) }}">View</a>
                                                </td>
                                            </tr>
                                        @elseif( $filter_key == '')
                                            <tr>
                                                <td scope="row">{{ $value->id }}</td>
                                                <td>{{ $value->company->title }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ count($value->rfqsNotDrafted) }}</td>
                                                <td>{{ $value->publish_type }}</td>
                                                <td>
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('supplier/channels/' . $value->id) }}">View</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                   <tr>
                                       <td colspan="5">
                                           {{ $channels->links() }}
                                       </td>
                                   </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
        <!--End::Companies List-->
    </div>

@endsection

