<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Damaged Products
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Damage/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
      <li class="active"></li>
    </ol>
  
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
        <div class="box-header">
          <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
          <!-- <h3 class="box-title">Data Table With Full Features</h3> -->

          <div class="row">
              <div class="col-md-3">
                <div class="input-group margin">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-primary nohover">Product</button>
                  </div><!-- /btn-group -->
                  <select name="product_id_fk" id="product_id_fk" style="width:350px;" class="form-control select2">
                                          <option value="" selected="selected">--SELECT--</option>
                                          <?php
                                          foreach ($product_names as $w)
                                          {
                                            ?><option value="<?php echo $w->product_id;?>"><?php echo $w->product_name ?></option>
                                            <?php
                                          }
                                          ?>         
                                           </select> 
                </div><!-- /input-group -->
              </div>
                <div class="col-sm-4">
                    <div class="input-group">
                      <button type="button" id="search" class="btn bg-orange btn-flat margin">Search</button>
                      <a href="<?php echo base_url(); ?>Damage/add" class="btn btn-danger"><i class="fa fa-plus-square"></i> Add New</a>
                     &nbsp;<a href="<?php echo base_url(); ?>Damage"  <button type="button" class="btn btn-info">Refresh</button></a>
                    </div>
                </div>
            </div>
      
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="classinfo_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: center;">SINO</th>
                <th>DATE</th>
                <th>PRODUCT_NAME</th>
                <th>DAMAGED_QTY</th>
                <th style="text-align: center;">EDIT</th>
                <th style="text-align: center;">
                  <center>DELETE</center>
                </th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exampleModalLabel" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b> Items -Transfer To Stock</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-body" style="font-weight: bold;">
          <div class="form-group">
            <div class="col-md-3">
              <label>Transfer Date <span style="color:red"></span></label>
              <input type="text" autofocus class="form-control" name="cdate" id="cdate" value="">
            </div>

            <div class="col-md-3">
              <label>Batch No<span style="color:red"></span></label>
              <input type="text" class="form-control" name="batchno" id="batchno" value="">
            </div>
          </div>

          <div class="col-md-12">
            <table id="data_room" class="table table-bordered table-striped" style="text-transform: uppercase;">
              <tr>
                <th>SL.NO</th>
                <th>Product_Name</th>
                <th>Product_Code</th>
                <th>Total_qty_transfered</th>
              </tr>
            </table>
          </div>

        </div>
        <br> <br> <br>
        <div class="modal-footer">
        <a href="<?php echo base_url(); ?>ProductTransfer" class="btn btn-info"><i class="fa fa-plus-refresh"></i> Close</a>
<!--           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
 -->          <!--         <button type="submit" name="sub" class="btn btn-primary">SAVEhr</button>
 -->
        </div>
      </form>
    </div>
  </div>
</div>
