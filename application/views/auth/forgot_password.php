<div class="login-box">
  <div class="login-box-body">
		<h1><?php echo lang('forgot_password_heading');?></h1>
		<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

		<div id="infoMessage"><?php echo $message;?></div>

		<?php echo form_open("admin/auth/forgot_password",array('class' => 'form-horizontal'));?>

		      <p>
		      	<label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
		      	<?php echo form_input($identity,'',array('class' => 'form-control'));?>
		      </p>

		      <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'),array('style' => 'color:white'));?></p>

		<?php echo form_close();?>

  </div>
</div>