<div class="form-box" id="login-box">
    <div class="header"><?php echo lang('login_heading');?></div>
	
	<div id="infoMessage"><?php echo $message;?></div>
	<?php echo form_open("auth/login");?>
		<div class="body bg-gray">
			<!-- p><?php echo lang('login_subheading');?></p -->		
        	<div class="form-group">
			    <?php echo lang('login_identity_label', 'identity');?>
			    <?php echo form_input($identity, false, 'class="form-control"');?>
	  		</div>
	  		<div class="form-group">
			    <?php echo lang('login_password_label', 'password');?>
			    <?php echo form_input($password, false, 'class="form-control"');?>
	  		</div>
	  		<div class="form-group">
			    <?php echo lang('login_remember_label', 'remember');?>
			    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
			</div>
		</div>
		<div class="footer"> 
	  		<p><?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn bg-olive btn-block"');?></p>
	  		<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
	  	</div>
	
	<?php echo form_close();?>
</div>