<div class="modal fade" id="ModalMasterProduct" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalMasterProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalMasterProductLabel">Master Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_master_product">
                <div class="modal-body">
                    <div class="row" id="master_product">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="master_product_id"
                                    id="master_product_id" readonly="true">
                                <label for="master_product_name">Product Name</label>
                                <input type="text" class="form-control" name="master_product_name"
                                    id="master_product_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="master_product_full_name">Product Full Name</label>
                                <input type="text" class="form-control" name="master_product_full_name"
                                    id="master_product_full_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="master_product_category">Product Category</label>
                                <select class="form-control" name="master_product_category" id="master_product_category"
                                    style="width: 100%">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="master_product_image">Product Image</label>
                                <div class="form_field_product_image">
                                    <input type="file" class="form-control" name="master_product_image"
                                        id="master_product_image" required>
                                </div>
                                <div class="form_field_link_product_image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="master_product_short_desc">Head Line</label>
                                <input type="text" class="form-control" name="master_product_short_desc"
                                    id="master_product_short_desc" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="master_product_main_desc">Description</label>
                                <textarea name="master_product_main_desc" id="master_product_main_desc" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <hr />
                    </div>
                    <hr class="bg-dark">
                    <div class="row" id="form_field_detail_product">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="master_product_detail_title">Title</label>
                                <input type="text" class="form-control" name="master_product_detail_title"
                                    id="master_product_detail_title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="master_product_detail_subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="master_product_detail_subtitle"
                                    id="master_product_detail_subtitle" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="form_field_detail_image">

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="master_product_detail_desc">Description</label>
                                <textarea name="master_product_detail_desc" id="master_product_detail_desc" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_form_master_product">

                </div>
            </form>
        </div>
    </div>
</div>
