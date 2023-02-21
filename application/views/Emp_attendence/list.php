<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance Register
        <small id="date" class="col-md-4"></small>
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance Register</li>
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="form-group">
        <div class="col-md-3">
          <div class="input-group margin">
            <div class="input-group-btn">
              <button type="button" class="btn btn-primary nohover">Date</button>
            </div><!-- /btn-group -->
            <input type="date" required  placeholder="Date" class="form-control" id="date1" name="att_date" value="<?php echo date('d/m/Y') ?>">
            <div id="result" type="hidden"></div>
              
          </div><!-- /input-group --> 
        </div>
		<div class="col-md-4">
					<div class="input-group margin">
						
					</div><!-- /input-group -->
					
				</div>
      </div>
    </div>
    <div class="row">
      <div class="box">
        <div class="box-header">
          <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
          <div class="col-md-2"><h2 class="box-title"></h2> </div>
            
          <div class="col-md-2 pull-right">
            <div class="input-group margin">
                <div class="input-group-btn">
                </div><!-- /btn-group -->
               <!--<a href="<?php echo base_url();?>Attendance/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add New</a> -->
            </div><!-- /input-group -->
           </div>
            <div id="details"></div>
            <input type="hidden" id="option"/>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
        <input type="hidden" required  placeholder="Date" class="form-control" id="date1" name="att_date" value="<?php echo date('d/m/Y') ?>">
          <table id="attendence_table" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>SlNo.</th>
            <th>Employee Name</th>
            <th>Present</th>
            <th>Sick leave</th>
            <th>Half day leave</th>
          </tr>
          </thead>
          <tbody>
          </tbody>
          </table>
          <div class="modal-footer">
          <button type="button" onclick="submit()" id="update" class="btn btn-primary option">UPDATE</button>
          </div>
        </div>
        <!-- /.box-body -->
        
        </div>
      <!-- /.box -->
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

