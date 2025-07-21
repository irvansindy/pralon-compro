<!-- Modal -->
<div class="modal fade" id="confirm_download_pricelist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="confirm_download_pricelistLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-2" id="confirm_download_pricelistLabel">Form Download Pricelist</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="df-booking2__form" style="padding: 10px !important;">
                <form action="" id="form_download_pricelist">
                    <div class="modal-body">
                        <div class="df-input-field">
                            <input type="text" name="fullname_pricelist" id="fullname_pricelist" placeholder="Nama Lengkap">
                        </div>
                        <div class="df-input-field">
                            <input type="text" name="phone_pricelist" id="phone_pricelist" placeholder="Nomor Telephone">
                        </div>
                        <div class="df-input-field"></div>
                        <input type="email" name="email_pricelist" id="email_pricelist" placeholder="Alamat Email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn bordered btn-x-small" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="primary-btn btn-x-small hover-white" id="submit_download_pricelist" data-product_id="" data-product_pricelist="" data-url_pricelist="{{ route('download-pricelist', ['pricelist' => $product->priceList != NULL ? $product->priceList->file_name : null]) }}">Submit</button> --}}
                        <button type="button" class="primary-btn btn-x-small hover-white" id="submit_download_pricelist" data-product_id="" data-product_pricelist="">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
