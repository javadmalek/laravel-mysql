@extends('../layouts.purchaser-dashboard')

@section('content')

    <div class="m-content">
        <!--Begin::Companies List-->
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    List of Companies
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <span class="m-section__sub">The list of all companies are as follows:</span>
                            <div class="m-section__content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>slug</th>
                                        <th>operation_type</th>
                                        <th>web_url</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $key => $value)
                                        <tr>
                                            <th scope="row">{{ $value->id }}</th>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->slug }}</td>
                                            <td>{{ $value->operation_type }}</td>
                                            <td>{{ $value->web_url }}</td>

                                            <td>
                                                {{ Form::open(array('url' => 'purchaser/companies/' . $value->id, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                                                {{ Form::close() }}

                                                <a class="btn btn-small btn-info"
                                                   href="{{ URL::to('purchaser/companies/' . $value->id) }}">View</a>
                                                <a class="btn btn-small btn-info"
                                                   href="{{ URL::to('purchaser/companies/' . $value->id . '/edit') }}">Edit</a>

                                            </td>
                                        </tr>
                                    @endforeach
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

