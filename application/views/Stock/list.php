<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Stock Details
      <small id="date" class="col-md-4"></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Stock"><i class="fa fa-dashboard"></i> Back To List</a></li>
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
            <table id="distributionTable" class="table table-bordered table-striped" style="color:black;font-size:14px;">
              <thead>
                <tr>
                  <th>Sl.No</th>
                  <th>Production Unit</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Opening Stock</th>
                  <!-- <th>Branch Transfer</th> -->
                  <!-- <th>Sold</th> -->
                  <th>Current Stock/Balance</th>
                  <th>R1 Price</th>
                  <th>R2 Price</th>
                  <th>R3 Price</th>
                  <th>Updated at</th>
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