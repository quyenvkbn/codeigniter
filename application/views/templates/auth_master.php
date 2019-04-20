<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>fontAwesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>iCheck/square/blue.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url('assets/lib/') ?>dist/css/auth.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,700,700i" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<?php if($this->ion_auth->logged_in()): ?>
    <div id="back-admin"><a href="<?php echo base_url('admin') ?>"><em>Click vào đây để trở về trang admin</em></a></div>
<?php else: ?>
    <?php if($this->uri->segment(3) === 'forgot_password'): ?>
        <div id="back-admin"><a href="<?php echo base_url('admin/auth/login') ?>"><em>Click vào đây để trở về trang đăng nhập</em></a></div>
    <?php endif; ?>
<?php endif; ?>


    
<?php echo $view_file;  ?>



<!-- jQuery 3 -->
<script src="<?php echo site_url('assets/lib/') ?>jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url('assets/lib/') ?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo site_url('assets/lib/') ?>iCheck/js/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
