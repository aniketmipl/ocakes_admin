		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
			<div class="col_3">
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-dollar icon-rounded"></i>
                    <div class="stats">
                      <h5 id="active_users"><strong><?php echo $active_users; ?></strong></h5>
                      <span>Active Users</span>
                    </div>
                </div>
        	</div>
        	<!-- <div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>$1019</strong></h5>
                      <span>Online Revenue</span>
                    </div>
                </div>
        	</div>
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-money user2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong>$1012</strong></h5>
                      <span>Expenses</span>
                    </div>
                </div>
        	</div> -->
        	<div class="col-md-3 widget widget1">
        		<div class="r3_counter_box">
                    <a href="../index.php/Family/index"><i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i></a>
                    <div class="stats">
                      <h5><strong><?php echo $total_groups ; ?></strong></h5>
                      <span>Total Families</span>
                    </div>
                </div>
        	 </div>
        	<div class="col-md-3 widget">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo $total_users ;?></strong></h5>
                      <span>Total Users</span>
                    </div>
                </div>
        	 </div>
        	<div class="clearfix"> </div>
		</div>
		
		
			 
		</div>
				
			</div>
	

<script type="text/javascript">
setInterval(function()
{ 
  var url = "<?php echo base_url()?>index.php/Dashboard/get_active_users";
    $.ajax({
      type:"get",
      url:url,
      //datatype:"html",
      success:function(data)
      {
          $("#active_users").html("<strong>"+data+"</strong>");
      }
    });
}, 10000);//time in milliseconds 

</script>