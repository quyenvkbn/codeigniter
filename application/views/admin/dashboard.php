<style>
Array
(
    [0] => 1556402400
    [1] => 1556488800
    [2] => 1556575200
)
Array
(
    [0] => 28/04/2019
    [1] => 29/04/2019
    [2] => 30/04/2019
)
</style>

<div class="content-wrapper" style="padding: 20px;">
	Đây là dashboard!
	<br><br><br>
	Upload nhiều img
	<?php echo form_open_multipart('admin/dashboard/upload_dashboard_multi',array('class' => "form-horizontal"));?>

	<input class="form-control"  type="file" name="image[]" size="20" multiple/>

	<br /><br />

	<input class="btn btn-success"  type="submit" value="upload single img" />

	</form>
	<br><br><br>
	Upload 1 img
	<?php echo form_open_multipart('admin/dashboard/upload_dashboard_single',array('class' => "form-horizontal"));?>

	<input  class="form-control" type="file" name="image" size="20" />

	<br /><br />

	<input class="btn btn-success"  type="submit" value="upload multi img" />
	
	</form>
                                <div class="input-group col-md-6" style="float: left;border-right: 5px solid white;">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" value="" class="form-control pull-right" id="reservation" name="date" readonly>
                                </div>

                                <div id="showdate">
                                	<div id="datepickers" data-date="20/04/2019,21/04/2019,26/04/2019,27/04/2019,28/04/2019,29/04/2019,30/04/2019,01/05/2019,02/05/2019,03/05/2019,04/05/2019"></div>
                                </div>
	<!-- <?php
		echo "<pre>";
		print_r($room);
		echo "<pre>";
	?> -->

	<ul class="pagination"><?= $page_links ?></ul>
</div>
<script>
	$(function () {
		$('#datepickers').datepicker({
		      format: 'dd/mm/yyyy',
		      startDate: '0d',
		      multidate:true,
		      language: 'vi',
		      datesDisabled:['18/04/2019','23/04/2019','24/04/2019','05/05/2019','06/05/2019','07/05/2019']
		});
		$(".datepicker-days").on("click","td.day",function(){
			return false;
		});
		
	});
</script>