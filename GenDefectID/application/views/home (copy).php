<style type="text/css">
.error{
    color: red !important;
}
</style>
<div class="row col-md-offset-3 signin col-sm-offset-2 col-xs-offset-1 col-xs-9">
      
    <div class="col-md-10 col-md-offset-3  col-sm-10  col-sm-offset-2" style="margin-bottom:10px">
        <?php  
        if(!empty($error)){
            echo '<div class="error"><label>'.$error."</label></div>";
        }
    ?>  
    </div>
    <form action="<?php echo base_url('home/login');?>" method="post"  name="LoginForm" id="LoginForm" class="form-horizontal">
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      <fieldset>
        <!-- Username input-->
        <div class="form-group">
          <label class="col-md-3 control-label col-sm-3" for="email_login"><?php echo $this->lang->line('USER_NAME');  ?>:</label>
          <div class="col-md-5  col-sm-7">
            <input value="<?php //echo $usernamerem; ?>" id="username" name="username" type="text" placeholder="<?php echo $this->lang->line('USER_NAME');  ?>" class="form-control input-md">
            <!--<span class="help-block">Enter your e-mail address</span>-->
             <?php //echo  $username;   ?>
                <div class="error"><?php echo form_error('username'); ?></div>
          </div>
          <div class="col-md-6"></div>
        </div>
        
        <!-- Password input-->
        <div class="form-group">
          <label class="col-md-3 control-label col-sm-3" for="password_login"><?php echo $this->lang->line('PASSWORD'); ?>:</label>
          <div class="col-md-5 col-sm-7">
            <input id="password" name="password" value="<?php //echo $passwordrem; ?>" type="password" placeholder="●●●●●" class="form-control input-md">
            <!--<span class="help-block">Enter your password</span>-->
             <?php //echo  $password;   ?>     
                <div class="error"><?php echo form_error('password'); ?></div>   
          </div>
          <div class="col-md-6"></div>
        </div>

        <?php
        if(!$is_super_admin)
        	{
        ?>
        <!-- Company input-->
        <div class="form-group">
          <label class="col-md-3 control-label col-sm-3" for="email_login"><?php echo $this->lang->line('COMPANY_NAME');  ?>:</label>
          <div class="col-md-5  col-sm-7">
            <input value="<?php //echo $usernamerem; ?>" id="companyName" name="companyName" type="text" placeholder="<?php echo $this->lang->line('COMPANY_NAME');  ?>" class="form-control input-md">
            <!--<span class="help-block">Enter your e-mail address</span>-->
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

          <div class="col-md-6"></div>
        </div>
        <?php
    		}
    	?>
        <!-- Multiple Checkboxes (inline) -->
        <div class="form-group">
          <div class="col-md-10 col-md-offset-3  col-sm-4  col-sm-offset-2">
              <div class="checkbox checkbox-warning">
                <input name="remember" value="1" id="checkbox5" type="checkbox"  <?php //echo $check; ?>>
                    <label for="checkbox5">
                         <?php echo $this->lang->line('REMEMBER_PASSWORD');?>
                    </label>
              </div>
          </div>
          <div class="col-md-10 col-md-offset-3  col-sm-10  col-sm-offset-2" style="margin-top:10px">
              <a href="pms.php?sect=forgot_password" class="forgot"><?php echo $this->lang->line('FORGOT_PASSWORD'); ?></a>
          </div>
          
        </div>
        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-2 control-label" for="singlebutton"></label>
          <div class="col-md-4">
            <button id="singlebutton" name="sign_in" class="btn btn-primary btnyellow"><?php echo $this->lang->line('LOGIN');?></button>
          </div>
          <div class="col-md-6"></div>
        </div>
      </fieldset>
    </form>
  </div>