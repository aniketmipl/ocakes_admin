<style type="text/css">
    .ajax-loader {
    cursor: wait;
    background:#ffffff url('http://localhost:8080/thefamilla/assets/images/ajax-loader.gif') no-repeat center center;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=75)";
    filter: alpha(opacity=75);
    opacity: 0.75;
    position: absolute;
    z-index: 10000;
    display: none;
}
</style>

<div id="page-wrapper" style=" margin-bottom: 12px;max-height:600px; overflow-y: scroll;">

<div id="myLoader" class="ajax-loader"> Sending ...</div>

<center><h2> Send Notification </h2></center>
<hr>
<input type="text" id="message" name="message" class="form-control" placeholder="Enter Message">
<div style="max-height:600px; overflow-y: scroll; ">
<table id="example" border="2" class="display fixed_headers table table-stripped" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th><input type="checkbox" id="select_all" name="select_all" ></th>
                <th>Name</th>
                <th>Phone no</th>
			</tr>
        </thead>
        </table>
        </div>

    <input type="button" id ="send" name="Send" value="Send Message" class="btn btn-success">

</div>

<script type="text/javascript">
	var url ="<?php echo base_url()?>index.php/Notification/get_all_users";
    $('#example').dataTable({
            "ajax": {
                "url": url,
                "dataType": "json",
                "cache": false,
                // "dataSrc": "",
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'user_id', 'sType': 'string', "orderable": false},
                    {'data': 'UserName', 'sType': 'string', 'bVisible': true}, 
                    {'data': 'mobileno', 'sType': 'string', 'bVisible': true}, 
                    
                    // {'data': 'edit', 'sType': 'string', 'bVisible': true}
                    ],
                    "columnDefs": [
                        { 
                            "targets": 0,
                            "render": function(data, type, row, meta){
                               return '<input type="checkbox" name="select_users" class="select_users" value="'+row["UserID"]+'">';  
                            }
                        }            
                    ],
	});

	$("#send").click(function(){
        var array = $.map($('input[name="select_users"]:checked'), function(c){return c.value; });
        var message = $("#message").val();

        if(message == ''){
        	alert("Please Enter Message");
        }
        else{
	        if(array.length > 0 ){
	            var url = "<?php echo base_url();?>index.php/Notification/send_notification";
	             $.ajax({
	                url:url,
	                data:{select_users:array,message:message},
	                type : "POST",
                    beforeSend:function(){
                        $('#myLoader').css({
                            height: $('#myLoader').parent().height(), 
                            width: $('#myLoader').parent().width()
                        });
                        $('#myLoader').show();
                    },
	                success : function(res){
	                    //alert(res);
                        // alert("Message has been send to "+res+" users");
                        alert(res);
	                },
                    complete:function(){
                        $('#myLoader').hide();
                    }
	             });
	        }
        }
        
    });

    $("#select_all").on('click',function(){

        if($(this).prop("checked")) 
        {
            $(".select_users").prop('checked', true);    
        }else{
            $(".select_users").prop('checked', false);
        }
       
    });



</script>