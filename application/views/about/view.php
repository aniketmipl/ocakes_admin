  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<div id="page-wrapper" style="overflow: scroll;max-height:500px;">
    <div class="panel panel-default">
      <div class="panel-body"><center> <b>Edit About Page </b> </center> </div>
    </div>
    <hr>
    
    <div class="col-md-12" > 
        <?php echo form_open_multipart('','id="frmabout"'); ?>
            <div class="panel">
                <div class="panel-body">

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-2">
                            <label > About Description  : </label>
                        </div>
                        <div class="col-lg-10">
                            <textarea name="about_us" class="form-control" id="about_us"><?php echo $about[0]['about_desc']?></textarea>
                            <!-- <input type="text" name="flavour_name" value="<?php //echo $flavours[0]['flavour_name']?>" class="form-control" id="flavour_name"> -->
                            <label style="color:red" id="error_about_us"></label>
                        </div>
                    </div>

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-4">
                            <label > About Image  : </label>
                        </div>
                        <div class="col-lg-4">
                            <input type="file" name="upload_file" id="upload_file">
                            <input type="hidden" name="old_file" id="old_file" value="<?php echo $about[0]['image_loc']; ?>">
                            <img src="<?php echo base_url()."assets/images/".$about[0]['image_loc']?>"  style="height:100%;width: 100%;">
                            <label style="color:red" id="error_upload_file"></label>
                        </div>
                    </div>


                    <div class="col-lg-12" align="center" style="padding-top: 20px">
                        <input type="submit" class="btn btn-primary" value="Submit" id="save_about" name="submit">
                        <a href="<?php echo base_url()?>index.php/Products" class="btn btn-default">Back</a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<!-- <script>
    ClassicEditor
        .create( document.querySelector( '#about_us' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script> -->

<script type="text/javascript">
    $(function(){
     $('#about_us').summernote();
     
        $("#save_about").click(function(e){
            e.preventDefault();
            var error = 0;
            var about_us = $("#about_us").val();
            if(about_us == ''){
                $("#error_about_us").html(' * Enter Description');
                error++;
            }else{
                $("#error_about_us").html('');
            }


            if(error < 1){
                var url = "<?php echo base_url()?>index.php/About/AddEdit";
                $.ajax({
                    url : url,
                    type:'POST',
                    data: new FormData($('#frmabout')[0]),
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
    })
</script>
