<div class="login-box create-user">
  <div class="login-box-body">    
    <h1><?php echo lang('create_user_heading');?></h1>
    <p><?php echo lang('create_user_subheading');?></p>

    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open("admin/auth/create_user",array('class' => 'form-horizontal'));?>

          <p>
                <?php echo lang('create_user_fname_label', 'first_name');?> <br />
                <?php echo form_input($first_name,'',array('class' => 'form-control'));?>
          </p>

          <p>
                <?php echo lang('create_user_lname_label', 'last_name');?> <br />
                <?php echo form_input($last_name,'',array('class' => 'form-control'));?>
          </p>
          
          <?php
          if($identity_column!=='email') {
              echo '<p>';
              echo lang('create_user_identity_label', 'identity');
              echo '<br />';
              echo form_error('identity');
              echo form_input($identity,'',array('class' => 'form-control'));
              echo '</p>';
          }
          ?>

          <p>
                <?php echo lang('create_user_company_label', 'company');?> <br />
                <?php echo form_input($company,'',array('class' => 'form-control'));?>
          </p>

          <p>
                <?php echo lang('create_user_email_label', 'email');?> <br />
                <?php echo form_input($email,'',array('class' => 'form-control'));?>
          </p>

          <p>
                <?php echo lang('create_user_phone_label', 'phone');?> <br />
                <?php echo form_input($phone,'',array('class' => 'form-control'));?>
          </p>

          <p>
                <?php echo lang('create_user_password_label', 'password');?> <br />
                <?php echo form_input($password,'',array('class' => 'form-control'));?>
          </p>

          <p>
                <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
                <?php echo form_input($password_confirm,'',array('class' => 'form-control'));?>
          </p>


          <p><?php echo form_submit('submit', lang('create_user_submit_btn'),array('style' => 'color:white'));?></p>

    <?php echo form_close();?>
  </div>
</div>