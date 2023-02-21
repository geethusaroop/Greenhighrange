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
        <li><a href="<?php echo base_url();?>Sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Sale Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		<div class="row">
            <div class="box-header">

              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->


				<div class="col-md-3">
					<div class="input-group margin">
						<div class="input-group-btn">
							<button type="button" class="btn btn-primary nohover">Item Number</button>
						</div><!-- /btn-group -->
					<input type="text"  class="form-control"  id="product"  placeholder="Product Number">
				</div><!-- /input-group -->
				</div>
			<div class="col-md-6">
				<div class="input-group margin">
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary nohover">Sale Date </button>
					</div><!-- /btn-group -->
						<input id="pmsDateStart" type="text" data-validation-optional="true" data-pms-max-date="today" data-pms-type="date" name="start_date" data-pms-date-to="pmsDateEnd" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
						<span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
						<input id="pmsDateEnd" type="text" data-validation-optional="true" data-pms-type="date" name="end_date" data-pms-date-from="pmsDateStart" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
						<span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
				</div>
			</div>
			<div class="col-sm-1">
					<div class="input-group">
						<button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
					</div>
			</div>
			  <!--<div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/sale/" class="btn btn-success"><i class="glyphicon glyphicon-user"></i>Sale List</a>
              </div>-->
            <div class="col-md-1">
				<div class="input-group margin">
					<a href="<?php echo base_url();?>Sale/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Sale</a>
				</div>
			</div>
            </div>
		</div>

            <!-- /.box-header -->
			<div class="row">
			<div class="box">
            <div class="box-body table-responsive">
              <table id="sale_details_table" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>SINO</th>
					<th>SALE DATE</th>
					<th>INVOICE</th>
					<th>CUSTOMER NAME</th>
					<th>TOTAL_QTY</th>
					<th>TOTAL_AMOUNT</th>
					<th>DISCOUNT</th>
					<th>NET_TOTAL</th>
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
