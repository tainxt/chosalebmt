
        <div class="col-md-9 col-sm-8 box-main-slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators hidden-sm hidden-lg hidden-md">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>
                <ol class="carousel-indicators hidden-xs nav-slider">
                    <?php
                    $active = "";
                    for ($x = 0; $x < 4; $x++):
                        ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $x; ?>" class="<?php
                        if ($x == 0): echo "sub-active";
                        endif;
                        ?>">
                            <div class="arrow-left"></div>
                            <div class="col-sm-3">
                                <img src="<?php echo base_url() . "public/images/img_chania.jpg" ?>" alt="Chania" class="img-responsive">
                            </div>
                            <div class="col-sm-9 text-left no-padding">
                                <a href="#">Iphone 6 World 99%</a>
                                <p class="funded-box-price">5.000.000đ</p>
                            </div>
                        </li>
                        <?php
                    endfor;
                    ?>
                </ol>
                <div class="carousel-inner main-slider" role="listbox">
                    <div class="item active">
                        <img src="<?php echo base_url() . "public/images/img_chania.jpg" ?>" alt="Chania">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url() . "public/images/img_chania2.jpg" ?>" alt="Chania">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url() . "public/images/img_flower.jpg" ?>" alt="Flower">
                    </div>

                    <div class="item">
                        <img src="<?php echo base_url() . "public/images/img_flower2.jpg" ?>" alt="Flower">
                    </div>
                </div>
            </div>
            <div class="row hidden-xs">
                <div class="col-md-4  col-xs-4 funded-box">
                    <div class="col-md-4 no-padding-left">
                        <img src="<?php echo base_url() . "public/images/bgr-iphone-6-6.jpg" ?>" class="img-responsive" >
                    </div>
                    <div class="col-md-8 no-padding">
                        <h5><a href="#">Iphone 6 World 99%</a></h5>
                        <span class="funded-box-price">5.000.000đ</span>
                    </div>
                </div>

                <div class="col-md-4 col-xs-4 funded-box">
                    <div class="col-md-4 no-padding-left">
                        <img src="<?php echo base_url() . "public/images/bgr-iphone-6-6.jpg" ?>" class="img-responsive" >
                    </div>
                    <div class="col-md-8 no-padding">
                        <h5><a href="#">Iphone 6 World 99%</a></h5>
                        <span class="funded-box-price">5.000.000đ</span>
                    </div>
                </div>

                <div class="col-md-4  col-xs-4 funded-box">
                    <div class="col-md-4 no-padding-left">
                        <img src="<?php echo base_url() . "public/images/bgr-iphone-6-6.jpg" ?>" class="img-responsive" >
                    </div>
                    <div class="col-md-8 no-padding">
                        <h5><a href="#">Iphone 6 World 99%</a></h5>
                        <span class="funded-box-price">5.000.000đ</span>
                    </div>
                </div>
            </div>
        </div>
    