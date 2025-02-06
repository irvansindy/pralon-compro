<div class="modal fade" id="ModalEmailTemplate" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="ModalEmailTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEmailTemplateLabel"></h5>
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
                <form id="form_email_template" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_email_template" id="id_email_template">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type_email_template" class="form-label">Type</label>
                                <input type="text" class="form-control" name="type_email_template" id="type_email_template">
                                <span class="text-sm text-danger mt-2 message_type_email_template" id="message_type_email_template" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name_email_template" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name_email_template" id="name_email_template">
                                <span class="text-sm text-danger mt-2 message_name_email_template" id="message_name_email_template" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="subject_email_template" class="form-label">Subject</label>
                                <input type="text" class="form-control" name="subject_email_template" id="subject_email_template">
                                <span class="text-sm text-danger mt-2 message_subject_email_template" id="message_subject_email_template" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="header_email_template" class="form-label">Header</label>
                                <input type="text" class="form-control" name="header_email_template" id="header_email_template">
                                <span class="text-sm text-danger mt-2 message_header_email_template" id="message_header_email_template" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body_email_template" class="form-label">Body and Footer</label>
                        <textarea type="text" class="form-control" name="body_email_template" id="body_email_template"></textarea>
                        <span class="text-sm text-danger mt-2 message_body_email_template" id="message_body_email_template" role="alert" style="font-size: 12px !important;"></span>
                    </div>
            </div>
            <div class="modal-footer" id="button_action_email_template">
                
            </div>
            </form>
        </div>
    </div>
</div>
