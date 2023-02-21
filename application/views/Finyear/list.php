
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #eef1f5;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        FinancialYear Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Finyear/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
        <li class="active">FinancialYear Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				
				
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>Finyear/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Year</a>
				</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="Finyear_table" class="table table-bordered table-striped" style="font-size:15px;color: #000;border: 1px solid #f0f0f0;">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>FinancialYear</th>
				  <th>Start Date</th>
				  <th>End Date</th>
                  <th style="text-align: center;">Edit/Delete</th>
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
   </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






