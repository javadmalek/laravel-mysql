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
                            <!-- Start Search -->
                            {{ Form::open(array('url' => 'purchaser/channels/filter', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}
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
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-no-border">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>RFQs</th>
                                        <th>publishing type</th>
                                        <th><a class="btn m-btn--square  btn-outline-info pull-right"
                                               href="{{ URL::to('purchaser/channels/create') }}">Create a New Channel</a></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($channels as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $value->id }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ count($value->rfqs) }}</td>
                                            <td>{{ $value->publish_type }}</td>

                                            <td>
                                                @if($value->canDelete())
                                                    {{ Form::open(array('url' => 'purchaser/channels/' . $value->id, 'class' => 'pull-right')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                                        'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                                    {{ Form::close() }}
                                                @endif

                                                <a class="btn m-btn--square  btn-outline-info"
                                                   href="{{ URL::to('purchaser/channels/' . $value->id) }}">View</a>
                                                <a class="btn m-btn--square  btn-outline-info"
                                                   href="{{ URL::to('purchaser/channels/' . $value->id . '/edit') }}">Edit</a>

                                            </td>
                                        </tr>
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

