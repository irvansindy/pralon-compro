<div class="modal fade" id="ModalHeaderSection" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalHeaderSectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalHeaderSectionLabel">Header Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_header_home_page" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="header_id" id="header_id" part="id">
                                <label for="header_title">Title</label>
                                <input type="text" class="form-control" name="header_title" id="header_title" placeholder="Enter title"/>
                                <span class="text-danger" style="font-size: 12px;" id="message_header_title"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="header_subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="header_subtitle" id="header_subtitle" placeholder="Enter subtitle"/>
                                <span class="text-danger" style="font-size: 12px;" id="message_header_subtitle"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="header_description">Description</label>
                                <textarea class="form-control" name="header_description" id="header_description" cols="20" rows="5" placeholder="Enter description"></textarea>
                                <span class="text-danger" style="font-size: 12px;" id="message_header_description"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="header_image_cover">Image Cover</label>
                                <input type="file" class="form-control" name="header_image_cover" id="header_image_cover" placeholder=""/>
                                <span class="text-danger" style="font-size: 12px;" id="message_header_image_cover"></span>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="header_video">Video</label>
                                <input type="file" class="form-control" name="header_video" id="header_video" placeholder=""/>
                                <span class="text-danger" style="font-size: 12px;" id="message_header_video"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_form_header_section">
                    
                </div>
            </form>
        </div>
    </div>
</div>
