<div id="page-wrapper"  style="overflow: scroll;max-height:500px;">
	<center><b>Delivery Pincode</b></center>
	<div class="pull-right" style="margin-bottom: 10px;">
		<a href="<?php echo base_url()?>index.php/Pincode/add"><button class="btn btn-primary">+ Add New</button></a>

	</div>
	 <table id="pincode" border="2" class=" table table-bordered table-responsive table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Pincode </th>
                                            <th> Action </th>
                                       </tr>
                                    </thead>
                            </table>
</div>
<script type="text/javascript">
	$(function(){
		var url = "<?php echo base_url()?>index.php/Pincode/get_all_pincode";
		  $('#pincode').dataTable({
            "ajax": {
                "url": url,
                "dataType": "json",
                "cache": false,
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'id', 'sType': 'string','orderable':true},
                    {'data': 'pincode', 'sType': 'string', 'bVisible': true}
                ],
                    "columnDefs":[{ 
                            "targets": 2,
                            "render": function(data, type, row, meta){
                               return ' <a href="<?php echo base_url()?>index.php/Pincode/edit/'+row["id"]+'" class="btn btn-success">Edit</a'; 
                            }
                    }],
    });
	});

</script>