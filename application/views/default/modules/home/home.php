<!-- CSS Home -->
<link href="<?php echo base_url() ?>components/default/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>components/default/css/owl.theme.css" rel="stylesheet" type="text/css"/>

<!-- JS Home -->


<script src="<?php echo base_url() ?>components/default/js/owl.carousel.min.js" ></script>
<script src="<?php echo base_url() ?>components/default/js/home.js" ></script>

<?php
if (isset($_GET['login']) && $_GET['login'] === 'false'):
    ?>
    <script>
        $(document).ready(function () {
            $('#loginModal').modal('show');
        });
    </script>
    <?php
endif;
?>



<div class="container top-3-main-ads  hidden-xs">
    <div class="row">
        <?php for ($i = 0; $i < 3; $i++): ?>
            <div class="col-xs-4">
                <img src="<?php echo base_url() . "public/images/ads-1.png" ?>" class="img-responsive" />
            </div>
        <?php endfor; ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-10 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="label-box-category col-sm-2 col-xs-12 label-size">Sản phẩm mới</div>
                            <div class="col-sm-10 col-xs-12 list-cat-xs">
                                <div id="owl-cat-product" class="owl-carousel">
                                    <div class="item active" data-id='0'>
                                        <i class="fa fa-bars fa-2x" aria-hidden="true"></i><br>Tất cả
                                    </div>
                                    <?php
                                    $cats_lv0 = $this->S_Default->get_parent_cat();
                                    foreach ($cats_lv0 as $cat_lv0):
                                        ?>
                                        <div class="item" data-id="<?php echo $cat_lv0->cat_id; ?>">
                                            <i class="fa <?php echo $cat_lv0->cat_font_awesome; ?> fa-2x" aria-hidden="true"></i><br>
                                            <?php echo $cat_lv0->cat_name; ?>
                                        </div>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id="owl-demo" class="owl-carousel">
                                <?php
                                foreach ($new_10 as $product):
                                    $feature_img = $this->S_Default->feature_image($product->p_id);
                                    ?>
                                    <div id="form-add-to-cart" class="item">
                                        <div class="view view-first">
                                            <img src="<?php echo base_url() . "uploads/files/thumb/" . $feature_img->name; ?>" class="img-responsive" alt="">
                                            <div class="mask">
                                                <p></p>
                                                <a href="<?php echo base_url() . "sanpham/" . $product->slug; ?>" class="info btn-info btn">Chi tiết</a>
                                                <div class="product-rating" data-score="4">
                                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                                    <i class="fa fa-star star-unvoted" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                            <?php if ($product->discount > 0): ?>
                                                <span class="btn btn-xs btn-warning btn-product-discount">-<?php echo $product->discount_val; ?>% <i class="fa fa-tag" aria-hidden="true"></i></span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="product-content">
                                            <div class="product-name">
                                                <a data-id="<?php echo $product->p_id; ?>" title="<?php echo $product->name; ?>" href="<?php echo base_url() . "sanpham/" . $product->slug; ?>"><?php echo $product->name; ?></a>
                                            </div>
                                            <div class="product-time">
                                                <span title="<?php echo date('H:i d/m/Y', strtotime($product->create_date)); ?>">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                                    <script>moment_date("<?php echo $product->create_date; ?>");</script>
                                                </span> | người bán  
                                                <a href="<?php echo base_url() . "gianhang/" . $product->u_username; ?>">
                                                    <?php echo $product->u_fullname; ?>
                                                </a>
                                            </div>
                                            <div class="product-price">
                                                <?php
                                                $price = $product->price;
                                                $discount_val = $product->discount_val;
                                                if ($product->discount > 0):
                                                    $new_price = $price - ($price / $discount_val);
                                                    echo '<span class="product-discont"><i class="fa fa-angle-down" aria-hidden="true"></i>' . number_format($price) . '₫  </span>';
                                                    echo "&nbsp; &nbsp; ";
                                                    echo '<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ' . number_format($new_price) . '₫</span>';
                                                else:
                                                    echo '<span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> ' . number_format($price) . '₫</span>';
                                                endif;
                                                ?>

                                            </div>
                                        </div>
                                        <div class="product-controll">
                                            <button class="btn btn-primary btn-sm add-to-cart"><i class="icon-cart fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ</button>
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-heart" aria-hidden="true"></i></button>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="loading-product-img hidden">
                                <img src="<?php echo base_url() . "public/images/loading.gif" ?>" class="img-responsive" />
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="" class="pull-right"> 
                                Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2 hidden-xs col-ads">
            <div class="row">
                <div class="col-sm-12">
                    <img src="<?php echo base_url() . "public/images/ads-2.jpg" ?>" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid csb-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

            </div>
        </div>
    </div>
</div>

