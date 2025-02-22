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
                                    <button class="btn btn-outline-info mr-1 add_submenu" id="" style="float: right !important;" data-toggle="modal" data-target="#createSubMenu" data-add_submenu_id="${menu.id}" title="add submenu">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-danger mr-1 delete_menu" id="" style="float: right !important;" data-toggle="" data-target="#" data-delete_id="${menu.id}" title="delete menu">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary mr-1 check_list_submenu" id="" style="float: right !important;" data-toggle="modal" data-target="#listSubMenu" data-master_id="${menu.id}" title="list submenu">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-info mr-1 detail_menu" id="" style="float: right !important;" data-toggle="modal" data-target="#createMenu" data-detail_id="${menu.id}" title="detail menu">
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
            let is_active = '';
            if ($('#menu_status').is(':checked')) {
                is_active = 1
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

        $(document).on('click', '.add_submenu', function(e) {
            e.preventDefault()
            let id = $(this).data('add_submenu_id')
            $('#form_create_submenu')[0].reset()
            $('#master_menu_id').val(id)
            $('#message_submenu_name').text('')
            $('#message_submenu_url').text('')
            $('#message_submenu_icon').text('')
            $('#button-footer-submenu').empty()
            $('#button-footer-submenu').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create_data_submenu">Save</button>
            `)
        })

        $(document).on('click', '#create_data_submenu', function(e) {
            e.preventDefault()
            let master_menu_id = $('#master_menu_id').val()
            let submenu_name = $('#submenu_name').val()
            let submenu_url = $('#submenu_url').val()
            let submenu_icon = $('#submenu_icon').val()
            let is_active = '';
            $('#submenu_status').is(':checked', true) ? is_active = 1 : is_active = 0
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('store-submenu') }}',
                method: 'POST',
                data: {
                    id: master_menu_id,
                    name: submenu_name,
                    url: submenu_url,
                    icon: submenu_icon,
                    active: is_active
                },
                dataType: 'json',
                success: function(res) {
                    fetchListMenu()
                    $('#createSubMenu').modal('hide')
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)
                    if (response_error.meta.code == 422) {
                        $('#message_submenu_name').text('')
                        $('#message_submenu_url').text('')
                        $('#message_submenu_icon').text('')
                        $.each(response_error.meta.message.errors, function(i, value) {
                            $('#message_submenu_' + i.replace('.', '_')).text(value)
                        })
                    }
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
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('detail-submenu') }}',
                type: 'get',
                data: {
                    id: id
                },
                dataType: 'json',
                async: true,
                success: function(res) {
                    let submenus = res.data
                    $('#list_submenu').DataTable().clear().destroy();
                    $('#list_submenu tbody').empty();
                    let status_active = ''
                    submenus.forEach((submenu, i) => {
                        status_active = submenu.active == 1 ? 'active' : 'non-active'
                        $('#list_submenu tbody').append(`
                            <tr>
                                <td>${i + 1}</td>
                                <td>${submenu.name != null ? submenu.name : 'not set'}</td>
                                <td>${submenu.url != null ? submenu.url : 'not set'}</td>
                                <td>${status_active}</td>
                                <td>
                                    <button class="btn btn-outline-info mr-1 add_submenu" id="" style="float: right !important;" data-toggle="modal" data-target="#createSubMenu" data-add_submenu_id="${submenu.id}" title="add submenu">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-danger mr-1 delete_menu" id="" style="float: right !important;" data-toggle="" data-target="#" data-delete_id="${submenu.id}" title="delete menu">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary mr-1 check_list_submenu" id="" style="float: right !important;" data-toggle="modal" data-target="#listSubMenu" data-master_id="${submenu.id}" title="list submenu">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-outline-info mr-1 detail_menu" id="" style="float: right !important;" data-toggle="modal" data-target="#createMenu" data-detail_id="${submenu.id}" title="detail menu">
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    })
                    $('#list_submenu').DataTable()
                }
            })
        })
    })
</script>