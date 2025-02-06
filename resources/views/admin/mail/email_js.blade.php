<script>
    $(document).ready(function() {
        $('#body_email_template').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });
        $('#body_email_template').summernote({
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '24', '36', '48' , '64', '82', '150']
        });
        $('#table_email_template').DataTable({
            processing: true,
            // serverSide: true,
            ajax: '{{ route('fetch-email-template') }}',
            columns: [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "email_type",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    "data": "subject",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-email_id="' + item.id +
                            '" data-email_type="' + item.email_type +
                            '" class="btn btn-outline-info btn-sm mt-2 mr-1 detail_email_template" data-toggle="modal" data-target="#ModalEmailTemplate" title="Detail Product"><i class="fas fa-edit"></i></button>'
                    }
                },
            ]
        });

        $('#add_email_template').click(function() {
            $('#form_email_template').trigger('reset');
            // $('#form_email_template').attr('action', '{{ route('store-email-template') }}');
            $('#ModalEmailTemplateLabel').text('Add Email Template');
            $('#button_action_email_template').empty()
            $('#button_action_email_template').append(`<button type="button" class="btn btn-secondary" data-target="#ModalEmailTemplate" data-toggle="modal"
                    data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submit_email_template">Submit</button>`)
        });

        $(document).on('click', '#submit_email_template', function() {
            var form = $('#form_email_template')[0];
            var formData = new FormData(form);
            $.ajax({
                url: '{{ route('store-email-template') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#table_email_template').DataTable().ajax.reload();
                    $('#ModalEmailTemplate').modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    if (err.errors) {
                        if (err.errors.type_email_template) {
                            $('#message_type_email_template').text(err.errors
                                .type_email_template[0])
                        }
                        if (err.errors.name_email_template) {
                            $('#message_name_email_template').text(err.errors
                                .name_email_template[0])
                        }
                        if (err.errors.subject_email_template) {
                            $('#message_subject_email_template').text(err.errors
                                .subject_email_template[0])
                        }
                        if (err.errors.header_email_template) {
                            $('#message_header_email_template').text(err.errors
                                .header_email_template[0])
                        }
                        if (err.errors.body_email_template) {
                            $('#message_body_email_template').text(err.errors
                                .body_email_template[0])
                        }
                    }
                }
            });
        });

        $(document).on('click', '.detail_email_template', function() {
            let id = $(this).data('email_id');
            let type = $(this).data('email_type');
            $('#form_email_template').trigger('reset');
            $.ajax({
                url: '{{ route('detail-email-template') }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(res) {
                    $('#id_email_template').val(res.data.id);
                    $('#type_email_template').val(res.data.email_type);
                    $('#name_email_template').val(res.data.name);
                    $('#subject_email_template').val(res.data.subject);
                    $('#header_email_template').val(res.data.header);
                    $('#body_email_template').summernote('code', res.data.body);
                    $('#ModalEmailTemplateLabel').text('Detail Email Template');
                    $('#button_action_email_template').empty()
                    $('#button_action_email_template').append(`<button type="button" class="btn btn-secondary" data-target="#ModalEmailTemplate" data-toggle="modal"
                    data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" id="update_email_template">Submit</button>`)
                }
            });
        })

        $(document).on('click', '#update_email_template', function() {
            var form = $('#form_email_template')[0];
            var formData = new FormData(form);
            $.ajax({
                url: '{{ route('update-email-template') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    $('#table_email_template').DataTable().ajax.reload();
                    $('#ModalEmailTemplate').modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    if (err.errors) {
                        if (err.errors.type_email_template) {
                            $('#message_type_email_template').text(err.errors
                                .type_email_template[0])
                        }
                        if (err.errors.name_email_template) {
                            $('#message_name_email_template').text(err.errors
                                .name_email_template[0])
                        }
                        if (err.errors.subject_email_template) {
                            $('#message_subject_email_template').text(err.errors
                                .subject_email_template[0])
                        }
                        if (err.errors.header_email_template) {
                            $('#message_header_email_template').text(err.errors
                                .header_email_template[0])
                        }
                        if (err.errors.body_email_template) {
                            $('#message_body_email_template').text(err.errors
                                .body_email_template[0])
                        }
                    }
                }
            });
        })
    })
</script>
