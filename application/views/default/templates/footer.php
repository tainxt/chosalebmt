        </div>
        <div id="theAlertModal" class="alert-modal"></div>
        <?php
        echo '<div id="current_cart">';
        $this->load->view('default/modules/cart/modal_cart');
        echo '</div>';
        $ses_uid = $this->session->userdata('uid');
        if ($ses_uid):
            
            $this->load->view('default/modules/products/choose_cat');
        else:
            $this->load->view('default/modules/auth/modal_login');
        endif;
        ?>
        
    </body>
    
</html>