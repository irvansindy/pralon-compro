<script>
    $(document).ready(function() {
        fetchProductList()
        
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            fetchProductList(url);
        });

        function fetchProductList(url = '/fetch-product') {
            $('.data_product_list').hide()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                dataType: 'json',
                async: true,
                beforeSend: function() {
                    $('#loading_animation_product').show()
                    $('.data_product_list').hide()
                },
                success: function(res) {
                    if (res.data.length != 0) {
                        $('#list_product').empty()
                        $.each(res.data, function(i, product) {
                            $('#list_product').append(`
                                <div class="col">
                                    <a href="/product-detail/${product.id}/${product.slug}" style="text-decoration:none !important;" class="each_product_detail" data-id="${product.id}" data-slug="${product.slug}">
                                        <div class="service__box">
                                            <div class="service__content">
                                                <div class="service__img">
                                                    <img src="{{ asset('assets/img/pralon/list_product/${product.image}') }}" alt="image Product">
                                                    </div>
                                                <h4 class="service__title">
                                                    ${product.name}
                                                </h4>
                                                <p class="service__text">${product.short_desc}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            `)
                        })

                        $('#pagination_product').empty()
                        if (res.links.length != 0) {
                            $('#pagination_product').append(`
                                <ul class="pagination pagination-lg pagination-circle justify-content-center mb-5" id="list_page_product">
                                </ul>
                            `)
                            $('#list_page_product').empty()
                            for (let index = 0; index < res.links.length; index++) {
                                let status = res.links[index].url != null ? 'active' : 'disabled';
                                let url = res.links[index].url != null ? res.links[index].url : '#';
                                // <a class="page-link" href="${res.links[index].url}" aria-label="Next">
                                //     <span aria-hidden="true">${res.links[index].label}</span>
                                // </a>
                                $('#list_page_product').append(`
                                <li class="page-item">
                                    <a class="page-link ${status}" href="${url}" aria-label="Next">
                                        <span aria-hidden="true">${res.links[index].label}</span>
                                    </a>
                                </li>
                                `)
                            }
                        }
                    }
                    $('#loading_animation_product').hide()
                    $('.data_product_list').show()
                    // alert(res.links[0].label)
                }
            })
        }

        // $(document).on('click', '.each_product_detail', function(e) {
        //     let id = $(this).data('id')
        //     let slug = $(this).data('slug')
        //     $.ajax({

        //     })
        // })
    })
</script>