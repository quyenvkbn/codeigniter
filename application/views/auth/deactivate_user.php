<div class="login-box edit-account">
  <div class="login-box-body">			
  		<h1><?php echo lang('deactivate_heading');?></h1>
		<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

		<?php echo form_open("admin/auth/deactivate/".$user->id,array('class' => 'form-horizontal'));?>

		  <p style="padding-top: 10px; padding-bottom: 10px;">
		  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
		    <input type="radio" name="confirm" value="yes" checked="checked" />
		    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
		    <input type="radio" name="confirm" value="no" />
		  </p>

		  <?php echo form_hidden($csrf); ?>
		  <?php echo form_hidden(['id' => $user->id]); ?>

		  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'),array('style' => 'color:white'));?></p>

		<?php echo form_close();?>
	</div>
</div>