 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Over Time Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Overtime/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Over Time Details Form</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Overtime/add">
     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="overtym_id" value="<?php if(isset($records->overtym_id)) echo $records->overtym_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
               <div class="col-lg-2"></div>
              <div class="col-lg-8">
             <div class="panel panel-danger">
                <div class="panel-heading">
                  <h3 class="panel-title"><b> OverTime Details Form</b></h3>
                </div>
                  <div class="panel-body" style="font-weight: bold;">
                <div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label">Employee Name</label>
					<div class="col-sm-4">
						<input type="hidden" id="design" value="<?php if(isset($records->emp_id_fk)) echo $records->emp_id_fk; ?>"/>
						<?php echo form_dropdown('emp_id', $emp_names, '', 'id="empname" class="form-control"  required data-pms-type="dropDown"', 'name="emp_id"');?>
					</div>
					<label for="description" class="col-sm-2 control-label">Date</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" required id="overtym_date" name="overtym_date" placeholder="date" value="<?php if(isset($records->overtym_date)) echo $records->overtym_date ?>">
					</div>
				</div>
				<div class="form-group">
          <label for="description" class="col-sm-2 control-label">Hours</label>
          <div class="col-sm-4">


    <!--         <input type="time" class="form-control" data-pms-required="true" id="overtym_hrs" name="overtym_hrs" placeholder="Hours" value="<?php if(isset($records->total_amount)) echo $records->total_amount ?>"> -->

            <select class="form-control" id="overtym_hrs" name="overtym_hrs">
              <option value="0">Select Hours</option>
              <option value="1">1 hr</option>
              <option value="2">2 hrs</option>
              <option value="3">3 hrs</option>
              <option value="4">4 hrs</option>
              <option value="5">5 hrs</option>
              <option value="6">6 hrs</option>
              <option value="7">7 hrs</option>
              <option value="8">8 hrs</option>
              <option value="9">9 hrs</option>
              <option value="10">10 hrs</option>
              <option value="11">11 hrs</option>
              <option value="12">12 hrs</option>
            </select>

          </div>
					<label for="description" class="col-sm-2 control-label">Amount</label>
					<div class="col-sm-4">
						<input type="text" class="form-control"  id="overtym_amt" name="overtym_amt" placeholder="Amount" value="<?php if(isset($records->total_amount)) echo $records->total_amount ?>">
					</div>
				</div>	
				<div class="form-group">
					
				</div>
            </div>
          </div></div></div>
              <!-- /.box-body -->
            <div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
			</div>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






