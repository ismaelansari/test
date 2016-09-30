<p class="login-box-msg"><?php  
        if(!empty($error)){
            echo '<div class="error"><label>'.$error."</label></div>";
        }
        ?></p>

            <form action="<?php echo base_url();?>home/login/<?php echo $is_super_admin; ?>" method="post"  name="LoginForm" id="LoginForm" class="form-horizontal">
              <div class="form-group has-feedback">
                <input type="text" id="username" name="username" class="form-control" placeholder="<?php echo $this->lang->line('USER_NAME'); ?>"
                value="<?php if(!empty($username)){echo $username;}?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" id="password" name="password"  placeholder="●●●●●"
                value="<?php if(!empty($password)){echo $password;}?>">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <?php 
              if(!$is_super_admin)
              {
              ?>
              <div class="form-group has-feedback">
                <input type="text" id="companyName" name="companyName" class="form-control" placeholder="<?php echo $this->lang->line('COMPANY_NAME');  ?>">
                <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
                <?php //echo  $username;   ?>
                <?php
                    if(!empty($this->session->flashdata('notification'))){
                ?>
                <label class="error" for=""><?php echo $this->session->flashdata('notification');?></label>                
                    <div class="error"></div>   
                <?php 
                }
                ?>
              </div>
              <?php } ?>
              <div class="row">
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                      <input <?php if(!empty($_COOKIE['remProbSWId'])){echo "checked";}?> type="checkbox" name="remember" id="remember" value="1"> Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
       
    <!-- /.social-auth-links -->

    <a href="#" data-target="#pwdModal" data-toggle="modal">I forgot my password</a><br>
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
<!--Forget password modal-->
<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Forgot Password?</h1>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">                          
                          <p>If you have forgotten your password you can reset it here.</p>
                          <p id="msg"></p>
                            <div class="panel-body">                                
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control input-lg" placeholder="E-mail Address" name="email" id="email" type="email">
                                        <label class="error" id="email_error" style="float:left;" for=""></label>
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block" onclick="ValidateEmail();" value="Submit" type="button">
                                </fieldset>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
          </div>    
      </div>
  </div>
  </div>
</div>
