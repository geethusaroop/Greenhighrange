<style type="text/css">
  .fsize {
    font-size: 14px;
    font-family: 'Rubik', sans-serif;
  }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/webcam.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #eef1f5;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Employee Login
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Employee_login"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active">Employee Login</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info container">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Employee_login/add" enctype="multipart/form-data">
            <div class="row">
              <!--  Personal Info -->
              <div class="col-lg-1"></div>
              <div class="col-lg-10">
                <div class="panel panel-default" style="box-shadow:2px 2px 2px 2px black;">
                  <div class="panel-heading">
                    <b>Employee Details </b>
                  </div>
                  <div class="panel-body">
                    <!-- radio -->
                    <div class="form-group">
                      <input type="hidden" id="id" name="id" value="<?php if (isset($records->id)) echo $records->id ?>" />
                      <?php echo validation_errors(); ?>
                      <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="size_name" class="col-md-3 control-label fsize">Employee Name<span style="color:red">*</span></label>
                        <div class="col-md-3">
                          <select name="emp_id" id="emp_id" class="form-control">
                            <option value="">SELECT</option>
                            <?php foreach($employee as $emp){ ?>
                              <option <?php if (isset($records->emp_id) && $records->emp_id == $emp->emp_id) echo "selected" ?> value="<?php echo $emp->emp_id ?>"><?php echo $emp->emp_fname.' '.$emp->emp_lname ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="size_name" class="col-md-3 control-label fsize">Designation<span style="color:red">*</span></label>
                        <div class="col-md-3">
                        <input type="hidden" name="emp_designation" id="emp_designation" class="form-control">
                        <input type="text" name="emp_designation1" id="emp_designation1" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="size_name" class="col-md-3 control-label fsize">User Name <span style="color:red">*</span></label>
                        <div class="col-md-3">
                          <input type="text" data-pms-required="true" class="form-control fsize" name="user_name" id="user_name" placeholder="User Name" value="<?php if (isset($records->user_name)) echo $records->user_name ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="size_name" class="col-md-3 control-label fsize">Password <span style="color:red">*</span></label>
                        <div class="col-md-3">
                          <input type="text" data-pms-required="true" class="form-control fsize" name="admin_password" id="admin_password" placeholder="Password" value="<?php if (isset($records->admin_password)) echo $records->admin_password ?>">
                        </div>
                      </div>
                      <br>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" align="right">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <button type="reset" class="btn btn-danger">Cancel</button>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->