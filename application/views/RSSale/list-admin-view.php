 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Details

        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sale Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		
            <div class="box-header">

				</div>

			<div class="row">
			<div class="box">
			<div class="row">
      <div class="col-md-2"></div>
					<div class="col-md-3">
						<div class="input-group margin">
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary nohover">Invoice Number</button>
							</div><!-- /btn-group -->
						<input type="text"  class="form-control"  id="product"  placeholder="Invoice Number">
					</div><!-- /input-group -->
					</div>

          <div class="col-md-3">
                <div class="input-group margin">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-primary nohover">Date</button>
                  </div><!-- /btn-group -->
                  <input type="date" name="sdate" placeholder="Date" id="sdate" class="form-control">
                </div><!-- /input-group -->
              </div>
			
					<div class="col-sm-2">
							<div class="input-group">
								<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>

							</div>
					</div>
			 
            </div>
            <div class="box-body table-responsive">
              <table id="sale_details_table" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>SINO</th>
					<th>SALE_DATE</th>
					<th>INVOICE</th>
					<th>CUSTOMER_NAME</th>
					<th>TOTAL_QTY</th>
					<th>SALE_AMOUNT</th>
					<th>OLD_BALANCE</th>
					<th>DISCOUNT</th>
					<th>SHAREHOLDER_DISCOUNT</th>
					<th>NET_TOTAL</th>
					<th>RECEIVED_AMOUNT</th>
					<th>NEW_BALANCE</th>
					<th>VIEW/INVOICE</th>
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
