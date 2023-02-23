<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Branch Stock Details
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
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
            <button type="button" class="btn btn-primary nohover">Branch</button>
          </div><!-- /btn-group -->
          <select class="form-control" name="branch" id="branch">
                          <option value="">SELECT</option>
                          <?php foreach($branch as $br){ ?>
                            <option value="<?php echo $br->branch_id ?>"><?php echo $br->branch_name ?></option>
                          <?php } ?>  
                         </select>
        </div><!-- /input-group -->
      </div>
      <div class="col-sm-1">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin">Search</button>
					</div>
			</div>
    </div>
         
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="classinfo_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SINO</th>
                <th>BRANCH NAME</th>
                <th>PRODUCT NAME</th>
                <th style="text-align: left;">PRODUCT_CODE</th>
                 <th>HSNCODE</th>
                 <th>AVAILABLE_STOCK</th>
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
