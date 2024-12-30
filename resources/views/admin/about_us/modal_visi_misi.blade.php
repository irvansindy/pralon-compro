<div class="modal fade" id="modalVisiMisiAboutUs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalVisiMisiAboutUsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVisiMisiAboutUsLabel">Visi Misi About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_visi_misi_about_us">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="visi_id" id="visi_id">
                                <label for="visi">Visi</label>
                                <textarea class="form-control" name="visi" id="visi" cols="20" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="visi_misi_image">Image</label>
                                <input type="file" class="form-control" name="visi_misi_image" id="visi_misi_image">
                                <div id="link_visi_misi_image"></div>
                            </div>
                        </div>
                    </div>
                    <div class="list-misi">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="list_misi[]" id="list_misi" required placeholder="1. Misi">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info add_dynamic_form_misi"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_form_visi_misi_about_us">
                    
                </div>
            </form>
        </div>
    </div>
</div>
