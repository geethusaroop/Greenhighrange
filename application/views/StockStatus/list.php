<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Stock Status
      <small id="date" class="col-md-4"></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>StockStatus"><i class="fa fa-dashboard"></i> Back To List</a></li>
      <li class="active"></li>
    </ol>
  </section>
  <!-- Main content -->
  <div class="row">
    <div class="box">
      <div class="box-header">
        <!-- <button type="button" class="btn btn-primary" name="button">Add allotment</button> -->
        <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
        <div class="">
          <div class="box-body table-responsive">
            <table id="distributionTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-transform: uppercase;">Sl.No</th>
                  <th style="text-transform: uppercase;">Product Name</th>
                  <th style="text-transform: uppercase;">Product Code</th>
                  <th style="text-transform: uppercase;">Current Stock</th>
                  <th style="text-transform: uppercase;text-align:center;">Stock History</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>