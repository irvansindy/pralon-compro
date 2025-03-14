<div class="modal fade" id="modalCertificateAboutUs" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalCertificateAboutUsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCertificateAboutUsLabel">Certificates About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" action="{{ route('store-certificate-about-us') }}" class="krajee-example-form" id="form_certificate_about_us">
                    @csrf
                    <div class="file-loading">
                        <input id="input-multiple-file" name="input-multiple-file[]" multiple type="file" accept="image/*" data-show-upload="true" data-show-caption="true">
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-lg btn-success btn-submit-sertificate"><i class="fa fa-upload"></i> Submit</button>
                        <button type="reset" class="btn btn-lg btn-secondary btn-reset-sertificate"><i class="fa fa-refresh"></i> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- modalCertificateAboutUs --}}