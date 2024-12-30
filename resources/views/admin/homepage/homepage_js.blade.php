<script>
    $(document).ready(() => {
        fetchMasterSection()
        function fetchMasterSection(){
            $('#list_section').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("fetch-home-page-setting") }}',
                method: 'GET',
                success: function(res) {
                    const data_master_section = res.data
                    $.each(data_master_section, (i, master_section) => {
                        $('#list_section').append(`
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-dark">${master_section.title}</h6>
                                    ${master_section.deleted_at == null ? '<span class="badge badge-pill badge-primary">Active</span>' : '<span class="badge badge-pill badge-danger">Inactive</span>'}
                                </div>
                                <div class="card-body">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-header">
                                            ${master_section.description}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    })
                }
            })
        }

        $(document).on('click', '#add_section_home_page', (e) => {
            e.preventDefault()
            $('#form_master_section')[0].reset()
            $('#button_action_form_master_section').empty()
            $('#button_action_form_master_section').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create_master_section">Submit</button>
            `)
        })

        $(document).on('click', '#create_master_section', (e) => {
            e.preventDefault()
            let form_data = new FormData($('#form_master_section')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("store-master-section") }}',
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data,
                enctype: 'multipart/form-data',
                success: function(res){
                    // $('#table_products').DataTable().ajax.reload();
                    $('#ModalHomePageSetting').modal('hide')
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
    })
</script>