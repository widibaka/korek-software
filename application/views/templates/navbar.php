  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url() ?>assets/index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <?php $unread = $this->KoreksoftModel->get_unread_notification($user["user_id"]); ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php if ( $unread != 0 ): ?>
            <span class="badge badge-danger navbar-badge"><?php echo $unread; ?></span>
          <?php endif ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $unread ?> Notifications</span>
          <div class="dropdown-divider"></div>
          <?php $notif = $this->KoreksoftModel->get_notification($user["user_id"]) ?>
          <?php foreach ($notif as $key => $ntf): ?>
            <a href="#" class="dropdown-item <?php if( $ntf['read'] == 0 ){ echo "bg-warning"; } ?>">
              <!-- Message Start -->
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?php echo $ntf['subject'] ?>
                    <span class="float-right text-sm text-warning"></span>
                  </h3>
                  <p class="text-sm"><?php echo $ntf['content'] ?></p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $this->KoreksoftModel->get_time_ago( $ntf['timestamp'] ) ?></p>
                </div>
              </div>
              <!-- Message End -->
            </a>
          <?php endforeach ?>
          <div class="dropdown-divider"></div>
          <a href="#mark_as_read" class="dropdown-item dropdown-footer" <?php if ( $this->session->userdata("email") ) {
            echo 'onclick="mark_as_read()"';
          }?>>Mark as read</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->
<?php echo $this->session->flashdata('alert');  ?>
<!-- Alert -->