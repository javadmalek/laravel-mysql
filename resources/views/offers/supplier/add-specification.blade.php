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
    </div>

    <div class="m-portlet__body">
        <!--begin: Datatable -->
        <div class="m-section">
            <div class="m-section__content">
                <table class="table m-table m-table--head-no-border">
                    <thead>
                    <tr>
                        <th>Key</th>
                        <th>Description</th>
                        <th>RFQ Values<BR />
                        <span> The RFQ values as default, You can modify it.</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rfq->rfqSpecifications->where('_section', 'SPEC') as $key => $value)
                        <tr>
                            <td>{{ $value->key }}</td>
                            <td style="width: 35%">{{ $value->description }}</td>
                            <td>
                                @if ( $value->is_mandatory == 'YES')
                                    {{ $value->value }}

                                @elseif ( $value->type == 'TEXT')
                                    <input type="text" class="form-control m-input" id="key{{$value->id}}"
                                           name="key{{$value->id}}"
                                           value="{{ $value->value }}" placeholder="Enter your{{$value->key }}"
                                           required="required">

                                @else
                                    <select id="key{{$value->id}}" name="key{{$value->id}}" class="form-control m-input">
                                    @if ( $value->type == 'YESNO')
                                        <option value="YES" @if ( $value->value == 'YES') selected @endif >YES</option>
                                        <option value="NO" @if ( $value->value == 'NO') selected @endif >NO</option>
                                    @elseif ( $value->type == 'DELIVERY')
                                        <option value="EXW" @if($value->value == 'EXW') selected @endif>EXW</option>
                                        <option value="FCA" @if($value->value == 'FCA') selected @endif>FCA</option>
                                        <option value="CIP" @if($value->value == 'CIP') selected @endif>CIP</option>
                                        <option value="DAP" @if($value->value == 'DAP') selected @endif>DAP</option>
                                        <option value="DAT" @if($value->value == 'DAT') selected @endif>DAT</option>
                                        <option value="DDP" @if($value->value == 'DDP') selected @endif>DDP</option>
                                        <option value="OTHERSDEL" @if($value->value == 'OTHERSDEL') selected @endif>OTHERS</option>
                                    @elseif ( $value->type == 'INJECTSYSTEM')
                                        <option value="HOTRUNNER" @if($value->value == 'HOTRUNNER') selected @endif>HOT RUNNER</option>
                                        <option value="HOTNOZZLE" @if($value->value == 'HOTNOZZLE') selected @endif>HOT NOZZLE</option>
                                        <option value="COLDRUNNER" @if($value->value == 'COLDRUNNER') selected @endif>COLD RUNNER</option>
                                        <option value="OTHERSINJ" @if($value->value == 'OTHERSINJ') selected @endif>OTHERS</option>
                                    @elseif ( $value->type == 'MOLDFLOWSIMULATION')
                                        <option value="FILLING" @if($value->value == 'FILLING') selected @endif>FILLING</option>
                                        <option value="CODING" @if($value->value == 'CODING') selected @endif>CODING</option>
                                        <option value="SHRINKAGE" @if($value->value == 'SHRINKAGE') selected @endif>SHRINKAGE</option>
                                        <option value="WARPAGE" @if($value->value == 'WARPAGE') selected @endif>WARPAGE</option>
                                        <option value="OTHERSMOLD" @if($value->value == 'OTHERSMOLD') selected @endif>OTHERS</option>
                                    @endif
                                    </select>
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