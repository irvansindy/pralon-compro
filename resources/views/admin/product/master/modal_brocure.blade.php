{{-- for list data brocure --}}
<div class="modal fade" id="ModalProductBrocure" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="ModalProductBrocureLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalProductBrocureLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success btn_create_product_brocure"
                        id="btn_create_product_brocure" data-target="#ModalCreateProductBrocure" data-toggle="modal"
                        data-dismiss="modal">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_product_brocure_by_id" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File Link</th>
                                <th>Tanggal Upload</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>File Link</th>
                                <th>Tanggal Upload</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- for form create or update brocure --}}
<div class="modal fade" id="ModalCreateProductBrocure" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="ModalCreateProductBrocureLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCreateProductBrocureLabel">Master Product Brocure</h5>
                <button type="button" class="close" data-target="#ModalProductBrocure" data-toggle="modal"
                    data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="loading_spinner_brocure" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <form id="create_new_product_brocure" enctype="multipart/form-data">
                    <input type="hidden" name="product_id_for_brocure" id="product_id_for_brocure">
                    <div class="mb-3">
                        <label for="brocure_file" class="form-label">File Brocure</label>
                        <input type="file" class="form-control" name="brocure_file" id="brocure_file">
                        <span class="text-sm text-danger mt-2 message_brocure_file" id="message_brocure_file" role="alert" style="font-size: 12px !important;"></span>
                    </div>
                    <div class="mb-3">
                        <label for="brocure_date" class="form-label">effective date</label>
                        <input type="date" class="form-control" name="brocure_date" id="brocure_date">
                        <span class="text-sm text-danger mt-2 message_brocure_date" id="message_brocure_date" role="alert" style="font-size: 12px !important;"></span>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-target="#ModalProductBrocure" data-toggle="modal"
                    data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submit_new_product_brocure">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
