<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Director Details Information
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Direct_details/"><i class="fa fa-dashboard"></i> Back to List</a></li>
      <li class="active"></li>
    </ol>
  </section>
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>index.php/Direct_details/add" enctype="multipart/form-data">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box">
             <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
           
            <!-- /.box-header -->
            <!-- form start -->
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="d_details_id" value="<?php if (isset($records->d_details_id)) echo $records->d_details_id ?>" />
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
              <div class="col-lg-1"></div>
              <div class="col-lg-10">
                <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                  <div class="panel-heading">
                    <h3 class="panel-title"><b>DIRECTOR DETAILS INFORMATION</b></h3>
                  </div>
                  <div class="panel-body" style="font-weight:bold;">
                    <div class="form-group">
                      <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" autofocus class="form-control" name="name" value="<?php if (isset($records->d_details_name)) echo $records->d_details_name ?>" style="text-transform:uppercase;">
                      </div>

                      <div class="col-md-6">
                        <label>Designation</label>
                        <input type="text" autofocus class="form-control" name="d_details_designation" value="<?php if (isset($records->d_details_designation)) echo $records->d_details_designation ?>" style="text-transform:uppercase;">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-4">
                        <label for="">Date Of Birth</label>
                        <input type="date" class="form-control" name="dob" value="<?php if (isset($records->d_details_dob)) echo $records->d_details_dob ?>">
                      </div>

                      <div class="col-md-4">
                        <label>Phone <span style="color:red"></span></label>
                        <input type="text" autofocus class="form-control" name="phone" value="<?php if (isset($records->d_details_phone)) echo $records->d_details_phone ?>">
                      </div>

                      <div class="col-md-4">
                        <label>Email <span style="color:red"></span></label>
                        <input type="text" autofocus class="form-control" name="email" value="<?php if (isset($records->d_details_email)) echo $records->d_details_email ?>">
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <label>Address <span style="color:red"></span></label>
                        <textarea name="address" class="form-control" id="" cols="30" rows="1"><?php if (isset($records->d_details_address)) echo $records->d_details_address ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      
                      <div class="col-md-3">
                        <label>DIN <span style="color:red"></span></label>
                        <input type="text" autofocus class="form-control" name="din" value="<?php if (isset($records->d_details_din)) echo $records->d_details_din ?>">
                      </div>
                      <div class="col-md-3">
                        <label>Father Name <span style="color:red"></span></label>
                        <input type="text" autofocus class="form-control" name="father" value="<?php if (isset($records->d_details_father_name)) echo $records->d_details_father_name ?>">
                      </div>
                   
                      <div class="col-md-3">
                        <label>PAN <span style="color:red"></span></label>
                        <input type="text" autofocus class="form-control" name="pan" value="<?php if (isset($records->d_details_pan)) echo $records->d_details_pan ?>">
                      </div>
                      <div class="col-md-3">
                        <label>AADHAR NO<span style="color:red"></span></label>
                        <input type="text" autofocus class="form-control" name="aadhar" value="<?php if (isset($records->d_details_aadhaar)) echo $records->d_details_aadhaar ?>">
                      </div>
                      
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <label for="">Upload Photo</label>
                        <input type="hidden" name="photo1" id="" class="form-control" value="<?php if (isset($records->d_details_photo)) echo $records->d_details_photo ?>">
                        <input type="file" name="photo" id="" class="form-control">
                        <?php if (isset($records->d_details_photo)) { ?>
                          <img src="<?php echo base_url() ?>upload/director/<?php echo $records->d_details_photo ?>" alt="" height="20" width="20">
                        <?php } ?>
                      </div>
                      <div class="col-md-6">
                        <label for="">Upload Signature</label>
                        <input type="hidden" name="signature1" id="" class="form-control" value="<?php if (isset($records->d_details_signature)) echo $records->d_details_signature ?>">
                        <input type="file" name="signature" id="" class="form-control">
                        <?php if (isset($records->d_details_signature)) { ?>
                          <img src="<?php echo base_url() ?>upload/director/<?php echo $records->d_details_signature ?>" alt="" height="20" width="20">
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-4">
                <a href="<?php echo base_url(); ?>Direct_details"  <button type="button" class="btn btn-danger">Cancel</button></a>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
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