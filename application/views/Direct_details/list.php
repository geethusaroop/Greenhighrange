<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Director Details Information
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Direct_details/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
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
          <div class="col-md-8">
            <h2 class="box-title"></h2>
          </div>
          <div class="col-md-2">
            <a href="<?php echo base_url(); ?>Direct_details/add" class="btn btn-danger"><i class="fa fa-plus-square"></i> Add Director Details</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="direct_table" class="table table-bordered table-striped" style="color:black;">
            <thead>
              <tr>
                <th>SINO</th>
                <th>NAME</th>
                <th>DESIGNATION</th>
                <th>PHOTO</th>
                <th>SIGANTURE</th>
                <th>FATHER NAME</th>
                <th>DATE OF BIRTH</th>
                <th>ADDRESS</th>
                <th>EMAIL</th>
                <th>PHONE</th>
                <th>PAN</th>
                <th>AADHAR</th>
                <th>DIN</th>
                <th>
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