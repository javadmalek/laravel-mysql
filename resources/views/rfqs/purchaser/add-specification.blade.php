<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="flaticon-statistics"></i>
                                </span>
                <h3 class="m-portlet__head-text">List of Pairs as (Key, Value)</h3>
                <h2 class="m-portlet__head-label m-portlet__head-label--info">
                    <span>Specifications</span>
                </h2>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href=""
                       class="m-portlet__nav-link btn btn-secondary m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                       data-toggle="modal" data-target="#specification_model">
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
                        <th>Key</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Is mandatory?</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'SPEC') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td>{{ $value->type }}</td>
                            <td>{{ $value->value }}</td>
                            <td>{{ $value->is_mandatory }}</td>
                            <td style="width: 35%">{{ $value->description }}</td>
                            <td>
                                @if($_editable)
                                    {{ Form::open(array('url' => 'purchaser/channels/' . $rfq->Channel->id.'/rfqs/' . $rfq->id.'/specifications/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete', array('class' => 'btn m-btn--square  btn-outline-info',
                                                        'onclick' => 'return confirm(\'Are you sure you want to delete?\')')) }}
                                    {{ Form::close() }}

                                    <a href=""
                                       class="btn m-btn--square  btn-outline-info"
                                       data-toggle="modal" data-target="#specification_model_edit_{{ $value->id }}">
                                        Edit
                                    </a>

                                    <div class="modal fade" id="specification_model_edit_{{ $value->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="">Edit a Specification</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true" class="la la-remove"></span>
                                                    </button>
                                                </div>

                                                <!--begin::Form-->
                                                <!-- if there are creation errors, they will show here -->
                                                {{ Html::ul($errors->all()) }}
                                                {{ Form::model($value, array('route' => array('purchaser.channels.{_channel_id}.rfqs.{_rfq_id}.specifications.update', $_channel_id, $rfq->id, $value->id), 'method' => 'PUT', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

                                                <div class="m-portlet__body">
                                                    <div class="form-group m-form__group row">
                                                        {{ Form::label('key', 'Key', array('class' => 'col-lg-2 col-form-label')) }}
                                                        <div class="col-lg-3">
                                                            {{ Form::text('key', Input::old('key'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your key', 'required' => 'required')) }}
                                                        </div>

                                                        {{ Form::label('type', 'Type of key', array('class' => 'col-lg-2 col-form-label')) }}
                                                        <div class="col-lg-3">
                                                            {{ Form::select('type', array('TEXT' => 'Text Box',
                                                                                          'YESNO' => 'YES / NO',
                                                                                          'DELIVERY' => 'DELIVERY',
                                                                                          'INJECTSYSTEM' => 'INJECTION SYSTEM',
                                                                                          'MOLDFLOWSIMULATION' => 'MOLD FLOW SIMULATION'
                                                                                          ), Input::old('type'), array('class' => 'form-control m-input',
                                                                                                                       'onchange'=>'changeSelect'.$value->id.'(this)',
                                                                                                                       'onfocus'=>'changeSelect'.$value->id.'(this)',
                                                                                                                       'onclick'=>'changeSelect'.$value->id.'(this)'))
                                                            }}
                                                        </div>

                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        {{ Form::label('value', 'Value', array('class' => 'col-lg-2 col-form-label')) }}
                                                        <div class="col-lg-3">
                                                            <input type="text" name="valueTEXT" id="valueTEXT{{$value->id}}" class="form-control m-input" value="{{$value->value}}" />
                                                            <select class="form-control m-input" id="valueYESNO{{$value->id}}" name="valueYESNO" >
                                                                <option value="YES">YES</option>
                                                                <option value="NO">NO</option>
                                                            </select>

                                                            <select class="form-control m-input" id="valueDELIVERY{{$value->id}}" name="valueDELIVERY" >
                                                                <option value="EXW" @if($value->value == 'EXW') selected @endif>EXW</option>
                                                                <option value="FCA" @if($value->value == 'FCA') selected @endif>FCA</option>
                                                                <option value="CIP" @if($value->value == 'CIP') selected @endif>CIP</option>
                                                                <option value="DAP" @if($value->value == 'DAP') selected @endif>DAP</option>
                                                                <option value="DAT" @if($value->value == 'DAT') selected @endif>DAT</option>
                                                                <option value="DDP" @if($value->value == 'DDP') selected @endif>DDP</option>
                                                                <option value="OTHERSDEL" @if($value->value == 'OTHERSDEL') selected @endif>OTHERS</option>
                                                            </select>

                                                            <select class="form-control m-input" id="valueINJECTSYSTEM{{$value->id}}" name="valueINJECTSYSTEM" >
                                                                <option value="HOTRUNNER" @if($value->value == 'HOTRUNNER') selected @endif>HOT RUNNER</option>
                                                                <option value="HOTNOZZLE" @if($value->value == 'HOTNOZZLE') selected @endif>HOT NOZZLE</option>
                                                                <option value="COLDRUNNER" @if($value->value == 'COLDRUNNER') selected @endif>COLD RUNNER</option>
                                                                <option value="OTHERSINJ" @if($value->value == 'OTHERSINJ') selected @endif>OTHERS</option>
                                                            </select>

                                                            <select class="form-control m-input" id="valueMOLDFLOWSIMULATION{{$value->id}}" name="valueMOLDFLOWSIMULATION" >
                                                                <option value="FILLING" @if($value->value == 'FILLING') selected @endif>FILLING</option>
                                                                <option value="CODING" @if($value->value == 'CODING') selected @endif>CODING</option>
                                                                <option value="SHRINKAGE" @if($value->value == 'SHRINKAGE') selected @endif>SHRINKAGE</option>
                                                                <option value="WARPAGE" @if($value->value == 'WARPAGE') selected @endif>WARPAGE</option>
                                                                <option value="OTHERSMOLD" @if($value->value == 'OTHERSMOLD') selected @endif>OTHERS</option>
                                                            </select>
                                                        </div>

                                                        <script type="text/javascript">
                                                            function changeSelect{{$value->id}}(select) {
                                                                var whichSelected = select.selectedIndex;
                                                                var value = select.options[whichSelected].value;

                                                                document.getElementById('valueTEXT{{$value->id}}').style.display = "none";
                                                                document.getElementById('valueYESNO{{$value->id}}').style.display = "none";
                                                                document.getElementById('valueDELIVERY{{$value->id}}').style.display = "none";
                                                                document.getElementById('valueINJECTSYSTEM{{$value->id}}').style.display = "none";
                                                                document.getElementById('valueMOLDFLOWSIMULATION{{$value->id}}').style.display = "none";

                                                                switch (value) {
                                                                    case 'TEXT':
                                                                        document.getElementById('valueTEXT{{$value->id}}').style.display = "block";
                                                                        break;
                                                                    case 'YESNO':
                                                                        document.getElementById('valueYESNO{{$value->id}}').style.display = "block";
                                                                        break;
                                                                    case 'DELIVERY':
                                                                        document.getElementById('valueDELIVERY{{$value->id}}').style.display = "block";
                                                                        break;
                                                                    case 'INJECTSYSTEM':
                                                                        document.getElementById('valueINJECTSYSTEM{{$value->id}}').style.display = "block";
                                                                        break;
                                                                    case "MOLDFLOWSIMULATION":
                                                                        document.getElementById('valueMOLDFLOWSIMULATION{{$value->id}}').style.display = "block";
                                                                        break;
                                                                    default:
                                                                        alert('error');
                                                                }
                                                            }

                                                            document.getElementById('valueTEXT{{$value->id}}').style.display = "none";
                                                            document.getElementById('valueYESNO{{$value->id}}').style.display = "none";
                                                            document.getElementById('valueDELIVERY{{$value->id}}').style.display = "none";
                                                            document.getElementById('valueINJECTSYSTEM{{$value->id}}').style.display = "none";
                                                            document.getElementById('valueMOLDFLOWSIMULATION{{$value->id}}').style.display = "none";

                                                        </script>

                                                        {{ Form::label('is_mandatory', 'Is it mandatory?', array( 'class' => 'col-lg-2 col-form-label')) }}
                                                        <div class="col-lg-4">
                                                            <div class="m-radio-inline">
                                                                {{ Form::select('is_mandatory', array('YES' => 'YES', 'NO' => 'NO'), $value->is_mandatory, array('class' => 'form-control m-input')) }}
                                                            </div>
                                                            <span class="m-form__help">If YES: The supplier has to confirm your value as the offered value.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        {{ Form::label('description', 'Description', array('class' => 'col-lg-2 col-form-label')) }}
                                                        <div class="col-lg-6">
                                                            {{ Form::text('description', Input::old('description'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your description')) }}
                                                        </div>

                                                        <input id="_section" type="hidden" name="_section" value="SPEC">
                                                    </div>
                                                </div>
                                                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                    <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                                                        <div class="row">
                                                            <div class="col-lg-2"></div>
                                                            <div class="col-lg-10">
                                                                {{ Form::submit('Update the Key!', array('class' => 'btn btn-success')) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            {{ Form::close() }}
                                            <!--end::Form-->
                                            </div>
                                        </div>
                                    </div>
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

<div class="modal fade" id="specification_model" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Adding a new Specification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <!--begin::Form-->
            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::open(array('url' => 'purchaser/channels/'. $_channel_id.'/rfqs/'.$rfq->id.'/specifications/store', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'id' => '"maskForm"')) }}

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    {{ Form::label('key', 'Key', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        {{ Form::text('key', Input::old('key'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your key', 'required' => 'required')) }}
                    </div>

                    {{ Form::label('type', 'Type of key', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        {{ Form::select('type', array('TEXT' => 'Text Box',
                                                      'YESNO' => 'YES / NO',
                                                      'DELIVERY' => 'DELIVERY',
                                                      'INJECTSYSTEM' => 'INJECTION SYSTEM',
                                                      'MOLDFLOWSIMULATION' => 'MOLD FLOW SIMULATION'
                                                      ), Input::old('type'), array('class' => 'form-control m-input',
                                                                                   'onchange'=>'changeSelect(this)',
                                                                                   'onfocus'=>'changeSelect(this)',
                                                                                   'onclick'=>'changeSelect(this)'))
                        }}
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    {{ Form::label('value', 'Value', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        <input type="text" name="valueTEXT" id="valueTEXT" class="form-control m-input" />
                        <select class="form-control m-input" id="valueYESNO" name="valueYESNO" >
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>

                        <select class="form-control m-input" id="valueDELIVERY" name="valueDELIVERY" >
                            <option value="EXW" @if($value->value == 'EXW') selected @endif>EXW</option>
                            <option value="FCA" @if($value->value == 'FCA') selected @endif>FCA</option>
                            <option value="CIP" @if($value->value == 'CIP') selected @endif>CIP</option>
                            <option value="DAP" @if($value->value == 'DAP') selected @endif>DAP</option>
                            <option value="DAT" @if($value->value == 'DAT') selected @endif>DAT</option>
                            <option value="DDP" @if($value->value == 'DDP') selected @endif>DDP</option>
                            <option value="OTHERSDEL" @if($value->value == 'OTHERSDEL') selected @endif>OTHERS</option>
                        </select>

                        <select class="form-control m-input" id="valueINJECTSYSTEM" name="valueINJECTSYSTEM" >
                            <option value="HOTRUNNER" @if($value->value == 'HOTRUNNER') selected @endif>HOT RUNNER</option>
                            <option value="HOTNOZZLE" @if($value->value == 'HOTNOZZLE') selected @endif>HOT NOZZLE</option>
                            <option value="COLDRUNNER" @if($value->value == 'COLDRUNNER') selected @endif>COLD RUNNER</option>
                            <option value="OTHERSINJ" @if($value->value == 'OTHERSINJ') selected @endif>OTHERS</option>
                        </select>

                        <select class="form-control m-input" id="valueMOLDFLOWSIMULATION" name="valueMOLDFLOWSIMULATION" >
                            <option value="FILLING" @if($value->value == 'FILLING') selected @endif>FILLING</option>
                            <option value="CODING" @if($value->value == 'CODING') selected @endif>CODING</option>
                            <option value="SHRINKAGE" @if($value->value == 'SHRINKAGE') selected @endif>SHRINKAGE</option>
                            <option value="WARPAGE" @if($value->value == 'WARPAGE') selected @endif>WARPAGE</option>
                            <option value="OTHERSMOLD" @if($value->value == 'OTHERSMOLD') selected @endif>OTHERS</option>
                        </select>
                    </div>
                    <script type="text/javascript">
                        function changeSelect(select) {
                            var whichSelected = select.selectedIndex;
                            var value = select.options[whichSelected].value;

                            document.getElementById('valueTEXT').style.display = "none";
                            document.getElementById('valueYESNO').style.display = "none";
                            document.getElementById('valueDELIVERY').style.display = "none";
                            document.getElementById('valueINJECTSYSTEM').style.display = "none";
                            document.getElementById('valueMOLDFLOWSIMULATION').style.display = "none";

                            switch (value) {
                                case 'TEXT':
                                    document.getElementById('valueTEXT').style.display = "block";
                                    break;
                                case 'YESNO':
                                    document.getElementById('valueYESNO').style.display = "block";
                                    break;
                                case 'DELIVERY':
                                    document.getElementById('valueDELIVERY').style.display = "block";
                                    break;
                                case 'INJECTSYSTEM':
                                    document.getElementById('valueINJECTSYSTEM').style.display = "block";
                                    break;
                                case "MOLDFLOWSIMULATION":
                                    document.getElementById('valueMOLDFLOWSIMULATION').style.display = "block";
                                    break;
                                default:
                                    alert('error');
                            }
                        }

                        document.getElementById('valueTEXT').style.display = "none";
                        document.getElementById('valueYESNO').style.display = "none";
                        document.getElementById('valueDELIVERY').style.display = "none";
                        document.getElementById('valueINJECTSYSTEM').style.display = "none";
                        document.getElementById('valueMOLDFLOWSIMULATION').style.display = "none";

                    </script>

                    {{ Form::label('is_mandatory', 'Is it mandatory?', array( 'class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-4">
                        <div class="m-radio-inline">
                            {{ Form::select('is_mandatory', array('YES' => 'YES', 'NO' => 'NO'), $value->is_mandatory, array('class' => 'form-control m-input')) }}
                        </div>
                        <span class="m-form__help">If YES: The supplier has to confirm your value as the offered value.</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    {{ Form::label('description', 'Description', array('class' => 'col-lg-2 col-form-label')) }}
                    <div class="col-lg-3">
                        {{ Form::text('description', Input::old('description'), array('class' => 'form-control m-input', 'placeholder' => 'Enter your description')) }}
                    </div>

                    <input id="_section" type="hidden" name="_section" value="SPEC">
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--solid m-form__actions--right">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-10">
                            {{ Form::submit('Create the Key!', array('class' => 'btn btn-success')) }}
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