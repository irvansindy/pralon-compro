<script>
    $(document).ready(function() {
        $('#news_blog_table').DataTable({
            processing: true,
            // serverSide: true,
            ajax: {
                url: '{{ route('fetch-news-blog') }}',
                type: 'GET',
            },
            columns: [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "title",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    "data": "short_desc",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    "data": "date",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-news_blog_id="' + item.id +
                            '" data-news_blog_title="' + item.title +
                            '" class="btn btn-outline-info btn-sm mt-2 mr-1 detail_news_blog" data-toggle="modal" data-target="#ModalMasterNewsBlog" title="Detail News and Product"><i class="fas fa-edit"></i></button>';
                    }
                },
                
            ]
        });

        $(document).on('click', '#add_master_news_blog', function() {
            $('#ModalMasterNewsBlogLabel').text('Add News and Blog');
            $('#form_master_news_blog')[0].reset();
            $('#message_news_blog_title').text('')
            $('#message_news_blog_category').text('')
            $('#message_news_blog_main_image').text('')
            $('#message_news_blog_short_desc').text('')
            $('#message_news_blog_content').text('')
            $('#message_news_blog_detail_image_1').text('')
            $('#message_news_blog_detail_image_2').text('')
            // reset form field detail image
            $('.detail_image_news_blog').empty()
            $('.detail_image_news_blog').append(`
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="news_blog_detail_image_1">Detail Image 1</label>
                        <input type="file" class="form-control" name="news_blog_detail_image_1" id="news_blog_detail_image_1" required>
                        <div class="link-detail-image-1"></div>
                        <span class="text-sm text-danger mt-2 message_news_blog_detail_image_1" id="message_news_blog_detail_image_1" role="alert" style="font-size: 12px !important;"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="news_blog_detail_image_2">Detail Image 2</label>
                        <input type="file" class="form-control" name="news_blog_detail_image_2" id="news_blog_detail_image_2" required>
                        <div class="link-detail-image-2"></div>
                        <span class="text-sm text-danger mt-2 message_news_blog_detail_image_2" id="message_news_blog_detail_image_2" role="alert" style="font-size: 12px !important;"></span>
                    </div>
                </div>
            `)
            $('.link-detail-image-1').empty()
            $('.link-detail-image-2').empty()
            // setup button action
            $('#button-action-news-blog').empty()
            $('#button-action-news-blog').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_news_blog">Submit</button>
            `)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news-blog-categories') }}',
                type: 'GET',
                success: function(res) {
                    $('#news_blog_category').empty()
                    $('#news_blog_category').append(`<option value="">Pilih Kategori</option>`)
                    let categories = res.data
                    $.each(categories, (i, category) => {
                        $('#news_blog_category').append(`<option value="${category.id}">${category.name}</option>`)
                    })
                }
            })
        })

        $(document).on('click', '#submit_news_blog', function(e) {
            e.preventDefault()
            let formData = new FormData($('#form_master_news_blog')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-news-blog') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#ModalMasterNewsBlog').modal('hide');
                    $('#news_blog_table').DataTable().ajax.reload();
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                }, error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    if (response_error.meta.code == 422) {
                        $('#message_news_blog_title').text('')
                        $('#message_news_blog_category').text('')
                        $('#message_news_blog_main_image').text('')
                        $('#message_news_blog_short_desc').text('')
                        $('#message_news_blog_content').text('')
                        $('#message_news_blog_detail_image_1').text('')
                        $('#message_news_blog_detail_image_2').text('')
                        $.each(response_error.meta.message.errors, function(i, value) {
                            $('#message_' + i.replace('.', '_')).text(value)
                        })
                    } else {
                        toastr.error(
                            '<p style="font-size: 16px !important; color: white !important;">' +
                            response_error.meta.message + '</p>',
                            '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Error</p>', {
                                timeOut: 5000
                            })
                    }
                }
            })
        })

        $(document).on('click', '.detail_news_blog', function() {
            var news_blog_id = $(this).data('news_blog_id')
            var news_blog_title = $(this).data('news_blog_title')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-news-blog-by-id') }}',
                method: 'GET',
                data: {
                    id: news_blog_id
                },
                success: function(res) {
                    $('#ModalMasterNewsBlogLabel').text('Add News and Blog');
                    $('#form_master_news_blog')[0].reset();
                    $('#message_news_blog_title').text('')
                    $('#message_news_blog_category').text('')
                    $('#message_news_blog_main_image').text('')
                    $('#message_news_blog_short_desc').text('')
                    $('#message_news_blog_content').text('')
                    $('#message_news_blog_detail_image_1').text('')
                    $('#message_news_blog_detail_image_2').text('')
                    $('#news_blog_category').empty()
                    $('.link-main-image').empty()
                    $('.link-main-image').append(`<a href="" id="link-main-image" target="_blank">Link Main Image</a>`)
                    $('#link-main-image').attr('href', '{{ asset('') }}' + res.data.image)
                    $('#news_blog_id').val(res.data.id)
                    $('#news_blog_title').val(res.data.title)
                    $('#news_blog_category').empty()
                    var category_selected = res.data.news_category_id
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('fetch-news-blog-categories') }}',
                        type: 'GET',
                        success: function(res) {
                            $('#news_blog_category').empty()
                            $('#news_blog_category').append(`<option value="">Pilih Kategori</option>`)
                            var categories = res.data
                            $.each(categories, (i, category) => {
                                let selected = category_selected == category.id ? 'selected' : ''
                                $('#news_blog_category').append(`<option value="${category.id}" ${selected}>${category.name}</option>`)
                            })
                        }
                    })
                    $('#news_blog_short_desc').val(res.data.short_desc)
                    $('#news_blog_content').val(res.data.content)
                    // reset form field detail image
                    $('.detail_image_news_blog').empty()
                    $('.detail_image_news_blog').append(`
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="news_blog_detail_image_1">Detail Image 1</label>
                                <input type="file" class="form-control" name="news_blog_detail_image_1" id="news_blog_detail_image_1" required>
                                <div class="link-detail-image-1"></div>
                                <span class="text-sm text-danger mt-2 message_news_blog_detail_image_1" id="message_news_blog_detail_image_1" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="news_blog_detail_image_2">Detail Image 2</label>
                                <input type="file" class="form-control" name="news_blog_detail_image_2" id="news_blog_detail_image_2" required>
                                <div class="link-detail-image-2"></div>
                                <span class="text-sm text-danger mt-2 message_news_blog_detail_image_2" id="message_news_blog_detail_image_2" role="alert" style="font-size: 12px !important;"></span>
                            </div>
                        </div>
                    `)
                    $('.link-detail-image-1').empty()
                    $('.link-detail-image-1').append(`<a href="" id="link-detail-image-1" target="_blank">Link Detail Image 1</a>`)
                    let data_link_detail_image_1 = res.data.news_image_detail != null ? res.data.news_image_detail[0].file_name : '#'
                    $('#link-detail-image-1').attr('href', '{{ asset('') }}' + data_link_detail_image_1)

                    $('.link-detail-image-2').empty()
                    $('.link-detail-image-2').append(`<a href="" id="link-detail-image-2" target="_blank">Link Detail Image 2</a>`)
                    let data_link_detail_image_2 = res.data.news_image_detail != null ? res.data.news_image_detail[1].file_name : '#'
                    $('#link-detail-image-2').attr('href', '{{ asset('') }}' + data_link_detail_image_2)
                    // setup button action
                    $('#button-action-news-blog').empty()
                    $('#button-action-news-blog').append(`
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="update_news_blog">Update</button>
                    `)
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: xhr.meta.message,
                    })
                }
            })
        })

        $(document).on('click', '#update_news_blog', function(e) {
            e.preventDefault()
            let formData = new FormData($('#form_master_news_blog')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('update-news-blog') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#ModalMasterNewsBlog').modal('hide');
                    $('#news_blog_table').DataTable().ajax.reload();
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                }, error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    if (response_error.meta.code == 422) {
                        $('#message_news_blog_title').text('')
                        $('#message_news_blog_category').text('')
                        $('#message_news_blog_main_image').text('')
                        $('#message_news_blog_short_desc').text('')
                        $('#message_news_blog_content').text('')
                        $('#message_news_blog_detail_image_1').text('')
                        $('#message_news_blog_detail_image_2').text('')
                        $.each(response_error.meta.message.errors, function(i, value) {
                            $('#message_' + i.replace('.', '_')).text(value)
                        })
                    } else {
                        toastr.error(
                            '<p style="font-size: 16px !important; color: white !important;">' +
                            response_error.meta.message + '</p>',
                            '<p style="font-size: 16px !important; font-weight: bold !important; color: white !important;">Error</p>', {
                                timeOut: 5000
                            })
                    }
                }
            })
        })
    });

    $('.news_blog_category').select2()
</script>
