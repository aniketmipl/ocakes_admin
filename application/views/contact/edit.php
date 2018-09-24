<div id="page-wrapper">
<center><h2> Edit Store </h2></center>
<hr>
<div style="padding-bottom: :50px;">
</div>
<div class="col-lg-12" style="max-height:600px; overflow-y: scroll;margin-top: 22px ">

  <form name="contact_form" id="contact_form" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
       <input type="hidden" name="id" id="contact_id" value="<?php echo $contact_details[0]['id']?>">
        <tr> 
          <td><label> Area Name </label></td>
          <td><input type="text" id="area" name="area" class="form-control" value="<?php echo $contact_details[0]['area']?>"><label id="area_error"></label></td>
        </tr>
        <tr> 
          <td><label> Address </label></td>
          <td>
            <textarea name="address" id="address" class="form-control"><?php echo $contact_details[0]['address']?></textarea>
            <label id="address_error"></label>
          </td>
        </tr>
        <tr> 
          <td><label> Phone No </label></td>
          <td><input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $contact_details[0]['phone']?>"><label id="phone_no_error"></label></td>
        </tr>
    </table>
    <div >
          <input type="submit" name="submit"  id="submit" class="btn btn-success"> 
          <a href="<?php  echo base_url()?>index.php/Contact" class="btn btn-primary">Back</a>
    </div>
  </form>

</div>

<script type="text/javascript">
  $(function(){
    $("#contact_form").submit(function(e){
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var area = $("#area").val();
      var address = $("#address").val();
      var phone_no = $("#phone_no").val()
      var contact_id = $("#contact_id").val();

      var form_data = new FormData();                  // Creating object of FormData class
      form_data.append("area",area);
      form_data.append("address", address);
      form_data.append("phone_no", phone_no);
      form_data.append("id", contact_id);
      $.ajax({
                url: "../../Contact/AddEdit",
                dataType :"json",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, 
                type: 'post',
                success:function(res){
                  alert("success !!!");
                  window.location.href="<?php echo base_url()?>index.php/Contact"
                }
       })
      

    });
  });

</script>