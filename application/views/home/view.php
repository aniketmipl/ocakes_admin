<?php print_r($_SESSION);?>
<div id="page-wrapper"  style="overflow: scroll;max-height:500px;">
	<center><b>Order List</b></center>
	<div class="pull-right" style="margin-bottom: 10px;">
	</div>
	 <table id="orders" border="2" class=" table table-bordered table-responsive table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th> Order ID </th>
                                            <th> Customer Name </th>
                                            <th> Order Date </th>
                                            <th> Amount </th>
                                            <th> delivery_date </th>
                                            <th> email_id </th>
                                            <th> phone_no </th>
                                            <th> status </th>
                                            <th> Action </th>
                                       </tr>
                                    </thead>
                            </table>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Order Details</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$(function(){
		var url = "<?php echo base_url()?>index.php/Home/get_orders";
		  $('#orders').dataTable({
            "order": [[ 2, "desc" ]],
            "ajax": {
                "url": url,
                "dataType": "json",
                "cache": false,
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'id', 'sType': 'string','orderable':true},
                    {'data': 'customer_name', 'sType': 'string', 'bVisible': true},
                    {'data': 'order_date', 'sType': 'string', 'bVisible': true},
                    {'data': 'amount', 'sType': 'string', 'bVisible': true},
                    {'data': 'delivery_date', 'sType': 'string', 'bVisible': true},
                    {'data': 'email_id', 'sType': 'string', 'bVisible': true},
                    {'data': 'phone_no', 'sType': 'string', 'bVisible': true},
                    {'data': 'status', 'sType': 'string', 'bVisible': true}                    ],
                    "columnDefs":[{ 
                            "targets": 8,
                            "render": function(data, type, row, meta){
                               return '<button class="btn btn-success view_order" data-id="'+row['id']+'">View</button>'; 
                            }
                    }],
	});


    $(document).on('click','.view_order',function(){

        var sid = $(this).attr('data-id');
        var url = "<?php echo base_url()?>index.php/Home/Get_order_details";
        var cake_ordered_url = "<?php echo base_url()?>index.php/Home/Get_order_cake_details";
        $.ajax({
            url:url,
            type:'POST',
            data:{'id':sid},
            success:function(res){
                var result = $.parseJSON(res);
                // console.log(result);
                // console.log(result[0].amount);
                $(".modal-body").html('');
                $(".modal-body").append('<p>Order ID: '+result[0].id+'</p>');
                $(".modal-body").append('<p>Order date: '+result[0].order_date+'</p>');
                $(".modal-body").append('<p>delivery_date: '+result[0].delivery_date+'</p>');
                $(".modal-body").append('<p>customer_name: '+result[0].customer_name+'</p>');
                $(".modal-body").append('<p>delivery_type: '+result[0].delivery_type+'</p>');
                $(".modal-body").append('<p>email_id D: '+result[0].email_id+'</p>');
                $(".modal-body").append('<p>phone_no: '+result[0].phone_no+'</p>');
                $(".modal-body").append('<p>pick_up_time: '+result[0].pick_up_time+'</p>');
                $(".modal-body").append('<p>pick_franchise: '+result[0].pick_franchise+'</p>');
                $(".modal-body").append('<p>address: '+result[0].address+'</p>');
                $(".modal-body").append('<p>del_pincode: '+result[0].del_pincode+'</p>');
                $(".modal-body").append('<p>status: '+result[0].status+'</p>');

                $.ajax({
                    url:cake_ordered_url,
                    type:'POST',
                    data:{'id':sid},
                    success:function(response){
                        var dec_response = $.parseJSON(response);
                        $(".modal-body").append('<p><h3>Cake Details</h3></p> <hr>');
                        $.each(dec_response,function(){
                            $(".modal-body").append('<p>Cake Name: '+this['name']+'</p>');
                            $(".modal-body").append('<p>Cake Quantity: '+this['cake_quantity']+'</p>');
                            $(".modal-body").append('<p>Message On Cake : '+this['message_on_cake']+'</p>');
                            $(".modal-body").append('<br> <br>');
                        })
                        // console.log(dec_response);
                    }
                })
        $("#myModal").modal("show");
            }
        })
    });
});
</script>