<div class="login-box show-account">
  <div class="login-box-body">
		<h1><?php echo lang('index_heading');?></h1>
		<p><?php echo lang('index_subheading');?></p>

		<div id="infoMessage"><?php echo $message;?></div>
		<div class="table-responsive">
			<table class="table" cellpadding=0 cellspacing=10>
				<tr>
					<th><?php echo lang('index_fname_th');?></th>
					<th><?php echo lang('index_lname_th');?></th>
					<th><?php echo lang('index_email_th');?></th>
					<th><?php echo lang('index_groups_th');?></th>
					<th><?php echo lang('index_status_th');?></th>
					<th><?php echo lang('index_action_th');?></th>
				</tr>
				<?php foreach ($users as $user):?>
					<tr>
			            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
			            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
						<td  id="auth-edit-group">
							<?php foreach ($user->groups as $group):?>
								<span class="btn btn-xs btn-<?php echo ($user->active) ? 'success' : 'danger'; ?>">
								<i class="fa fa-pencil"></i>
								<?php echo anchor("admin/auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?>
								</span>
								<br />
			                <?php endforeach?>
						</td>
						<td id="auth-active">
							<span class="btn btn-xs btn-<?php echo ($user->active) ? 'success' : 'danger'; ?>">
								<i class="fa fa-<?php echo ($user->active) ? 'check' : 'close'; ?>"></i>
								<?php echo ($user->active) ? anchor("admin/auth/deactivate/".$user->id, lang('index_active_link')) : anchor("admin/auth/activate/". $user->id, lang('index_inactive_link'));?>
							</span>
						</td>
						<td  id="auth-edit">
							<span class="btn btn-xs btn-warning?>">
								<i class="fa fa-pencil"></i>
								<?php echo anchor("admin/auth/edit_user/".$user->id, 'Edit') ;?>
							</span>
						</td>
					</tr>
				<?php endforeach;?>
			</table>

			
		<div id="auth-index" style="float: right;">
			<span class="btn btn-primary"><?php echo anchor('admin/auth/create_user', lang('index_create_user_link'))?></span>
			<span class="btn btn-primary"><?php echo anchor('admin/auth/create_group', lang('index_create_group_link'))?></span>
		</div>
		</div>
	</div>
</div>