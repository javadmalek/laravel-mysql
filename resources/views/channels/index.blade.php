@extends('../layouts.purchaser-dashboard')

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
                                    List of your Channels
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <span class="m-section__sub">The list of all Channels of your Company are as follows: </span>
                            <div class="m-section__content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>sector</th>
                                        <th>sub sector</th>
                                        <th>group</th>
                                        <th>keywords</th>
                                        <th>publishing type</th>
                                        <th>actions
                                            <a class="btn m-btn--square  btn-outline-accent pull-right"
                                               href="{{ URL::to('purchaser/channels/create') }}">Create</a></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($channels as $key => $value)
                                        <tr>
                                            <th scope="row">{{ $value->id }}</th>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ $value->_sector_id }}</td>
                                            <td>{{ $value->_sub_sector_id }}</td>
                                            <td>{{ $value->_group_id }}</td>
                                            <td>{{ $value->keywords }}</td>
                                            <td>{{ $value->publish_type }}</td>

                                            <td>
                                                {{ Form::open(array('url' => 'purchaser/channels/' . $value->id, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-danger')) }}
                                                {{ Form::close() }}

                                                <a class="btn m-btn--square  btn-outline-info"
                                                   href="{{ URL::to('purchaser/channels/' . $value->id) }}">View</a>
                                                <a class="btn m-btn--square  btn-outline-accent"
                                                   href="{{ URL::to('purchaser/channels/' . $value->id . '/edit') }}">Edit</a>

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

