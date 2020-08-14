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
                <h3 class="card-title">Produk yang Anda pesan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="order_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Bukti Pembayaran<br> (Purchase Image)</th>
                    <th>Expire</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($orders as $key => $value): ?>
                  <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php 
                      $plan_id = $value['product_plan_id'];
                      $plan = $this->KoreksoftModel->getProductPlanById( $plan_id );

                      $product_id = $plan['product_id'];
                      $product = $this->KoreksoftModel->getProductById( $product_id );
                      echo $product['title'] . " - " . $plan['plan_title'];
                    ?></td>
                    <td><?php echo $value['amount'] ?></td>
                    <td>


                      <?php 
                      // filename terdiri dari user id - plan id - order id . jpg
                      $image_name = explode("?", $value['image']);
                      $filepath = 'assets/koreksoft/bukti_pembayaran/' . $image_name[0];
                      if ( file_exists( $filepath )  == true AND !empty($value['image']) ): ?>
                        <div style="max-width: 220px;">
                          <img src="<?php echo base_url() . 'assets/koreksoft/bukti_pembayaran/' . $value['image'] ?>" id="image-prev" class="img-thumbnail">
                        </div>

                      <?php else : ?>
                        <div class="col-12">
                          <i>No image</i>
                        </div>
                      <?php endif ?>
                      

                      <?php if ( $value['is_active'] != 1 ): ?>
                         <button type="button" class="btn btn-default mt-2" data-toggle="modal" data-target="#modal-default" onclick="show_modal(<?php echo $plan['id'] .',' . $value['id'] ?>)">
                         Upload Image</button> 
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
                      <a class="btn btn-sm btn-warning mb-1" href="<?php echo base_url("product/renew_order/") . $value['id'] . "/order/" . $product['id'] ?>"><i class="fas fa-retweet"></i> Perpanjang</a>
                      <a class="btn btn-sm btn-danger mb-1" href="<?php echo base_url("product/delete_order/") . $value['id'] . "/order/" . $product['id'] ?>"><i class="fas fa-trash"></i> Batalkan</a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Bukti Pembayaran (Purchase Image)</th>
                    <th>Expire</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->



        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <form action="" enctype="multipart/form-data" method="post" name="upload_form" accept-charset="utf-8">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Upload Bukti Pembayaran</h4>
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
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="hidden" name="plan_id" id="plan_id">
                            <input type="hidden" name="order_id" id="order_id">

                          <div class="col-sm-12">
                            <img style="display: none;" src="" id="image-prev-in-modal" class="img-thumbnail">
                            
                            <div class="form-group">
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="btn btn-default" name="image" id="input_img" style="width: 100%;" accept="image/*" onchange="loadFile(event)">
                                </div>
                              </div>
                            </div>
                            <div class="form-group row">
                              <p>Max Size : 1MB</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Upload Now!</button>
                </div>
              </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->