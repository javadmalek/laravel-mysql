<div class="modal fade" id="model{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Catalog {{ $value->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">Title</div>
                    <div class="col-lg-3">{{$value->title}}</div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">Type</div>
                    <div class="col-lg-3">{{$value->type}}</div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-3">Application</div>
                    <div class="col-lg-3">{{ $value->application }}</div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        {{ $value->keywords }}
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-3">Standards</div>
                    <div class="col-lg-3">{{ $value->standards }}</div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">CRC</div>
                    <div class="col-lg-3">{{ $value->crc }}</div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-lg-3">Price</div>
                    <div class="col-lg-3">{{ $value->price }}</div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-3">
                        <a href="#" class="m-nav-grid__item">
                            <img src="{{ Illuminate\Support\Facades\Storage::disk('minio')->url('catalogs/'. $value->type.'/'. $value->id.'/'.$value->logo) }}"  width="100px" height="100px">
{{--                            <img href="{{ env('MINIO_ENDPOINT').'/catalogs/'. $value->type.'/'. $value->id.'/'.$value->logo }}" alt="{{ $value->title }}" width="100px" height="100px">--}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6">{{ $value->description }}</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--end::Modal-->