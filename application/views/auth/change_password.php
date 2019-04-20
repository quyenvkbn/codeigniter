<div class="login-box">
  <div class="login-box-body">
            <h1><?php echo lang('change_password_heading');?></h1>
            <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open("admin/auth/change_password",array('class' => 'form-horizontal'));?>

                  <p>
                        <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                        <?php echo form_input($old_password,'',array('class' => 'form-control'));?>
                  </p>

                  <p>
                        <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                        <?php echo form_input($new_password,'',array('class' => 'form-control'));?>
                  </p>

                  <p>
                        <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                        <?php echo form_input($new_password_confirm,'',array('class' => 'form-control'));?>
                  </p>

                  <?php echo form_input($user_id);?>
                  <p><?php echo form_submit('submit', lang('change_password_submit_btn'),array('style' => 'color:white'));?></p>

            <?php echo form_close();?>
      </div>
</div>
