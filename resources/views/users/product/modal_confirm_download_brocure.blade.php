<!-- Modal -->
<div class="modal fade" id="confirm_download_brocure" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="confirm_download_brocureLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-2" id="confirm_download_brocureLabel">Form Download Brosur</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="df-booking2__form" style="padding: 10px !important;">
                <form action="" id="form_download_brocure">
                    @csrf
                    <div class="modal-body">
                        <div class="df-input-field">
                            <input type="text" name="fullname_brocure" id="fullname_brocure" placeholder="Nama Lengkap">
                        </div>
                        <div class="df-input-field">
                            <input type="text" name="phone_brocure" id="phone_brocure" placeholder="Nomor Telephone">
                        </div>
                        <div class="df-input-field"></div>
                        <input type="email" name="email_brocure" id="email_brocure" placeholder="Alamat Email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn bordered btn-x-small" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="primary-btn btn-x-small hover-white" id="submit_download_brocure" data-product_id="" data-product_brocure="" data-url_brocure="{{ route('download-catalog', ['catalog' => $product->brocure != NULL ? $product->brocure->file_name : NULL]) }}">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
