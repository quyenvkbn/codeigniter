<style>

</style>

<div class="content-wrapper" style="padding: 20px;">
	Đây là dashboard!
	<br><br><br>
	<?php if ($this->session->flashdata('message_error')): ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <?php echo $this->session->flashdata('message_error'); ?>
        </div>
    <?php endif ?>
	chon lich
	<?php echo form_open_multipart('admin/booking/create',array('class' => "form-horizontal"));?>
		<input type="hidden" value='<?php echo $date_full; ?>' id="date_disabled"></input>
		<div class="col-xs-12">
            <label>Date:</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="date" value="" class="form-control pull-right" id="datepicker" readonly>
            </div>
            <br>
        	<button class="btn btn-primary" style="float: right">Xac Nhan</button>
        </div>
	</form>
</div>
<script>
	$(function () {
		$('#datepicker').datepicker({
		      format: 'dd/mm/yyyy',
		      startDate: '0d',
		      multidate:true,
		      language: 'vi',
		      datesDisabled:$('#date_disabled').val()
		});
		
	});
</script>