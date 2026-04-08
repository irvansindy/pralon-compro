@extends('layouts.admin.app', ['title' => 'Security Logs'])

@section('title', 'Blocked Requests Log')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">🛡️ Blocked Requests Log</h2>
        {{-- <button id="btnTestAlert" class="btn btn-danger mb-3">🚨 Test Security Alert</button> --}}
        <div id="export" class="float-right">
            <div class="btn-group dropleft">
                {{-- dropdown-toggle --}}
                <button type="button" class="btn btn-info" id="btn-filter-request-block-log" data-toggle="dropdown">
                    <i class="fas fa-filter"></i>
                </button>

                <div class="dropdown-menu">
                    <form class="px-4 py-3 form-filter-request-block-log">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" id="start_date" value="">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="" value="">
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-danger" id="export_to_pdf">
                                <i class="fas fa-file-pdf"></i>
                            </button>
                            <button type="button" class="btn btn-success" id="export_to_excel">
                                <i class="fas fa-file-excel"></i>
                            </button>
                            <button type="button" class="btn btn-primary" id="search_data_table">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table id="logTable" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Type</th>
                    <th>IP</th>
                    <th>User Agent</th>
                    <th>URL</th>
                    <th>Extra</th>
                </tr>
            </thead>
            <tbody>
                {{-- Data akan diisi via jQuery --}}
            </tbody>
        </table>

    </div>
@endsection

@push('js')
    <!-- Pusher & Echo -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logTable').DataTable({
                processing: true,
                ajax: {
                    'url': '{{ route('security-logs-data') }}',
                    'type': 'GET',

                },
                columns: [{
                        "data": "time",
                        "defaultContent": "<i>Not set</i>",
                        "render": function(data, type, row) {
                            let timeValue = data || row.created_at;
                            if (!timeValue) return "<i>Not set</i>";

                            // Buat objek Date
                            let date = new Date(timeValue);

                            // Deteksi offset timezone lokal
                            let offset = date.getTimezoneOffset() / -60; // -60 untuk WIB (+7)
                            let zone = "WIB";
                            if (offset === 8) zone = "WITA";
                            else if (offset === 9) zone = "WIT";

                            // Format pendek (DD/MM/YYYY HH:mm WIB)
                            let shortFormat = date.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            }) + ' ' + date.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: false
                            }) + ` ${zone}`;

                            // Format panjang (DD/MM/YYYY HH:mm:ss WIB)
                            let longFormat = date.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            }) + ' ' + date.toLocaleTimeString('id-ID', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: false
                            }) + ` ${zone}`;

                            // Return format pendek (default)
                            return `<span title="${longFormat}">${shortFormat}</span>`;
                        }
                    },
                    {
                        "data": "type",
                        "defaultContent": "<i>Not set</i>"
                    },
                    {
                        "data": "ip",
                        "defaultContent": "<i>Not set</i>"
                    },
                    {
                        "data": "user_agent",
                        "defaultContent": "<i>Not set</i>",
                        "render": function(data, type, row) {
                            if (!data) return "<i>No User-Agent</i>";

                            return `
                                <b>Browser:</b> ${data.browser || 'N/A'}<br>
                                <b>OS:</b> ${data.os || 'N/A'}<br>
                                <b>Device:</b> ${data.device || 'N/A'}<br>
                                <b>Mobile:</b> ${data.is_mobile ? '✅' : '❌'}<br>
                                <b>Tablet:</b> ${data.is_tablet ? '✅' : '❌'}<br>
                                <b>Bot:</b> ${data.is_robot ? '🤖' : '❌'}<br>
                                <small>${data.raw}</small>
                            `;
                        }
                    },
                    {
                        "data": "url",
                        "defaultContent": "<i>Not set</i>"
                    },
                    {
                        "data": "extra.info",
                        "defaultContent": "<i>Not set</i>"
                    },

                ],
            })

            $(document).on('click', '#btnTestAlert', function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('security-test-alert') }}",
                    method: "POST",
                    success: function(response) {
                        toastr.success('Test alert berhasil dikirim ke super-admin!',
                            'Success', {
                                timeOut: 3000
                            });
                    },
                    error: function(xhr) {
                        toastr.error('Gagal mengirim test alert.', 'Error', {
                            timeOut: 3000
                        });
                    }
                });
            });

            $(document).on('click', '#btn-filter-request-block-log', function(e) {
                e.preventDefault()
                $('.form-filter-request-block-log')[0].reset()
                let start_date = $('#start_date').val()
                let end_date = $('#end_date').val()
            })

            $(document).on('click', '#export_to_pdf', function(e) {
                e.preventDefault()
                let start_date = $('#start_date').val()
                let end_date = $('#end_date').val()
            })
        });

        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true,
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });

        const channel = pusher.subscribe('private-super-admin.alerts');
        channel.bind('security.alert', function(data) {
            console.log('🔔 Security Alert:', data);

            // Append to table
            $('#logTable tbody').prepend(`
                <tr>
                    <td>${data.time}</td>
                    <td>${data.type}</td>
                    <td>${data.ip}</td>
                    <td>${data.user_agent}</td>
                    <td>${data.url}</td>
                    <td>${data.extra}</td>
                </tr>
            `);
        });
    </script>
@endpush