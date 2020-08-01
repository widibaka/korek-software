<style type="text/css">
  .wadah_previewer-textarea_satu{
    position: relative;
    height: auto;
    background-color: #FFFFFF;
    border: 1px solid #ddd;
    border-bottom: 0px;
    width: 100%;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow: #eee 0 0 4px;
  }
  .wadah_previewer-textarea_satu p{
    line-height: 1em;
    margin-bottom: 0.5em;
    padding: 0 5px 0 5px;
  }
  .previewer_gambar{
    width: 100%;
  }
  .previewer_title{
    font-weight: bold;
    font-size: 1.3em;
    padding: 5px;
    margin-top: 10px;
    padding-bottom: 0px;
  }
  .previewer_url{
    font-weight: normal;
    font-size: 1em;
    font-style: italic;
  }
  .previewer_description{
    font-weight: normal;
    font-size: 0.9em;
  }
  .previewer_close{
    position: absolute;
    font-size: 1em;
    right: 8px;
    top: 4px;
    color: #FFFFFF;
    font-weight: bold;
    text-shadow: 0px 0px 2px #333;
  }
  .previewer_close:hover{
    color: #ddd;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Link Previewer</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <?php //var_dump( $user ) ?><br>
            <input type="text" name="" style="width: 100%" value="https://www.youtube.com/watch?v=eWEgUcHPle0" koreksoft="textarea_satu" >
          </div>
          
          <!-- /.card-body -->
          <div class="card-footer">
            Footer
          </div>
          <!-- /.card-footer-->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
