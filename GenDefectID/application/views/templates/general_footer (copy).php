<div class="col-md-12 col-sm-12 col-xs-12" style="border-top:1px #CCCCCC solid;">&nbsp;</div>
<footer>
<div class="col-md-2 col-sm-2 col-xs-2"><a href="<?php echo base_url()?>home/login/1">Super Admin Login</a></div>
 <div class="col-md-10 col-sm-10 col-xs-10"><?php echo $this->lang->line('FOOTER');?></div>
</footer>
<script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
<script type="text/javascript">
$("#LoginForm").validate({
  rules: {
    username: "required",
    password: "required"
  },
  messages: {
    username: "The Username field is required.",
    password: "The Password field is required."
  }
});
</script>