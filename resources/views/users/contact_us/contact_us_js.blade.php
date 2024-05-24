<script>
    $(document).ready(function() {
        var lebar = $(window).width()
        var tinggi = $(window).height()
        // alert('lebar :'+lebar)
        // alert('tinggi :' +tinggi)
        fetchContactUs()
        function fetchContactUs() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("fetch-contact-us") }}',
                type: 'GET',
                // data: { 
                //     offset: offset_data,
                //     limit: limit_fetch
                // },
                dataType: 'json',
                async: true,
                success: function(res) {
                    $('#list_contact_us').empty()
                    $.each(res.data, function(i, contact) {
                        $('#list_contact_us').append(`
                        <div class="col">
                            <div class="df-blog4__box">
                                <div class="df-blog4__thumb">
                                    <a href="#  "><img src="{{ asset('assets/img/pralon/contact/${contact.image}') }}"
                                            alt="image not found"></a>
                                </div>
                                <div class="df-blog4__content">
                                    <h3 class="df-blog4__title">
                                        <a href="#">${contact.name}</a>
                                    </h3>
                                    <p title="${contact.address}">${contact.address}</p>
                                    <div class="row row-cols-1 py-2" style="font-size: 12px !important;">
                                        <div class="col">
                                            <span style="font-size: 12px !important;">
                                                <i class="fa-solid fa-envelope"></i>
                                                <a href="mailto:${contact.email}" style="font-size: 12px !important;">${contact.email}</a>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span style="font-size: 12px !important;">
                                                <i class="fa-solid fa-phone"></i>
                                                ${contact.phone_number}
                                            </span>

                                        </div>
                                        <div class="col">
                                            <span style="font-size: 12px !important;">
                                                <i class="fa-solid fa-fax"></i> ${contact.fax}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `)
                    })
                }
            })
        }
    })
</script>