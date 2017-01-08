<div class="col-sm-9">
    <div class="box">
        <div class="box-header">
            <label>Sản phẩm mới</label>
        </div>
        <div class="box-body">

            <?php if (count($new_10) > 0): ?>
                <div id="owl-demo" class="owl-carousel">
                    <?php
                    foreach ($new_10 as $product):
                        $feature_img = $this->S_Default->feature_image($product->p_id);
                        ?>
                        <div class="item">
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
                                <div class="product-name"><a href=""><?php echo $product->name; ?></a></div>
                                <div class="product-time">
                                    <span title="<?php echo date('H:i d/m/Y', strtotime($product->create_date)); ?>">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                        <script>moment_time("<?php echo $product->create_date; ?>");</script>
                                    </span>
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
                                <button class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ</button>
                                <button class="btn btn-danger btn-sm"><i class="fa fa-heart" aria-hidden="true"></i></button>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                Chưa có sản phẩm
            <?php endif; ?>

        </div>
        <div class="box-footer">
            <?php if (count($new_10) > 0): ?>
                <a href="" class="pull-right"> 
                    Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i> 
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <label>Sản phẩm giảm giá</label>
        </div>
        <div class="box-body">
            <?php if(count($discounts) > 0): ?>
            <div id="owl-discount" class="owl-carousel">
                <?php
                foreach ($discounts as $discount):
                    $feature_img = $this->S_Default->feature_image($discount->p_id);
                    ?>
                    <div class="item">
                        <div class="view view-first">
                            <img src="<?php echo base_url() . "uploads/files/thumb/" . $feature_img->name; ?>" class="img-responsive" alt="">
                            <div class="mask">
                                <p></p>
                                <a href="<?php echo base_url() . "sanpham/" . $discount->slug; ?>" class="info btn-info btn">Chi tiết</a>
                                <div class="product-rating" data-score="4">
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                                    <i class="fa fa-star star-unvoted" aria-hidden="true"></i>
                                </div>
                            </div>
                            <?php if ($discount->discount > 0): ?>
                                <span class="btn btn-xs btn-warning btn-product-discount">-<?php echo $discount->discount_val; ?>% <i class="fa fa-tag" aria-hidden="true"></i></span>
                            <?php endif; ?>
                        </div>

                        <div class="product-content">
                            <div class="product-name"><a href=""><?php echo $discount->name; ?></a></div>
                            <div class="product-time">
                                <span title="<?php echo date('H:i d/m/Y', strtotime($discount->create_date)); ?>">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                    <script>moment_time("<?php echo $discount->create_date; ?>");</script>
                                </span>
                            </div>
                            <div class="product-price">
                                <?php
                                $price = $discount->price;
                                $discount_val = $discount->discount_val;
                                if ($discount->discount > 0):
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
                            <button class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ</button>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-heart" aria-hidden="true"></i></button>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
            <?php else:?>
            Chưa có sản phẩm
            <?php endif; ?>
        </div>
        <div class="box-footer">
            <?php if(count($discounts) > 0): ?>
            <a href="" class="pull-right"> 
                Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i> 
            </a>
            <?php endif; ?>
        </div>
    </div>

</div>


