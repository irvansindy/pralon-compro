<div class="modal fade" id="ModalProductSection" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalProductSectionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalProductSectionLabel">Product Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_header_home_page" enctype="multipart/form-data">
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="product-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Full Name</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                        </tbody>
                    </table>
                    
                    <button id="saveOrderBtn" class="btn btn-primary my-3 float-right">Submit</button>
                    
                </div>
                {{-- <div class="modal-footer" id="button_action_form_product_section">
                    
                </div> --}}
            </form>
        </div>
    </div>
</div>
