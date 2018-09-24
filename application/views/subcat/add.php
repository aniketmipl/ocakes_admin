<div id="page-wrapper" >
    <div class="panel panel-default">
      <div class="panel-body"><center> <b> Add Sub Category </b> </center> </div>
    </div>
    <hr>

    <div class="col-md-12" style="margin-top: 20px;overflow-y: scroll;min-height: 20px;">  
        <?php echo form_open('','id="frmsubcategory"'); ?>

            <div class="panel">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <label > Category Name : </label>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="cat_id">
                                <?php 
                                foreach ($category as $key => $value){
                                    echo '<option value="'.$value['cat_id'].'">'.$value['cat_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Sub Category Name : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="sub_cat_name" id="sub_cat_name" class="form-control">
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
    $("#save_category").click(function(){
        var url = "<?php echo base_url()?>index.php/Subcategories/AddEdit";
        $.ajax({
            url : url,
            type:'POST',
            data:$('#frmsubcategory').serialize(),
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