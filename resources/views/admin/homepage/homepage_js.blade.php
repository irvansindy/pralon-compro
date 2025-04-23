<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('dblclick', '#card_header', function(e) {
            e.preventDefault();
            $('#ModalHeaderSection').modal('hide');
            $('#ModalHeaderSection').modal('show');
            $('#button_action_form_header_section').empty();
            $('#button_action_form_header_section').append(`
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit_header">Submit</button>
            `);
            $('#form_header_home_page')[0].reset();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-header-home-page') }}",
                type: 'GET',
                success: function(res) {
                    if (res.data != null) {
                        $('#header_id').val(res.data.id);
                        $('#header_title').val(res.data.title);
                        $('#header_subtitle').val(res.data.subtitle);
                        $('#header_description').val(res.data.description);
                        $('#header_image_cover').val(res.data.image_cover);
                        $('#header_video').val(res.data.video);
                    } else {
                        $('#form_header_home_page')[0].reset();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            });
        });

        $(document).on('click', '#submit_header', function(e) {
            e.preventDefault();
            let formData = new FormData($('#form_header_home_page')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('submit-header-home-page') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('.text-danger').html('');
                    $('#form_header_home_page')[0].reset();
                    $('#ModalHeaderSection').modal('hide');
                    // success handling
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)

                    if (xhr.status === 422) {
                        $('.text-danger').html('');
                        $.each(response_error.meta.message.errors, function(key, value) {
                            $(`#message_${key}`).html(value[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                }
            });
        });

        $(document).on('dblclick', '#card_product', function(e) {
            e.preventDefault();
            $('#ModalProductSection').modal('hide');
            $('#ModalProductSection').modal('show');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-product-home-page') }}",
                type: 'GET',
                success: function(res) {
                    if (res.data != null) {
                        $('#product-table tbody').empty();
                        $.each(res.data, function(index, product) {
                            $('#product-table tbody').append(`
                                <tr id="row_${product.product_id}" data-id="${product.product_id}">
                                    <td class="row-index">${index+1}</td>
                                    <td>${product.product_name}</td>
                                    <td>${product.product_full_name}</td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#product-table tbody').empty();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            })
        });

        $('#sortable').sortable({
            placeholder: 'ui-state-highlight',
            cursor: 'move',
            update: function() {
                updateRowNumber();
            }
        });

        // Update angka "No" berdasarkan posisi
        function updateRowNumber() {
            $('#sortable tr').each(function(index) {
                $(this).find('.row-index').text(index + 1);
            });
        }
        function updateProjectRowNumber() {
            $('#project-sortable tr').each(function(index) {
                $(this).find('.row-index').text(index + 1);
            });
        }
        function updateNewsRowNumber() {
            $('#news-sortable tr').each(function(index) {
                $(this).find('.row-index').text(index + 1);
            });
        }

        // Jalankan awal
        updateRowNumber();

        $(document).on('click', '#saveOrderBtn', function(e) {
            e.preventDefault();
            let order = [];

            $('#sortable tr').each(function(index) {
                let id = $(this).data('id');
                order.push({
                    id: id,
                    sort_order: index + 1
                });
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('save-order-product-home-page') }}",
                data: {
                    order: order
                },
                success: function(res) {
                    $('#ModalProductSection').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            });
        });

        $(document).on('dblclick', '#card_about_us', function(e) {
            e.preventDefault();
            $('#modalHistoryAboutUs').modal('hide')
            $('#modalHistoryAboutUs').modal('show')
            $('#form_history_about_us')[0].reset()
            $('#button_action_form_history_about_us').empty()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('fetch-about-us-home-page') }}',
                method: 'GET',
                success: function(res) {
                    let history_data = res.data
                    if (history_data == null) {
                        $('#form_history_about_us')[0].reset()
                        $('#link_thumbnail_video').empty()
                    } else {
                        $('#form_history_about_us')[0].reset()
                        $('#history_id').val(history_data.id)
                        $('#history_title').val(history_data.title)
                        $('#history_subtitle').val(history_data.subtitle)
                        // $('#history_source_thumbnail_video').val(history_data.source_thumbnail_video)
                        $('#link_thumbnail_video').empty()
                        $('#link_thumbnail_video').append(
                            `<a href="" id="link_source_thumbnail_video" target="_blank">Link Thumbnail</a>`
                            )
                        let data_thumbnail = history_data.source_thumbnail_video
                        $("#link_source_thumbnail_video").attr("href", data_thumbnail);
                        $('#history_source_video').val(history_data.source_video)
                        $('#history_link').val(history_data.history_link)
                        $('#history_desc').val(history_data.desc)
                    }
                    $('#button_action_form_history_about_us').append(`
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit_about_us">Submit</button>
                    `)
                }
            })
        })

        $(document).on('click', '#submit_about_us', function(e) {
            e.preventDefault();
            let formData = new FormData($('#form_history_about_us')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('submit-about-us-home-page') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('.text-danger').html('');
                    $('#form_history_about_us')[0].reset();
                    $('#modalHistoryAboutUs').modal('hide');
                    // success handling
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)

                    if (xhr.status === 422) {
                        $('.text-danger').html('');
                        $.each(response_error.meta.message.errors, function(key, value) {
                            $(`#message_${key}`).html(value[0]);
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                }
            });
        })

        $(document).on('dblclick', '#card_project_references', function(e) {
            e.preventDefault()
            $('#ModalProjectSection').modal('hide');
            $('#ModalProjectSection').modal('show');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-project-references-home-page') }}",
                type: 'GET',
                success: function(res) {
                    if (res.data != null) {
                        $('#project-table tbody').empty();
                        $.each(res.data, function(index, project) {
                            $('#project-table tbody').append(`
                                <tr id="row_${project.product_id}" data-id="${project.news_id}">
                                    <td class="row-index">${index+1}</td>
                                    <td>${project.news_title}</td>
                                    <td>${project.project_location}</td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#project-table tbody').empty();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            })
        })

        $('#project-sortable').sortable({
            placeholder: 'ui-state-highlight',
            cursor: 'move',
            update: function() {
                updateProjectRowNumber();
            }
        });
        updateProjectRowNumber()

        $(document).on('click', '#saveOrderProjectBtn', function(e) {
            e.preventDefault()
            e.preventDefault();
            let order = [];

            $('#project-sortable tr').each(function(index) {
                let id = $(this).data('id');
                order.push({
                    id: id,
                    sort_order: index + 1
                });
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('save-order-project-home-page') }}",
                data: {
                    order: order
                },
                success: function(res) {
                    $('#ModalProjectSection').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            });
        });
        
        $(document).on('dblclick', '#card_testimonials', function(e) {
            e.preventDefault()
            $('#ModaTestimonialSection').modal('hide');
            $('#ModaTestimonialSection').modal('show');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-testimonial-home-page') }}",
                type: 'GET',
                success: function(res) {
                    $('#list-testimonial').DataTable().clear().destroy()
                    $('#list-testimonial tbody').empty()
                    $.each(res.data, function(index, testimonial) {
                        $('#list-testimonial tbody').append(`
                            <tr id="row_${testimonial.id}" data-id="${testimonial.id}">
                                <td class="row-index">${index+1}</td>
                                <td>${testimonial.name}</td>
                                <td>${testimonial.position}</td>
                                <td>
                                    <button type="button" class="btn btn-primary detail-testimonial" data-testi_id="${testimonial.id}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                    $('#list-testimonial').DataTable()
                    
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            })
        })

        $(document).on('click', '#create-new-testi', function(e) {
            e.preventDefault()
            $('#ModaTestimonialSection').modal('hide')
            $('#ModalFormTestimonial').modal('hide')
            $('#ModalFormTestimonial').modal('show')
            $('#form-testimonial')[0].reset()
            $('#testi_id').val('')
            $('#button-form-testimonial').empty()
            $('#button-form-testimonial').html(`
                <button type="button" class="btn btn-danger" id="btn-close-modal-form-testimonial" data-dismiss="modal" aria-label="Close">
                        Cancel
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-testimonial">Simpan</button>
            `)
        })

        $(document).on('click', '#close-modal-form-testimonial', function(e) {
            e.preventDefault()
            $('#ModaTestimonialSection').modal('show')
            $('#ModalFormTestimonial').modal('hide')
            $('#form-testimonial')[0].reset()
            $('#testi_id').val('')
        })

        $(document).on('click', '#btn-save-testimonial, #btn-update-testimonial', function(e) {
            e.preventDefault()
            let data = new FormData($('#form-testimonial')[0])
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('submit-testimonial') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(res) {
                    $('.text-danger').html('')
                    $('#form-testimonial')[0].reset()
                    $('#ModalFormTestimonial').modal('hide')
                    // success handling
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    let response_error = JSON.parse(xhr.responseText)

                    if (xhr.status === 422) {
                        $('.text-danger').html('')
                        $.each(response_error.meta.message.errors, function(key, value) {
                            $(`#message_${key}`).html(value[0])
                        })
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: 'Error!',
                            text: 'Silahkan hubungi team ICT!.',
                        })
                    }
                }
            })
        })

        $(document).on('click', '.detail-testimonial', function(e) {
            e.preventDefault()
            let id = $(this).data('testi_id')
            $('#ModaTestimonialSection').modal('hide')
            $('#ModalFormTestimonial').modal('hide')
            $('#ModalFormTestimonial').modal('show')
            $('#form-testimonial')[0].reset()
            $('#testi_id').val(id)
            $('#button-form-testimonial').empty()
            $('#button-form-testimonial').html(`
                <button type="button" class="btn btn-danger" id="btn-close-modal-form-testimonial" data-dismiss="modal" aria-label="Close">
                        Cancel
                </button>
                <button type="submit" class="btn btn-primary" id="btn-update-testimonial">Update</button>
            `)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-testimonial-home-page-by-id') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.data != null) {
                        $('#testi_name').val(res.data.name)
                        $('#testi_position').val(res.data.position)
                        $('#testi_message').val(res.data.message)
                    } else {
                        $('#form-testimonial')[0].reset()
                    }
                },
            })
        })

        $(document).on('click', '#btn-close-modal-form-testimonial', function(e) {
            e.preventDefault()
            $('#ModaTestimonialSection').modal('show')
            $('#ModalFormTestimonial').modal('hide')
            $('#form-testimonial')[0].reset()
            $('#testi_id').val('')
        })

        $(document).on('dblclick', '#card_blog_and_news', function(e) {
            e.preventDefault()
            $('#ModalNewsSection').modal('hide');
            $('#ModalNewsSection').modal('show');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('fetch-news-home-page') }}",
                type: 'GET',
                success: function(res) {
                    if (res.data != null) {
                        $('#news-table tbody').empty();
                        $.each(res.data, function(index, news) {
                            $('#news-table tbody').append(`
                                <tr id="row_${news.news_id}" data-id="${news.news_id}">
                                    <td class="row-index">${index+1}</td>
                                    <td>${news.news_title}</td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#news-table tbody').empty();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            })
        })

        $('#news-sortable').sortable({
            placeholder: 'ui-state-highlight',
            cursor: 'move',
            update: function() {
                updateNewsRowNumber();
            }
        });
        updateNewsRowNumber()

        $(document).on('click', '#saveOrderNewsBtn', function(e) {
            e.preventDefault()
            e.preventDefault();
            let news = [];

            $('#news-sortable tr').each(function(index) {
                let id = $(this).data('id');
                news.push({
                    id: id,
                    sort_order: index + 1
                });
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('save-order-news-home-page') }}",
                data: {
                    news: news
                },
                success: function(res) {
                    $('#ModalNewsSection').modal('hide');
                    Swal.fire({
                        icon: "success",
                        title: 'Success!',
                        text: res.meta.message,
                    })
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: "error",
                        title: 'Error!',
                        text: 'Terjadi kesalahan, Silahkan refresh atau contact admin ICT!',
                    })
                }
            });
        });
        
    });
</script>
