<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                    <span>Dimensions</span>
                </h2>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href=""
                       class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                       data-toggle="modal" data-target="#dimension_model">
                        <i class="fa fa-plus" title="Add new property to product"></i>
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
                        <th>Title</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($channel->variables->where('variable', 'D') as $key => $value)
                        <tr>
                            <td>{{ $value->title }}</td>
                            <td>
                                {{ Form::open(array('url' => 'purchaser/channels/' . $channel->id.'/variables/' . $value->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                    'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                {{ Form::close() }}

                                <a href=""
                                   class="btn m-btn--square  btn-outline-info"
                                   data-toggle="modal" data-target="#dimension_model_edit_{{ $value->id }}">
                                    Edit
                                </a>
                                <div class="modal fade" id="dimension_model_edit_{{ $value->id }}" tabindex="-1"
                                     role="dialog" aria-labelledby="" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="">Edit a Variable of Channel</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="la la-remove"></span>
                                                </button>
                                            </div>

                                            <!--begin::Form-->
                                            <!-- if there are creation errors, they will show here -->
                                            {{ Html::ul($errors->all()) }}
                                            {{ Form::model($value, array('route' => array('purchaser.channels.{_channel_id}.variables.update', $channel->id, $value->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    {{ Form::label('title', 'Title', array('class' => 'col-lg-2 col-form-label')) }}
                                                    <div class="col-lg-6">
                                                        {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter the title of your type', 'required' => 'required')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                                                    <div class="row">
                                                        <div class="col-lg-2"></div>
                                                        <div class="col-lg-10">
                                                            {{ Form::submit('Update the Dimension!', array('class' => 'btn btn-success')) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        {{ Form::close() }}
                                        <!--end::Form-->
                                        </div>
                                    </div>
                                </div>
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

<div class="modal fade" id="dimension_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Adding a new Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <!--begin::Form-->
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => 'purchaser/channels/'. $channel->id.'/variables', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    {{ Form::label('title', 'Title', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-6">
                        {{ Form::text('title', Input::old('title'), array('class' => 'form-control m-input', 'placeholder' => 'Enter the title of your type', 'required' => 'required')) }}
                    </div>
                    <input id="variable" type="hidden" name="variable" value="D">
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                            {{ Form::submit('Create the Type!', array('class' => 'btn btn-success')) }}
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