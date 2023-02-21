<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance Form
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Attendancestaff/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Attendance Form</li>
      </ol>
    </section>

     <!-- Main content -->
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Attendancestaff/add"> 
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" id="att_staffid" name="att_staffid" value="<?php if(isset($records->att_staffid)) echo $records->att_staffid ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
              <div class="box-body">
			  <div class="row">
				<div class="form-group col-md-12">
				<div class="col-md-2">
					<label for="description" class="col-sm-2 control-label">Date</label>
					</div>
						<div class="col-sm-4">
							<input type="text" readonly placeholder="Date" class="form-control"  name="att_date" value="<?php date('d/m/Y') ?>">
						</div>
				</div>				
				<div class="form-group col-md-12">
				<div class="col-md-2">
					<label for="Staff Name">Staff Name</label>
					</div>
						<div class="col-md-4">
							<input type="hidden" id="staff_id_fk" value="<?php if(isset($records->staff_id_fk)) echo $records->staff_id_fk; ?>"/>
							<?php echo form_dropdown('staff_id', $staffnames, '', 'id="staff_name" class="form-control"  required data-pms-type="dropDown"', 'name="staff_id"');?>
						</div>	
				</div>
				<div class="form-group col-md-12">
				
					<div class="col-md-2">
					<label for="exampleInputEmail1">Attendance</label>
					</div>
					
					<div class="col-md-4">
					<select class="form-control" name="staff_attendance" id="staff_attendance">
					<option>----Please Select----</option>
					<option value="0">Absent</option>
					<option value="1">Half Day</option>
					<option value="2">Present</option>
					</select>
					</div>
                </div>
			</div>
			</div>
              
              <!-- /.box-body -->
            
          </div>
          <!-- /.box -->
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
        <!--/.col (right) -->
     </div>

    </section>
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


