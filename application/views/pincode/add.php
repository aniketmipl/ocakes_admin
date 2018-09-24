<div id="page-wrapper">
<center><h2> Add Pincode </h2></center>
<hr>
<div style="padding-bottom: :50px;">
</div>
<div class="col-lg-12" style="max-height:600px; overflow-y: scroll;margin-top: 22px ">

  <form name="pincode_form" id="pincode_form" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr> 
          <td><label> Pincode </label></td>
          <td><input type="text" id="pincode" name="pincode" class="form-control" ><label id="pincode_error"></label></td>
        </tr>
    </table>
    <div >
          <input type="submit" name="submit"  id="submit" class="btn btn-success"> 
          <a href="<?php  echo base_url()?>index.php/Pincode" class="btn btn-primary">Back</a>
    </div>
  </form>

</div>

<script type="text/javascript">
  $(function(){
    $("#pincode_form").submit(function(e){
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var pincode = $("#pincode").val();

      var form_data = new FormData();                  // Creating object of FormData class
      form_data.append("pincode", pincode);
  
      $.ajax({
                url: "../../index.php/Pincode/AddEdit",
                dataType :"json",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, 
                type: 'post',
                success:function(res){
                  alert("success !!!");
                  window.location.href="<?php echo base_url()?>index.php/Pincode"
                }
       })
      

    });
  });

</script>