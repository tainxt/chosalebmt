<link href="<?php echo base_url(); ?>components/default/css/detail-product.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>components/default/css/ninja-slider.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>components/default/script/success-add-product.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>components/default/js/ninja-slider.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>components/default/js/jquery.collagePlus.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>components/default/js/jquery.removeWhitespace.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>components/default/js/jquery.collageCaption.js" type="text/javascript"></script>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-warning">
                <strong>Cảnh báo! </strong>Đây chỉ là bản xem thử của sản phẩm, mọi người sẽ thấy sản phẩm của 
                bạn sau khi quản trị viên duyệt bài đăng này. <br/>
                Đây là liên kết đến sản phẩm của bạn sau khi được duyệt <strong> <?php echo base_url()."sanpham/".$product->slug;?> </strong><br/>
                <strong>Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của Chosalebmt.com</strong>
            </div>
            <div class="box detail-product">

                <div class="box-header">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                        <?php
                        $parent_cat_id = $product->cat_parent;
                        if ($parent_cat_id > 0):
                            $parent_cat_1 = $this->M_Dangtin->get_parent_cat($parent_cat_id);
                            if ($parent_cat_1->cat_parent > 0):
                                $parent_cat_2 = $this->M_Dangtin->get_parent_cat($parent_cat_1->cat_parent);
                                echo '<li><a href="#">' . $parent_cat_2->cat_name . '</a></li>';
                                echo '<li><a href="#">' . $parent_cat_1->cat_name . '</a></li>';
                                echo '<li><a href="#">' . $product->cat_name . '</a></li>';
                            endif;
                        endif;
                        ?>
                        <li class="active"><?php echo $product->name; ?></li>        
                    </ol>
                </div>
                <div id="detail-product" class="box-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-6 col-xs-12"> 
                            <div class="gallery Collage effect-parent">
                                <?php
                                $total_img = count($product_imgs) - 4;
                                foreach ($product_imgs as $k => $img):
                                    //$k+=1;
                                    if ($k < 4):
                                        echo '<div class="Image_Wrapper">';
                                        echo '<a><img src="' . base_url() . 'uploads/files/thumb/' . $img->name . '" onclick="lightbox(' . $k . ')" /></a>';
                                        if ($k == 3) {
                                            echo '<div class="overlay-count-hide-img">+' . $total_img . '</div>';
                                        }
                                        echo '</div>';
                                        ?>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                            <div style="display:none;">
                                <div id="ninja-slider">
                                    <div class="slider-inner">
                                        <ul>
                                            <?php
                                            foreach ($product_imgs as $full_img):
                                                ?>
                                                <li>
                                                    <a class="ns-img" href="<?php echo base_url() . "uploads/files/" . $full_img->name; ?>"></a>
                                                    <div class="caption">
                                                        <h3><?php echo $full_img->alt; ?></h3>
                                                        <p><?php echo $full_img->title; ?></p>
                                                    </div>
                                                </li>
                                                <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                        <div id="fsBtn" class="fs-icon" title="Expand/Close"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <h2><?php echo $product->name; ?> <span>(Mới <?php echo $product->status_val; ?>%)</span> </h2>
                            <div class="product-time">
                                <span title="<?php echo date('H:i d/m/Y', strtotime($product->create_date)); ?>">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <script>moment_date("<?php echo $product->create_date; ?>");</script>
                                </span> 
                                | người bán  
                                <a href="http://localhost/ci_account/gianhang/<?php echo $product->u_username; ?>">
                                    <?php echo $product->u_fullname; ?>
                                </a>
                            </div>

                            <div class="view-rank">
                                <span> <i class="fa fa-eye" aria-hidden="true"></i> 
                                    <b><?php echo $product->views; ?></b> lượt xem | &nbsp;</span>
                                <div class="product-rate" data-score="4">
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-unvoted" aria-hidden="true"></i>

                                </div>
                                <span>&nbsp; (0 lượt đánh giá)</span>
                            </div>

                            <div class="box-product-price">
                                <?php
                                if ($product->discount > 0):
                                    $remain = $product->price - ($product->price / $product->discount_val);
                                    $saving = $product->price - $remain;
                                    ?>
                                    <p class="product-price"> Giá gốc: <?php echo number_format($product->price); ?> ₫  </p>
                                    <p class="percent-discount">Giảm giá: <span><?php echo number_format($product->discount_val); ?>%</span></p>
                                    <p class="product-discount"><span>Chỉ còn</span>&nbsp;&nbsp;<?php echo number_format($remain); ?> ₫</p>
                                    <p class="saving-money">Tiết kiệm: <span><?php echo number_format($saving); ?> ₫</span></p>
                                <?php else: ?>
                                    <p class="product-discount" style="margin-top: 10px"><span>Chỉ với giá </span>&nbsp;&nbsp;<?php echo number_format($product->price); ?> ₫</p>
                                <?php endif; ?>
                            </div>
                            <hr/>

                            <div class="box-add-product col-md-6 hidden-sm hidden-xs">
                                <div class="row">
                                    <label>Số lượng</label>
                                    <div class="select-qty">

                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="<?php echo $product->qty; ?>">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                            <span class="product-qty">/<?php echo $product->qty; ?></span>
                                        </div>

                                    </div>
                                    <div class="tool-box">
                                        <button class="btn btn-success">Thêm vào giỏ <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger">Yêu thích  <i class="fa fa-heart" aria-hidden="true"></i></button>
                                        <p>
                                            <label>Thẻ sản phẩm: </label> <span class="list-tag">
                                                <?php
                                                $tags = $product->tag;
                                                $list_tags = explode(",", $tags);
                                                foreach ($list_tags as $tag):
                                                    echo '<a href="' . base_url() . "tags/" . str_replace(" ", "-", $tag) . '">' . $tag . ',</a>';
                                                endforeach;
                                                ?>
                                            </span>
                                        </p>
                                        <p>
                                            <label>Tại danh mục: </label> <span class="list-tag"><a href="<?php echo base_url() . "danhmuc/" . $product->p_cat . "/" .$product->cat_slug; ?>"><?php echo $product->cat_name; ?></a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-add-product col-md-6 hidden-sm hidden-xs">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label style="width: 100%;">Chia sẻ sản phẩm trên mạng xã hội</label>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-comment"></i> Gửi</button>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Chia sẻ</button>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-thumbs-up"></i> Thích</button>
                                    </div>

                                    <hr>
                                    <div class="col-xs-12">
                                        <button class="report-product btn btn-sm btn-danger"><i class="fa fa-close"></i> Báo lỗi sản phẩm</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 hidden-lg hidden-md ">
                            <div class="box-add-product col-sm-6 col-xs-6">
                                <div class="row">
                                    <label>Số lượng</label>
                                    <div class="select-qty">

                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="<?php echo $product->qty; ?>">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                            <span class="product-qty">/<?php echo $product->qty; ?></span>
                                        </div>
                                    </div>
                                    <div class="tool-box">
                                        <button class="btn btn-success">Thêm vào giỏ <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger">Yêu thích  <i class="fa fa-heart" aria-hidden="true"></i></button>
                                        <p>
                                            <label>Thẻ sản phẩm: </label> <span class="list-tag">
                                                <?php
                                                $tags = $product->tag;
                                                $list_tags = explode(",", $tags);
                                                foreach ($list_tags as $tag):
                                                    echo '<a href="' . base_url() . "tags/" . str_replace(" ", "-", $tag) . '">' . $tag . ',</a>';
                                                endforeach;
                                                ?>
                                            </span>
                                        </p>
                                        <p>
                                            <label>Tại danh mục: </label> <span class="list-tag"><a href="<?php echo base_url() . "danhmuc/". $product->p_cat ."/". $product->cat_slug; ?>"><?php echo $product->cat_name; ?></a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-add-product col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label style="width: 100%;">Chia sẻ sản phẩm trên mạng xã hội</label>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-comment"></i> Gửi</button>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Chia sẻ</button>
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-thumbs-up"></i> Thích</button>
                                    </div>

                                    <hr/>
                                    <div class="col-xs-12">
                                        <button class="report-product btn btn-sm btn-danger"><i class="fa fa-close"></i> Báo lỗi sản phẩm</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="box-footer">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Thông tin người bán</a></li>
                        <li><a data-toggle="tab" href="#menu1">Mô tả sản phẩm</a></li>
                        <li><a data-toggle="tab" href="#menu2">Đánh giá người dùng</a></li>
                        <li><a data-toggle="tab" href="#menu3">Bình luận </a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active poster-info">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>
                                        <?php echo $shop_info->name ?>
                                    </h3>
                                    <label>Đánh giá gian hàng</label>: 
                                    <span class="product-rate">
                                        <?php
                                        $voter = $shop_info->vote;
                                        $vote_point = $shop_info->vote_point;
                                        if ($voter > 0 && $vote_point > 0):
                                            $star = floor($vote_point / $voter);
                                            for ($s = 1; $s <= $star; $s++):
                                                ?>
                                                <i class="fa fa-star voted" aria-hidden="true"></i>
                                                <?php
                                            endfor;
                                        else:
                                            echo "Chưa có đánh giá!";
                                        endif;
                                        ?>
                                    </span>
                                    <br/>
                                    <label>Chủ sở hữu</label>: <a href="<?php echo base_url() . "gianhang/" . $shop_info->u_username; ?>"><?php echo $shop_info->u_fullname; ?></a><br/>
                                    <label>Số điện thoại</label>: <a href="phone:<?php echo ($shop_info->phone); ?>"><?php echo ($shop_info->phone); ?></a> <br/>
                                    <label>Email</label>: <a href="mailto:<?php echo $shop_info->email; ?>"><?php echo $shop_info->email; ?></a> <br>
                                    <label>Địa chỉ</label>:<?php echo $shop_info->address; ?><br/>

                                </div>
                                <?php if($product->is_info === "1"):?>
                                <div class="col-sm-6">
                                    <h3>
                                        Hoặc liên hệ qua địa chỉ sau
                                    </h3>
                                    <label>Người bán</label>: <?php echo $product->fullname; ?> <br/>
                                    <label>Số điện thoại</label>: <a href="phone:<?php echo $product->phone; ?>"><?php echo $product->phone; ?></a> <br/>
                                    <label>Địa chỉ</label>: <?php echo $product->address; ?>
                                </div>
                                <?php endif;?>
                            </div>

                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <?php echo $product->description; ?>
                        </div>
                        <div id="menu2" class="tab-pane fade">

                            <p>Tính năng đang cập nhật</p>
                        </div>
                        <div id="menu3" class="tab-pane fade">

                            <p>Tính năng đang cập nhật</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
