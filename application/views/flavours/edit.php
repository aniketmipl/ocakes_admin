<div id="page-wrapper" style="overflow: scroll;max-height:500px;">
    <div class="panel panel-default">
      <div class="panel-body"><center> <b>Edit Flavours </b> </center> </div>
    </div>
    <hr>
    
    <div class="col-md-12" > 
        <?php echo form_open_multipart('','id="frmflavours"'); ?>
        <input type="hidden" name="id" id="id" value="<?php echo $flavours[0]['id']?>">
            <div class="panel">
                <div class="panel-body">

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Flavour Name : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="flavour_name" value="<?php echo $flavours[0]['flavour_name']?>" class="form-control" id="flavour_name">
                            <label style="color:red" id="error_flavour_name"></label>
                        </div>
                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Large Price : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="large_price" value="<?php echo $flavours[0]['large_price']?>" class="form-control" id="large_price">
                            <label style="color:red" id="error_large_price"></label>
                        </div>
                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Fancy Price : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="flavour_price" value="<?php echo $flavours[0]['flavour_price']?>" class="form-control" id="flavour_price">
                            <label style="color:red" id="error_flavour_price"></label>
                        </div>
                    </div>

                    <div class="col-lg-12" align="center" style="padding-top: 20px">
                        <input type="submit" class="btn btn-primary" value="Submit" id="save_flavour" name="submit">
                        <a href="<?php echo base_url()?>index.php/Products" class="btn btn-default">Back</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

<style type="text/css">
    #accordion{
        margin: 20px;
    }
</style>
<script type="text/javascript">

    $("#save_flavour").click(function(e){
        e.preventDefault();
        var error = 0;
        var flavour_name = $("#flavour_name").val();
       
        if(flavour_name == ''){
            $("#error_flavour_name").html(' * Enter Flavour');
            error++;
        }else{
            $("#error_flavour_name").html('');
        }


        if(error < 1){
            var url = "<?php echo base_url()?>index.php/Products/AddEdit_flavour";
            $.ajax({
                url : url,
                type:'POST',
                data: new FormData($('#frmflavours')[0]),
                processData: false,
                contentType: false,
                // data:$('#frmsubcategory').serialize(),
                success: function(res){
                    if(res == 1){
                        alert("Record Updated !!");
                        window.location.href = "<?php echo base_url()?>index.php/Products";
                    }
                    else{
                        alert("ERROR");
                    }
                }
            });
        }else{
            alert("else part");
        }

    });
</script>