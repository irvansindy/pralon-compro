<!-- Page level plugins -->
<script src="{{ asset('assets/admin_pages/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin_pages/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        function fetchListMenu() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-menu') }}',
                method: 'GET',
                success: function(res) {
                    const menus = res.data
                    $('#list_menu').DataTable().clear().destroy();
                    $('#list_menu tbody').empty();
                    let status_active = ''
                    menus.forEach((menu, i) => {
                        status_active = menu.active == 1 ? 'active' : 'non-active'
                        $('#list_menu tbody').append(`
                            <tr>
                                <td>${i + 1}</td>
                                <td>${menu.name != null ? menu.name : 'not set'}</td>
                                <td>${menu.url != null ? menu.url : 'not set'}</td>
                                <td>${status_active}</td>
                                <td>
                                    <button class="btn btn-outline-danger mx-1 my-1 delete_menu" id="" style="float: right !important;" data-toggle="" data-target="#" data-delete_id="${menu.id}" title="delete menu">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary mx-1 my-1 check_list_submenu" id="" style="float: right !important;" data-toggle="modal" data-target="#listSubMenu" data-master_id="${menu.id}" title="list submenu">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-info mx-1 my-1 detail_menu" id="" style="float: right !important;" data-toggle="modal" data-target="#createMenu" data-detail_id="${menu.id}" title="detail menu">
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });

                    $('#list_menu').dataTable()
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            })
        }
        
        fetchListMenu()

        $(document).on('click', '#button_create_menu', function(e) {
            e.preventDefault()
            $('#form_create_menu')[0].reset()
            $('#button-footer').empty()
            $('#button-footer').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create_data_menu">Save</button>
            `)
        })

        $(document).on('click', '#create_data_menu', function(e) {
            e.preventDefault()
            let menu_name = $('#menu_name').val()
            let menu_url = $('#menu_url').val()
            let menu_icon = $('#menu_icon').val()
            // let menu_status = $('#menu_status').val()
            let is_active = '';
            if ($('#menu_status').is(':checked')) {
                is_active = 1
                // alert(is_active)
            } else {
                is_active = 0
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-menu') }}',
                method: 'POST',
                data: {
                    name: menu_name,
                    url: menu_url,
                    icon: menu_icon,
                    active: is_active
                },
                dataType: 'json',
                // async: true,
                success: function(res){
                    $('#createMenu').modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                    fetchListMenu()
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'gagal memuat data, silahkan hubungi admin.',
                    })
                }
            })
        })

        $(document).on('click', '.detail_menu', function(e) {
            e.preventDefault()
            $('#form_create_menu')[0].reset()
            $('#button-footer').empty()
            $('#button-footer').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_data_menu">Update</button>
            `)
            let id = $(this).data('detail_id')
            $('#update_data_menu').attr('data-update_id', id)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('detail-menu') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                async: true,
                success: function(res) {
                    $('#menu_name').val(res.data.name)
                    $('#menu_url').val(res.data.url)
                    $('#menu_icon').val(res.data.icon)
                    if (res.data.active = 1) {
                        $('#menu_status').prop('checked', true)
                    } else {
                        $('#menu_status').prop('checked', false)
                    }
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            })
        })

        $(document).on('click', '#update_data_menu', function(e) {
            e.preventDefault()
            let menu_name = $('#menu_name').val()
            let menu_url = $('#menu_url').val()
            let menu_icon = $('#menu_icon').val()
            let menu_id = $(this).data('update_id')
            let is_active = '';
            if ($('#menu_status').is(':checked')) {
                is_active = 1
                // alert(is_active)
            } else {
                is_active = 0
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('update-menu') }}',
                method: 'POST',
                data: {
                    id: menu_id,
                    name: menu_name,
                    url: menu_url,
                    icon: menu_icon,
                    active: is_active
                },
                dataType: 'json',
                // async: true,
                success: function(res){
                    $('#createMenu').modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                    fetchListMenu()
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'gagal memuat data, silahkan hubungi admin.',
                    })
                }
            })
            // <i class="fa fa-tachometer" aria-hidden="true"></i>
        })

        $(document).on('click', '.check_list_submenu', function(e) {
            e.preventDefault()
            let id = $(this).data('master_id')
            alert(id)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('detail-menu') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                async: true,
            })
        })
    })
</script>