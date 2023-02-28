<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fund Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Voucherhead/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
        <li class="active">  Fund Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->				
			
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
            <div class="row">
                  <div class="col-md-4"></div>
             
              <div class="col-md-3">
                <div class="input-group margin">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-primary nohover">FUND TYPE</button>
                  </div><!-- /btn-group -->
                  <select name="cat_type" id="cat_type" class="form-control" style="font-weight: bold;">
							<option value="">-SELECT-</option>
							<?php foreach($ftype as $row){ ?>
								<option value="<?php echo $row->ftype_id; ?>"><?php echo $row->ftype_name; ?></option>
							<?php } ?>
						</select>
                </div><!-- /input-group -->
              </div>
              <div class="col-sm-2">
                  <div class="input-group">
                    <button type="button" id="search" class="btn bg-orange btn-flat margin">Search</button>
                    <a href="<?php echo base_url();?>Fund/add" class="btn btn-danger"><i class="fa fa-plus-square"></i>  Add new</a>
                  </div>
              </div>
            </div>
              <table class="table table-bordered table-striped" id="receipt_list" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Date</th>
                  <th>Fund_type</th>
                  <th>Amount</th>
                  <th>Description</th>
                  <th class="text-center">Edit/Delete</th>
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






