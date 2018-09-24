  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<div id="page-wrapper" style="overflow: scroll;max-height:500px;">
    <div class="panel panel-default">
      <div class="panel-body"><center> <b> Add New Cake </b> </center> </div>
    </div>
    <hr>

    <div class="col-md-12" > 
        <?php echo form_open_multipart('','id="frmsubcategory"'); ?>
            <div class="panel">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <label > Category Name : </label>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="cat_id" id="cat_id">
                                <option value="">--select--</option>
                                <?php 
                                foreach ($category as $key => $value){
                                    echo '<option value="'.$value['cat_id'].'">'.$value['cat_name'].'</option>';
                                }
                                ?>
                            </select>
                            <label style="color:red" id="error_sel_cat"></label>
                        </div>

                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Sub Category Name : </label>
                        </div>
                        <div class="col-lg-4">

                             <select class="form-control" name="sub_cat_id" id="sub_cat_id">
                                <option value="">--select--</option>
                            </select>
                            <label style="color:red" id="error_sel_sub_cat"></label>
                        </div>

                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Cake Name : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="cake_name" class="form-control" id="cake_name">
                            <label style="color:red" id="error_cake_name"></label>
                        </div>

                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Cake Image : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="file" class="form-control" name="product_image" id="product_image">
                            <label style="color:red" id="error_product_image"></label>
                        </div>

                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Cake Description : </label>
                        </div>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="product_description" id="product_description"></textarea>
                            <label style="color:red" id="error_product_description"></label>
                        </div>

                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Weight & Price : </label>
                        </div>
                        <div class="col-lg-8 form-inline">
                            <input type="button" name="add_weight" value="Add More" class="btn btn-success add_weight" style="float: right">
                            <div class="quant_price">
                                <input type="text" class="form-control" placeholder="Enter Weight" name="quantity1" id="quantity">
                                <input type="text" class="form-control" placeholder="Enter Price" name="price1" id="price">
                            </div>
                            
                            <label style="color:red" id="error_quantity"></label>
                        </div>

                    </div>

                      <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > Flavours : </label>
                        </div>
                        <div class="col-lg-4 ">
                        <?php


                        foreach ($all_flaours as $key => $value) {
                            echo '<div class="checkbox">';
                            echo '<label><input type="checkbox" name="flavours[]"  value="'.$value['id'].'">'.$value['flavour_name'].'</label>'; 
                            echo '</div>';
                        }
                        ?>
                            <label style="color:red" id="error_flavours"></label>
                        </div>

                    </div>


                    <input type="hidden" name="cnt" id="cnt" value="1">
                 <!--    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > price : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="price" id="price">
                            <label style="color:red" id="error_price"></label>
                        </div>

                    </div> -->

                    <div class="col-lg-12" align="center" style="padding-top: 20px">
                        <input type="submit" class="btn btn-primary" value="Submit" id="save_product" name="submit">
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
     $('#product_description').summernote();
    var cnt=1;
    $(".add_weight").click(function(){
        cnt++;
        var add_div = '<div class="add_more_weight"  style="padding-top:5px"><input type="text" class="form-control" placeholder="Enter Weight" name="quantity'+cnt+'" id="quantity'+cnt+'"><input type="text" class="form-control" placeholder="Enter Price" name="price'+cnt+'" id="price'+cnt+'"  style="margin-left: 4px;"> <i class="fa fa-close del_weight"></i></div>';
        $(".quant_price").append(add_div);
        $("#cnt").val(cnt);
    })

    $(document).on('click','.del_weight',function(){
        $(this).closest('.add_more_weight').remove();
    });

    $(document).on('change','#cat_id',function(){
        var cat_url = "<?php echo base_url()?>index.php/Products/get_sub_cat_details"
        var cat_id = $(this).val();
        $.ajax({
            url : cat_url,
            type:'POST',
            data:{"cat_id":cat_id},
            success: function(res){
                var results = $.parseJSON(res);
                var options = '';
                $.each(results,function(i,k){
                    // console.log(k.cat_id);
                    // options+= '<option value="'+k.cat_id+'">+'k.sub_cat_name+'</option>';
                    options+= '<option value='+k.sub_cat_id+'>'+k.sub_cat_name+'</option>';
                });
                // console.log(options);
                $("#sub_cat_id").html(options);

            }
        })
    })

    $("#save_product").click(function(e){
        e.preventDefault();
        var cat_id = $("#cat_id").val();
        var sub_cat_id =$("#sub_cat_id").val();
        var cake_name = $("#cake_name").val();
        var product_image = $("#product_image").val();
        var product_description = $('#product_description').val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        var error =0;

        if(cat_id == ''){
            $("#error_sel_cat").html(' * Please select category');
            error++;
        }else{
            $("#error_sel_cat").html('');
        }

        if(sub_cat_id == ''){
            $("#error_sel_sub_cat").html(' * Please select sub category');
            error++;
        }else{
            $("#error_sel_sub_cat").html('');
        }

        if(cake_name == ''){
            $("#error_cake_name").html(' * Enter Cake Name');
            error++;
        }else{
            $("#error_cake_name").html('');
        }

        if(product_image == ''){
            $("#error_product_image").html(' * Image Required');
            error++;
        }else{

            var ext = product_image.match(/\.(.+)$/)[1];
            switch(ext)
            {
                case 'jpg':
                case 'bmp':
                case 'png':
                case 'tif':
                    $("#error_product_image").html('');
                    // alert('allowed');
                    break;
                default:
                    $('#error_product_image').html('* Invalid file type only images allowed');
                    $('#product_image').val('');
                    error++;
            }
        }

        if(product_description == ''){
            $("#error_product_description").html(' * Description Required');
            error++;
        }else{
            $("#error_product_description").html('');
        }

        if(quantity == ''){
            $("#error_quantity").html(' * Enter Weight');
            error++;
        }else{
            $("#error_quantity").html('');
        }

        if(price == ''){
            $("#error_price").html(' * Enter Price');
            error++;
        }else{
            $("#error_price").html('');
        }

        if(error < 1){
            var url = "<?php echo base_url()?>index.php/Products/AddEdit";

            $.ajax({
                url : url,
                type:'POST',
                data: new FormData($('#frmsubcategory')[0]),
                processData: false,
                contentType: false,
                // data:$('#frmsubcategory').serialize(),
                success: function(res){
                    if(res == 1){
                        alert("Record Added !!");
                    }
                    else{
                        alert("ERROR");
                    }
                }
            });
        }

    });
</script>