<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Vendor Details
      <small id="date" class="col-md-4"></small>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url(); ?>Vendor_master/"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Vendor Details</li>
    </ol>
  </section>
  <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Vendor_master/add">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">


            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />

            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="vendor_id" value="<?php if (isset($records->vendor_id)) echo $records->vendor_id ?>" />
              <?php echo validation_errors(); ?>
              <div class="box-body">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div class="panel panel-danger" style="box-shadow:2px 2px 2px 2px black;">
                    <div class="panel-heading">
                      <h3 class="panel-title"><b>VENDORS INFORMATION</b></h3>
                    </div>
                    <div class="panel-body" style="font-weight:bold;">
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>Name <span style="color:red"> *</span></label>
                          <input type="text" required class="form-control" name="vendorname" id="vendorname" value="<?php if (isset($records->vendorname)) echo $records->vendorname ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12">
                          <label>Address<span style="color:red"> *</span></label>
                          <textarea class="form-control" rows="1" name="vendoraddress"> <?php if (isset($records->vendoraddress)) echo $records->vendoraddress ?> </textarea>
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="col-md-6">
                          <label>Phone<span style="color:red"> *</span></label>
                          <input type="text" required class="form-control" name="vendorphone" id="vendorphone" value="<?php if (isset($records->vendorphone)) echo $records->vendorphone ?>">
                        </div>

                        <div class="col-md-6">
                          <label>Email<span style="color:red"> *</span></label>
                          <input type="text" required class="form-control" name="vendoremail" id="vendoremail" value="<?php if (isset($records->vendoremail)) echo $records->vendoremail ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label>GST<span style="color:red"> *</span></label>
                          <input type="text" required class="form-control" name="vendorgst" id="vendorgst" value="<?php if (isset($records->vendorgst)) echo $records->vendorgst ?>">
                        </div>

                        <div class="col-md-6">
                          <label>Old Balance<span style="color:red"> *</span></label>
                          <input type="text" required class="form-control" placeholder="Old Balance" name="vendor_oldbal" id="vendor_oldbal" value="<?php if (isset($records->vendor_oldbal)) echo $records->vendor_oldbal ?>">
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
                <a href="<?php echo base_url(); ?>Vendor_master"  <button type="button" class="btn btn-danger">Cancel</button></a>
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