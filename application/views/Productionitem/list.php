<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Production Item- Transfer To Stock
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Productionitem/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
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
                    <button type="button" class="btn btn-primary nohover">Item</button>
                  </div><!-- /btn-group -->
                  <input type="text" name="item_names" placeholder="Item Name or Code" id="item_names" class="form-control">
                </div><!-- /input-group -->
              </div>
              <div class="col-sm-2">
                  <div class="input-group">
                    <button type="button" id="search" class="btn bg-orange btn-flat margin">Search</button>
                    <a href="<?php echo base_url(); ?>Productionitem/add" class="btn btn-danger"><i class="fa fa-plus-square"></i> Add </a>

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
                <th>PRODUCTION_UNIT</th>
                <th>PRODUCTION_DATE</th>
                <th>PRODUCT NAME</th>
                <th style="text-align: left;">PRODUCT_CODE</th>
                 <th>HSNCODE</th>
                 <th>TOTAL_ITEM_PRODUCED(QTY) </th>
               <!--  <th style="text-align: center;">
                  <center>EDIT/DELETE</center>
                </th> -->
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
