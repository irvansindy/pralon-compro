<div class="modal fade" id="modalHistoryAboutUs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalHistoryAboutUsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistoryAboutUsLabel">History About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_history_about_us">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="history_id" id="history_id" readonly="true">
                                <label for="history_title">Title</label>
                                <input type="text" class="form-control" name="history_title" id="history_title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="history_subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="history_subtitle" id="history_subtitle" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="history_source_thumbnail_video">Thumbnail</label>
                                <input type="file" class="form-control" name="history_source_thumbnail_video" id="history_source_thumbnail_video" required>
                                <div id="link_thumbnail_video">
                                    <a href="">Link Thumbnail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="history_source_video">Link Video</label>
                                <input type="text" class="form-control" name="history_source_video" id="history_source_video" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="history_desc">Desc</label>
                                <textarea class="form-control" name="history_desc" id="history_desc" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="history_link">Link</label>
                                <input type="text" class="form-control" name="history_link" id="history_link">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_form_history_about_us">
                    
                </div>
            </form>
        </div>
    </div>
</div>
