        <link rel="stylesheet" href="<?php echo base_url("assets/") ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1><?php echo $title ?></h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Produk dipesan & aktif</h3>
                <br>
                <div class="form-group col-12">
                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                    <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="fn_tampilkan_gambar()">
                    <label class="custom-control-label" for="customSwitch3">Tampilkan Gambar</label>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="order_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Client</th>
                    <th>Amount</th>
                    <th>Bukti Pembayaran<br> (Purchase Image)</th>
                    <th>Expire</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($orders as $key => $value): ?>
                    <?php if ( $value['cancel'] == 0 ): ?>
                      <tr>
                        <td><?php echo $value['id'] ?></td>
                        <td><?php 
                          $plan_id = $value['product_plan_id'];
                          $plan = $this->KoreksoftModel->getProductPlanById( $plan_id );

                          $product_id = $plan['product_id'];
                          $product = $this->KoreksoftModel->getProductById( $product_id );
                          echo $product['title'] . " - " . $plan['plan_title'];
                        ?></td>
                        <td>
                          <?php 
                            $client = $this->KoreksoftModel->getUserById( $value['user_id'] );
                            $username = $client['username'];
                            $client_id = $client['user_id'];
                          ?>
                          <a href="<?php echo base_url() . "admin/client/" . $client_id ?>"><?php echo $username; ?></a>
                          
                        </td>
                        <td><?php echo $value['amount'] ?></td>
                        <td class="text-center">


                          <?php 
                          // filename terdiri dari user id - plan id - order id . jpg
                          $image_name = explode("?", $value['image']);
                          $filepath = 'assets/koreksoft/bukti_pembayaran/' . $image_name[0];
                          if ( file_exists( $filepath )  == true AND !empty($value['image']) ): ?>
                            <div style="width: 220px;">
                              <a class="gambar" target="_blank" href="<?php echo base_url() . 'assets/koreksoft/bukti_pembayaran/' . $value['image'] ?>" class="img-thumbnail">Show Picture</a>
                              <img src="" id="image-prev" class="img-thumbnail" style="display: none;">
                            </div>

                          <?php else : ?>
                            <div class="col-12">
                              <i>No image</i>
                            </div>
                          <?php endif ?>
                          
                        </td>
                        <td><?php echo $this->KoreksoftModel->convertTimeFormat($value['expire']) ?> <i><br>(<?php echo $this->KoreksoftModel->getDayLeft($value['expire']) ?> day left)</i> </td>
                        <td><?php if ( $value['is_active'] == 1 ) {
                          echo '<span style="color: green; font-weight: bold;">Active</span>';
                        }
                        else {
                          echo '<span style="color: red; font-weight: bold;">Inactive</span>';
                        }
                        ?></td>
                        <td>
                          <?php if ( $value['is_active'] == 0 ): ?>
                            <a class="btn btn-sm btn-success mb-1" href="<?php echo base_url("product/confirm_order/") . $value['id'] . "/admin-order/" . $product['id'] ?>"><i class="fas fa-trash"></i> Konfirmasi</a>
                          <?php else: ?>
                            <a class="btn btn-sm btn-warning mb-1" href="<?php echo base_url("product/unconfirm_order/") . $value['id'] . "/admin-order/" . $product['id'] ?>"><i class="fas fa-trash"></i> Un-konfirmasi</a>
                          <?php endif ?>
                          
                          <a class="btn btn-sm btn-danger mb-1" href="<?php echo base_url("product/delete_order_admin/") . $value['id'] . "/admin-order/" . $product['id'] ?>"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>




        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Produk yang dibatalkan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="canceled_order_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Client</th>
                    <th>Amount</th>
                    <th>Bukti Pembayaran<br> (Purchase Image)</th>
                    <th>Expire</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($orders as $key => $value): ?>
                    <?php if ( $value['cancel'] == 1 ): ?>
                      <tr>
                        <td><?php echo $value['id'] ?></td>
                        <td><?php 
                          $plan_id = $value['product_plan_id'];
                          $plan = $this->KoreksoftModel->getProductPlanById( $plan_id );

                          $product_id = $plan['product_id'];
                          $product = $this->KoreksoftModel->getProductById( $product_id );
                          echo $product['title'] . " - " . $plan['plan_title'];
                        ?></td>
                        <td><?php 
                          $username = $this->KoreksoftModel->getUserById( $value['user_id'] )['username'];
                          echo  $username;
                        ?></td>
                        <td><?php echo $value['amount'] ?></td>
                        <td class="text-center">


                          <?php 
                          // filename terdiri dari user id - plan id - order id . jpg
                          $image_name = explode("?", $value['image']);
                          $filepath = 'assets/koreksoft/bukti_pembayaran/' . $image_name[0];
                          if ( file_exists( $filepath )  == true AND !empty($value['image']) ): ?>
                            <div style="width: 220px;">
                              <a class="gambar" target="_blank" href="<?php echo base_url() . 'assets/koreksoft/bukti_pembayaran/' . $value['image'] ?>" class="img-thumbnail">Show Picture</a>
                              <img src="" id="image-prev" class="img-thumbnail" style="display: none;">
                            </div>

                          <?php else : ?>
                            <div class="col-12">
                              <i>No image</i>
                            </div>
                          <?php endif ?>
                          
                        </td>
                        <td><?php echo $this->KoreksoftModel->convertTimeFormat($value['expire']) ?> <i><br>(<?php echo $this->KoreksoftModel->getDayLeft($value['expire']) ?> day left)</i> </td>
                        <td><?php if ( $value['is_active'] == 1 ) {
                          echo '<span style="color: green; font-weight: bold;">Active</span>';
                        }
                        else {
                          echo '<span style="color: red; font-weight: bold;">Inactive</span>';
                        }
                        ?></td>
                        <td>
                          <a class="btn btn-sm btn-danger mb-1" href="<?php echo base_url("product/delete_order_admin/") . $value['id'] . "/admin-order/" . $product['id'] ?>"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


