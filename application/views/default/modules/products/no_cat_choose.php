<script type="text/javascript">
    $(window).load(function () {
        $('#choose_cat').modal('show');
    });
    $(document).ready(function(){
       $('#choose_cat').modal({backdrop: 'static', keyboard: false}); 
       $('#choose_cat .modal-footer .btn-danger').remove();
       $('#choose_cat .modal-header .close').remove();
    });
</script>
