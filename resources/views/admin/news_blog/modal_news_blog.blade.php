<div class="modal fade" id="ModalMasterNewsBlog" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="ModalMasterNewsBlogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalMasterNewsBlogLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_master_news_blog">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="news_blog_id"
                                    id="news_blog_id" readonly="true">
                                <label for="news_blog_title">Title</label>
                                <input type="text" class="form-control" name="news_blog_title" id="news_blog_title" required>
                                <span class="text-sm text-danger mt-2 message_news_blog_title" id="message_news_blog_title" role="alert" style="font-size: 12px !important;"></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="news_blog_category">Category</label>
                                <select name="news_blog_category" id="news_blog_category" class="form-control news_blog_category" style="width: 100%; height:38px !important;">
                                    <option value="">Pilih Kategori</option>
                                </select>
                                <span class="text-sm text-danger mt-2 message_news_blog_category" id="message_news_blog_category" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="news_blog_main_image">Main Image</label>
                                <input type="file" class="form-control" name="news_blog_main_image" id="news_blog_main_image" required>
                                <div class="link-main-image">
                                    
                                </div>
                                <span class="text-sm text-danger mt-2 message_news_blog_main_image" id="message_news_blog_main_image" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="news_blog_short_desc">Short Description</label>
                                <input type="fil" class="form-control" name="news_blog_short_desc" id="news_blog_short_desc" required>
                                <span class="text-sm text-danger mt-2 message_news_blog_short_desc" id="message_news_blog_short_desc" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row detail_image_news_blog"></div>
                    <div class="row content_news_blog">
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="news_blog_header_content">Header Content</label>
                                <textarea name="news_blog_header_content" id="news_blog_header_content" class="form-control" required></textarea>
                                <span class="text-sm text-danger mt-2 message_news_blog_header_content" id="message_news_blog_header_content" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row content_news_blog">
                        <div class="col-md-12">
                            <div class="form-group mt-3">
                                <label for="news_blog_content">Main Content</label>
                                <textarea name="news_blog_content" id="news_blog_content" class="form-control" required></textarea>
                                <span class="text-sm text-danger mt-2 message_news_blog_content" id="message_news_blog_content" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button-action-news-blog">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>