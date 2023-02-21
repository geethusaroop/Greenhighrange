



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Return Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>/Purchaseitem/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Purchase Return Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="box">
            <div class="box-header">
              <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="purchase_details_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>SINO</th>
                <th>INVOICE</th>
                <th>SUPPLIER.NAME</th>
                <th>PURCHASE.DATE</th>
                <th>PRODUCT NAME</th>
                <th>RETURN COUNT</th>
                <th>RETURN DATE</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
        </div>
	</div>
   </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
