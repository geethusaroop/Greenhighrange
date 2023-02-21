 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Advance Payment Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Advancepayments/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Advance Payment Form</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/Advancepayments/add">
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
					<input type="hidden" name="adv_id" value="<?php if(isset($records->adv_id)) echo $records->adv_id ?>"/>
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
               <div class="col-lg-2"></div>
              <div class="col-lg-8">
             <div class="panel panel-danger">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Advance Payments</b></h3>
                </div>
                  <div class="panel-body" style="font-weight: bold;">
                <div class="form-group">
					<label for="customer_email" class="col-sm-2 control-label">Employee Name</label>
					<div class="col-sm-4">
						<input type="hidden" id="design" value="<?php if(isset($records->emp_id_fk)) echo $records->emp_id_fk; ?>"/>
						<?php echo form_dropdown('emp_id', $emp_names, '', 'id="empname" class="form-control"  data-pms-required="true" data-pms-type="dropDown"', 'name="emp_id"');?>
					</div>
					<label for="size_name" class="col-sm-2 control-label">Basic Salary</label>
							<div class="col-sm-4">
								<input type="text" readonly placeholder="Basic Salary" id="basic_sal" name="basic_sal" class="form-control" >
							</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Amount</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" required id="adv_amt" placeholder="Amount" name="adv_amt" value="<?php if(isset($records->adv_amount)) echo $records->adv_amount ?>">
					</div>
					<label for="description" class="col-sm-2 control-label">Date</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" required id="adv_date" name="adv_date" placeholder="date" value="<?php if(isset($records->overtym_date)) echo $records->overtym_date ?>">
          </div>
				</div>	

        <div class="form-group">
          
		  <label for="description" class="col-sm-2 control-label">Remaing Balance</label>
          <div class="col-sm-4">
								<input type="text"  id="total_sal" name="total_sal" class="form-control" >
							</div>
        </div>


            </div>
          </div></div></div>
              <!-- /.box-body -->
            <div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
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






