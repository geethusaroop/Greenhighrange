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
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Employee/"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Employee Details</li>
    </ol>
  </section>
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Employee/add" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">

            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />

            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="emp_id" value="<?php if (isset($records->emp_id)) echo $records->emp_id ?>" />
              <?php echo validation_errors(); ?>
              <div class="box-body">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="panel panel-danger">
                    <div class="panel-heading">
                      <h3 class="panel-title"><b>EMPLOYEE DETAILS</b></h3>
                    </div>
                    <div class="panel-body" style="font-weight: bold;">
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Employee ID <span style="color:red">*</span></label>
                          <input type="text" data-pms-required="true" class="form-control" name="emp_eid" id="emp_eid" value="<?php if (isset($records->emp_eid)) echo $records->emp_eid ?>">
                        </div>

                        <div class="col-md-6">
                          <label>Name <span style="color:red">*</span></label>
                          <input type="text" data-pms-required="true" class="form-control" name="emp_name" id="emp_name" value="<?php if (isset($records->emp_name)) echo $records->emp_name ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Designation <span style="color:red">*</span></label>
                          <input type="text" data-pms-required="true" class="form-control" name="emp_designation" id="emp_designation" value="<?php if (isset($records->emp_designation)) echo $records->emp_designation ?>">
                        </div>

                        <div class="col-md-6">
                          <label>Address<span style="color:red">*</span></label>
                          <textarea data-pms-type="address" class="form-control" name="emp_address"><?php if (isset($records->emp_address)) echo $records->emp_address ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Phone</label>
                          <input type="text" class="form-control" name="emp_phone" id="emp_phone" value="<?php if (isset($records->emp_phone)) echo $records->emp_phone ?>">
                        </div>

                        <div class="col-md-6">
                          <label>Phone 2</label>
                          <input type="text" class="form-control" name="emp_phone2" id="emp_phone" value="<?php if (isset($records->emp_phone2)) echo $records->emp_phone2 ?>">
                        </div>


                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label for="">Blood Group</label>
                          <select name="emp_blood_grp" class="form-control" id="">
                            <option value="">SELECT</option>
                            <option value="1">A+</option>
                            <option value="2">A-</option>
                            <option value="3">B+</option>
                            <option value="4">B-</option>
                            <option value="5">O+</option>
                            <option value="6">O-</option>
                            <option value="7">AB+</option>
                            <option value="8">AB-</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label>Email</label>
                          <input type="text" class="form-control" name="emp_email" id="emp_email" value="<?php if (isset($records->emp_email)) echo $records->emp_email ?>">
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="col-md-6">
                          <label>DOJ</label>
                          <input type="text" class="form-control" name="emp_doj" id="emp_doj" value="<?php if (isset($records->emp_doj)) echo $records->emp_doj ?>">
                        </div>


                        <div class="col-md-6">
                          <label>Basic Salary</label>
                          <input type="text" class="form-control" name="emp_sal" id="emp_sal" value="<?php if (isset($records->emp_sal)) echo $records->emp_sal ?>">
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="col-md-6">
                          <label>Employee Image<span style="color:red"></span></label>

                          <input type="hidden" name="emp_img1" value="<?php if (isset($records->emp_img)) echo $records->emp_img ?>" />
                          <input type="file" id="fileupload" onclick="hide()" name="emp_img" class="form-control" />
                        </div>

                        <div class="col-md-6">
                          <label>Employee Government ID(ANY ONE)<span style="color:red"></span></label>
                          <input type="hidden" name="emp_govt_img1" value="<?php if (isset($records->emp_govt_id)) echo $records->emp_govt_id ?>" />
                          <input type="file" id="fileupload" onclick="hide()" name="emp_govt_img" class="form-control" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->


                </div>
              </div>
            </div>
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

        <!-- /.col -->
      </div>

    </section>

  </form>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->