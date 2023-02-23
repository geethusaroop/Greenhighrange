
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Return Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="<?php echo base_url();?>index.php/Purchase_Return/add"><i class="fa fa-dashboard"></i> Back to Add</a></li> -->
        <li class="active">Sale Return Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-2"><h2 class="box-title"></h2> </div>
              <div class="col-md-4">
                <div class="input-group margin">
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-primary nohover">Date </button>
                  </div><!-- /btn-group -->
                  <input id="pmsDateStart" type="text" data-validation-optional="true" data-pms-max-date="today" data-pms-type="date" name="start_date" data-pms-date-to="pmsDateEnd" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                  <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
                    
                  <input id="pmsDateEnd" type="text" data-validation-optional="true" data-pms-type="date" name="end_date" data-pms-date-from="pmsDateStart" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                  <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
                </div>
              </div>
              <div class="col-md-2">
                  <button type="button" class="btn btn-warning" id="search">SEARCH</button>
              </div>
			  
              <!-- <div class="col-md-2">
                  <a href="<?php echo base_url();?>Purchaseitem/p_return" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Purchase return</a>
              </div> -->
            </div>
            
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="purchase_details_table" class="table table-bordered table-striped">
                <thead>
                <tr>
					          <th>SINO</th>
					          <th>INVOICE</th>
					          <th>MEMBER NAME</th>
                    <th>RETURN QTY</th>
                    <th>RETURN AMT</th>
                    <th>DATE</th>
                    <th>ACTION</th>
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






