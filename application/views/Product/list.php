<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php if($this->session->userdata['user_type'] == "A"){ ?>
      Products Information
      <?php } else{ ?>
        Stock From Master Branch
        <?php } ?>
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Product/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
      <li class="active"></li>
    </ol>
    <div class="row">
      <div class="col-md-3">
        <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Item</button>
          </div><!-- /btn-group -->
          <input type="text" name="item_names" placeholder="Item Name or Code" id="item_names" class="form-control">
        </div><!-- /input-group -->
      </div>
      <div class="col-sm-1">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin">Search</button>
					</div>
			</div>
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
        <div class="box-header">
          <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
          <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
          <div class="col-md-8">
            <h2 class="box-title"></h2>
          </div>
          <?php if($this->session->userdata['user_type'] == "A"){ ?>
          <div class="col-md-4">
           
            <a href="<?php echo base_url(); ?>Product/add" class="btn btn-danger"><i class="fa fa-plus-square"></i> Add Products</a>

            &nbsp; <a href="<?php echo base_url(); ?>Product/addExcelProduct" class="btn btn-info"><i class="fa fa-plus-square"></i> Import Excel</a>

          </div>
          <?php } ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="classinfo_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SINO</th>
                <th>ITEM NAME</th>
                <th style="text-align: left;">ITEM CODE</th>
                 <th>HSNCODE</th>
                 <th>OPENING_STOCK</th>
                 <th>CURRENT_STOCK</th>
                <th style="text-align: center;">ITEM UNIT</th>
              
                <th style="text-align: center;">
                  <center>EDIT/DELETE</center>
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
