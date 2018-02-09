<div class="modal fade" id="terminate_status_model" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Inspecting Offers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        Purchaser Terminate Status
                    </div>
                    <div class="col-lg-6">
                        <strong> {{ $myoffer->deal->purchaser_terminate_status }}</strong>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        Purchaser Terminate Description
                    </div>
                    <div class="col-lg-6">
                        <strong> {{ $myoffer->deal->purchaser_terminate_descr }}</strong>
                    </div>
                </div>

            </div>

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        Supplier Terminate Status
                    </div>
                    <div class="col-lg-6">
                        <strong> {{ $myoffer->deal->supplier_terminate_status }}</strong>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-4">
                        Supplier Terminate Description
                    </div>
                    <div class="col-lg-6">
                       <strong> {{ $myoffer->deal->supplier_terminate_descr }}</strong>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>