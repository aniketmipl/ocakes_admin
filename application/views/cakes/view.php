<div id="page-wrapper">
<center><h2> Cakes & Pastries </h2></center>
<hr>
<div style="padding-bottom: :50px;">
    <a href="<?php echo base_url()?>index.php/cakes/add" class="btn btn-success" style="text-align: right">+ Add Cakes</a>
</div>
<div class="col-lg-12" style="max-height:600px; overflow-y: scroll;margin-top: 22px ">

    <table id="example" border="2" class="display table table-stripped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th> ID </th>
                <th> Name </th>
                <th> Pastry </th>
                <th> Small </th>
                <th> Large </th>
                <th> Action </th>
           </tr>
        </thead>
    </table>
</div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Product Detail</h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <button type="button" id="save_product" class="btn btn-default" data-dismiss="modal">Save</button>  
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <script type="text/javascript">
  	
  	    var url ="<?php echo base_url()?>index.php/Cakes/get_all_cakes";
    $('#example').dataTable({
            "ajax": {
                "url": url,
                "dataType": "json",
                "cache": false,
                // "dataSrc": "",
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'p_id', 'sType': 'string','orderable':true},
                    {'data': 'name', 'sType': 'string', 'bVisible': true},
                    {'data': 'pastery_price', 'sType': 'string', 'bVisible': true}, 
                    {'data': 'small_price', 'sType': 'string', 'bVisible': true},
                    {'data': 'large_price', 'sType': 'string', 'bVisible': true}
                ],
                    "columnDefs":[{ 
                            "targets": 5,
                            "render": function(data, type, row, meta){
                            //    return '   <button type="button" class="product_id btn btn-info btn-lg"  value='+row['p_id']+' >Edit</button>'; 
                               return '<a href="Cakes/edit/'+row['p_id']+'" type="button" class="product_id btn btn-info btn-lg"  value='+row['products_id']+' >Edit</button>'; 
                            }
                        }],
                });

        $(document).on('click','.product_id',function(){
        	var product_id = $(this).val();
        	var edit_product_url = "<?php echo base_url()?>index.php/Cakes/get_product_details";
        	$.ajax({
				type: "POST",
				url: edit_product_url,
				data: product_id,
				success: function(res){

				}
			});
        });
  </script>