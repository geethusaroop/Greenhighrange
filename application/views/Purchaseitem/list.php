



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Purchaseitem/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Purchase Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              
              <div class="row">
				<div class="col-md-3">
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover">Invoice No/Name</button>
						</div><!-- /btn-group -->
					<input type="text"  class="form-control"  id="product"  placeholder="" style="text-transform: uppercase;">
				</div><!-- /input-group -->
				</div>
				<div class="col-md-3">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">From Date </button>
					</div><!-- /btn-group -->
					<input type="date" class="form-control" id="pmsDateStart" name="start_date">
				</div>
			</div>

			<div class="col-md-3">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">To Date </button>
					</div><!-- /btn-group -->
					<input type="date" class="form-control" id="pmsDateEnd" name="end_date">
				</div>
			</div>
			<div class="col-sm-1">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
					</div>
			</div>
			 
            <div class="col-md-1">
				<div class="input-group margin">
        <a href="<?php echo base_url();?>Purchaseitem/add" class="btn btn-danger"><i class="fa fa-plus-square"></i>  Add Purchase</a>
				</div>
			</div>
            </div>
            
            
            
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
                <th>ITEM.COUNT</th>
                <th>TOTAL.PRICE</th>
                <!-- <th>RETURN</th> -->
                <th class="text-center">VIEW/INVOICE</th>
                <!-- <th>UPDATE.STOCK</th> -->
                <th class="text-center">ACTION</th>
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
