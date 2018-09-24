  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<div id="page-wrapper" style="overflow: scroll;max-height:500px;">
    <div class="panel panel-default">
      <div class="panel-body"><center> <b>Edit Terms and Condition Page </b> </center> </div>
    </div>
    <hr>
    
    <div class="col-md-12" > 
        <?php echo form_open_multipart('','id="frmterms"'); ?>
            <div class="panel">
                <div class="panel-body">

                    <div class="col-lg-12" style="padding-top: 50px;">
                        <div class="col-lg-2">
                            <label > Terms and conditions Description  : </label>
                        </div>
                        <div class="col-lg-10">
                            <textarea name="terms" class="form-control" id="terms"><?php echo $terms[0]['terms_desc']?></textarea>
                            <!-- <input type="text" name="flavour_name" value="<?php //echo $flavours[0]['flavour_name']?>" class="form-control" id="flavour_name"> -->
                            <label style="color:red" id="error_about_us"></label>
                        </div>
                    </div>

                    <div class="col-lg-12" align="center" style="padding-top: 20px">
                        <input type="submit" class="btn btn-primary" value="Submit" id="save_terms" name="submit">
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
     $('#terms').summernote();
     
        $("#save_terms").click(function(e){
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
                var url = "<?php echo base_url()?>index.php/Terms/AddEdit";
                $.ajax({
                    url : url,
                    type:'POST',
                    data: new FormData($('#frmterms')[0]),
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
