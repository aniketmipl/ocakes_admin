<div id="page-wrapper">
<center><h2> Product List </h2></center>
<hr>
<div style="padding-bottom: :50px;">
</div>
<div class="col-lg-12" style="max-height:600px; overflow-y: scroll;margin-top: 22px ">

    <table id="example" border="2" class="display table table-stripped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th> Product ID </th>
                <th> Product Name </th>
                <th> Search Keywords </th>
                <th> Alternate Name </th>
                <th> Edit </th>
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


    var url ="<?php echo base_url()?>index.php/Products/get_all_products";
    $('#example').dataTable({
            "ajax": {
                "url": url,
                "dataType": "json",
                "cache": false,
                // "dataSrc": "",
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'products_id', 'sType': 'string','orderable':true},
                    {'data': 'products_name', 'sType': 'string', 'bVisible': true},
                    {'data': 'search_keywords', 'sType': 'string', 'bVisible': true}, 
                    {'data': 'alternatename', 'sType': 'string', 'bVisible': true}
                ],
                    "columnDefs":[{ 
                            "targets": 4,
                            "render": function(data, type, row, meta){
                               return '   <button type="button" class="product_id btn btn-info btn-lg"  value='+row['products_id']+' >Edit</button>'; 
                            }
                        }],
                });

    $(document).on('click','.product_id',function(){
        var id  = $(this).closest('tr').find('td').html();
        var product_name  = $(this).closest('tr').find('td').next().html();
        var search_keywords  = $(this).closest('tr').find('td').next().next().html();
        var alternate_name  = $(this).closest('tr').find('td').next().next().next().html();

        var content ='<div class="col-lg-12"> <div class ="col-lg-4"><label>Product ID </label> <input type="text" id="p_id" value="'+id+'"></div><div class ="col-lg-4"><label>Product Name </label> <input type="text" id="p_name" value="'+product_name+'"></div><div class ="col-lg-4"><label>Search Keywords </label> <input type="text" id="p_keywords" value="'+search_keywords+'"></div><div class ="col-lg-4"><label>Alernate name </label> <input type="text" id="p_alt_name" value="'+alternate_name+'"></div></div>';

        $(".modal-body").html(content);
        $('#myModal').modal('show');

    });

    $("#save_product").click(function(){
        var p_id =$("#p_id").val();
        var p_name =$("#p_name").val();
        var p_keywords =$("#p_keywords").val();
        var p_alt_name =$("#p_alt_name").val();

        var url = "<?php echo base_url()?>index.php/Products/save_product";
        $.ajax({
            url : url,
            type:'POST',
            data:{'product_id':p_id,'product_name':p_name,'p_keywords':p_keywords,'p_alt_name':p_alt_name},
            success: function(res){
                if(res == 1){
                    alert("Record Updated !!");
                    $('#example').DataTable().ajax.reload();

                }
                else{
                    alert("ERROR");
                }
            }
        })

    });
    

    </script>