<div class="modal fade" id="ModalHomePageSetting" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="ModalHomePageSettingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalHomePageSettingLabel">Master Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_master_section">
                <div class="modal-body">
                    <div class="row" id="master_product">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="master_section_id"
                                    id="master_section_id" readonly="true">
                                <label for="master_section_title">Title</label>
                                <input type="text" class="form-control" name="master_section_title"
                                    id="master_section_title" placeholder="Title Section" required>
                            </div>
                            <div class="form-group">
                                <label for="master_product_description">Description</label>
                                <textarea class="form-control" name="master_product_description" id="master_product_description" cols="20"
                                    rows="5" placeholder="Description Section" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="button_action_form_master_section">

                    </div>
            </form>
        </div>
    </div>
</div>
