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
                                    List of all Catalogs
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->

                        <!-- Start Search -->
                        {{ Form::open(array('url' => 'supplier/companies/catalogs/filter', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                {{ Form::label('filter_key', 'Search for a catalog', array('class' => 'col-lg-2 col-form-label')) }}

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
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Keywords</th>
                                        <th><a class="btn m-btn--square  btn-outline-info pull-right"
                                               href="{{ URL::to('supplier/companies/catalogs/create') }}">Create a Catalog</a></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($catalogs as $key => $value)
                                        @if( $filter_key != ''
                                                  &&
                                              (strpos( strtolower($value->title), strtolower($filter_key) ) !== false ||
                                               strpos( strtolower($value->type), strtolower($filter_key) ) !== false ||
                                               strpos( strtolower($value->keywords), strtolower($filter_key) ) !== false
                                               )
                                           )
                                            <tr>
                                                <td scope="row">{{ $value->id }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ $value->type }}</td>
                                                <td>{{ $value->price }}</td>
                                                <td>{{ $value->keywords }}</td>
                                                <td>
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('supplier/companies/catalogs/' . $value->id . '/edit') }}">Edit</a>
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('supplier/companies/catalogs/' . $value->id) }}">View</a>

                                                    {{ Form::open(array('url' => 'supplier/companies/catalogs/' . $value->id, 'class' => 'pull-right')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                                        'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        @elseif( $filter_key == '')
                                            <tr>
                                                <td scope="row">{{ $value->id }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ $value->type }}</td>
                                                <td>{{ $value->price }}</td>
                                                <td>{{ $value->keywords }}</td>
                                                <td>
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="{{ URL::to('supplier/companies/catalogs/' . $value->id . '/edit') }}">Edit</a>
                                                    <a class="btn m-btn--square  btn-outline-info"
                                                       href="#" data-toggle="modal"
                                                       data-target="#model{{ $value->id }}">View</a>
                                                    @include('catalogs.supplier.show')

                                                    {{ Form::open(array('url' => 'supplier/companies/catalogs/' . $value->id, 'class' => 'pull-right')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                                        'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                                    {{ Form::close() }}

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    <tr>
                                        <td colspan="6">
                                            {{ $catalogs->links() }}
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

