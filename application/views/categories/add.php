<div id="page-wrapper" >
    <div class="panel panel-default">
      <div class="panel-body"><center> <b> Add New Category </b> </center> </div>
    </div>
    <hr>

    <div class="col-md-12" style="margin-top: 20px;overflow-y: scroll;min-height: 20px;">  
        <?php echo form_open('','id="frmcategory"'); ?>

            <div class="panel">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <label > Category Name : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="cat_name" class="form-control">
                        </div>

                    </div>

                    <div class="col-lg-12" align="center" style="padding-top: 20px">
                        <input type="button" class="btn btn-primary" value="Submit" id="save_category" name="submit">
                        <a href="<?php echo base_url()?>index.php/Products" class="btn btn-default">Back</a>
                    </div>

                </div>
            </div>
    </div>
</div>

<style type="text/css">
    #accordion{
        margin: 20px;
    }
</style>
<script type="text/javascript">

    var cat_url ="<?php echo base_url()?>index.php/Products/get_category";

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
                               return ' <a href="<?php echo base_url()?>index.php/Product/edit_cat/'+row["cat_id"]+'" class="btn btn-success">Edit</a'; 
                            }
                    }],
    });

    $("#save_category").click(function(){
        var url = "<?php echo base_url()?>index.php/Categories/AddEdit";
        $.ajax({
            url : url,
            type:'POST',
            data:$('#frmcategory').serialize(),
            success: function(res){
                if(res == 1){
                    alert("Record Added !!");
                }
                else{
                    alert("ERROR");
                }
            }
        })

    });
</script>