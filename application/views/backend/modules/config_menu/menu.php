<script>
    $(document).ready(function () {
        $('.config_menu').addClass('active');
    })
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cấu hình Menu chính
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo admin; ?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Menu</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="main_content">


                        <div class="col-xs-6">
                            <h4>Danh sách danh mục</h4>
                            <div class="" id="list-categories">
                                <?php

                                function has_children($rows, $id) {
                                    foreach ($rows as $row) {
                                        if ($row->cat_parent == $id)
                                            return true;
                                    }
                                    return false;
                                }

                                function build_menu($rows, $parent = 0) {
                                    $result = "<ul>";
                                    foreach ($rows as $row) {
                                        if ($row->cat_parent == $parent) {
                                            $result.= "<li id='{$row->cat_id}' class='sortableListsClosed' data-name='{$row->cat_name}' data-url='{$row->cat_slug}'>";
                                            $result.= "<div>{$row->cat_name}<a href='#' class='pull-right add-to-menu'>Thêm </a></div>";
                                            if (has_children($rows, $row->cat_id)):
                                                $result.= build_menu($rows, $row->cat_id);
                                            endif;
                                            $result.= "</li>";
                                        }
                                    }
                                    $result.= "</ul>";

                                    return $result;
                                }

                                echo build_menu($categories);
                                ?>
                            </div>




                        </div>
                        <div class="col-xs-6 tainxt">
                            <h4>Menu hiện tại</h4>

                            <ul class="sTree2 listsClass old-menu" id="sTree2">
                                
                            </ul>

                            <button id="toArrBtn" class="btn btn-success">To array</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <textarea id="content-json" class="input-group col-xs-12"></textarea>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script src="<?php echo base_url() . "components/backend/dist/js/" ?>jquery-sortable-lists.js"></script>
<script type="text/javascript">
    $(function ()
    {
        var options = {
            placeholderCss: {'background-color': '#ff8'},
            hintCss: {'background-color': '#bbf'},
            onChange: function (cEl)
            {
                console.log('onChange');
            },
            complete: function (cEl)
            {
                console.log('complete');
            },
            opener: {
                active: true,
                as: 'html', // if as is not set plugin uses background image
                close: '<i class="fa fa-minus c3"></i>', // or 'fa-minus c3',  // or './imgs/Remove2.png',
                open: '<i class="fa fa-plus"></i>', // or 'fa-plus',  // or'./imgs/Add2.png',
                openerCss: {
                    'display': 'inline-block',
                    //'width': '18px', 'height': '18px',
                    'float': 'left',
                    'margin-left': '-35px',
                    'margin-right': '5px',
                    //'background-position': 'center center', 'background-repeat': 'no-repeat',
                    'font-size': '1.1em'
                }
            },
            ignoreClass: 'clickable'
        };


        //$('#list-categories > ul').sortableLists(options);

        $('#sTree2').sortableLists(options);
        $('#toArrBtn').on('click', function () {
            console.log($('#sTree2').sortableListsToArray());
            var json = $('#sTree2').sortableListsToArray();

            $('#content-json').val(JSON.stringify(json));


        });


    });
    $(document).ready(function () {

        function make_ver() {
            var text = "";
            var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 5; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        $('.add-to-menu').click(function () {

            //Call functtion version click!
            var ver_click = make_ver();

            $(this).addClass('clone-menu-ver' + ver_click);

            //Create Attr data-ver for a tag!
            $(this).attr('data-ver', ver_click);
            //Find Parent
            g = $(this).parents('li');
            x = g[0];
            $(x).attr('data-ver', ver_click);
            $(x).attr('class', ver_click);
            //Clone Parent to Old menu
            $(x).clone().appendTo('.old-menu');
            //Remove a tag 
            $('.tainxt .add-to-menu').remove();


            var add_delete_btn = "<a href='#' class='delete-menu pull-right' title='Double Click để xóa'>Xóa</a>";
            $(".tainxt ." + ver_click).attr('style', '');
            $(".tainxt ." + ver_click + " div").attr('class', 'my-div-menu');
            $(".tainxt ." + ver_click + " div").append(add_delete_btn);

            $(this).removeClass('clone-menu-ver' + ver_click);

            return false;

        });

        $(document).on('click', '.delete-menu', function () {
            var x = $(this).parents('li');
            x.html("");
            x.removeAttr('data-module');
            x.removeAttr('id');
            x.css('display', 'none');
            return false;
        });
        $('#list-categories > ul').attr('id', 'sTree1');
        $('#list-categories > ul').addClass('sTree2 listsClass');

    });
</script>
<style>
    li {
        list-style: none;
    }

    #sTree2 ul, #sTree2 li , .sTree2 ul, .sTree2 li, #sTree1 ul, #sTree1 li , .sTree2 ul, .sTree2 li{
        list-style-type:none;
        color:#b5e853;
        border:1px solid #3f3f3f;
    }

    .sTree2 ul, #sTree2, #sTree1, ul.sTree2 { padding:0; background-color:#151515; }

    #sTree2 li, #sTree1 li, #sTreePlus li, ul#sortableListsBase li {
        padding-left:50px;
        margin:5px; border:1px solid #3f3f3f;
        background-color:#3f3f3f;
    }

    li div {
        padding:7px;
        background-color:#222;
    }



    .c1 { color:#b5e853; }
    .c2 { color:#63c0f5; }
    .c3 { color: #f77720; }
    .c4 { color: #888; }
    .c5 { color: #666667; }
    .c6 { color: #888; }

    .bgC1, .gray { background-color:#ccc; }
    .bgC2, .yellow { background-color:#ff8; }
    .bgC3, .red { background-color:#ff9999; }
    .bgC4, .blue { background-color:#aaaaff;}
    .bgC5, .green { background-color:#99ff99; }
    .bgC6, .gree2 { background-color:#bbffbb; }
    .bgC7, .brown { background-color:#c26b2b; }

    .pT20 { padding-top:20px; }

    .pV10 { padding-top:10px; padding-bottom:10px; }

    .pR { position: relative; }

    .t10 { top: 10px; }

    .dN { display:none; }

    .zI1000 { z-index:1000; }

    .small1 { font-size:0.8em; }
    .small2 { font-size:0.7em; }
    .small3 { font-size:0.6em; }

    .tAR { text-align:right; }

    .clear { clear:both; }



    #sTree2, #sTreePlus { margin:10px auto; }


    li {
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
    }
</style>

