<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg login animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    Tài khoản Chosalebmt.com
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#Login" data-toggle="tab">Đăng nhập</a></li>
                            <li><a href="#Registration" data-toggle="tab">Đăng ký</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="Login">
                                <form role="form" class="form-horizontal login_form" method="post">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">
                                            Tài khoản</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="login_account" name="login_account" placeholder="Nhập tên tài khoản" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="col-sm-2 control-label">
                                            Mật khẩu</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Nhập mật khẩu" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <span id="login_error"></span>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Xác nhận</button>
                                            <a href="" style="color:red">Quên mật khẩu?</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="Registration">
                                <form role="form" action="#" class="form-horizontal register_form" method="post">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Tên</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select class="form-control" name="u_gender">
                                                        <option value="0">Anh.</option>
                                                        <option value="1">Chị.</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Họ và tên" name="u_fullname" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">
                                            Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="u_email" placeholder="Địa chỉ Email" name="u_email" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile" class="col-sm-2 control-label">Tài khoản</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="u_username" placeholder="Nhập vào tài khoản" name="u_username" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Mật khẩu</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" placeholder="Nhập vào mật khẩu" name="u_password" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">
                                            Xác nhận</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirm_password" placeholder="Xác nhận mật khẩu" required/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">
                                            Mã</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-3 col-xs-4 captcha-image"></div>
                                                <div class="col-md-9 col-xs-8">
                                                    <div class="input-group">
                                                        <span class="input-group-addon refesh-captcha " id="sizing-addon3"><i class="fa fa-refresh refresh-button" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control" name="captcha" id="confirm_captcha" placeholder="Xin nhập mã bảo vệ" aria-describedby="sizing-addon3" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <span id="register_error"></span>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-sm">Xác nhận</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Hủy bỏ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="OR" class="hidden-sm hidden-xs">
                            <i class="fa fa-arrows-h" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row text-center sign-with">
                            <div class="col-md-12">
                                <h3>
                                    Đăng nhập bằng</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-group btn-group-justified">
                                    <a href="#" class="btn btn-primary">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                        Facebook
                                    </a> 
                                    <a href="#" class="btn btn-danger">
                                        <i class="fa fa-google" aria-hidden="true"></i>
                                        Google
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>components/default/script/ajax-login.js" type="text/javascript"></script>