<div class="modal fade" id="ModalFormTestimonial" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalFormTestimonialLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalFormTestimonialLabel">Form Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-modal-form-testimonial">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-testimonial" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="hidden" class="form-control" id="testi_id" name="testi_id" placeholder="Nama" required>
                        <input type="text" class="form-control" id="testi_name" name="testi_name" placeholder="Nama" required>
                        <span class="text-danger" id="message_testi_name" style="font-size: 12px;"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Posisi</label>
                        <input type="text" class="form-control" id="testi_position" name="testi_position" placeholder="Posisi" required>
                        <span class="text-danger" id="message_testi_position" style="font-size: 12px;"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Pesan</label>
                        <textarea class="form-control" name="testi_message" id="testi_message"></textarea>
                        <span class="text-danger" id="message_testi_message" style="font-size: 12px;"></span>
                    </div>
                </div>
                <div class="modal-footer" id="button-form-testimonial">
                    <button type="button" class="btn btn-danger" id="btn-close-modal-form-testimonial" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn-save-testimonial">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>