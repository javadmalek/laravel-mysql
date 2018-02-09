<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                <h3 class="m-portlet__head-text">List of Pairs as (Key, Value)</h3>
                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                    <span>Media</span>
                </h2>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href=""
                       class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                       data-toggle="modal" data-target="#media_model">
                        <i class="fa fa-plus" title="Add new file"></i>
                    </a>
                </li>
            </ul>
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
                        <th>File-Type</th>
                        <th>Download</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'MEDIA') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td>{{ $value->type }}</td>
                            <td><a href="{{ $value->value }}" class="m-nav__link">
                                    <span class="m-nav__link-text">Download</span>
                                </a></td>
                            <td style="width: 35%">{{ $value->description }}</td>
                            <td>
                                @if($_editable)
                                    {{ Form::open(array('url' => 'purchaser/channels/' . $rfq->Channel->id.'/rfqs/' . $rfq->id.'/specifications/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                        'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                    {{ Form::close() }}

                                    {{--<a class="btn m-btn--square  btn-outline-accent"--}}
                                    {{--href="{{ URL::to('purchaser/channels/' . $rfq->Channel->id.'/rfqs/' . $rfq->id.'/specifications/' . $value->id . '/edit') }}">Edit</a>--}}
                                @else
                                    <span style="color: red;">NOT EDITABLE</span>
                                @endif

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

<div class="modal fade" id="media_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Adding a new Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <!--begin::Form-->
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => 'purchaser/channels/'. $_channel_id.'/rfqs/'.$rfq->id.'/specifications/store',
                        'files'=>true,
                        'method' => 'POST',
                        'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed',
                        'enctype' => 'multipart/form-data',
                        'id' => '"maskForm"')) }}

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    {{ Form::label('key', 'Subject', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        {{ Form::text('key', Input::old('key'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your key', 'required' => 'required')) }}
                    </div>

                    {{ Form::label('type', 'Currency', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        {{ Form::select('type', array('3D' => '3D', 'DRAWING' => 'DRAWING', 'TECHNICAL SPEC' => 'TECHNICAL SPEC'), Input::old('type'), array('class' => 'form-control m-input')) }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    {{ Form::label('value', 'Amount', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        {{ Form::file('value', Input::old('value'), array('class' => 'form-control m-input', 'placeholder' => 'Select your file', 'required' => 'required')) }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    {{ Form::label('description', 'Description', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        {{ Form::text('description', Input::old('description'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your description')) }}
                    </div>

                    <input id="_section" type="hidden" name="_section" value="MEDIA">
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                            {{ Form::submit('Create the Media!', array('class' => 'btn btn-success')) }}
                        </div>
                    </div>
                </div>
            </div>

        {{ Form::close() }}
        <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal-->