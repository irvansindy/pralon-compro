<script>
    $(document).ready(() => {
        $('#table_products').DataTable({
            processing: true,
            // serverside: true,
            ajax: {
                url: '{{ route('fetch-master-product') }}',
                type: 'GET',
            },
            columns: [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "name",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    "data": "full_name",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    "data": "slug",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-product_id="' + item.id +
                            '" data-product_name="' + item.name +
                            '" class="btn btn-outline-info btn-sm mt-2 mr-1 detail_master_product" data-toggle="modal" data-target="#ModalMasterProduct" title="Detail Product"><i class="fas fa-edit"></i></button> <button type="button" data-product_id="' +
                            item.id + '" data-product_name="' + item.name +
                            '" class="btn btn-outline-dark btn-sm mt-2 mr-1 brocure_product" data-toggle="modal" data-target="#ModalProductBrocure" title="Brocure Product"><i class="fas fa-file"></i></button> <button type="button" data-product_id="' +
                            item.id + '" data-product_name="' + item.name +
                            '" class="btn btn-outline-danger btn-sm mt-2 mr-1 price_list_product" data-toggle="modal" data-target="#ModalProductPriceList" title="Price List Product"><i class="fas fa-money-check-alt"></i></button>';
                    }
                },
            ]
        })
        // setup create master product
        $(document).on('click', '#add_master_product', (e) => {
            e.preventDefault()
            $('#form_master_product')[0].reset()
            $('#master_product_category').empty()
            $('#master_product_category').append(`<option value="">Select One</option>`)
            // clear summernote
            $('#master_product_main_desc').summernote('reset');
            $('#master_product_main_desc').summernote('fullscreen.isFullscreen');
            $('#master_product_main_desc').summernote({
                fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '18', '20', '22' , '24', '28', '32', '36', '40', '48'],
                toolbar: [
                    // [groupName, [list of button]]
                    ['style'],
                    ['style', ['clear', 'bold', 'italic', 'underline']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],       
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview']]
                ],
            });
            // clear summernote
            $('#master_product_detail_desc').summernote('reset');
            $('#master_product_detail_desc').summernote('fullscreen.isFullscreen');
            $('#master_product_detail_desc').summernote({
                fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '18', '20', '22' , '24', '28', '32', '36', '40', '48'],
                toolbar: [
                    // [groupName, [list of button]]
                    ['style'],
                    ['style', ['clear', 'bold', 'italic', 'underline']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],       
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview']]
                ]
            });
            $('#form_field_link_product_image').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-product-categories') }}',
                method: 'GET',
                success: function(res) {
                    $.each(res.data, (i, category) => {
                        $('#master_product_category').append(
                            `<option value="${category.id}">${category.name}</option>`
                        )
                    })
                }
            })
            $('#form_field_detail_image').empty()
            let image_detail_length = 2
            for (let i = 0; i < image_detail_length; i++) {
                $('#form_field_detail_image').append(`
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="master_product_image_detail_${i+1}">Detail Image ${i+1}</label>
                            <div class="form_field_product_image_detail" id="form_field_product_image_detail_${i+1}">
                                <input type="file" class="form-control" name="master_product_image_detail[]" id="master_product_image_detail_${i+1}" required>
                            </div>
                        </div>
                    </div>
                `)
            }
            $('#button_action_form_master_product').empty()
            $('#button_action_form_master_product').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create_product_detail">Submit</button>
            `)
        })
        // get data master product detail
        $(document).on('click', '.detail_master_product', function(e) {
            e.preventDefault()
            let product_id = $(this).data('product_id')
            $('#form_master_product')[0].reset()
            $('#master_product_category').empty()
            $('#master_product_category').append(`<option value="">Select One</option>`)
            // $('#form_field_link_product_image').empty()
            $('.form_field_link_product_image').empty()

            $('.form_field_link_product_image').append(`
                <a id="link_product_image" target="_blank" href="">
                    <i class="fas fa-file"></i> Your Image Product
                </a>
                <div class="button-change-product-image" style="cursor: pointer;"></div>
            `)
            // clear summernote
            $('#master_product_main_desc').summernote('reset');
            $('#master_product_main_desc').summernote('fullscreen.isFullscreen');
            $('#master_product_main_desc').summernote({
                fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '18', '20', '22' , '24', '28', '32', '36', '40', '48'],
                toolbar: [
                    // [groupName, [list of button]]
                    ['style'],
                    ['style', ['clear', 'bold', 'italic', 'underline']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],       
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview']]
                ],
            });
            // clear summernote
            $('#master_product_detail_desc').summernote('reset');
            $('#master_product_detail_desc').summernote('fullscreen.isFullscreen');
            $('#master_product_detail_desc').summernote({
                fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '18', '20', '22' , '24', '28', '32', '36', '40', '48'],
                toolbar: [
                    // [groupName, [list of button]]
                    ['style'],
                    ['style', ['clear', 'bold', 'italic', 'underline']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],       
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['view', ['codeview']]
                ],
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-master-product-by-id') }}',
                method: 'GET',
                data: {
                    id: product_id
                },
                success: function(res) {
                    let product = res.data.product
                    let categories = res.data.categories
                    $('#master_product_id').val(product.id)
                    $('#master_product_name').val(product.name)
                    $('#master_product_full_name').val(product.full_name)

                    $.each(categories, (i, category) => {
                        let selected = category.id == product.category_id ?
                            'selected' : '';
                        $('#master_product_category').append(
                            `<option value="${category.id}" ${selected}>${category.name}</option>`
                        )
                    })

                    let data_image = product.image
                    $("#link_product_image").attr("href", data_image);
                    $('#master_product_short_desc').val([product.short_desc])
                    $('.form_field_product_image').empty()
                    $('.button-change-product-image').empty()
                    if (product.image != '' || product.image != null) {
                        // $("#detail_stamp_file").attr("hidden",true);
                        $('.button-change-product-image').append(`
                            <i class="fas fa-edit change_product_image" title="Ubah data image" for="change_product_image"></i>
                            <span class="info-box-text change_product_image" id="change_product_image" title="Ubah data image"><small>Ubah data image</small></span>
                        `)
                    }
                    $('#master_product_detail_title').val(product.detail_product.title)
                    $('#master_product_detail_subtitle').val(product.detail_product
                        .subtitle)
                    $('#master_product_main_desc').summernote('code', product.main_desc)
                    $('#master_product_detail_desc').summernote('code', product
                        .detail_product.desc)

                    let detail_image = product.detail_image
                    $('#form_field_detail_image').empty()
                    if (detail_image <= 0) {
                        let image_detail_length = 2
                        for (let i = 0; i < image_detail_length; i++) {
                            $('#form_field_detail_image').append(`
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="master_product_image_detail_${i+1}">Detail Image ${i+1}</label>
                                        <div class="form_field_product_image_detail" id="form_field_product_image_detail_${i+1}">
                                            <input type="file" class="form-control" name="master_product_image_detail[]" id="master_product_image_detail_${i+1}" required>
                                        </div>
                                    </div>
                                </div>
                            `)
                        }
                    } else {
                        $.each(detail_image, (i, image) => {
                            let data_detail_image = image.image_detail
                            $('#form_field_detail_image').append(`
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="detail_product_image_${i+1}">Detail Image ${i+1}</label>
                                        <div class="form_field_product_image_detail" id="form_field_product_image_detail_${i+1}">
                                            <input type="text" class="form-control" name="detail_product_image[]" id="detail_product_image_${i+1}" required>
                                        </div>
                                        <a id="link_product_image" target="_blank" href="${data_detail_image}">
                                            <i class="fas fa-file"></i> Your Image Product
                                        </a>
                                        <input type="hidden" name="master_product_image_detail_link_${i+1}" id="master_product_image_detail_link_${i+1}" value="${data_detail_image}" disabled/>
                                        <div class="button-change-product-image" id="button-change-product-image-detail_${i+1}" style="cursor: pointer;"></div>
                                    </div>
                                </div>
                            `)
                            let number = i + 1
                            $('#button-change-product-image-detail_' + number)
                                .append(`
                                <i class="fas fa-edit change_product_image_detail_${i+1}" title="Ubah data image" for="change_product_image_detail_${i+1}"></i>
                                <span class="info-box-text change_product_image_detail_${i+1}" id="change_product_image_detail_${i+1}" title="Ubah data image"><small>Ubah data image</small></span>
                            `)
                        })
                    }
                    $('.form_field_product_image_detail').empty()
                    $('#button_action_form_master_product').empty()
                    $('#button_action_form_master_product').append(`
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="update_product_detail">Submit</button>
                    `)
                }
            })
        })
        // edit product image
        $(document).on('click', '.change_product_image', function() {
            $('.form_field_product_image').empty()
            $('.form_field_product_image').append(
                `<input type="file" class="form-control" name="master_product_image" id="master_product_image" required>`
            )
            $('.button-change-product-image').empty()
            $('.button-change-product-image').append(`
                <i class="fas fa-times-circle text-danger cancel_change_product_image" title="Cancel perubahan image" for="cancel_change_product_image"></i>
                <span class="info-box-text text-danger cancel_change_product_image" id="cancel_change_product_image" title="Cancel perubahan image"><small>Cancel perubahan image</small></span>
            `)
        })
        // cancel edit product image
        $(document).on('click', '#cancel_change_product_image', function() {
            $('.form_field_product_image').empty()
            $('.button-change-product-image').empty()
            $('.button-change-product-image').append(`
                <i class="fas fa-edit change_product_image" title="Ubah data image" for="change_product_image"></i>
                <span class="info-box-text change_product_image" id="change_product_image" title="Ubah data image"><small>Ubah data image</small></span>
            `)
        })
        // edit product image 1
        $(document).on('click', '#change_product_image_detail_1', function() {
            $('#form_field_product_image_detail_1').empty()
            $('#form_field_product_image_detail_1').append(
                `<input type="file" class="form-control" name="master_product_image_detail_1" id="master_product_image_detail_1" required>`
            )

            $('#master_product_image_detail_link_1').prop('disabled', false);
            $('#master_product_image_detail_link_1').prop('readonly', true);

            $('#button-change-product-image-detail_1').empty()
            $('#button-change-product-image-detail_1').append(`
                <i class="fas fa-times-circle text-danger cancel_change_product_image_detail_1" title="Cancel perubahan image" for="cancel_change_product_image_detail_1"></i>
                <span class="info-box-text text-danger cancel_change_product_image_detail_1" id="cancel_change_product_image_detail_1" title="Cancel perubahan image"><small>Cancel perubahan image</small></span>
            `)
        })
        // cancel edit product image 1
        $(document).on('click', '#cancel_change_product_image_detail_1', function() {
            $('#form_field_product_image_detail_1').empty()
            $('#button-change-product-image-detail_1').empty()

            $('#master_product_image_detail_link_1').prop('disabled', true);
            $('#master_product_image_detail_link_1').prop('readonly', false)

            $('#button-change-product-image-detail_1').append(`
                <i class="fas fa-edit change_product_image_detail_1" title="Ubah data image" for="change_product_image_detail_1"></i>
                <span class="info-box-text change_product_image_detail_1" id="change_product_image_detail_1" title="Ubah data image"><small>Ubah data image</small></span>
            `)
        })
        // edit product image 2
        $(document).on('click', '#change_product_image_detail_2', function() {
            $('#form_field_product_image_detail_2').empty()
            $('#form_field_product_image_detail_2').append(
                `<input type="file" class="form-control" name="master_product_image_detail_2" id="master_product_image_detail_2" required>`
            )

            $('#master_product_image_detail_link_2').prop('disabled', false);
            $('#master_product_image_detail_link_2').prop('readonly', true);

            $('#button-change-product-image-detail_2').empty()
            $('#button-change-product-image-detail_2').append(`
                <i class="fas fa-times-circle text-danger cancel_change_product_image_detail_2" title="Cancel perubahan image" for="cancel_change_product_image_detail_2"></i>
                <span class="info-box-text text-danger cancel_change_product_image_detail_2" id="cancel_change_product_image_detail_2" title="Cancel perubahan image"><small>Cancel perubahan image</small></span>
            `)
        })
        // cancel edit product image 2
        $(document).on('click', '#cancel_change_product_image_detail_2', function() {
            $('#form_field_product_image_detail_2').empty()
            $('#button-change-product-image-detail_2').empty()

            $('#master_product_image_detail_link_2').prop('disabled', true);
            $('#master_product_image_detail_link_2').prop('readonly', false);

            $('#button-change-product-image-detail_2').append(`
                <i class="fas fa-edit change_product_image_detail_2" title="Ubah data image" for="change_product_image_detail_2"></i>
                <span class="info-box-text change_product_image_detail_2" id="change_product_image_detail_2" title="Ubah data image"><small>Ubah data image</small></span>
            `)
        })
        // create new product
        $(document).on('click', '#create_product_detail', (e) => {
            e.preventDefault()
            let form_data = new FormData($('#form_master_product')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-master-product') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data,
                enctype: 'multipart/form-data',
                success: function(res) {
                    $('#table_products').DataTable().ajax.reload();
                    $('#ModalMasterProduct').modal('hide')
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
        // update master product
        $(document).on('click', '#update_product_detail', (e) => {
            e.preventDefault()
            let form_data = new FormData($('#form_master_product')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('update-master-product') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data,
                enctype: 'multipart/form-data',
                success: function(res) {
                    $('#table_products').DataTable().ajax.reload();
                    $('#ModalMasterProduct').modal('hide')
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
        // add or update brocure 
        $(document).on('click', '.brocure_product', function() {
            let product_id = $(this).data('product_id')
            let product_name = $(this).data('product_name')
            $('#ModalProductBrocureLabel').html('List Brocure ' + product_name)

            // Ambil data-product_id dari tombol yang diklik
            var productId = $(this).data('product_id');
            // Set data-product_id_for_brocure ke tombol btn_create_product_brocure
            $('#btn_create_product_brocure').data('product_id_for_brocure', productId);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-brocure-product-by-id') }}',
                method: 'GET',
                data: {
                    id: product_id
                },
                success: function(res) {
                    refreshDataTableBrocure(res.data)

                    // Event listener untuk checkbox
                    $(document).on('change', '.brocure-status', function() {
                        let selectedId = $(this).val()
                        let selectedProductId = $(this).data('product-id')
                        let isChecked = $(this).is(':checked')

                        // Uncheck semua kecuali yang dicentang saat ini
                        $('.brocure-status').not(this).prop('checked', false)

                        // Jika tidak ada checkbox yang dicentang, tampilkan alert
                        if ($('.brocure-status:checked').length === 0) {
                            Swal.fire({
                                icon: "error",
                                title: 'Error!',
                                text: 'Harus ada satu brosur yang dipilih.',
                            })
                            $(this).prop('checked',
                                true) // Paksa checkbox tetap tercentang
                            return
                        }

                        // Tentukan status berdasarkan checkbox
                        let status = isChecked ? 'active' : 'inactive'

                        // Kirim request AJAX untuk update status
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            url: '{{ route('update-brocure-status') }}', // Ganti dengan route update Anda
                            method: 'POST',
                            data: {
                                id: selectedId,
                                product_id: selectedProductId,
                                status: status
                            },
                            success: function(response) {
                                // Refresh data table setelah sukses update status
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]'
                                        ).attr(
                                            'content')
                                    },
                                    url: '{{ route('fetch-brocure-product-by-id') }}',
                                    method: 'GET',
                                    data: {
                                        id: product_id
                                    },
                                    success: function(res) {
                                        Swal.fire({
                                            icon: "success",
                                            title: 'Success!',
                                            text: 'Status berhasil diperbaharui.',
                                        })
                                        refreshDataTableBrocure
                                            (res.data)

                                    },
                                    error: function(err) {
                                        Swal.fire({
                                            icon: "error",
                                            title: 'Error!',
                                            text: 'Failed to refresh data table.',
                                        })
                                    }
                                })
                            },
                            error: function(err) {
                                Swal.fire({
                                    icon: "error",
                                    title: 'Error!',
                                    text: 'Status gagal diperbaharui.',
                                })
                            }
                        })
                    })
                }
            })
        })
        // Function untuk refresh DataTable
        function refreshDataTableBrocure(data) {
            $('#table_product_brocure_by_id').DataTable().clear().destroy()
            $('#table_product_brocure_by_id tbody').empty()
            $.each(data, (i, brocure) => {
                let link = brocure.brocure_file
                $('#table_product_brocure_by_id tbody').append(`
                    <tr>
                        <td>${i+1}</td>
                        <td>
                            <a href="${link}" target="_blank">Link Brosur</a>
                        </td>
                        <td>
                            ${brocure.date}
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input brocure-status" type="checkbox" 
                                    value="${brocure.id}" data-product-id="${brocure.product_id}"
                                    ${brocure.status == 'active' ? 'checked' : ''}>
                                <label class="form-check-label">
                                    ${brocure.status == 'active' ? 'active' : 'inactive'}
                                </label>
                            </div>
                        </td>
                    </tr>
                `)
            })
            $('#table_product_brocure_by_id').DataTable()
        }
        // create new product brocure
        $(document).on('click', '.btn_create_product_brocure', function() {
            // Ambil data-product_id_for_brocure dari tombol
            var productIdForBrocure = $(this).data('product_id_for_brocure');
            // reset form
            $('#create_new_product_brocure')[0].reset()
            $('#loading_spinner_brocure').hide();
            $('#create_new_product_brocure').show()
            // Set nilai input product_id_for_brocure dengan productIdForBrocure
            $('#product_id_for_brocure').val(productIdForBrocure);
            $('#message_brocure_file').text('')
            $('#message_brocure_date').text('')
        })
        //submit new product brocure
        $(document).on('click', '#submit_new_product_brocure', function(e) {
            e.preventDefault()
            var form_brocure = new FormData($('#create_new_product_brocure')[0])
            // Tampilkan loading spinner
            $('#loading_spinner_brocure').show();
            $('#create_new_product_brocure').hide()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-brocure') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_brocure,
                enctype: 'multipart/form-data',
                success: function(res) {
                    $('#table_products').DataTable().ajax.reload();
                    $('#ModalProductBrocure').modal('hide')
                    $('#ModalCreateProductBrocure').modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    if (response_error.meta.code == 422) {
                        $('#message_brocure_file').text('')
                        $('#message_brocure_date').text('')
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
                },
                complete: function() {
                    // Sembunyikan loading spinner setelah selesai
                    $('#loading_spinner').hide();
                    $('#create_new_product_brocure').show()
                }
            })
        })
        // add or update price list 
        $(document).on('click', '.price_list_product', function() {
            let product_id = $(this).data('product_id')
            let product_name = $(this).data('product_name')
            $('#ModalProductPriceListLabel').html('Price List ' + product_name)
            // Ambil data-product_id dari tombol yang diklik
            var productId = $(this).data('product_id');
            // Set data-product_id_for_brocure ke tombol btn_create_product_price_list
            $('#btn_create_product_price_list').data('product_id_for_price_list', productId);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-pricelist-product-by-id') }}',
                method: 'GET',
                data: {
                    id: product_id
                },
                success: function(res) {
                    refreshDataTablePriceList(res.data)

                    // Event listener untuk checkbox
                    $(document).on('change', '.price_list-status', function() {
                        let selectedId = $(this).val()
                        let selectedProductId = $(this).data('product-id')
                        let isChecked = $(this).is(':checked')

                        // Uncheck semua kecuali yang dicentang saat ini
                        $('.price_list-status').not(this).prop('checked', false)

                        // Jika tidak ada checkbox yang dicentang, tampilkan alert
                        if ($('.price_list-status:checked').length === 0) {
                            Swal.fire({
                                icon: "error",
                                title: 'Error!',
                                text: 'Harus ada satu brosur yang dipilih.',
                            })
                            $(this).prop('checked',
                                true) // Paksa checkbox tetap tercentang
                            return
                        }

                        // Tentukan status berdasarkan checkbox
                        let status = isChecked ? 'active' : 'inactive'

                        // Kirim request AJAX untuk update status
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            url: '{{ route('update-price-list-status') }}', // Ganti dengan route update Anda
                            method: 'POST',
                            data: {
                                id: selectedId,
                                product_id: selectedProductId,
                                status: status
                            },
                            success: function(response) {
                                // Refresh data table setelah sukses update status
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]'
                                        ).attr(
                                            'content')
                                    },
                                    url: '{{ route('fetch-pricelist-product-by-id') }}',
                                    method: 'GET',
                                    data: {
                                        id: product_id
                                    },
                                    success: function(res) {
                                        Swal.fire({
                                            icon: "success",
                                            title: 'Success!',
                                            text: 'Status berhasil diperbaharui.',
                                        })
                                        refreshDataTablePriceList
                                            (res.data)

                                    },
                                    error: function(err) {
                                        Swal.fire({
                                            icon: "error",
                                            title: 'Error!',
                                            text: 'Failed to refresh data table.',
                                        })
                                    }
                                })
                            },
                            error: function(err) {
                                Swal.fire({
                                    icon: "error",
                                    title: 'Error!',
                                    text: 'Status gagal diperbaharui.',
                                })
                            }
                        })
                    })
                }
            })
        })
        // Function untuk refresh DataTable
        function refreshDataTablePriceList(data) {
            $('#table_product_price_list_by_id').DataTable().clear().destroy()
            $('#table_product_price_list_by_id tbody').empty()
            $.each(data, (i, price_list) => {
                let link = price_list.price_list_file
                $('#table_product_price_list_by_id tbody').append(`
                    <tr>
                        <td>${i+1}</td>
                        <td>
                            <a href="${link}" target="_blank">Link Price List</a>
                        </td>
                        <td>
                            ${price_list.date}
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input price_list-status" type="checkbox" 
                                    value="${price_list.id}" data-product-id="${price_list.product_id}"
                                    ${price_list.status == 'active' ? 'checked' : ''}>
                                <label class="form-check-label">
                                    ${price_list.status == 'active' ? 'active' : 'inactive'}
                                </label>
                            </div>
                        </td>
                    </tr>
                `)
            })
            $('#table_product_price_list_by_id').DataTable()
        }
        // create product price list
        $(document).on('click', '.btn_create_product_price_list', function() {
            // Ambil data-product_id_for_brocure dari tombol
            var productIdForPriceList = $(this).data('product_id_for_price_list');
            // reset form
            $('#create_new_product_price_list')[0].reset()
            $('#loading_spinner_price_list').hide();
            $('#create_new_product_price_list').show()
            // Set nilai input product_id_for_brocure dengan productIdForPriceList
            $('#product_id_for_price_list').val(productIdForPriceList);
            $('#message_price_list_file').text('')
            $('#message_price_list_date').text('')
        })
        //submit new product brocure
        $(document).on('click', '#submit_new_product_price_list', function(e) {
            e.preventDefault()
            var form_price_list = new FormData($('#create_new_product_price_list')[0])
            // Tampilkan loading spinner
            $('#loading_spinner_price_list').show();
            $('#create_new_product_price_list').hide()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-price-list') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_price_list,
                enctype: 'multipart/form-data',
                success: function(res) {
                    $('#table_products').DataTable().ajax.reload();
                    $('#ModalProductPriceList').modal('hide')
                    $('#ModalCreateProductPriceList').modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    if (response_error.meta.code == 422) {
                        $('#message_price_list_file').text('')
                        $('#message_price_list_date').text('')
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
                },
                complete: function() {
                    // Sembunyikan loading spinner setelah selesai
                    $('#loading_spinner_price_list').hide();
                    $('#create_new_product_brocure').show()
                }
            })
        })
        // select2
        $('#master_product_category').select2({
            dropdownParent: $('#ModalMasterProduct')
        })

    })
</script>
