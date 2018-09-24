<div id="page-wrapper"  style="overflow: scroll;max-height:500px;">
	<center><b>Store Locations</b></center>
	<div class="pull-right" style="margin-bottom: 10px;">
		<a href="<?php echo base_url()?>index.php/Contact/add"><button class="btn btn-primary">+ Add New</button></a>

	</div>
	 <table id="contacts" border="2" class=" table table-bordered table-responsive table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Area </th>
                                            <th> Address</th>
                                            <th> Phone No </th>
                                            <th> Action </th>
                                       </tr>
                                    </thead>
                            </table>
</div>
<script type="text/javascript">
	$(function(){
		var url = "<?php echo base_url()?>index.php/Contact/get_all_contacts";
		  $('#contacts').dataTable({
            "ajax": {
                "url": url,
                "dataType": "json",
                "cache": false,
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'id', 'sType': 'string','orderable':true},
                    {'data': 'area', 'sType': 'string', 'bVisible': true},
                    {'data': 'address', 'sType': 'string', 'bVisible': true},
                    {'data': 'phone', 'sType': 'string', 'bVisible': true},
                ],
                    "columnDefs":[{ 
                            "targets": 4,
                            "render": function(data, type, row, meta){
                               return ' <a href="<?php echo base_url()?>index.php/Contact/edit_contact/'+row["id"]+'" class="btn btn-success">Edit</a'; 
                            }
                    }],
    });
	});

</script>