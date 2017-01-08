<?php
foreach ($new_10 as $product):
    $feature_img = $this->S_Default->feature_image($product->p_id);
    $thumb = explode('.', $feature_img->name);
    ?>
    <div class="item">
        <div class="view view-first">
            <img src="<?php echo base_url() . "uploads/files/thumb/" . $thumb[0] . "_thumb." . $thumb[1]; ?>" class="img-responsive" alt="">
            <div class="mask">
                <p></p>
                <a href="<?php echo base_url() . "Sanpham/" . $product->slug; ?>" class="info btn-info btn">Chi tiết</a>
                <div class="product-rating" data-score="4">
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-unvoted" aria-hidden="true"></i>
                </div>
            </div>
            <button class="btn btn-xs btn-warning btn-product-discount">-10% <i class="fa fa-tag" aria-hidden="true"></i></button>
        </div>

        <div class="product-content">
            <div class="product-name"><a href=""><?php echo $product->name; ?></a></div>
            <div class="product-time">
                <span title="<?php echo date('H:i d/m/Y', strtotime($product->create_date)); ?>">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    <?php echo $product->create_date; ?>
                </span> | người bán  
                <a href="<?php echo base_url() . "Gianhang/" . $product->u_fullname; ?>">
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
            <button class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ</button>
            <button class="btn btn-danger btn-sm"><i class="fa fa-heart" aria-hidden="true"></i></button>
        </div>

    </div>
<?php endforeach; ?>