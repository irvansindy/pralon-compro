<div class="modal fade" id="modalWhyPralonAboutUs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalWhyPralonAboutUsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalWhyPralonAboutUsLabel">Why Pralon About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_why_pralon_about_us">
                <div class="modal-body">
                    <span class="text-info">Master/header</span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="why_pralon_id" id="why_pralon_id"
                                    readonly="true">
                                <label for="why_pralon_title">Title</label>
                                <input type="text" class="form-control" name="why_pralon_title" id="why_pralon_title"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="why_pralon_subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="why_pralon_subtitle"
                                    id="why_pralon_subtitle" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="why_pralon_image">Image</label>
                                <input type="file" class="form-control" name="why_pralon_image" id="why_pralon_image"
                                    required>
                                    <div id="link_why_pralon_image"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="why_pralon_desc">Desc</label>
                                <textarea class="form-control" name="why_pralon_desc" id="why_pralon_desc" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <span class="text-info">Detail</span>
                    <div class="list-detail-why-pralon">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="detail_why_pralon_title[]"
                                        id="detail_why_pralon_title_0" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="detail_why_pralon_icon[]"
                                        id="detail_why_pralon_icon_0" placeholder="Code Icon" required>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="detail_why_pralon_desc[]"
                                        id="detail_why_pralon_desc_0" placeholder="Desc" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-info add_dynamic_detail_why"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" id="button_action_form_why_pralon_about_us">

                </div>
            </form>
        </div>
    </div>
</div>
