<div id="page-wrapper">
<center><h2> Add New Store </h2></center>
<hr>
<div style="padding-bottom: :50px;">
</div>
<div class="col-lg-12" style="max-height:600px; overflow-y: scroll;margin-top: 22px ">

  <form name="contact_form" id="contact_form" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
       
        <tr> 
          <td><label> Area Name </label></td>
          <td><input type="text" id="area" name="area" class="form-control" value=""><label id="area_error"></label></td>
        </tr>
        <tr> 
          <td><label> Address </label></td>
          <td>
            <textarea name="address" id="address" class="form-control"></textarea>
            <label id="address_error"></label>
          </td>
        </tr>
        <tr> 
          <td><label> Phone No </label></td>
          <td><input type="text" id="phone_no" name="phone_no" class="form-control" value=""><label id="phone_no_error"></label></td>
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
      
      var form_data = new FormData();                  // Creating object of FormData class
      form_data.append("area",area);
      form_data.append("address", address);
      form_data.append("phone_no", phone_no);

      $.ajax({
                url: "../Contact/AddEdit",
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