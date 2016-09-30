<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Change Password</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form action="<?php echo base_url();?>home/resetPassword" method="post"  name="resetpwdForm" id="resetpwdForm" class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>

                <div class="col-sm-9">
                    <input class="form-control" name="password" id="password" placeholder="New Password" type="password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Confirm Password</label>

                <div class="col-sm-9">
                    <input class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" type="password">
                </div>
            </div>            
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
           <!--  <button type="submit" class="btn btn-default">Cancel</button> -->
            <button type="submit" class="btn btn-info pull-right">Submit</button>
        </div>
        <!-- /.box-footer -->
    </form>
    </div>