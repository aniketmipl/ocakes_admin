<div class="container" >
  <div class="col-md-12" align="center"><h1>o-cakes </h1></div>
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-primary" >
        <div class="panel-heading"><h2 class="panel-title">Sign In</h2></div>
          <div class="panel-body">
            <!-- <form action="Login/validate" method="post"> -->
            <?php echo form_open(base_url().'index.php/login/validate'); ?>
              <span>
              <?php
                if(isset($msg)){ 
                  echo $msg;
                }
              ?>
               <?php
                    echo form_open('login/process'); 

                    $username = array(
                                  'name'        => 'username',
                                  'id'          => 'username',
                                  'class'       =>  'form-control',
                                  'autocomplete' => 'off',
                                  'placeholder' =>'username'
                                );

                    echo form_input($username);
                    echo '<br>';

                    $password = array(
                                  'name'        => 'password',
                                  'id'          => 'password',
                                  'class'       =>  'form-control',
                                  'autocomplete' => 'off',
                                  'placeholder' =>'password'
                                );

                    echo form_password($password);
                    echo '<br>';
                    $submit = array(
                                  'name'        => 'submit', 
                                  'id'          => 'login',
                                  'value'       =>  'Login',
                                  'class'       =>  'btn btn-lg btn-success btn-block',
                                );

                    echo form_submit($submit);
                    ?>
            </form>
        </div>
      </div>
  </div>
</div>