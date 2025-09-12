{{-- <div class="modal fade" id="ModalMasterNewsBlog" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="ModalMasterNewsBlogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalMasterNewsBlogLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div id="loading_master_news_blog"></div>
            
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
</div> --}}
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

            <div id="loading_master_news_blog"></div>

            <form id="form_master_news_blog">
                <div class="modal-body">

                    <input type="hidden" name="news_blog_id" id="news_blog_id" readonly="true">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="news_blog_category">Category</label>
                                <select name="news_blog_category" id="news_blog_category" class="form-control news_blog_category" style="width: 100%; height:38px !important;">
                                    <option value="">Pilih Kategori</option>
                                </select>
                                <span class="text-sm text-danger mt-2 message_news_blog_category"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="news_blog_main_image">Main Image</label>
                                <input type="file" class="form-control" name="news_blog_main_image" id="news_blog_main_image" required>
                                <div class="link-main-image"></div>
                                <span class="text-sm text-danger mt-2 message_news_blog_main_image"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs untuk bahasa -->
                    <ul class="nav nav-tabs" id="langTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-id" data-toggle="tab" href="#lang-id" role="tab">Indonesia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-en" data-toggle="tab" href="#lang-en" role="tab">English</a>
                        </li>
                        <!-- Tambahkan tab baru kalau ada bahasa lain -->
                    </ul>

                    <div class="tab-content mt-3">
                        <!-- Bahasa Indonesia -->
                        <div class="tab-pane fade show active" id="lang-id" role="tabpanel">
                            <div class="form-group">
                                <label>Title (ID)</label>
                                <input type="text" class="form-control" name="translations[id][title]" required>
                            </div>
                            <div class="form-group">
                                <label>Short Description (ID)</label>
                                <input type="text" class="form-control" name="translations[id][short_desc]" required>
                            </div>
                            <div class="form-group">
                                <label>Header Content (ID)</label>
                                <textarea name="translations[id][header_content]" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Main Content (ID)</label>
                                <textarea name="translations[id][content]" class="form-control" required></textarea>
                            </div>
                        </div>

                        <!-- Bahasa Inggris -->
                        <div class="tab-pane fade" id="lang-en" role="tabpanel">
                            <div class="form-group">
                                <label>Title (EN)</label>
                                <input type="text" class="form-control" name="translations[en][title]" required>
                            </div>
                            <div class="form-group">
                                <label>Short Description (EN)</label>
                                <input type="text" class="form-control" name="translations[en][short_desc]" required>
                            </div>
                            <div class="form-group">
                                <label>Header Content (EN)</label>
                                <textarea name="translations[en][header_content]" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Main Content (EN)</label>
                                <textarea name="translations[en][content]" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row detail_image_news_blog"></div>
                </div>

                <div class="modal-footer" id="button-action-news-blog">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>
