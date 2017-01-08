<script>
    var base_url = "<?php echo base_url(); ?>";
    $(document).ready(function () {
        $('.products').addClass('active');
        $('.products .product_categories').addClass('active');
    });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Loại sản phẩm
            <small>danh sách các loại sản phẩm</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo admin; ?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="<?php echo admin . "/Products" ?>">Sản phẩm</a></li>
            <li class="active">Loại SP</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách loại sản phẩm</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div id="table-data-cat" class="box-body table-responsive ">
                        <ul class="table-ul-title">
                            <li>
                                <span class='row-cat-id'>#</span>
                                <span>Danh mục</span>
                                <span>Slug</span>
                                <span>Font Awesome</span>
                                <span>Hình</span>
                                <span>Chức năng</span>
                            </li>
                        </ul>

                        <?php

                        function has_children($rows, $id) {
                            foreach ($rows as $row) {
                                if ($row->cat_parent == $id)
                                    return true;
                            }
                            return false;
                        }

                        function build_menu($rows, $parent = 0) {
                            $result = "<ul class='table-content-ulli'>";
                            foreach ($rows as $row) {
                                if ($row->cat_parent == $parent) {
                                    $result.= "<li>";
                                    $result.= "<span class='row-cat-id'>{$row->cat_id}</span>";
                                    $result.= "<span>{$row->cat_name}</span>";
                                    $result.= "<span>{$row->cat_slug}</span>";
                                    $result.= "<span>{$row->cat_font_awesome} 	&nbsp;</span>";
                                    $result.= "<span>{$row->cat_img}</span>";
                                    $result.= "<span><a href='' class='btn-edit-cat' data-id='{$row->cat_id}'>Sửa</a> ";
                                    $result.= " | <a href='' class='btn-delete-cat' data-id='{$row->cat_id}'>Xóa</a></span>";
                                    if (has_children($rows, $row->cat_id)):
                                        $result.= build_menu($rows, $row->cat_id);
                                    endif;
                                    $result.= "</li>";
                                }
                            }
                            $result.= "</ul>";

                            return $result;
                        }

                        echo build_menu($categories);
                        ?>
                    </div>
                    <div class="box-footer clearfix">
                        <button class="btn btn-primary open-add-cat-modal">Thêm mới</button>
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" role="dialog"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form id="form-category" action="#" method="post" onsubmit="return false;">
                <div class="modal-header">
                    <button type="button" class="close btn-close-modal-add-cat">&times;</button>
                    <h4 class="modal-title">Thêm mới danh mục sản phẩm</h4>
                </div>
                <div class="modal-body">
                    <div class="my-input-form">
                        <div class="form-group">
                            <label for="">Tên danh mục</label>
                            <input type="text" id="cat_name" class="form-control" name="cat_name" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group">
                            <label for="">Hình đại diện</label>
                            <input type="text" id="cat_img" class="form-control" name="cat_img" placeholder="Hình đại diện" required>
                        </div>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input type="text" id="cat_slug" class="form-control" name="cat_slug" placeholder="Tên danh mục không dấu" required>
                        </div>
                        <div class="form-group">
                            <label for="">Class Font Awesome</label>
                            <input type="text" id="cat_font_awesome" class="form-control" name="cat_font_awesome" placeholder="fa-example" >
                        </div>
                        <div class="form-group">
                            <label for="">KeyWord</label>
                            <input type="text" id="cat_keyword" class="form-control" name="cat_keyword" placeholder="Từ khóa" required>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" id="cat_description" class="form-control" name="cat_description" placeholder="Mô tả" required>
                        </div>
                        <div class="form-group">
                            <label for="">Danh muc cha</label>
                            <select id="cat_parent" class="form-control select2" name="cat_parent" style="width: 100%;">
                                <option class="list-cat-id-0" value="0">Không</option>
                                <?php foreach ($categories as $category): ?>
                                    <option class="list-cat-id-<?php echo $category->cat_id; ?>" value="<?php echo $category->cat_id; ?>"><?php echo $category->cat_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="addnew-error"></div> 
                </div>
                <div class="modal-footer">
                    <div id="hidden-id"></div>
                    <button type="submit" id="btn-addnew-cat" class="btn btn-success">Xác nhận</button>
                    <a href="#" class="btn btn-danger btn-close-modal-add-cat">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>components/backend/plugins/select2/select2.full.min.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>components/backend/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>components/backend/bootstrap/js/bootstrap-confirm.js"></script>
<script src="<?php echo base_url() . "components/backend/script/" ?>cats.js"></script>
<link href="<?php echo base_url(); ?>components/backend/dist/css/ul-li-table.css" rel="stylesheet" type="text/css"/>

<script>
                $(function () {
                    $(".select2").select2();
                });
</script>
<style>
    .select2-container--default .select2-selection--single {
        border-radius: 0px;
    }

    .select2-container .select2-selection--single {
        height: 34px;
    }
</style>