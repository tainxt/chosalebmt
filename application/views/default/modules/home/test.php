<div class="line-product col-xs-6 col-xxs-12 item col-sm-4 col-xs-12 col-lg-4">
    <div class="border-product">
        <div class="col-xs-12 thumbnail view view-first">
            <div class="col-xs-12 box-product-image">
                <img class="group list-group-image img-responsive" 
                     src="<?php echo base_url() . "uploads/files/thumb/" . $product['pi_name']; ?>" alt="" />
            </div>
            <div class="mask">
                <p></p>
                <a href="<?php echo base_url() . "sanpham/" . $product['slug']; ?>" class="info btn-info btn">Chi tiết</a>
                <div class="product-rating" data-score="4">
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-voted" aria-hidden="true"></i>
                    <i class="fa fa-star star-unvoted" aria-hidden="true"></i>
                </div>
            </div>
            <?php if ($product['discount'] > 0): ?>
                <span class="btn btn-xs btn-warning btn-product-discount"><?php echo $product['discount_val']; ?>% <i class="fa fa-tag" aria-hidden="true"></i></span>
            <?php endif; ?>
        </div>
        <div class="caption">
            <h4 class="group inner list-group-item-heading product-name">
                <a href=""><?php echo $product['name']; ?></a>
            </h4>
            <div class="row">
                <div class="col-xs-12">
                    <div class="product-price">
                        <?php
                        if ($product['discount'] > 0):
                            $price = $product['price'];
                            $discount_val = $product['discount_val'];
                            $remain = $price - (($price * $discount_val) / 100);
                            ?>
                            <span class="product-discont">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                <?php echo number_format($product['price']); ?>
                            </span>
                            &nbsp; &nbsp; 
                            <span>
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 
                                <?php echo number_format($remain); ?>₫
                            </span>
                        <?php else: ?>
                            <?php echo number_format($product['price']); ?>₫
                        <?php endif; ?>
                    </div>
                    <p class="poster">
                        <span class="hidden">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 
                            <script>moment_date("<?php echo $product['create_date']; ?>");</script> | 
                        </span>

                        Người bán: 
                        <a href="#"><?php echo $product['u_fullname']; ?></a>
                    </p>
                </div>
                <div class="col-xs-12">
                    <button class="btn btn-success">Thêm vào giỏ</button>
                    <button class="btn btn-warning">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="product-time">
            <i class="fa fa-clock-o" aria-hidden="true"></i> 
            <script>moment_date("<?php echo $product['create_date']; ?>");</script>
        </div>
    </div>

</div>