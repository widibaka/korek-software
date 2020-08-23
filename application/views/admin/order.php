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
                    <th>Premium Code</th>
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


                          <!-- Tagihan -->
                          <?php if ( $value['is_active'] != 1 ): ?>
                             <?php 
                                $amount = $this->KoreksoftModel->hitung_tagihan($value['id']);
                             ?>
                             <span>Tagihan: Rp<?= $amount['total_rp'] ?> or $<?= $amount['total_d'] ?></span>
                          <?php endif ?>

                          
                          
                        </td>

                        <td>
                          <?php if ( $value['expire'] != "0000-00-00 00:00:00" ): ?>
                            
                            <?php echo $this->KoreksoftModel->convertTimeFormat($value['expire'])?> <i><br>
                            (<?php echo $this->KoreksoftModel->getDayLeft($value['expire']) ?> day left)</i>
                          <?php else: ?>
                            -
                          <?php endif ?>
                        </td>

                        <td><?php if ( $value['is_active'] == 1 ) {
                          echo '<span style="color: green; font-weight: bold;">Active</span>';
                        }
                        else {
                          echo '<span style="color: red; font-weight: bold;">Inactive</span>';
                        }
                        ?></td>

                        <td>

                          <span id="code-<?php echo $value['id'] ?>" style="display: none;"><?php if ( $value['is_active'] == 1 ) {
                              if ( $value['free_code'] ) {
                                echo $value['free_code'];
                              }else{
                                echo $value['premium_code'];
                              }
                            }
                            ?></span>
                          <span id="remaining-request-<?php echo $value['id'] ?>" style="display: none;"><?php if ( $value['is_active'] == 1 ) {
                              $request_remains = $this->KoreksoftModel->get_request_remains($value['id']);
                              if ( $request_remains ) {
                                echo $request_remains;
                              }
                            }
                            ?></span>

                          <?php if ( $value['free_code'] ): ?>
                            <button type="button" class="btn bg-gray btn-sm mt-2" data-toggle="modal" data-target="#modal-default-2" onclick="show_code(<?php echo $value['id'] ?>)">
                             Show Free Code</button>
                          <?php else: ?>
                            <button type="button" class="btn btn-success btn-sm mt-2" data-toggle="modal" data-target="#modal-default-2" onclick="show_code(<?php echo $value['id'] ?>)">
                             Show Premium Code</button>
                          <?php endif ?>
                        </td>

                        <td>
                          <?php if ( $value['is_active'] == 0 ): ?>
                            <a class="btn btn-sm btn-success mb-1" href="<?php echo base_url("product/confirm_order/") . $value['id'] . "/" . $value['user_id'] . "/admin-order/" . $product['id'] ?>"><i class="fas fa-trash"></i> Konfirmasi</a>
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





        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pesanan dibatalkan</h3>
                <br>
                <div class="form-group col-12">
                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
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
                    <th>Premium Code</th>
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

                          <!-- Tagihan -->
                          <?php if ( $value['is_active'] != 1 ): ?>
                             <?php 
                                $amount = $this->KoreksoftModel->hitung_tagihan($value['id']);
                             ?>
                             <span>Tagihan: Rp<?= $amount['total_rp'] ?> or $<?= $amount['total_d'] ?></span>
                          <?php endif ?>


                          
                        </td>

                        <td>
                          <?php if ( $value['expire'] != "0000-00-00 00:00:00" ): ?>
                            
                            <?php echo $this->KoreksoftModel->convertTimeFormat($value['expire'])?> <i><br>
                            (<?php echo $this->KoreksoftModel->getDayLeft($value['expire']) ?> day left)</i>
                          <?php else: ?>
                            -
                          <?php endif ?>
                        </td>

                        <td><?php if ( $value['is_active'] == 1 ) {
                          echo '<span style="color: green; font-weight: bold;">Active</span>';
                        }
                        else {
                          echo '<span style="color: red; font-weight: bold;">Inactive</span>';
                        }
                        ?></td>

                        <td>
                          <span id="premium_code-<?php echo $value['id'] ?>" style="display: none;"><?php if ( $value['is_active'] == 1 ) {
                              echo $value['premium_code'];
                            }
                            else {
                              echo '-';
                            }
                            ?></span>


                          <?php if ( $value['is_active'] == 1 ): ?>
                            <button type="button" class="btn btn-success btn-sm mt-2" data-toggle="modal" data-target="#modal-default-2" onclick="show_premium_code(<?php echo $value['id'] ?>)">
                             Show Premium Code</button>
                          <?php endif ?>
                        </td>

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




        <div class="modal fade" id="modal-default-2">
          <div class="modal-dialog">
            <form action="" enctype="multipart/form-data" method="post" name="upload_form" accept-charset="utf-8">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Your Code</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- <p>Caption</p> -->
                  <div class="container">
                    
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <div class="row">
                            <textarea class="form-control" type="text" id="code-modal"></textarea>
                            <p id="request_remains"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="#" class="btn btn-primary">See How to use</a>
                </div>
              </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->