<div class="modal fade" id="my-cart-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng của tôi</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-responsive" id="my-cart-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data_carts = $this->cart->contents();
                        if( count($data_carts) > 0 ):
                            
                        
                        $arr = array();
                        foreach ($data_carts as $key => $item) {
                            $arr[$item['options']['shop_id']][$key] = $item;
                        }

                        ksort($arr, SORT_NUMERIC);
                        $k = 1;
                        foreach ($arr as $s => $val):

                            if (count($val) > 1):
                                foreach ($val as $cart):
                                    $image = $this->S_Default->feature_image($cart['id']);
                                    ?>
                                    <tr class="tr-<?php echo $k; ?> row-cart-<?php echo $cart['id']; ?>" data-id="<?php echo $cart["id"]; ?>" data-price="<?php echo $cart["options"]["amount"]; ?>">
                                        <td>
                                            <img width="50px" height="70px" src="<?php echo base_url()."uploads/files/thumb/".$image->name; ?>">
                                            <a href=""><?php echo $cart["name"]; ?></a> <br/>
                                            <a href="" class="my-product-remove">
                                                <i class="fa fa-remove" arial-hidden="true"></i>
                                                bỏ sản phẩm này
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            if ($cart["options"]["discount"] > 0):
                                                echo '<span class="cart-p-discount">' . number_format($cart["price"]) . '₫</span> <br/>';
                                                echo '<span class="cart-p-remain">' . number_format($cart["options"]["remain"]) . '₫</span>';
                                            else:
                                                echo '<span class="cart-p-price">' . number_format($cart["price"]) . '₫</span>';
                                            endif;
                                            ?>
                                        </td>
                                        <td><input type="number" min="1" style="width: 70px;" class="my-product-quantity" value="<?php echo $cart["qty"]; ?>"></td>
                                        <td class="my-product-total">
                                            <?php
                                            if ($cart["options"]["discount"] > 0):
                                                $total = $cart["options"]["remain"] * $cart['qty'];
                                                echo '<span data-total="' . $total . '">' . number_format($total) . '₫</span>';
                                            else:
                                                echo '<span data-total="' . $cart['subtotal'] . '">' . number_format($cart['subtotal']) . '₫</span>';
                                            endif;
                                            ?>

                                        </td>
                                    </tr>
                                    <?php
                                    $k++;
                                endforeach;
                                $shop_name = $this->S_Default->getShopname($s);
                                echo '<tr class="shop-name" data-shop-id="'.$s.'"><td>Gian hàng: ' . $shop_name->name . '</td>';
                                echo '<td><button class="btn btn-primary">Thanh toán</button></td><td><button class="btn btn-success">Cập nhật số lượng</button></td><td><button class="btn btn-danger">Xóa tất cả</button></td></tr>';

                            else:
                                foreach ($val as $cart):
                                    $image = $this->S_Default->feature_image($cart['id']);
                                    ?>
                                    <tr class="tr-<?php echo $k; ?> row-cart-<?php echo $cart['id']; ?>" data-id="<?php echo $cart["id"]; ?>" data-price="<?php echo $cart["options"]["amount"]; ?>">
                                        <td>
                                            <img width="50px" height="70px" src="<?php echo base_url()."uploads/files/thumb/".$image->name; ?>">
                                            <a href=""><?php echo $cart["name"]; ?></a> <br/>
                                            <a href="" class="my-product-remove">
                                                <i class="fa fa-remove" arial-hidden="true"></i>
                                                bỏ sản phẩm này
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            if ($cart["options"]["discount"] > 0):
                                                echo '<span class="cart-p-discount">' . number_format($cart["price"]) . '₫</span> <br/>';
                                                echo '<span class="cart-p-remain">' . number_format($cart["options"]["remain"]) . '₫</span>';
                                            else:
                                                echo '<span class="cart-p-price">' . number_format($cart["price"]) . '₫</span>';
                                            endif;
                                            ?>
                                        </td>
                                        <td><input type="number" min="1" style="width: 70px;" class="my-product-quantity" value="<?php echo $cart["qty"]; ?>"></td>
                                        <td class="my-product-total">
                                            <?php
                                            if ($cart["options"]["discount"] > 0):
                                                $total = $cart["options"]["remain"] * $cart['qty'];
                                                echo '<span data-total="' . $total . '">' . number_format($total) . '₫</span>';
                                            else:
                                                echo '<span data-total="' . $cart['subtotal'] . '">' . number_format($cart['subtotal']) . '₫</span>';
                                            endif;
                                            ?>

                                        </td>
                                    </tr>
                                    <?php
                                    $k++;
                                endforeach;
                                $shop_name = $this->S_Default->getShopname($s);
                                echo '<tr class="shop-name" data-shop-id="'.$s.'"><td>Gian hàng: ' . $shop_name->name . '</td>';
                                echo '<td><button class="btn btn-primary">Thanh toán</button></td><td><button class="btn btn-success">Cập nhật số lượng</button></td><td><button class="btn btn-danger">Xóa tất cả</button></td></tr>';

                            endif;


                        endforeach;
                        else:
                            echo '<tr class="nothing"><td colspan="4">Bạn chưa có sản phẩm nào trong giỏ hàng!</td></tr>';
                        endif;
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary my-cart-checkout-all pull-right">Thanh toán tất cả</button>
                <button type="button" class="btn btn-danger my-cart-delete-all pull-left">Xóa bỏ tất cả</button>
            </div>
        </div>
    </div>
</div>
