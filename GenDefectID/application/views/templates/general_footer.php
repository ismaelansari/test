
  </div>
  <!-- /.login-box-body -->
</div>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
         Copyright © 2016 All rights reserved — WiseWorking | version: alpha
      </div>
      <strong><a href="<?php echo base_url('home/login/1')?>">Super Admin Login</a></strong>
    </div>
    <!-- /.container -->
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo defaltPath; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo defaltPath; ?>bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo defaltPath; ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo defaltPath; ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo defaltPath; ?>dist/js/demo.js"></script>
<script src="<?php echo defaltPath; ?>plugins/iCheck/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
<script>  
var baseUrl = '<?php echo base_url();?>'
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

$("#resetpwdForm").validate({
  rules: {
    password: "required",
    cpassword: "required"
  },
  messages: {
    password: "The New Password field is required.",
    cpassword: "The Confirm Password field is required."
  }
});


function ValidateEmail()   
{  
	var email = $('#email').val();	
 	var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {        
        $("#email_error").html("Not a valid e-mail address");
        return false;
    }
    else{
    	$("#email_error").html("");    
    	$.ajax({
	      	url: baseUrl+'home/forgotPassword',
	      	type: 'post',
	      	data: {'email': email},
	      	success: function(data, status) {
	      		$('#email').val('');
	            $('#msg').html(data);
	      	},
	      	error: function(xhr, desc, err) {
	        console.log(xhr);
	        console.log("Details: " + desc + "\nError:" + err);
	      	}
	    }); // end ajax call	
    }
    return (false)  
}  

</script>
</body>
</html>
