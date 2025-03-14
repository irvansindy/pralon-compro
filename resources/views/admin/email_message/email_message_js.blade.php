<script>
    $(document).ready(function() {
        $('#table_email_contact_us').DataTable({
            "processing": true,
            // "serverSide": true,
            "ajax": {
                url: '{{ route('fetch-email-message') }}',
                type:   'GET',
            },
            "columns": [
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "email",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    "data": "type",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    'data': null,
                    title: 'Action',
                    wrap: true,
                    "render": function(item) {
                        return '<button type="button" data-email_contact_us_id="' + item.id +
                            '" data-email_contact_us_title="' + item.title +
                            '" class="btn btn-outline-info btn-sm mt-2 mr-1 detail_email_contact_us" data-toggle="modal" data-target="#ModalMasterNewsBlog" title="Detail News and Product"><i class="fas fa-file"></i></button>';
                    }
                },
            ]
        });
    });
</script>