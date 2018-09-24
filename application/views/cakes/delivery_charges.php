<div id="page-wrapper">
<center><h2> Set Delivery Charges</h2></center>
<hr>
<div style="padding-bottom: :50px;">
</div>
<div class="col-lg-12" style="max-height:600px; overflow-y: scroll;margin-top: 22px ">

  <form name="delivery_form" id="delivery_form" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr> 
          <td><label> Delivery Charges </label></td>
          <td><input type="text" id="charges" name="charges" value="<?php echo $delivery_charges[0]->delivery_charges;?>"></td>
        </tr>
    </table>
    <div align="center">
          <input type="submit" name="submit"  id="submit" class="btn btn-success"> 
          <a href="<?php  echo base_url()?>index.php/Products" class="btn btn-primary">Back</a>
        </div>
  </form>

</div>

<script type="text/javascript">
  $(function(){
    $("#delivery_form").submit(function(e){
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var charges= $("#charges").val();

      var form_data = new FormData();                  // Creating object of FormData class
      form_data.append("charges", charges);
      $.ajax({
                url: "../cakes/edit_delivery_charge",
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