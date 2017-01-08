<link type="text/css" rel="stylesheet" href=" <?php echo base_url() . "components/default/css/select2.min.css"; ?> ">
<link type="text/css" rel="stylesheet" href=" <?php echo base_url() . "components/default/css/add-product.css"; ?> ">
<script src="<?php echo base_url() . "components/default/js/select2.full.min.js"; ?>"></script>
<script src="<?php echo base_url() . "components/default/js/add-product.js"; ?>"></script>
<script src="<?php echo base_url() . "components/default/js/jquery.number.js"; ?>"></script>
<script src="<?php echo base_url(); ?>js/ajax-upload.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
    $(function () {
        $(".select2").select2();
        $('#p-price').number(true, 0);
        CKEDITOR.replace('product_description');
    });

</script>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="label-box-category col-sm-2 col-xs-12 label-size">Đăng sản phẩm</div>
                </div>
                <div class="box-body">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" data-step="1" type="button" class="btn btn-primary btn-circle step-1">1</a>
                                <p>Nhập thông tin</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" data-step="2" type="button" class="btn btn-default btn-circle step-2" disabled="disabled">2</a>
                                <p>Chọn hình ảnh</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" data-step="3" type="button" class="btn btn-default btn-circle step-3" disabled="disabled">3</a>
                                <p>Hoàn thành</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-10 col-xs-12">
                        <form id="add-product-form" class="box-body-add-product col-xs-10" method="post" action="#" role="form">
                            <div class="row setup-content" id="step-1">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">Thông tin sản phẩm</legend>

                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12">
                                                <div class="form-group">
                                                    <label>Khu vực</label>
                                                    <select name="region" class="form-control">
                                                        <?php foreach($list_regions as $region):?>
                                                        <option value="<?php echo $region->id; ?>"><?php echo $region->name; ?></option>
                                                        <?php endforeach;?>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <label>Danh mục sản phẩm</label>
                                                    <select name="p_cat" class="form-control select2" data-placeholder="Chọn danh mục sản phẩm" style="width: 100%;" >
                                                        <?php
                                                        foreach ($list_cat as $cat):
                                                            ?>
                                                            <option value="<?php echo $cat->cat_id; ?>" disabled="disabled"><?php echo $cat->cat_name; ?></option>
                                                            <?php
                                                            $sub_parent = $cat->cat_id;
                                                            $list_sub_cat = $this->S_Default->getChildbyParent($sub_parent);
                                                            foreach ($list_sub_cat as $sub_cat):
                                                                echo '<option value="' . $sub_cat->cat_id . '"> -- ' . $sub_cat->cat_name . '</option>';
                                                            endforeach;
                                                            ?>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="input-product-name form-group">
                                            <label>Tên sản phẩm </label><span class="info-label"> (bắt buộc) </span>
                                            <input name="name" type="text" class="form-control" placeholder="Ví dụ: iPhone 7" required="required">
                                            <input type="hidden" name="slug" class="slug" />
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Giá sản phẩm (VNĐ)</label>
                                            <input id="p-price" name="price" type="text" class="form-control" placeholder="Giá tiền của sản phẩm" required="required"  >
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12 box-status">
                                        <div class="form-group">
                                            <label>Tình trạng</label> <span class="info-label"></span>
                                            <select name="status" class="form-control status-product">
                                                <option value="0">Sản phẩm mới (100%)</option>
                                                <option value="1">Sản phẩm cũ (%)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 percent-status">
                                        <div class="form-group">
                                            <label>Tỷ lệ (%)</label>
                                            <input name="status_val" type="number" class="form-control" value="100" placeholder="% còn mới của sản phẩm"  required="required" >
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12">
                                        <div class="input-product-qty form-group">
                                            <label>Số lượng </label><span class="info-label"> (bắt buộc) </span>
                                            <input name="qty" type="number" class="form-control txt-qty" placeholder="0" required="required">
                                            <span class="input-error qty-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12 box-discount">
                                        <div class="form-group">
                                            <label>Sản phẩm giảm giá</label>
                                            <select name="discount" class="form-control discount-product">
                                                <option value="0">Không giảm giá</option>
                                                <option value="1">Có (%)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12 percent-discount">
                                        <div class="form-group">
                                            <label>Phần trăm giảm giá (%)</label>
                                            <input name="discount_val" type="number" class="form-control" value="0" placeholder="Số % giảm giá của sản phẩm"  required="required" >
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <label>Phương thức vận chuyển</label>
                                            <textarea name="transport" class="form-control" placeholder="Ví dụ: Miễn phí vận chuyển trong thành phố" style="max-width: 100%;"></textarea>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>Nội dung sản phẩm</legend>
                                    <div class="col-xs-12">
                                        <div class="input-product-keyword form-group">
                                            <label>Từ khóa sản phẩm</label> <span class="info-label"> (Để Google biết đến sản phẩm của bạn) </span>
                                            <input name="keyword" type="text" class="form-control" placeholder="Ví dụ: iphone 7 giá rẻ"  >
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="input-product-tag form-group">
                                            <label>Thẻ sản phẩm (#Tag)</label><span class="info-label"> (Để mọi người biết đến sản phẩm của bạn) </span>
                                            <input name="tag" type="text" class="form-control" placeholder="Ví dụ: iPhone 7"  >
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Mô tả chung</label> <span class="info-label"> (Giới thiệu về sản phẩm của bạn) </span>
                                            <a href="http://pik.vn/" class="btn btn-primary" title="Upload ảnh nhanh tại pik.vn" target="_blank" onclick="return pikvn_popup();">Thêm ảnh với pik.vn</a>
                                            <textarea name="description" id="product_description" class="textarea" placeholder="Mô tả chung về sản phẩm của bạn" required="required"></textarea>
                                        </div>

                                    </div>
                                </fieldset>
                                <div class="col-xs-12">
                                    <br />
                                    <button class="btn btn-primary nextBtn" type="button" >
                                        Tiếp theo 
                                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="row setup-content" id="step-2">

                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><b>Lưu ý khi tải hình lên</b></h3>
                                        </div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Dung lượng tối đa mà bạn có thể tải lên là 5MB.</li>
                                                <li>Chỉ có định dạng (<strong>JPG, GIF, PNG</strong>) được cho phép tải lên.</li>
                                                <li>Khi chưa hoàn thành đăng tải sản phẩm mà rời khỏi trang này, hình của bạn sẽ bị xóa.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12">

                                    <div class="img-zone text-center" id="img-zone">
                                        <div class="img-drop">
                                            <h2><small>Kéo &amp; Thả hình vào đây</small></h2>
                                            <p><em>- Hoặc -</em></p>
                                            <h2><i class="glyphicon glyphicon-camera"></i></h2>
                                            <span class="btn btn-success btn-file">
                                                Click vào đây để tải hình lên
                                                <input type="file" multiple="" accept="image/*">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="progress hidden">
                                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active">
                                            <span class="sr-only">0% Complete</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xs-12">
                                    <div id="img-preview" class="row">

                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <br />
                                    <button class="btn btn-primary nextBtn" type="button" >
                                        Tiếp theo 
                                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row setup-content" id="step-3">
                                <div class="col-sm-12 col-xs-12">
                                    <h4>Khách hàng liên hệ với tôi qua.</h4>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label><input type="radio" id="cur-address" name="cbx-contact" checked="checked">Sử dụng địa chỉ của tài khoản</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label><input type="radio" id="new-address" name="cbx-contact">Thêm địa chỉ khác</label>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input name="p_seller" type="text" class="form-control ct-name" placeholder="Nhập họ và tên của bạn" required="required" value="<?php echo $user_info->u_fullname; ?>" disabled="disabled">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input name="p_seller_phone" type="text" class="form-control ct-phone" placeholder="Nhập số điện thoại của bạn" required="required" value="<?php echo $user_info->ud_phone; ?>" disabled="disabled">
                                    </div>
                                </div>

                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Địa chỉ liên hệ</label>
                                        <textarea name="p_seller_address" class="form-control ct-address" rows="3" disabled="disabled"><?php echo $user_info->ud_address; ?></textarea>
                                    </div>    
                                </div>

                                <button type="button" class="hidden add-success"></button>
                                <div class="col-xs-12">
                                    <br />
                                    <button class="btn btn-success btn-upload-form" type="button" >
                                        Hoàn thành
                                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-3 box-rules">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><b>Lưu ý khi đăng sản phẩm</b></h3>
                            </div>
                            <div class="panel-body">
                                <ul>
                                    <li>Vì lý do tránh những sản phẩm không hợp lệ hoặc vi phạm nên bài của bạn đăng tải chỉ xuất hiện khi được quản trị viên duyệt và thông qua.</li>
                                    <li>Không bán sản phẩm, hàng hóa vi phạm pháp luật. Nếu bạn cố tình quản trị viên sẽ xóa bài mà không cần báo trước.</li>
                                    <li>Phương thức thanh toán do người bán và người mua tự quyết định.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">

                </div>
            </div>
        </div>
    </div>
</div>