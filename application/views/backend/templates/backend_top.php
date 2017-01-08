

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>components/backend/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>components/backend/bootstrap/js/bootstrap.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>components/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url(); ?>components/backend/plugins/fastclick/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>components/backend/dist/js/app.min.js"></script>    

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>components/backend/dist/js/demo.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php 
        $this->load->view('backend/modules/layout/main_header');
        $this->load->view('backend/modules/layout/main_menu');
        ?>