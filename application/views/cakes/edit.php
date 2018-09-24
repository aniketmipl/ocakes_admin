<div id="page-wrapper">
<center><h2> Edit Cakes & Pastries </h2></center>
<hr>
<div style="padding-bottom: :50px;">
</div>
<div class="col-lg-12" style="max-height:600px; overflow-y: scroll;margin-top: 22px ">

  <form name="cake_form" id="cake_form" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr> 
          <td><label> ID </label></td>
          <td><input type="text" id="id" name="id" value="<?php echo $cake_details[0]['p_id'];?>"></td>
        </tr>
        <tr> 
          <td><label> Name </label></td>
          <td><input type="text" id="name" name="name" value="<?php echo $cake_details[0]['name'];?>"><label id="name_error"></label></td>
        </tr>
        <tr> 
          <td><label> Image </label></td>
          <td><input type="file" name="file" id="file"> 
            <?php echo form_error('file','<p class="help-block">','</p>'); ?>

            <?php if($cake_details[0]['product_image'] !=''){?>
            <img src="<?php echo base_url().$cake_details[0]['product_image']?>" style="height: 100px;width:100px;" title="Click to view" onclick="window.open(this.src)">
            <?php } ?>
            
            <label id="file_error"></label>
          </td>
        </tr>
        <tr> 
          <td><label> Pastry Price </label></td>
          <td><input type="text" id="pastry_price" name="pastry_price" value="<?php echo $cake_details[0]['pastery_price'];?>"><label id="pastry_error"></label></td>
        </tr>
        <tr> 
          <td><label> Small Price </label></td>
          <td><input type="text" id="small_price" name="small_price" value="<?php echo $cake_details[0]['small_price'];?>"> <label id="small_error"></label> </td>
        </tr>
        <tr> 
          <td><label> Large Price </label></td>
          <td><input type="text" id="large_price" name="large_price" value="<?php echo $cake_details[0]['large_price'];?>"></td>
          <td><label id="large_error"></label></td>
        </tr>
        <tr> 
          <td><label> Fancy Price </label></td>
          <td><input type="text" id="fancy_price" name="fancy_price" value="<?php echo $cake_details[0]['large_price']+100;?>"><label id="fancy_error"></label></td>
        </tr>
    </table>
    <div >
          <input type="submit" name="submit"  id="submit" class="btn btn-success"> 
          <a href="<?php  echo base_url()?>index.php/Cakes" class="btn btn-primary">Back</a>
        </div>
  </form>

</div>

<script type="text/javascript">
  $(function(){
    $("#cake_form").submit(function(e){
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var file_data = $("#file").prop("files")[0]; 
      var id= $("#id").val();
      var name = $("#name").val();
      var pastry_price = $("#pastry_price").val();
      var small_price = $("#small_price").val()
      var large_price = $("#large_price").val()
      var fancy_price = $("#fancy_price").val()

      var form_data = new FormData();                  // Creating object of FormData class
      form_data.append("id", id);
      form_data.append("name",name);
      form_data.append("pastry_price", pastry_price);
      form_data.append("small_price", small_price);
      form_data.append("large_price", large_price);
      form_data.append("fancy_price", fancy_price);
      form_data.append("file",file_data);
      form_data.append("action","edit");
      $.ajax({
                url: "../edit_save",
                dataType :"json",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, 
                type: 'post',
                success:function(res){
                  alert("success !!!");
                }
       })
      

    });
  });

</script>