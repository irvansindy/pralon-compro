<script>
    $(document).ready(function() {
        setInterval(() => {
            $('#table_user_subcription').DataTable().ajax.reload();
        }, 30000); 
        
        $('#table_user_subcription').DataTable({
            processing: true,
            // serverSide: true,
            ajax: '{{ route('fetch-user-subcription') }}',
            columns: [{
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
                    "data": "ip_address",
                    "defaultContent": "<i>Not set</i>"
                },
                {
                    "data": "is_verified",
                    "render": function(data, type, row) {
                        return data == 1 ? 'Yes' : 'No';
                    },
                    "defaultContent": "<i>Not set</i>"
                },
                // {
                //     'data': null,
                //     title: 'Action',
                //     wrap: true,
                //     "render": function(item) {
                //         return '<button type="button" data-email_id="' + item.id +
                //             '" data-email_type="' + item.email_type +
                //             '" class="btn btn-outline-info btn-sm mt-2 mr-1 detail_email_template" data-toggle="modal" data-target="#ModalEmailTemplate" title="Detail Product"><i class="fas fa-edit"></i></button>'
                //     }
                // },
            ]
        });
    });
</script>