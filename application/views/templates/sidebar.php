<?php 
 $website = $this->KoreksoftModel->getWebsiteDetail();
 if ( $user['role_id'] == 1 ){
    $sidebar = $this->KoreksoftModel->getSidebarItems_admin();
 }
 else {
    $sidebar = $this->KoreksoftModel->getSidebarItems();
 }

?>
  <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url() ?>assets/index3.html" class="brand-link">
        <img src="<?= base_url() ?>assets/koreksoft/img/logo.png"
             alt="Koreksoft Logo"
             class="brand-image"
             style="opacity: .8;">
        <span class="brand-text font-weight-light"><?php echo $website['website_name'] ?></span>
      </a>

      
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="<?= base_url() ?>assets/dist/img/user_default.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?php 
                if ( !empty($user) ) {
                  echo $user['username'];
                }else{
                  echo "Guest";
                }
              ?></a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <?php foreach ($sidebar as $key => $value) : ?>

                  <?php 
                  $active = "";
                  if ( !empty($title) ){
                    if ( $value['item'] == $title )
                      { $active = "active"; }
                  }
                  ?>


                <li class="nav-item has-treeview">
                  <a href="<?= base_url() . $value['url'] ?>" class="nav-link <?= $active ?>">
                    <i class="nav-icon <?php echo $value['icon'] ?>"></i>
                    <p>
                      <?= $value['item'] ?>
                    </p>
                  </a>
                </li>
              <?php endforeach ?>
              <hr>
                <?php if ( !empty( $this->session->userdata("email") ) ): ?>
                <li class="nav-item has-treeview" style="border-top: #666 solid 1px;">
                  <a href="<?= base_url("auth/logout") ?>" class="nav-link">
                    <i class="nav-icon fa fa-sign-out-alt"></i>
                    <p>
                      Logout
                    </p>
                  </a>
                </li>
                <?php else: ?>
                <li class="nav-item has-treeview" style="border-top: #666 solid 1px;">
                  <a href="<?= base_url("auth/login") ?>" class="nav-link">
                    <i class="nav-icon fa fa-sign-in-alt"></i>
                    <p>
                      login
                    </p>
                  </a>
                </li>
                <?php endif ?>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      <!-- /.sidebar -->
    </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">