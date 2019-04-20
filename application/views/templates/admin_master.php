<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('templates/admin/header'); ?>
<?php  $this->load->view('templates/admin/slide'); ?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
		<?php echo $view_file; ?>
    </section>
</section>
<!--main content end-->
<?php $this->load->view('templates/admin/footer'); ?>