<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div id="page-wrapper"  style="overflow: scroll;max-height:500px;">
    <div class="panel panel-default">
  <div class="panel-body"><center> <b> Our Products </b> </center> </div>
</div>
<hr>

<div class="col-md-12" style="margin-top: 20px;overflow-y: scroll;min-height: 20px;">  
                      <div class="panel-group">
                        <div class="panel  panel-info">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapse1">Category Details </a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse">
                                <a href="<?php echo base_url()?>index.php/Categories/Add_new" style="float:  right;margin-bottom:20px" class="btn btn-lg btn-info"><b>+ Add Category</b> </a>
                                <table id="category" border="2" class=" table table-bordered table-responsive table-striped " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th> Category ID </th>
                                            <th> Category Name </th>
                                            <th> Action </th>
                                       </tr>
                                    </thead>
                            </table>
                          </div>
                        </div>
                        <div class="panel  panel-info">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapse2">Sub Category Details</a>
                            </h4>
                          </div>
                          <div id="collapse2" class="panel-collapse collapse">
                            <a href="<?php echo base_url()?>index.php/Subcategories/Add_new" style="float:  right;margin-bottom:20px" class="btn btn-lg btn-info"><b>+ Add Sub Category </b> </a>
                           <table id="sub_category" border="2" class=" table table-bordered table-responsive table-striped  " cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th> Sub Category ID </th>
                                            <th> Category Name </th>
                                            <th> Sub Category Name </th>
                                            <th> Action </th>
                                       </tr>
                                    </thead>
                            </table>
                          </div>
                        </div>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapse3">Product Details</a>
                            </h4>
                          </div>
                          <div id="collapse3" class="panel-collapse collapse">
                            <a href="<?php echo base_url()?>index.php/Products/Add_new" style="float:  right;margin-bottom:20px" class="btn btn-lg btn-info"><b>+ Add Product </b> </a>
                                
                           <table id="product" border="2" class="table table-bordered table-responsive table-striped " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th> Product ID </th>
                                        <th> Cake Name </th>
                                        <th> Cake Image </th>
                                        <th> Product Category</th>
                                        <th> Product Sub Category </th>
                                        <th> Display On Homepage </th>
                                        <th> Action </th>
                                   </tr>
                                </thead>
                            </table>
                          </div>
                        </div>
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapse4">Flavours</a>
                            </h4>
                          </div>
                          <div id="collapse4" class="panel-collapse collapse">
                            <a href="<?php echo base_url()?>index.php/Products/Add_new_flavours" style="float:  right;margin-bottom:20px" class="btn btn-lg btn-info"><b>+ Add Flavours </b> </a>
                                
                           <table id="total_flavour" border="2" class="table table-bordered table-responsive table-striped " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Flavour Name </th>
                                        <th> Large Price </th>
                                        <th> Flavour Price </th>
                                        <th> Action </th>
                                   </tr>
                                </thead>
                            </table>
                          </div>
                        </div>


                      </div>
                    </div>
<div style="padding-bottom:50px;">
</div>



<!-- Modal -->
  <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg"> -->
    
      <!-- Modal content-->
     <!--  <div class="modal-content">
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
  </div> -->
<style type="text/css">
    #accordion{
        margin: 20px;
    }
</style>
<script type="text/javascript">
$( "#accordion" ).accordion({
    collapsible: true,
    active: false,

});

    var cat_url ="<?php echo base_url()?>index.php/Products/get_category";
    var sub_cat_url ="<?php echo base_url()?>index.php/Products/get_sub_category";
    var product_url = "<?php echo base_url()?>index.php/Products/get_all_product";
    var flavours_url ="<?php echo base_url()?>index.php/Products/get_all_flavours"; 
    $('#category').dataTable({
            "ajax": {
                "url": cat_url,
                "dataType": "json",
                "cache": false,
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'cat_id', 'sType': 'string','orderable':true},
                    {'data': 'cat_name', 'sType': 'string', 'bVisible': true}
                ],
                    "columnDefs":[{ 
                            "targets": 2,
                            "render": function(data, type, row, meta){
                               return ' <a href="<?php echo base_url()?>index.php/Categories/edit_cat/'+row["id"]+'" class="btn btn-success">Edit</a'; 
                            }
                    }],
    });

    $('#sub_category').dataTable({
            "ajax": {
                "url": sub_cat_url,
                "dataType": "json",
                "cache": false,
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'sub_cat_id', 'sType': 'string','orderable':true},
                    {'data': 'cat_name', 'sType': 'string', 'bVisible': true},
                    {'data': 'sub_cat_name', 'sType': 'string', 'bVisible': true}
                ],
                    "columnDefs":[{ 
                            "targets": 3,
                            "render": function(data, type, row, meta){
                               return ' <a href="<?php echo base_url()?>index.php/Subcategories/edit_sub_cat/'+row["sub_cat_id"]+'" class="btn btn-success">Edit</a'; 
                            }
                    }],
    });

    $('#product').dataTable({
            "ajax": {
                "url": product_url,
                "dataType": "json",
                "cache": false,
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'id', 'sType': 'string','orderable':true},
                    {'data': 'name', 'sType': 'string', 'bVisible': true},
                    {'data': 'sub_cat_name', 'sType': 'string', 'bVisible': true},
                    {'data': 'cat_name', 'sType': 'string', 'bVisible': true},
                    {'data': 'sub_cat_name', 'sType': 'string', 'bVisible': true},
                    // {'data': 'sub_cat_name', 'sType': 'string', 'bVisible': true}
                ],
                    "columnDefs":[{ 
                            "targets": 6,
                            "render": function(data, type, row, meta){
                               return ' <a href="<?php echo base_url()?>index.php/Products/edit/'+row["id"]+'" class="btn btn-success">Edit</a><button class="btn btn-danger del_product" data-id='+row["id"]+'>Delete</button>';
                            }
                    },
                    { 
                            "targets": 2,
                            "render": function(data, type, row, meta){
                               return '<img height ="75" width=""src="<?php echo base_url()?>assets/images/cakes/'+row["product_image"]+'">'; 
                            }
                    }
                    ,
                     { 
                            "targets": 5,
                            "render": function(data, type, row, meta){

                                // alert(row["display_on_homepage"]);
                                if(row["display_on_homepage"]=='true'){

                                return '<label class="switch"><input type="checkbox" name="display_on_homepage" class="display_on_homepage" checked data-id='+row["id"]+'>  <span class="slider round"></span></label>'; 
                                }
                                else{
                                return '<label class="switch"><input type="checkbox" name="display_on_homepage" class="display_on_homepage" data-id='+row["id"]+'>  <span class="slider round"></span></label>'; 
                                }
                            }
                    }
                    ],
    });

    $('#total_flavour').dataTable({
            "ajax": {
                "url": flavours_url,
                "dataType": "json",
                "cache": false,
                "contentType": "application/json; charset=utf-8"
                },
                "aoColumns": [
                    {'data': 'id', 'sType': 'string','orderable':true},
                    {'data': 'flavour_name', 'sType': 'string', 'bVisible': true},
                    {'data': 'large_price', 'sType': 'string', 'bVisible': true},
                    {'data': 'flavour_price', 'sType': 'string', 'bVisible': true}
                   
                ]
                ,
                    "columnDefs":[{ 
                            "targets": 4,
                            "render": function(data, type, row, meta){
                               return ' <a href="<?php echo base_url()?>index.php/Products/edit_flavour/'+row["id"]+'" class="btn btn-success">Edit</a><button class="btn btn-danger del_flavour" data-id='+row["id"]+'>Delete</button>';
                            }
                    }]
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




    $(document).on('click','.del_product',function(){
            if (confirm("Are you sure to delete?")) {
            var id = $(this).attr('data-id');
            var url = "<?php echo base_url()?>index.php/Products/del_product";
            $.ajax({
                url:url,
                type:'POST',
                data:{'id':id},
                success:function(res){
                    
                }
            });
        }else{
            
        }
    });

    $(document).on('click','.display_on_homepage',function(){
            if (confirm("Are you sure to display on homepage?")) {
            var id = $(this).attr('data-id');
            var value= $(this).prop('checked');

            // alert(value);
            var url = "<?php echo base_url()?>index.php/Products/display_on_homepage";
            $.ajax({
                url:url,
                type:'POST',
                data:{'id':id,'value':value},
                success:function(res){
                    
                }
            });
        }else{
            
        }
    });

</script>