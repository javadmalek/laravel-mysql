@extends('../layouts.purchaser-dashboard')

@section('content')
    <div class="m-content">
        <!-- Begin::Inbox -->
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--mobile ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">Outbox</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Datatable -->
                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-no-border">
                                    <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Company</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($messages as $key => $value)
                                        <tr>
                                            <td scope="row">{{ $value->subject }}</td>
                                            <td>{{ $value->receiver->title }}</td>
                                            <td>{{ substr($value->message, 0, 50) }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>
                                                {{ Form::open(array('url' => 'purchaser/messages/outbox/' . $value->id, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                                    'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                                {{ Form::close() }}

                                                <a class="btn m-btn--square  btn-outline-info"
                                                   href="{{ URL::to('purchaser/messages/outbox/' . $value->id.'/show') }}">View</a>
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