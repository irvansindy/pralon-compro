<script>
    $(document).ready(function() {
        $('#table_product_category').DataTable({
            processing: true,
            // serverside: true,
            ajax: {
                url: '{{ route('fetch-product-categories') }}',
                type: 'GET',
            },
            columns: [
                {
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
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-category_id="' + item.id + '" data-category_name="' + item.name + '" class="btn btn-outline-info btn-sm mt-2 detail_product_category" data-toggle="modal" data-target="#ModalProductCategory"><i class="fas fa-edit"></i></button>';
                    }
                },
            ]
        })

        $(document).on('click', '#add_product_category', function(e) {
            e.preventDefault()
            $('#form_product_category')[0].reset()
            $('#button_action_form_product_category').empty()
            $('#button_action_form_product_category').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create_product_category">Submit</button>
            `)
        })

        $(document).on('click', '#create_product_category', (e) => {
            e.preventDefault()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store-product-category") }}',
                type: 'POST',
                data: {
                    product_category_name: $('#product_category_name').val()
                },
                dataType: 'json',
                async: true,
                success: function(res){
                    $('#table_product_category').DataTable().ajax.reload();
                    $('#ModalProductCategory').modal('hide')
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
                        text: response_error.meta.message.errors.product_category_name,
                    })
                }
            })
        })

        $(document).on('click', '.detail_product_category', function(e) {
            e.preventDefault()
            let id = $(this).data('category_id')
            let name = $(this).data('category_name')
            $('#form_product_category')[0].reset()
            $('#product_category_id').val(id)
            $('#product_category_name').val(name)
            $('#button_action_form_product_category').empty()
            $('#button_action_form_product_category').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_product_category">Submit</button>
            `)
        })

        $(document).on('click', '#update_product_category', (e) => {
            e.preventDefault()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("update-product-category") }}',
                type: 'POST',
                data: {
                    product_category_id: $('#product_category_id').val(),
                    product_category_name: $('#product_category_name').val()
                },
                dataType: 'json',
                async: true,
                success: function(res){
                    $('#table_product_category').DataTable().ajax.reload();
                    $('#ModalProductCategory').modal('hide')
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
                        text: response_error.meta.message.errors.product_category_name,
                    })
                }
            })
        })
    })
</script>
