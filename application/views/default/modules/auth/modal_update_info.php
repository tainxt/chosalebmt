<link href="<?php echo base_url(); ?>components/default/css/datepicker3.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>components/default/js/bootstrap-filestyle.min.js"></script>
<script src="<?php echo base_url(); ?>components/default/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>components/default/script/update-user-info.js" type="text/javascript"></script>


<div class="modal fade" id="update-user-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-update-info" action="#" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-user" aria-hidden="true"></i> Cập nhật thông tin cá nhân
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group col-xs-12">
                        <div class="row">
                            <div class="col-sm-3 col-xs-4 row">
                                <img id="preview-avatar" src="<?php echo base_url() . "uploads/shop/noavatar.png" ?>" class="img-responsive" width="100" height="100"/>
                            </div>

                            <div class="col-sm-8 col-xs-8">
                                <label>Chọn ảnh đại diện</label>
                                <input type="file" accept = "image/*" name="avatar" id="BSbtndanger" required="required" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input id="txt-number" type="text" name="ud_phone" class="form-control" required="required"/>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="ud_dob" class="form-control pull-right" id="txt-date" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <textarea class="form-control" name="ud_address" required="required" style="max-width: 100%;" placeholder="Ví dụ: 1234 Trần Văn Rựa, P.Xyz, Tp.Buôn Ma Thuột"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <span id="result-update"></span>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger " data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-success update-user-info">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>