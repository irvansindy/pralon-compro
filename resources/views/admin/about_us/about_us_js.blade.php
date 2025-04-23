<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.5.4/js/fileinput.min.js" integrity="sha256-eyql5FyEi9+B/fPWI8q0rZRgbYtBuzXmkO0XAqMq+Bg=" crossorigin="anonymous"></script>
<!-- Include sortable.min.js for drag-and-drop functionality -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>

<script>
    $(document).ready(() => {
        fetchAllContentAboutUs()
        function fetchAllContentAboutUs() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-about-us-setting') }}',
                method: 'GET',
                success : function(res) {
                    const header = res.data.header
                    const history = res.data.history
                    const why_pralon = res.data.why_pralon
                    const vision = res.data.vision_mision
                    // const mision = res.data.mision
                    const value_pralon = res.data.value_pralon
                    const certificates = res.data.certificates

                    header != null ? $('#btn-header-about-us').attr('data-header_id', header.id) : $('#btn-header-about-us').attr('data-header_id', '')
                    let data_header_id = $('#btn-header-about-us').data('header_id')
                    
                    history != null ? $('#btn-history-about-us').attr('data-history_id', history.id) : $('#btn-history-about-us').attr('data-history_id', '')
                    let data_history_id = $('#btn-history-about-us').data('history_id')
                    
                    why_pralon != null ? $('#btn-why-pralon-about-us').attr('data-why_pralon_id', why_pralon.id) : $('#btn-why-pralon-about-us').attr('data-why_pralon_id', '')
                    let why_pralon_id = $('#btn-why-pralon-about-us').data('why_pralon_id')
                    
                    vision != null ? $('#btn-visi-misi-about-us').attr('data-vision_id', vision.id) : $('#btn-visi-misi-about-us').attr('data-vision_id', '')
                    let data_vision_id = $('#btn-visi-misi-about-us').data('vision_id')
                    
                    value_pralon != null ? $('#btn-value-with-contact-us-about-us').attr('data-value_pralon_id', value_pralon.id) : $('#btn-value-with-contact-us-about-us').attr('data-value_pralon_id', '')
                    let data_value_pralon_id = $('#btn-value-with-contact-us-about-us').data('value_pralon_id')
                    
                    certificates != null ? $('#btn-sertifikat-about-us').attr('data-certificate_id', certificates.id) : $('#btn-sertifikat-about-us').attr('data-certificate_id', '')
                    let data_certificate_id = $('#btn-sertifikat-about-us').data('data-certificate_id')
                    
                }
            })
        }

        $(document).on('dblclick', '#btn-header-about-us', (e) => {
            e.preventDefault()
            let header_id = $('#btn-header-about-us').attr('data-header_id');
            
            $('#modalHeaderAboutUs').modal('hide')
            $('#modalHeaderAboutUs').modal('show')
            $('#form_header_about_us')[0].reset()
            $('#button_action_form_header_about_us').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-detail-header-about-us') }}',
                data: {
                    id: header_id
                },
                method: 'GET',
                success: function(res) {
                    let header_data = res.data
                    if (header_data == null) {
                        $('#form_header_about_us')[0].reset()
                        $('#header_id').val(null)
                        $('#button_action_form_header_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="create_header_about_us">Submit</button>
                        `)
                    } else {
                        $('#header_id').val(header_data.id)
                        $('#header_name').val(header_data.name)
                        $('#header_title').val(header_data.title)
                        $('#header_link').val(header_data.link)
                        $('#header_version').val(header_data.version)
                        $('#button_action_form_header_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_header_about_us">Submit</button>
                        `)
                    }

                }
            })
        })

        $(document).on('click', '#create_header_about_us', (e) => {
            e.preventDefault()
            let form_data_header = new FormData($('#form_header_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store-header-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_header,
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalHeaderAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })

        $(document).on('click', '#update_header_about_us', (e) => {
            e.preventDefault()
            let form_data_header = new FormData($('#form_header_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("update-header-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_header,
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalHeaderAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })

        $(document).on('dblclick', '#btn-history-about-us', (e) => {
            e.preventDefault()
            let history_id = $('#btn-history-about-us').attr('data-history_id');
            $('#modalHistoryAboutUs').modal('hide')
            $('#modalHistoryAboutUs').modal('show')
            $('#form_history_about_us')[0].reset()
            $('#button_action_form_history_about_us').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-detail-history-about-us') }}',
                data: {
                    id: history_id
                },
                method: 'GET',
                success: function(res) {
                    let history_data = res.data                    
                    if (history_data == null) {
                        $('#form_history_about_us')[0].reset()
                        $('#history_id').val(null)
                        $('#link_thumbnail_video').empty()
                        $('#button_action_form_history_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="create_history_about_us">Submit</button>
                        `)
                    } else {
                        $('#form_history_about_us')[0].reset()
                        $('#history_id').val(history_data.id)
                        $('#history_title').val(history_data.title)
                        $('#history_subtitle').val(history_data.subtitle)
                        // $('#history_source_thumbnail_video').val(history_data.source_thumbnail_video)
                        $('#link_thumbnail_video').empty()
                        $('#link_thumbnail_video').append(`<a href="" id="link_source_thumbnail_video" target="_blank">Link Thumbnail</a>`)
                        let data_thumbnail = history_data.source_thumbnail_video
                        $("#link_source_thumbnail_video").attr("href", data_thumbnail);
                        $('#history_source_video').val(history_data.source_video)
                        $('#history_link').val(history_data.history_link)
                        $('#history_desc').val(history_data.desc)
                        $('#button_action_form_history_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_history_about_us">Submit</button>
                        `)

                    }
                }
            })
        })

        $(document).on('click', '#create_history_about_us', (e) => {
            e.preventDefault()
            let form_data_history = new FormData($('#form_history_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store-history-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_history,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalHistoryAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })

        $(document).on('click', '#update_history_about_us', (e) => {
            e.preventDefault()
            let form_data_history = new FormData($('#form_history_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("update-history-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_history,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalHistoryAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })
        
        $(document).on('dblclick', '#btn-why-pralon-about-us', (e) => {
            e.preventDefault()
            let why_pralon_id = $('#btn-why-pralon-about-us').attr('data-why_pralon_id');
            $('#modalWhyPralonAboutUs').modal('hide')
            $('#modalWhyPralonAboutUs').modal('show')
            $('#form_why_pralon_about_us')[0].reset()
            $('#button_action_form_why_pralon_about_us').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-detail-why-pralon-about-us') }}',
                data: {
                    id: why_pralon_id
                },
                method: 'GET',
                success: function(res) {
                    let why_pralon_data = res.data                    
                    if (why_pralon_data == null) {
                        $('#form_why_pralon_about_us')[0].reset()
                        $('#why_pralon_id').val(null)
                        $('#link_why_pralon_image').empty()
                        $('.list-detail-why-pralon').empty()
                        $('.list-detail-why-pralon').append(`
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
                        `)
                        $('#button_action_form_why_pralon_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="create_why_pralon_about_us">Submit</button>
                        `)
                    } else {
                        $('#form_why_pralon_about_us')[0].reset()
                        $('#why_pralon_id').val(why_pralon_data.id)
                        $('#why_pralon_title').val(why_pralon_data.title)
                        $('#why_pralon_subtitle').val(why_pralon_data.subtitle)
                        $('#link_why_pralon_image').empty()
                        $('#link_why_pralon_image').append(`<a href="" id="link_source_why_pralon_image" target="_blank">Link Image</a>`)
                        
                        let data_image = why_pralon_data.image
                        $("#link_source_why_pralon_image").attr("href", data_image);
                        $('#why_pralon_desc').val(why_pralon_data.desc)
                        
                        $('.list-detail-why-pralon').empty()
                        let detail_why = res.data.detail
                        $.each(detail_why, (i, detail) => {
                            // alert(i)
                            let class_array = i != 0 ? 'array_list-detail-why-pralon' : '';
                            let class_button = i != 0 ? 'btn btn-danger pop_dynamic_detail_why' : 'btn btn-info add_dynamic_detail_why';
                            let class_icon = i != 0 ? 'fas fa-minus' : 'fas fa-plus';
                            $('.list-detail-why-pralon').append(`
                                <div class="row ${class_array}">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="detail_why_pralon_title[]"
                                                id="detail_why_pralon_title" placeholder="Title" value="${detail.title}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="detail_why_pralon_icon[]"
                                                id="detail_why_pralon_icon" placeholder="Code Icon" value="${detail.icon}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="detail_why_pralon_desc[]"
                                                id="detail_why_pralon_desc" placeholder="Desc" value="${detail.desc}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button type="button" class="${class_button}"><i class="${class_icon}"></i></button>
                                        </div>
                                    </div>
                                </div>
                            `)
                        })

                        updateIdWhyPralon()

                        $('#button_action_form_why_pralon_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_why_pralon_about_us">Submit</button>
                        `)

                    }
                }
            })
        })

        $(document).on('click', '.add_dynamic_detail_why', () => {
            $('.list-detail-why-pralon').append(`
                <div class="row array_list-detail-why-pralon">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="detail_why_pralon_title[]"
                                id="detail_why_pralon_title" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="detail_why_pralon_icon[]"
                                id="detail_why_pralon_icon" placeholder="Code Icon" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" name="detail_why_pralon_desc[]"
                                id="detail_why_pralon_desc" placeholder="Desc" required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="button" class="btn btn-danger pop_dynamic_detail_why"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            `)
            updateIdWhyPralon()
        })

        $(document).on('click', '.pop_dynamic_detail_why', function() {
            $(this).closest('.array_list-detail-why-pralon').remove();
            updateIdWhyPralon()
        });

        function updateIdWhyPralon() {
            $('.array_list-detail-why-pralon').each(function(i) {
                const detail_why_pralon_title = 'detail_why_pralon_title_' + (i + 1);
                const detail_why_pralon_icon = 'detail_why_pralon_icon_' + (i + 1);
                const detail_why_pralon_desc = 'detail_why_pralon_desc_' + (i + 1);

                $(this).find('input[name="detail_why_pralon_title[]"]').attr('id', detail_why_pralon_title);
                $(this).find('input[name="detail_why_pralon_icon[]"]').attr('id', detail_why_pralon_icon);
                $(this).find('input[name="detail_why_pralon_desc[]"]').attr('id', detail_why_pralon_desc);
            })
        }

        $(document).on('click', '#create_why_pralon_about_us', (e) => {
            e.preventDefault()
            let form_data_why = new FormData($('#form_why_pralon_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store-why-pralon-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_why,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalWhyPralonAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })

        $(document).on('click', '#update_why_pralon_about_us', (e) => {
            e.preventDefault()
            let form_data_why = new FormData($('#form_why_pralon_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("update-why-pralon-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_why,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalWhyPralonAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
            
        })
        
        $(document).on('dblclick', '#btn-visi-misi-about-us', (e) => {
            e.preventDefault()
            let vision_id = $('#btn-visi-misi-about-us').attr('data-vision_id')
            // alert(vision_id)
            $('#modalVisiMisiAboutUs').modal('hide')
            $('#modalVisiMisiAboutUs').modal('show')
            $('#form_visi_misi_about_us')[0].reset()
            $('#link_visi_misi_image').empty()
            $('#button_action_form_visi_misi_about_us').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-detail-visi-misi-about-us') }}',
                data: {
                    id: vision_id
                },
                method: 'GET',
                success: function(res) {
                    let visi_misi_data = res.data
                    console.log(visi_misi_data);
                    if (visi_misi_data == null) {
                        $('#form_visi_misi_about_us')[0].reset()
                        $('#button_action_form_visi_misi_about_us').empty()
                        $('.list-misi').empty()
                        $('.list-misi').append(`
                            <div class="row array_list-misi">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="list_misi[]" id="list_misi" required placeholder="1. Misi">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info add_dynamic_form_misi"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        `)
                        $('#button_action_form_visi_misi_about_us').empty()
                        $('#button_action_form_visi_misi_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="create_visi_misi_about_us">Submit</button>
                        `)
                    } else {
                        $('#form_visi_misi_about_us')[0].reset()
                        $('#visi_id').val(visi_misi_data.id)
                        $('#visi').val(visi_misi_data.text)

                        $('#link_visi_misi_image').empty()
                        $('#link_visi_misi_image').append(`<a href="" id="link_source_visi_misi_image" target="_blank">Link Image</a>`)
                        let data_image = visi_misi_data.image
                        $("#link_source_visi_misi_image").attr("href", data_image);

                        $('.list-misi').empty()
                        let misions = visi_misi_data.mision
                        $.each(misions, (i, misi) => {
                            let class_array = i != 0 ? 'array_list-misi' : '';
                            let class_button = i != 0 ? 'btn btn-danger pop_dynamic_form_misi' : 'btn btn-info add_dynamic_form_misi';
                            let class_icon = i != 0 ? 'fas fa-minus' : 'fas fa-plus';
                            let numbering = i+1
                            $('.list-misi').append(`
                                <div class="row ${class_array}">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="list_misi[]" id="list_misi" required placeholder="${numbering}. Misi" value="${misi.text}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="${class_button}"><i class="${class_icon}"></i></button>
                                    </div>
                                </div>
                            `)
                        })
                        $('#button_action_form_visi_misi_about_us').empty()
                        $('#button_action_form_visi_misi_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_visi_misi_about_us">Submit</button>
                        `)

                    }
                }
            })
        })

        $(document).on('click', '.add_dynamic_form_misi', function() {
            $('.list-misi').append(`
                <div class="row array_list-misi">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input class="form-control" type="text" name="list_misi[]" id="list_misi" required placeholder="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger pop_dynamic_form_misi"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
            `)
            updateIdWMisiPralon()
        })

        $(document).on('click', '.pop_dynamic_form_misi', function() {
            $(this).closest('.array_list-misi').remove()
            updateIdWMisiPralon()
        })

        function updateIdWMisiPralon() {
            $('.array_list-misi').each(function(i) {
                const index = i + 1
                const list_misi = 'list_misi_' + (i + 1);

                $(this).find('input[name="list_misi[]"]').attr('id', list_misi);
                $(this).find('input[name="list_misi[]"]').attr('placeholder', index+'. Misi');
            })
        }

        $(document).on('click', '#create_visi_misi_about_us', (e) => {
            e.preventDefault()
            let form_data_visi_misi = new FormData($('#form_visi_misi_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store-visi-misi-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_visi_misi,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalVisiMisiAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })

        $(document).on('click', '#update_visi_misi_about_us', (e) => {
            e.preventDefault()
            let form_data_visi_misi = new FormData($('#form_visi_misi_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("update-visi-misi-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_visi_misi,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalVisiMisiAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })
        
        $(document).on('dblclick', '#btn-value-with-contact-us-about-us', (e) => {
            e.preventDefault()
            let value_pralon_id = $('#btn-value-with-contact-us-about-us').attr('data-value_pralon_id')
            // alert(value_pralon_id)
            $('#modalValueAboutUs').modal('hide')
            $('#modalValueAboutUs').modal('show')
            $('.list-value').empty()
            $('#button_action_form_header_about_us').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-detail-value-about-us') }}',
                method: 'GET',
                success: function(res) {
                    let value_data = res.data
                    // console.log(value_data);
                    if (value_data == null) {
                        $('.list-value').empty()
                        $('.list-value').append(`
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="value_name[]" id="value_name" required placeholder="Value Text">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="value_icon[]" id="value_icon" required placeholder="Icon">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-info add_dynamic_form_value"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        `)
                        $('#button_action_form_value_about_us').empty()
                        $('#button_action_form_value_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="create_value_about_us">Submit</button>
                        `)
                    } else {
                        $('.list-value').empty()
                        $.each(value_data, (i, value) => {
                            let class_array = i != 0 ? 'array_list-value' : '';
                            let class_button = i != 0 ? 'btn btn-danger pop_dynamic_form_value' : 'btn btn-info add_dynamic_form_value';
                            let class_icon = i != 0 ? 'fas fa-minus' : 'fas fa-plus';
                            let numbering = i+1
                            $('.list-value').append(`
                                <div class="row ${class_array} mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="value_name[]" id="value_name_${numbering}" required value="${value.name}" placeholder="Value Text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="value_icon[]" id="value_icon_${numbering}" required value="${value.icon}" placeholder="Icon">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="${class_button}"><i class="${class_icon}"></i></button>
                                    </div>
                                </div>
                            `)
                        })
                        $('#button_action_form_value_about_us').empty()
                        $('#button_action_form_value_about_us').append(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="update_value_about_us">Submit</button>
                        `)

                    }
                }
            })
        })

        $(document).on('click', '.add_dynamic_form_value', function() {
            $('.list-value').append(`
                <div class="row array_list-value mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="value_name[]" id="value_name" required placeholder="Value Text">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="value_icon[]" id="value_icon" required placeholder="Icon">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger pop_dynamic_form_value"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
            `)
        })

        $(document).on('click', '.pop_dynamic_form_value', function() {
            $(this).closest('.array_list-value').remove()
        })

        $(document).on('click', '#create_value_about_us', () => {
            let form_data_value = new FormData($('#form_value_about_us')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store-value-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_value,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalValueAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })
        
        $(document).on('click', '#update_value_about_us', function() {
            let form_data_value = new FormData($('#form_value_about_us')[0])
            // alert('update_value_about_us')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("update-value-about-us") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data_value,
                enctype: 'multipart/form-data',
                success: function(res) {
                    // $('#table_products').DataTable().ajax.reload();
                    $('#modalValueAboutUs').modal('hide')
                    fetchAllContentAboutUs()
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    let code = response_error.meta.code
                    if (code == 500 || code == 400) {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            // text: response_error.meta.message,
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: response_error.meta.message.errors,
                    })
                }
            })
        })
        
        $(document).on('dblclick', '#btn-sertifikat-about-us', (e) => {
            e.preventDefault()
            let certificate_id = $('#btn-sertifikat-about-us').attr('data-certificate_id')
            // alert(certificate_id)
            $('#modalCertificateAboutUs').modal('hide')
            $('#modalCertificateAboutUs').modal('show')
            $('#form_certificate_about_us')[0].reset()
            $('#list-certificate').empty()
            $('#button_action_form_certificate_about_us').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-certificate-about-us') }}',
                method: 'GET',
                success: function(res) {
                    let certificate_data = res.data
                    if (certificate_data == null) {
                        $('#list-certificate').empty()
                        $("#input-multiple-file").fileinput({
                            uploadUrl: "/store-certificate-about-us",
                            showUpload: true,
                            showRemove: false,
                            required: true,
                            validateInitialCount: true,
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            dropZoneEnabled: true,
                            fileActionSettings: { showZoom: true },
                            allowedFileExtensions: ["jpg", "png", "jpeg"],
                            ajaxSettings: {
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                processData: false,
                                contentType: false,
                                method: 'POST',
                                enctype: 'multipart/form-data',
                            },
                            fileActionSettings: {
                                showDrag: true // Display the drag handle
                            },
                        });
                        $(".btn-submit-sertificate").on("click", function() {
                            $("#input-multiple-file").fileinput('upload');
                        });
                    } else {
                        let initialPreview = [];
                        let initialPreviewConfig = [];
                        initialPreview = certificate_data.map(file => file.icon);
                        initialPreviewConfig = certificate_data.map(file => ({
                            caption: file.title,
                            size: file.size,
                            key: file.id,
                            extra: { _token: '{{ csrf_token() }}' } // CSRF token for Laravel
                        }));

                        $("#input-multiple-file").fileinput({
                            uploadUrl: "/store-certificate-about-us",
                            showUpload: true,
                            showRemove: false,
                            required: true,
                            validateInitialCount: true,
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            initialPreview: initialPreview,
                            initialPreviewConfig: initialPreviewConfig,
                            dropZoneEnabled: true,
                            allowedFileExtensions: ["jpg", "png", "jpeg"],
                            fileActionSettings: { showZoom: true },
                            fileActionSettings: {
                                showDrag: true // Display the drag handle
                            },
                            deleteUrl: "/delete-certificate-about-us",
                            ajaxSettings: {
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                processData: false,
                                contentType: false,
                                method: 'POST',
                                enctype: 'multipart/form-data',
                            }
                        });

                        // Event listeners
                        $(".btn-upload-4").off('click').on("click", function() {
                            $("#input-freqd-2").fileinput('upload');
                        });

                        $(".btn-reset-4").off('click').on("click", function() {
                            $("#input-freqd-2").fileinput('clear');
                        });

                        $('#input-freqd-2').on('filedeleted', function(event, key) {
                            console.log('File deleted: ', key);
                        });

                        $('#input-freqd-2').on('fileclear', function(event) {
                            console.log('All files cleared.');
                        });
                        $(".btn-submit-sertificate").on("click", function() {
                            $("#input-multiple-file").fileinput('upload');
                        });
                    }
                }
            })
        })
    })
</script>