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
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="order_table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Bukti Pembayaran (Purchase Image)</th>
                    <th>Expire</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($orders as $key => $value): ?>
                  <tr>
                    <td><?php 
                      $plan_id = $value['product_plan_id'];
                      $plan = $this->KoreksoftModel->getProductPlanById( $plan_id );

                      $product_id = $plan['product_id'];
                      $product = $this->KoreksoftModel->getProductById( $product_id );
                      echo $product['title'] . " - " . $plan['plan_title'];
                    ?></td>
                    <td><?php echo $value['amount'] ?></td>
                    <td><?php echo $this->KoreksoftModel->convertTimeFormat($value['timestamp']) ?></td>
                    <td><?php echo $value['image'] ?></td>
                    <td><?php echo $this->KoreksoftModel->convertTimeFormat($value['expire']) ?></td>
                    <td> <a href="<?php echo base_url("product/delete_order/") . $value['id'] ?>">Hapus</a></td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Bukti Pembayaran (Purchase Image)</th>
                    <th>Expire</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->