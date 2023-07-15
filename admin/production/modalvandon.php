<div id="vandon" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập Nhập Trạng Thái Đơn Hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>ID</label>
                        <input class="form-control" id="idOrder" name="idOrder" type="number" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Chọn Thời Gian</label>
                        <input value="" name="updateDateStatus" type="datetime-local" step="1"
                               class="form-control" id="timeVanDon">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button id="btnSaveChangeStautus" name="tqnhan" type="submit" class="btn btn-primary" data-id="">
                    KhoTQ Nhận
                </button>
                <button id="btnSaveChangeStautus" name="nhapkhovn" type="submit" class="btn btn-warning" data-id="">
                    NhậpKho VN
                </button>
                <button id="btnSaveChangeStautus" name="dagiaoall" type="submit" class="btn btn-success" data-id="">
                    Đã Giao
                </button>
                <button id="btnSaveChangeStautus" name="reset" type="submit" class="btn btn-danger" data-id="">
                    Reset
                </button>
            </div>
            </form>
        </div>
    </div>
</div>