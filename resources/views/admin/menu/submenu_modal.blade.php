<!-- Modal -->
<div class="modal fade" id="createSubMenu" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createSubMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" id="form_create_submenu">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="submenu_name">Name</label>
                        <input type="hidden" class="form-control" id="master_menu_id" placeholder="Name">
                        <input type="text" class="form-control" id="submenu_name" name="submenu_name" placeholder="Name">
                        <span class="text-sm text-danger mt-2 message_submenu_name" id="message_submenu_name" role="alert" style="font-size: 12px !important;"></span>
                    </div>
                    <div class="form-group">
                        <label for="submenu_url">Url</label>
                        <input type="text" class="form-control" id="submenu_url" name="submenu_url" placeholder="Name">
                        <span class="text-sm text-danger mt-2 message_submenu_url" id="message_submenu_url" role="alert" style="font-size: 12px !important;"></span>
                    </div>
                    <div class="form-group">
                        <label for="submenu_icon">Icon</label>
                        <input type="text" class="form-control" id="submenu_icon" name="submenu_icon" placeholder="Name">
                        <span class="text-sm text-danger mt-2 message_submenu_icon" id="message_submenu_icon" role="alert" style="font-size: 12px !important;"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="submenu_status" name="submenu_status">
                            <label class="form-check-label" for="submenu_status">
                                Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button-footer-submenu">
                    
                </div>
            </form>
        </div>
    </div>
</div>
