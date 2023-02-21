<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee Details
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Employee/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Employee Details</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				
				
				<div class="col-md-2 pull-right">
                  <a href="<?php echo base_url();?>Employee/add" class="btn btn-danger"><i class="fa fa-plus-square"></i>  Add New</a>
				</div>
				
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="customer_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.NO.</th>
                  <th>PHOTO</th>
                  <th> EMPLOYEE ID</th>
				  <th>NAME</th>
				  <th>BLOOD GROUP</th>
				  <th>DESIGNATION</th>
                  <th>ADDRESS</th>
				  <th>PHONE</th>
				  <th>PHONE 2</th>
                  <th>EMAIL</th>
                  <th>DOJ</th>
                  <th>BASIC SALARY</th>
				  <th>GOVT. ID</th>
				  <th>EDIT/DELETE</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		 <div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				<!-- Modal content-->
				<!-- <div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add New Trays</h4>
					</div>
				<div class="modal-body">
					<div class="row">
						<form method="post">
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-sm-4 control-label">Supplier Name</label>
									<div class="col-sm-6">
										<input type="hidden" id="cust_id_fk" value="<?php// if(isset($records->cust_id_fk)) echo $records->cust_id_fk; ?>"/>
										<?php //echo form_dropdown('cust_id', $cust_names,'', 'id="cust_id" class="form-control select2"  data-pms-required="true" data-pms-type="dropDown"', 'name="cust_id"');?>
									</div>
								</div><br></br>
								<div class="form-group">
									<label class="col-sm-4 control-label">No.of Trays</label>
									<div class="col-sm-6">
										<input type="text" required class="form-control"  id="no_trays" placeholder="No.of Trays">
									</div>
								</div><br></br>
								<div class="form-group">
									<label class="col-sm-4 control-label">Tray Size</label>
									<div class="col-sm-6">
										<select class="form-control"  id="tray_size">
											<option value="">---Please Select---</option>
											<option value="10">10</option>
											<option value="20">20</option>
											<option value="10S">10 Special</option>
											<option value="20S">20 Special</option>
											<option value="BB">BB</option>
										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div> -->
				
				<div class="modal-footer">
					<button type="submit" id="addtray" data-dismiss="modal" class="btn btn-default">Submit</button>
				</div>	
				</div>
			  </div>
			</div>
         
     </div>
	<div id="set_pvlg" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" onclick="sizemodalclose()" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Set username and password</h4>
			</div>
			<div class="form-group clearfix">
			</br>
				<div class="form-group">
				
					<div class="col-md-3">
					<label for="exampleInputEmail1">Choose Name</label>
					</div>
					
					<div class="col-md-7">
					<?php echo form_dropdown('emp_id', $emp_names, '', 'id="emp_id" class="form-control"  data-pms-required="true" data-pms-type="dropDown"', 'name="emp_id"');?>
					</div>
				</div></br></br>
				<div class="form-group">
				
					<div class="col-md-3">
					<label for="exampleInputEmail1">Username</label>
					</div>
					
					<div class="col-md-7">
					<input type="text"  class="form-control" id="username" placeholder="User Name">
					</div>
				</div></br></br>
				<div class="form-group">
				
					<div class="col-md-3">
					<label for="exampleInputEmail1">Password</label>
					</div>
					
					<div class="col-md-7">
					<input type="text"  class="form-control" id="password" placeholder="Password">
					</div>
					
				</div></br></br>
				<div class="form-group">
				
					<div class="col-md-3">
					<label for="exampleInputEmail1">Role</label>
					</div>
					
					<div class="col-md-7">
					<select class="form-control" name="user_type" id="user_type">
					<option>----Please Select----</option>
					<option value="S">Sales</option>
					</select>
					</div>
				</div>
			</div>
					
			<div class="modal-footer">
			<button type="button"  onclick="setpvlg()" class="btn btn-primary option" data-dismiss="modal">OK</button>
			</div>
			</div>
		</div>
	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
