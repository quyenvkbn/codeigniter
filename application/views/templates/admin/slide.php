<?php
//if($this->ion_auth->logged_in()) {
//?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo site_url('assets/img/admin/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>
                        <?php
                            if (  $this->ion_auth->logged_in()  ) {
                                echo 'Hello  ' . $this->ion_auth->user()->row()->first_name . $this->ion_auth->user()->row()->last_name;
                            }
                        ?>
                    </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form hidden">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">THÔNG TIN CHUNG</li>
                <li class="<?php echo ($this->uri->segment(2) == '') ? 'active' : '' ?>">
                    <a href="<?php echo base_url('admin') ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'manager') ? 'active' : '' ?>">
                    <a href="<?php echo base_url('admin/manager') ?>">
                        <i class="fa fa-cubes"></i> <span>Manager Test</span>
                    </a>
                </li>
                <li class="header">QUẢN LÝ TÀI KHOẢN</li>
                <li>
                    <a href="<?php echo base_url('admin/auth/change_password') ?>">
                        <i class="fa fa-refresh" aria-hidden="true"></i> <span>Đổi Mật Khẩu</span>
                    </a>
                </li>
                <?php if ($this->ion_auth->is_admin()===TRUE): ?>
                    <li>
                    <a href="<?php echo base_url('admin/auth') ?>">
                        <i class="fa fa-users" aria-hidden="true"></i> <span>Quản lý tài khoản</span>
                    </a>
                </li>
                    <li>
                        <a href="<?php echo base_url('admin/auth/create_user') ?>">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> <span>Tạo tài khoản</span>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
<?php //} ?>



