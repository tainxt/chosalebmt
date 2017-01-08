<script>
    var base_url = "<?php echo base_url(); ?>";
    $(document).ready(function () {
        $('.users').addClass('active');
        $('.users .user_list').addClass('active');
    })
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Người dùng
            <small>thành viên của website</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo admin; ?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Người dùng</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Bảng danh sách thành viên</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Tìm kiếm thành viên">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover user-data-table">
                            <tr>
                                <th>#ID</th>
                                <th>Họ tên</th>
                                <th>Tài khoản</th>
                                <th>Quyền hạn</th>
                                <th>Ngày tạo</th>
                                <th>Ảnh</th>
                                <th>Email</th>
                                <th>Điểm</th>
                                <th>Trạng thái</th>
                            </tr>
                            <?php
                            foreach ($users as $user):
                                $u_status = "";
                                switch ($user->u_status):
                                    case '1':
                                        $u_status = "<span class='label label-success'>Hoạt động</span>";
                                        break;

                                    case '2':
                                        $u_status = "<span class='label label-danger'>Tạm khóa</span>";
                                        break;

                                    default:
                                        $u_status = "<span class='label label-success'>Hoạt động</span>";
                                        break;
                                endswitch;
                                ?>

                                <tr>
                                    <td><?php echo $user->u_id; ?></td>
                                    <td>
                                        <a href="<?php echo base_url() . "admin/Users/UserDetail/" . $user->u_id; ?>" 
                                           title="Click xem chi tiết thành viên" id="view_detail">
                                               <?php echo $user->u_fullname; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $user->u_username; ?></td>
                                    <td><span class="label label-primary"><?php echo $user->r_name; ?></span></td>
                                    <td>
                                        <?php echo date('d/m/Y', strtotime($user->u_createdate)); ?>
                                    </td>
                                    <td class="grow_avatar">
                                        <img src="<?php echo base_url() . $user->u_image; ?>" width="60" height="60"  onerror="imgError(this);"/>
                                    </td>
                                    <td><a href="mailto:<?php echo $user->u_email; ?>"><?php echo $user->u_email; ?></a></td>
                                    <td><?php echo $user->u_point; ?> Point</td>
                                    <td>
                                        <?php echo $u_status; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" id="u_id" value="<?php echo $user->u_id; ?>"/>
                                        <button class="btn btn-warning btn-xs btn-edit" uid="<?php echo $user->u_id; ?>"
                                                data-toggle="modal" data-target="#myModal" 
                                                href="<?php echo admin . "/Users/EditUser/" . $user->u_id; ?>">
                                            Sửa
                                        </button>
                                        <button class="btn btn-danger btn-xs">Xóa</button>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <button id="addnew-btn" class="btn btn-primary" data-toggle="modal" data-target="#modal_add" 
                                href="<?php echo admin . "/Users/AddUser/"; ?>">
                            Thêm mới
                        </button>
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
<div class="modal fade" id="myModal" role="dialog"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="#" method="POST" role="form" id="update-user-form" onsubmit="return false;">
                <div class="modal-header">
                    <button type="button" class="close close_Modal" onclick="closeModal();">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="form_point">Họ và tên</label>
                        <input type="text" class="form-control" id="edit_fullname" placeholder="Họ và tên" required>
                    </div>
                    <div class="form-group">
                        <label for="form_point">Điểm</label>
                        <input type="number" class="form-control" id="edit_point" placeholder="Điểm">
                    </div>
                    <div class="form-group">
                        <label>Quyền hạn</label>
                        <select class="form-control" name="edit_role" id="edit_select_role">
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role->r_id; ?>" >
                                    <?php echo $role->r_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="edit_status" id="edit_select_status">
                            <option value="1">Hoạt động</option>
                            <option value="2">Tạm khóa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                    <button type="button" class="btn btn-danger close_Modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Add New User-->
<div class="modal fade" id="modal_add" role="dialog"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="#" method="POST" role="form" id="form-addnew" onsubmit="return false;">
                <div class="modal-header">
                    <button type="button" class="close close_Modal" onclick="closeModal();">&times;</button>
                    <h4 class="modal-title">Thêm mới thành viên</h4>
                </div>
                <div class="modal-body">
                    <!--<div class="center loading-process-img hidden">
                        <img src='http://www.arabianbusiness.com/skins/ab.main/gfx/loading_spinner.gif' 
                        class="img-responsive center-block">
                    </div>-->
                    <div class="info-form-adnew">
                        <div class="form-group">
                            <label for="u_fullname">Họ và tên</label>
                            <input required type="text" class="form-control" 
                                   id="u_fullname" name="u_fullname" placeholder="Họ và tên">
                        </div>

                        <div class="form-group">
                            <label for="u_username">Tên tài khoản</label>
                            <input required type="text" class="form-control" pattern="[A-Za-z0-9]{6,20}" 
                                   title="Tên tài khoản không dấu và từ 6 đến 20 ký tự"
                                   id="u_username" name="u_username" placeholder="Tên tài khoản">
                        </div>

                        <div class="form-group">
                            <label for="u_password">Mật khẩu</label>
                            <input required type="password" class="form-control" pattern=".{6}" 
                                   title="Mật khẩu tối thiểu phải 6 ký tự!"
                                   id="u_password" name="u_password" placeholder="Mật khẩu">
                        </div>

                        <div class="form-group">
                            <label for="u_password_confirm">Nhập lại mật khẩu</label>
                            <input required type="password" class="form-control" id="u_password_confirm" placeholder="Nhập lại mật khẩu">
                        </div>

                        <div class="form-group">
                            <label for="u_email">Email</label>
                            <input required type="email" class="form-control" id="u_email" name="u_email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label>Quyền hạn</label>
                            <select class="form-control" name="r_id" id="r_id">
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?php echo $role->r_id; ?>"><?php echo $role->r_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="addnew-error"></div>   

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-addnew" class="btn btn-success" 
                            oldurl="<?php echo base_url() . "admin/Users/" ?>">
                        Xác nhận
                    </button>
                    <button type="button" class="btn btn-danger close_Modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . "components/backend/script/users.js"; ?>"></script>