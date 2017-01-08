<?php
$all_cat = $this->S_Default->get_parent_cat();
?>

<!-- Modal -->
<div id="choose_cat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chọn loại sản phẩm muốn đăng</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <?php
                    foreach ($all_cat as $cat):
                        ?>

                        <div class="col-sm-4 text-center box-list-choose-cat" data-slug="<?php echo $cat->cat_slug; ?>">
                            <div class="form-group">

                                <i class="fa <?php echo $cat->cat_font_awesome; ?>" aria-hidden="true"></i> <br />
                                <?php echo $cat->cat_name; ?>

                            </div>
                        </div>

                        <?php
                    endforeach;
                    ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success choose_cat_up_btn" data-cat-slug="">Đăng sản phẩm</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>

    </div>
</div>