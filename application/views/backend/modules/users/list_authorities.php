<script>
    $(document).ready(function(){
        $('.users').addClass('active');
        $('.users .authorities').addClass('active');
    })
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Người dùng
        <small>thành viên của website</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo admin; ?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li><a href="<?php echo admin."/Users"?>">Người dùng</a></li>
        <li class="active">Quyền hạn</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bảng danh sách quyền người dùng</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Reason</th>
                  <th></th>
                </tr>
                <tr>
                  <td>183</td>
                  <td><a href="#" title="Click xem chi tiết sản phẩm">John Doe</a></td>
                  <td>11-7-2014</td>
                  <td><span class="label label-success">Approved</span></td>
                  <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                  <td>
                    <button class="btn btn-warning btn-xs btn-edit" 
                        data-toggle="modal" data-target="#myModal" href="<?php echo admin."/Products/EditProduct"; ?>">
                        Sửa
                    </button>
                    <button class="btn btn-danger btn-xs">Xóa</button>
                  </td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close close_Modal" onclick="closeModal();">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default close_Modal">Hủy</button>
        </div>
      </div>
    </div>
  </div>
  
<script>
    $(document).ready(function(){
    	$(".btn-edit").click(function(e){
    		//e.preventDefault(); 
    		/*	
    		if uncomment the above line, html5 nonsupported browers won't change the url but will display the ajax content;
    		if commented, html5 nonsupported browers will reload the page to the specified link. 
    		*/
    		//get the link location that was clicked
    		pageurl = $(this).attr('href');
    		
            $("#myModal").modal();
            
    		//to change the browser URL to 'pageurl'
    		if(pageurl!=window.location){
    			window.history.pushState({path:pageurl},'',pageurl);	
    		}
    		return false;  
    	});
        
        $('.close_Modal').click(function(){
            $("#myModal").modal('hide');
           history.back(); 
        });
        
    });
    
    /* the below code is to override back button to get the ajax content without reload*/
    $(window).bind('popstate', function() {
    	$.ajax({url:location.pathname+'?rel=tab',success: function(data){
    		$('#content').html(data);
    	}});
    });
</script>
  
  