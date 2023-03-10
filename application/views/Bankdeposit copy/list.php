<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bank Deposit Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Bankdeposit/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
        <li class="active">  Bank Deposit Details</li>
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
                  <div class="col-md-8"></div>
             
              
              <div class="col-sm-2">
                  <div class="input-group">
                    <a href="<?php echo base_url();?>Bankdeposit/add" class="btn btn-danger"><i class="fa fa-plus-square"></i>  Add new</a>
                  </div>
              </div>
            </div>
              <table class="table table-bordered table-striped" id="receipt_list" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Date</th>
                  <th>Bank_Name</th>
                  <th>Deposit_Type</th>
                  <th>Member_Name</th>
                  <th>Deposit_Amount</th>
                  <th>Remark</th>
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






